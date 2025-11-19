<?php

namespace App\Services;

use DOMDocument;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class DomContent
{
    // to upload images from editor
    public static function processContent($html, $path = null, bool $addHeadingIds = false): ?string
    {
        if (! $html) {
            return null;
        }

        self::ensureDirectoryExists($path);
        $dom = self::createDOM($html);

        self::processImages($dom, $path);

        if ($addHeadingIds) {
            self::addHeadingIds($dom);
        }

        return $dom->saveHTML();
    }

    public static function extractHeadings($html): array
    {
        if (! $html) {
            return [];
        }

        $dom        = self::createDOM($html);
        $headingIds = [];

        foreach (['h1', 'h2', 'h3', 'h4', 'h5', 'h6'] as $tag) {
            foreach ($dom->getElementsByTagName($tag) as $heading) {
                if ($heading->hasAttribute('id')) {
                    $headingIds[] = [
                        'id'   => "#" . trim($heading->getAttribute('id')),
                        'text' => trim(preg_replace("/\r|\n/", "", strip_tags($heading->textContent))),
                    ];
                }
            }
        }

        return $headingIds;
    }

    public static function fixImagePaths($html): ?string
    {
        if (! $html) {
            return null;
        }

        $dom    = self::createDOM($html);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $img) {
            $filename = basename($img->getAttribute('src'));
            $fullPath = self::searchFileInAssets($filename);

            if ($fullPath) {
                $relativePath = str_replace(public_path(), '', $fullPath);
                $img->setAttribute('src', asset(trim(str_replace('\\', '/', $relativePath), '/')));
            }
        }

        return $dom->saveHTML();
    }

    public static function updateDocImgPath($html): ?string
    {
        if (! $html) {
            return null;
        }

        $dom    = self::createDOM($html);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $img) {
            $src = $img->getAttribute('src');

            if (! $src) {
                continue;
            }

            $parts = explode('documentation/', $src);
            if (isset($parts[1])) {
                $img->setAttribute('src', asset("upload/articles/{$parts[1]}"));
            }
        }

        return $dom->saveHTML();
    }

    // helpers functions
    private static function createDOM($html): DOMDocument
    {
        $html = self::removeSourceSet($html);

        libxml_use_internal_errors(true);
        $dom = new DOMDocument();
        $dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();
        return $dom;
    }

    private static function ensureDirectoryExists($path): void
    {
        $directory = public_path("upload/{$path}");

        if (! File::isDirectory($directory)) {
            File::makeDirectory($directory, 0755, true, true);
        }
    }

    private static function getImageExtension($src): string
    {
        $mime      = explode(';', $src)[0];
        $extension = explode('/', $mime)[1];
        return $extension === 'svg+xml' ? 'svg' : $extension;
    }

    private static function processImages(DOMDocument $dom, $path): void
    {
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $image) {
            $src = $image->getAttribute('src');

            if (strpos($src, 'data:image') === 0) {
                $extension = self::getImageExtension($src);
                $data      = base64_decode(explode(',', $src)[1]);

                if ($data === false) {
                    abort(422, 'Invalid image data');
                }

                $imgName = "upload/{$path}/" . Str::random(20) . ".{$extension}";
                file_put_contents(public_path($imgName), $data);
                $image->setAttribute('src', $imgName);
            }
        }
    }

    public static function addHeadingIds(\DOMDocument $dom): void
    {
        $usedIds = [];

        foreach (['h1', 'h2', 'h3', 'h4', 'h5', 'h6'] as $tag) {
            foreach ($dom->getElementsByTagName($tag) as $heading) {
                if ($heading->hasAttribute('id')) {
                    continue;
                }

                if ($heading->childNodes->length !== 1) {
                    continue;
                }

                $child = $heading->firstChild;
                if (! in_array($child->nodeName, ['#text', 'span', 'b'])) {
                    continue;
                }

                // Get clean text
                $text = trim($heading->textContent);
                if (empty($text)) {
                    continue;
                }

                $baseSlug = Str::slug($text);
                $slug     = $baseSlug;
                $i        = 2;

                while (in_array($slug, $usedIds)) {
                    $slug = $baseSlug . '-' . $i++;
                }

                $usedIds[] = $slug;
                $heading->setAttribute('id', $slug);
            }
        }
    }

    private static function searchFileInAssets($filename): ?string
    {
        $directory = public_path('assets');
        $iterator  = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));

        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getFilename() === $filename) {
                return $file->getPathname();
            }
        }

        return null;
    }

    public static function removeSourceSet($content)
    {
        return $content ? preg_replace('/\s*srcset="[^"]*"/i', '', $content) : null;
    }
}
