@php
    $classes = App\Models\Classes::where('status', 1)->get();

@endphp

<form action="{{ route('sections.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <x-input label="{{ translate('Full Name') }}" name="name" type="text" required />
    <x-select label="{{ translate('Class') }}" name="class_id" :options="$classes->pluck('name', 'id')" required />
    <button type="submit" class="btn btn-dark rounded-6">{{ translate('Save') }}</button>

</form>

@include('core::modal')
