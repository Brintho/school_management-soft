@php
    $package = App\Models\Package::findOrFail($id);
@endphp

<form action="{{ route('package.update', $package->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <x-input type="text" class="mb-3" label="{{ translate('Title') }}" name="title" required
        value="{{ $package->title ?? '' }}" />
    <x-input type="text" class="mb-3" label="{{ translate('Sub Title') }}" name="sub_title" required
        value="{{ $package->sub_title ?? '' }}" />
    <x-textarea class="mb-3" label="{{ translate('Description') }}" name="description"
        value="{{ $package->description ?? '' }}" required></x-textarea>
    <x-input type="number" step="0.01" class="mb-3" label="{{ translate('Price') }}" name="price" required
        value="{{ $package->price ?? '' }}" />
    <x-input type="number" step="0.01" class="mb-3" label="{{ translate('Discount') }}" name="discount"
        value="{{ $package->discount ?? '' }}" />
    <x-input type="file" class="mb-3" label="{{ translate('Icon') }}" name="icon" />
    <x-input type="text" class="mb-3" label="{{ translate('Type') }}" name="type" required
        value="{{ $package->type ?? '' }}" />
    <x-input type="number" class="mb-3" label="{{ translate('Order') }}" name="order"
        value="{{ $package->order ?? '' }}" />

    <x-select label="{{ translate('Period') }}" name="period" required :options="[
        'monthly' => translate('Monthly'),
        'yearly' => translate('Yearly'),
        'lifetime' => translate('Life Time'),
    ]"
        data-value="{{ $package->period }}" />
    <x-select name="status" label="{{ translate('Status') }}" required :options="['1' => 'Active', '0' => 'Inactive']"
        data-value="{{ $package->status }}" />
    <button type="submit" class="btn btn-dark rounded-6">
        <span class="fs-12 fw-500">{{ translate('Update') }}</span>
    </button>
</form>

@include('core::modal')
