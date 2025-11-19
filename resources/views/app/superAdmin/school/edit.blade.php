@extends('layouts::backend')
@push('title', translate('School Edit'))
<style>

</style>
@section('content')
    <form action="{{ route('schools.update', $school->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <x-input type="text" class="col-md-6" label="{{ translate('School Name') }}" name="school_name" required
                value="{{ $school->school_name }}" />

            <div class="col-md-6 mb-3">
                <label class="form-label required">{{ translate('Code') }}</label>
                <div class="input-group">
                    <input type="text" name="code" id="code-generate" class="form-control" value="{{ $school->code }}"
                        autocomplete="off" required>

                    <button type="button" class="btn btn-dark" onclick="generateCode()">
                        Generate
                    </button>
                </div>
            </div>
        </div>



        <div class="row">
            <x-input type="tel" class="col-md-6" label="{{ translate('Email') }}" name="email" required
                value="{{ $school->email }}" />

            <x-input type="tel" class="col-md-6" label="{{ translate('phone') }}" name="phone" required
                value="{{ $school->phone }}" />
        </div>

        <div class="row">
            <x-input type="tel" class="col-md-6" label="{{ translate('Alternative Phone') }}" name="alternative_phone"
                required value="{{ $school->alternative_phone }}" />

            <x-input type="text" class="col-md-6" label="{{ translate('Institute Type ID') }}" name="institute_type_id"
                required value="{{ $school->institute_type_id }}" />
        </div>

        <div class="row">
            <x-input type="file" class="col-md-6" label="{{ translate('Logo') }}" name="logo" />

            <x-input type="url" class="col-md-6" label="{{ translate('Website URL') }}" name="website"
                value="{{ $school->website }}" />
        </div>

        <div class="row">
            <x-textarea class="col-md-6" label="{{ translate('Present Address') }}" name="present_address"
                value="{{ $school->present_address }}">{{ $school->present_address }}</x-textarea>

            <x-textarea class="col-md-6" label="{{ translate('Permanent Address') }}" name="permanent_address"
                value="{{ $school->permanent_address }}"></x-textarea>
        </div>

        <div class="row">
            <x-input type="text" class="col-md-6" label="{{ translate('City') }}" name="city"
                value="{{ $school->city }}" />

            <x-input type="text" class="col-md-6" label="{{ translate('State') }}" name="state"
                value="{{ $school->state }}" />
        </div>

        <div class="row">
            <x-input type="text" class="col-md-6" label="{{ translate('Zipcode') }}" name="zipcode"
                value="{{ $school->zipcode }}" />

            <x-input type="text" class="col-md-6" label="{{ translate('Country') }}" name="country"
                value="{{ $school->country }}" />
        </div>

        <div class="row">
            <x-input type="text" class="col-md-6" label="{{ translate('Latitude') }}" name="lat"
                value="{{ $school->lat }}" />

            <x-input type="text" class="col-md-6" label="{{ translate('Longitude') }}" name="lng"
                value="{{ $school->lng }}" />
        </div>

        <div class="row">
            <span class="text-muted">{{ translate('Admin Info') }}</span>

            <x-input type="text" class="col-md-6" label="{{ translate('Admin Email') }}" name="admin_email" required
                value="{{ $school->admin_email }}" />

            <x-select class="col-md-6" name="status" label="{{ translate('Status') }}" :options="['active' => 'Active', 'inactive' => 'Inactive']"
                data-value="{{ $school->status }}" />
        </div>

        <div class="row">
            <x-select class="col-md-6" label="{{ translate('Is Admission Going') }}" name="is_admission_going"
                :options="['0' => translate('No'), '1' => translate('Yes')]" data-value="{{ $school->is_admission_going }}" />
        </div>

        <button type="submit" class="btn btn-dark rounded-6 mt-3">
            {{ translate('Update') }}
        </button>
    </form>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('.custom-selectTo').select2();
        });

        function generateCode() {
            let code = Math.random().toString(36).substring(2, 8).toUpperCase();
            document.getElementById('code-generate').value = code;
        }
    </script>
@endpush
