@php
    $classes = App\Models\Classes::where('status', 1)->get();
    $section = App\Models\Section::findOrFail($id);
@endphp

<form action="{{ route('sections.update', $section->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <x-input label="{{ translate('Full Name') }}" name="name" type="text" value="{{ $section->name }}" required />
    <x-select label="{{ translate('Class') }}" name="class_id" :options="$classes->pluck('name', 'id')" data-value="{{ $section->class_id }}"
        required />
    <button type="submit" class="btn btn-dark rounded-6">{{ translate('Save') }}</button>

</form>


@include('core::modal')
