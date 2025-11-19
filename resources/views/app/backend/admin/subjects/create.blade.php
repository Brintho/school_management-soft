@php
    $classes = App\Models\Classes::where('status', 1)->get();
@endphp

<form action="{{ route('subjects.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <x-select name="class_id" label="{{ translate('Select Class') }}" :options="$classes->pluck('name', 'id')" required />
    <x-input name="name" label="{{ translate('Subject Name') }}" required />
    <x-input type="number" name="marks" label="{{ translate('Marks') }}" required />
    <x-select name="category" label="{{ translate('Category') }}" :options="['compulsory' => translate('Compulsory'), 'optional' => translate('Optional')]" required />
    <x-select name="status" label="{{ translate('Status') }}" required :options="['1' => 'Active', '0' => 'Inactive']" />

    <button type="submit" class="btn btn-dark rounded-6">{{ translate('Save') }}</button>
    {{-- <x-select name="status" label="{{ translate('Status') }}" required :options="['1' => 'Active', '0' => 'Inactive']" /> --}}

</form>

@include('core::modal')
