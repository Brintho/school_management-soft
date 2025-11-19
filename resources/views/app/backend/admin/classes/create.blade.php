<form action="{{ route('classes.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <x-input type="text" class="mb-3" label="{{ translate('Name') }}" name="name" required />
    {{-- <x-input type="number" class="mb-3" label="{{ translate('Class Code') }}" name="class_code" /> --}}
    <div class=" mb-3">
        <label class="form-label required">{{ translate('Class Code') }}</label>
        <div class="input-group">
            <input type="text" name="class_code" id="code-generate" class="form-control" autocomplete="off" required>

            <button type="button" class="btn btn-dark" onclick="generateCode()">
                Generate
            </button>
        </div>
    </div>
    <x-input type="number" class="mb-3" label="{{ translate('Capacity') }}" name="capacity" />
    <x-textarea class="mb-3" label="{{ translate('Description') }}" name="description" />
    <x-select class="mb-3" name="status" label="{{ translate('Status') }}" :options="['1' => 'Active', '0' => 'Inactive']" required />

    <button type="submit" class="btn btn-dark rounded-6">{{ translate('Save') }}</button>

</form>

@include('core::modal')
