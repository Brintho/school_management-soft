@php
    $customers = App\Models\Customer::findOrFail($id);
@endphp

<form action="{{ route('customers.update', $customers->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="input-field mb-3">
        <label for="name" class="form-label fw-500 text-secondary">{{ translate('Full Name') }}</label>
        <input type="text" id="name" name="name" value="{{ $customers->name }}" class="form-control" required>
    </div>

    <div class="input-field mb-3">
        <label for="email" class="form-label fw-500 text-secondary">{{ translate('Email') }}</label>
        <input type="email" id="email" name="email" value="{{ $customers->email }}" class="form-control"
            required>
    </div>

    <div class="input-field mb-3">
        <label for="phone" class="form-label fw-500 text-secondary">{{ translate('phone') }}</label>
        <input type="tel" id="phone" name="phone" value="{{ $customers->phone }}" class="form-control"
            required>
    </div>

    <div class="input-field mb-3">
        <label for="address" class="form-label fw-500 text-secondary">{{ translate('Address') }}</label>
        <input type="text" id="address" name="address" value="{{ $customers->address }}" class="form-control"
            required>
    </div>
    <div class="input-field mb-3 ">
        <label class="form-label fw-500 text-secondary">{{ translate('Photo') }}</label>
        <input type="file" name="photo" class="form-control" multiple>
    </div>

    <button type="submit" class="btn btn-dark rounded-6">{{ translate('Save') }}</button>

</form>


@include('core::modal')
