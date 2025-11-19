@php
    $feature = App\Models\packageFeatures::findOrFail($id);
    $package = App\Models\Package::find($feature->package_id);
@endphp

<form action="{{ route('package.features.update', $feature->id) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="hidden" name="package_id" value="{{ $package->id }}">

    <div class="input-field mb-3">
        <label for="title" class="form-label">{{ translate('Title') }}</label>
        <input type="text" id="title" name="title" class="form-control" value="{{ $feature->title }}">
    </div>

    <button type="submit" class="btn btn-dark">{{ translate('Update') }}</button>
</form>


<script src="{{ asset('assets/backend/js/jquery.min.js') }}"></script>
@include('core::modal')
