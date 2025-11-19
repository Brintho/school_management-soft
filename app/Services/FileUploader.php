<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class FileUploader
{
    public static function upload($file, $path, $width = 500, $height = 500)
    {
        if (! $file) {
            return null;
        }

        // If it's a remote image URL
        if (filter_var($file, FILTER_VALIDATE_URL)) {
            $response = Http::get($file);
            if (! $response->successful()) {
                return null;
            }

            $extension = pathinfo(parse_url($file, PHP_URL_PATH), PATHINFO_EXTENSION);
            $extension = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp'])
            ? $extension
            : 'jpg';

            $tempPath = storage_path('app/temp_' . Str::random(10) . '.' . $extension);
            File::put($tempPath, $response->body());
            $file = new \Illuminate\Http\File($tempPath);
        }

        if (! $file || ! is_file($file)) {
            return null;
        }

        // Upload directory
        $upload_path      = "storage/{$path}";
        $full_upload_path = public_path($upload_path);

        if (! is_dir($full_upload_path)) {
            File::makeDirectory($full_upload_path, 0777, true, true);
        }

        $file_name = Str::random(20);
        $extension = strtolower($file->extension());
        $file_name = "{$file_name}.{$extension}";

        // File type groups
        $video_extensions = ['mp4', 'mov', 'avi', 'wmv', 'flv', 'mkv', 'webm', '3gp', 'mpeg'];
        $image_extensions = ['jpeg', 'jpg', 'png', 'gif', 'bmp', 'svg', 'webp'];
        $doc_extensions   = ['pdf', 'doc', 'docx', 'txt'];

        // Handle image upload
        if (in_array($extension, $image_extensions)) {
            try {
                $image_manager = new ImageManager(new Driver());
                $image         = $image_manager->read($file);

                // Resize proportionally by width
                $image->scale(width: $width);

                $image->save("{$full_upload_path}/{$file_name}");
            } catch (\Exception $e) {
                return null; // If reading or saving image fails
            }

        } elseif (in_array($extension, $doc_extensions) || in_array($extension, $video_extensions)) {
            // Handle docs/videos
            $file->move(public_path($upload_path), $file_name);
        } else {
            return false;
        }

        return "{$path}/{$file_name}";
    }
}
