<form action="{{ route('shifts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <x-input class="mb-3" :label="translate('Title')" :type="'text'" :id="'name'" :name="'name'" required />
    <x-select name="status" label="{{ translate('Status') }}" :options="['1' => translate('Active'), '0' => translate('Inactive')]" required />

    <button type="submit" class="btn btn-dark rounded-6">{{ translate('Save') }}</button>

</form>

@include('core::modal')
