@php
    $class = App\Models\Classes::school()->findOrFail($id);
@endphp
<form action="{{ route('classes.update', $class->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <x-input type="text" class="mb-3" label="{{ translate('Name') }}" name="name" required value="{{ $class->name }}" />
    <div class="input-field mb-3">
        <label class="form-label required">{{ translate('Code') }}</label>
        <div class="input-group">
            <input type="text" name="class_code" id="code-generate" class="form-control" value="{{ $class->class_code }}" autocomplete="off" required>

            <button type="button" class="btn btn-dark" onclick="generateCode()">
                Generate
            </button>
        </div>
    </div>
    <x-input type="number" class="mb-3" label="{{ translate('Capacity') }}" name="capacity" value="{{ $class->capacity }}" />

    <x-textarea class="mb-3" label="{{ translate('Description') }}" name="description" value="{{ $class->description }}">{{ $class->description }}</x-textarea>

    <x-select class="mb-3" name="status" label="{{ translate('Status') }}" :options="['1' => 'Active', '0' => 'Inactive']" required data-value="{{ $class->status }}" />
    <button type="submit" class="btn btn-dark rounded-6">{{ translate('Save') }}</button>

</form>


@include('core::modal')
