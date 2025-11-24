<form action="{{ route('subscription.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="input-field mb-3">
        <input type="hidden" id="package_id" name="package_id" value="{{ $package->id }}">
        <input type="hidden" id="customer_id" name="customer_id" value="{{ $customer->id }}">

    </div>

    <div class="input-field mb-3">
        <label for="issue" class="form-label fw-500 text-secondary">{{ translate('Issue') }}</label>
        <input type="date" id="issue" name="issue" class="form-control" required>
    </div>

    <div class="input-field mb-3">
        <label for="expiry" class="form-label fw-500 text-secondary">{{ translate('Expiry') }}</label>
        <input type="date" id="expiry" name="expiry" class="form-control" required>
    </div>
    <div class="input-field mb-3">
        <label for="payment_status" class="form-label fs-14 fw-500 text-secondary mb-8">{{ translate('Payment Status') }}</label>
        <select id="payment_status" name="payment_status" class="form-control border rounded-6">
            <option value="paid">{{ translate('Paid') }}</option>
            <option value="unpaid">{{ translate('Unpaid') }}</option>
        </select>
    </div>
    <div class="input-field mb-3">
        <label for="status" class="form-label fs-14 fw-500 text-secondary mb-8">{{ translate('Status') }}</label>
        <select id="status" name="status" class="form-control border rounded-6">
            <option value="1">{{ translate('Active') }}</option>
            <option value="0">{{ translate('Inactive') }}</option>
        </select>
    </div>


    <button type="submit" class="btn btn-dark rounded-6">{{ translate('Save') }}</button>

</form>

@include('core::modal')
