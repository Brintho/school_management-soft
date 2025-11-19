@props([
    'editUrl' => '#',
    'deleteUrl' => '#',
    'confirmText' => 'Are you sure?',
])

<div class="action-icon">
    <i class="fi fi-rr-menu-dots-vertical " id="icon"></i>
    <div class="hover-actions ">
        <a href="{{ $editUrl }}" data-modal="r-canvas">Edit</a>
        <faction="{{ $deleteUrl }}" data-modal="delete" method="POST" onsubmit="return confirm('{{ $confirmText }}')">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("icon").click(function() {
            $("hover-actions").toggle();
        });
    });
</script>
