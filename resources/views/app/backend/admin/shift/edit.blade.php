@php
    $shift = App\Models\Shift::findOrFail($id);
@endphp
<form action="{{ route('shifts.update', $shift->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <x-input class="mb-3" :label="translate('Title')" :type="'text'" :id="'name'" :name="'name'" :value="$shift->name"
        required />
    <x-select name="status" label="{{ translate('Status') }}" :options="['1' => translate('Active'), '0' => translate('Inactive')]" :data-value="$shift->status" required />

    <button type="submit" class="btn btn-dark rounded-6">{{ translate('Save') }}</button>

</form>

@include('core::modal')
