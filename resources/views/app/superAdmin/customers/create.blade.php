<form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="input-field mb-3">
        <label for="name" class="form-label fw-500 text-secondary">{{ translate('Full Name') }}</label>
        <input type="text" id="name" name="name" class="form-control" required>
    </div>

    <div class="input-field mb-3">
        <label for="email" class="form-label fw-500 text-secondary">{{ translate('Email') }}</label>
        <input type="email" id="email" name="email" class="form-control" required>
    </div>

    <div class="input-field mb-3">
        <label for="phone" class="form-label fw-500 text-secondary">{{ translate('Phone') }}</label>
        <input type="number" id="phone" name="phone" class="form-control" required>
    </div>
    <div class="input-field mb-3">
        <label for="address" class="form-label fw-500 text-secondary">{{ translate('Address') }}</label>
        <input type="text" id="address" name="address" class="form-control" required>
    </div>

    <div class="input-field mb-3">
        <label for="password" class="form-label fw-500 text-secondary">{{ translate('Password') }}</label>
        <input type="password" id="password" name="password" class="form-control" required>
    </div>
    <div class="input-field mb-3 ">
        <label class="form-label fw-500 text-secondary">{{ translate('Photo') }}</label>
        <input type="file" name="photo" class="form-control" multiple>
    </div>


    <button type="submit" class="btn btn-dark rounded-6">{{ translate('Save') }}</button>

</form>

@include('core::modal')
