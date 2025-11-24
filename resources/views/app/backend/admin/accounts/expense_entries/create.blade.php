<form action="{{ route('income-entry.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <x-input class="mb-3" :label="translate('Title')" :type="'text'" :id="'title'" :name="'title'" required />
    <x-input class="mb-3" :label="translate('Date')" :type="'date'" :id="'transaction_date'" :name="'transaction_date'" />
    <x-textarea class="mb-3" :label="translate('Details')" :type="'text'" :id="'details'" :name="'details'" />
    <x-input class="mb-3" :label="translate('Amount')" :type="'number'" :id="'amount'" :name="'amount'" />

    <button type="submit" class="btn btn-dark rounded-6">{{ translate('Save') }}</button>

</form>

@include('core::modal')
