<form action="{{ route('chartofaccounts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <x-input class="mb-3" :label="translate('Account name')" :type="'text'" :id="'account_name'" :name="'account_name'" required />
    <x-select name="account_type" label="{{ translate('Account Type') }}" :options="['asset' => translate('Asset'), 'liability' => translate('Liability'), 'income' => translate('Income'), 'expense' => translate('Expense'), 'equity' => translate('Equity')]" required />
    <x-input class="mb-3" :label="translate('Notes')" :type="'text'" :id="'notes'" :name="'notes'" />

    <button type="submit" class="btn btn-dark rounded-6">{{ translate('Save') }}</button>

</form>

@include('core::modal')
