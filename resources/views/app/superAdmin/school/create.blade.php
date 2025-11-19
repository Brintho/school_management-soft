@extends('layouts::backend')
@push('title', translate('School Create'))

@section('content')
    <form action="{{ route('schools.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <x-input type="text" class="col-md-6" label="{{ translate('School Name') }}" name="school_name" required />
            <div class="col-md-6 mb-3">
                <label class="form-label required">{{ translate('Code') }}</label>
                <div class="input-group">
                    <input type="text" name="code" id="code-generate" class="form-control" autocomplete="off" required>

                    <button type="button" class="btn btn-dark" onclick="generateCode()">
                        Generate
                    </button>
                </div>
            </div>
        </div>

        <div class="row">
            <x-input type="text" class="col-md-6" label="{{ translate('Email') }}" name="email" required />
            <x-input type="tel" class="col-md-6" label="{{ translate('phone') }}" name="phone" required />
        </div>

        <div class="row">
            <x-input type="tel" class="col-md-6" label="{{ translate('Alternative Phone') }}" name="alternative_phone" required />
            <x-input type="number" class="col-md-6" label="{{ translate('Institute Type ID') }}" name="institute_type_id" required />
        </div>
        <div class="row">
            <x-input type="file" class="col-md-6" label="{{ translate('Logo') }}" name="logo" />
            <x-input type="url" class="col-md-6" label="{{ translate('Website URL') }}" name="website" />
        </div>
        <div class="row">
            <x-textarea class="col-md-6" label="{{ translate('Present Address') }}" name="present_address" />
            <x-textarea class="col-md-6" label="{{ translate('Permanent Address') }}" name="permanent_address" />
        </div>
        <div class="row">
            <x-input type="text" class="col-md-6" label="{{ translate('City') }}" name="city" />
            <x-input type="text" class="col-md-6" label="{{ translate('State') }}" name="state" />
        </div>
        <div class="row">
            <x-input type="text" class="col-md-6" label="{{ translate('Zipcode') }}" name="zipcode" />
            <x-input type="text" class="col-md-6" label="{{ translate('Country') }}" name="country" />
        </div>
        <div class="row">
            <x-input type="text" class="col-md-6" label="{{ translate('Latitude') }}" name="lat" />
            <x-input type="text" class="col-md-6" label="{{ translate('Longitude') }}" name="lng" />
        </div>
        <div class="row">
            <span class="text-muted">{{ translate('Admin Info') }}</span>
            <x-input type="text" class="col-md-6" label="{{ translate('Admin Email') }}" name="admin_email" required />
            <x-select class="col-md-6" name="status" label="{{ translate('Status') }}" :options="['active' => 'Active', 'inactive' => 'Inactive']" />
        </div>

        <div class="row">
            <x-input type="text" class="col-md-6" label="{{ translate('Password') }}" name="admin_password" required />
            <x-select class="col-md-6" label="{{ translate('Is Admission Going') }}" name="is_admission_going" :options="['0' => translate('No'), '1' => translate('Yes')]" />

        </div>
        <button type="submit" class="btn btn-dark rounded-6 mt-3">{{ translate('Save') }}</button>
    </form>
@endsection
@push('js')
    @include('core.initJs')
@endpush
