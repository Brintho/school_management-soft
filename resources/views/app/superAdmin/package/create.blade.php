<form action="{{ route('package.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <x-input type="text" class="mb-3" label="{{ translate('Title') }}" name="title" required />
    <x-input type="text" class="mb-3" label="{{ translate('Sub Title') }}" name="sub_title" required />
    <x-textarea class="mb-3" label="{{ translate('Description') }}" name="description" />
    <x-input type="number" step="0.01" class="mb-3" label="{{ translate('Price') }}" name="price" required />
    <x-input type="number" step="0.01" class="mb-3" label="{{ translate('Discount') }}" name="discount" />
    <x-input type="file" class="mb-3" label="{{ translate('Icon') }}" name="icon" />
    <x-input type="text" class="mb-3" label="{{ translate('Type') }}" name="type" required />
    <x-input type="number" class="mb-3" label="{{ translate('Order') }}" name="order" />
    <x-select label="{{ translate('Period') }}" name="period" required :options="[
        'monthly' => translate('Monthly'),
        'yearly' => translate('Yearly'),
        'lifetime' => translate('Life Time'),
    ]" />
    <x-select name="status" label="{{ translate('Status') }}" required :options="['1' => 'Active', '0' => 'Inactive']" />
    <button type="submit" class="btn btn-dark rounded-6">{{ translate('Save') }}</button>

</form>
@include('core.initJs')
