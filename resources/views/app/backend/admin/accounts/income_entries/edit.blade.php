@php
    $chartofaccounts = App\Models\ChartOfAccount::find($id);
    $incomeEntries = App\Models\IncomeEntry::findOrFail($id);
@endphp

<form action="{{ route('income-entry.update', $incomeEntries->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="chart_of_accounts_id" name="chart_of_accounts_id" value="{{ $chartofaccounts->id }}">

    <x-input class="mb-3" :label="translate('Title')" :type="'text'" :id="'title'" :name="'title'" :value="$incomeEntries->title" required />
    <x-textarea class="mb-3" :label="translate('Details')" :type="'text'" :id="'details'" :name="'details'" :value="$incomeEntries->details" />
    <x-input class="mb-3" :label="translate('Details')" :type="'text'" :id="'details'" :name="'details'" :value="$incomeEntries->details" />
    <x-input class="mb-3" :label="translate('Amount')" :type="'number'" :id="'amount'" :name="'amount'" :value="$incomeEntries->amount" />

    <button type="submit" class="btn btn-dark rounded-6">{{ translate('Save') }}</button>

</form>
@include('core::modal')
