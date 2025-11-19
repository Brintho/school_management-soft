@php
    $classes = App\Models\Classes::get();
@endphp


@extends('layouts::backend')
@push('title', translate('Add Student'))

@section('content')
    <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <x-input type="text" class="col-md-6" label="Name" name="name" required />
            <x-input type="email" class="col-md-6" label="Email" name="email" required />
        </div>

        <div class="row">
            <x-input type="password" class="col-md-6" label="Password" name="password" required />
            <x-input type="text" class="col-md-6" label="Phone" name="phone" required />
        </div>


        <div class="row">
            <x-select class="col-md-6" id="class-select" name="class_id" label="Class" :options="$classes->pluck('name', 'id')->toArray()" required />
            <div id="section-wrapper" style="display:none; " class="col-md-6">
                <x-select name="section_id" label="Select Section" :options="[]" id="section-select" />
            </div>

        </div>

        <div class="row">
            <x-input type="date" class="col-md-6" label="Birthday" name="dob" />
            <x-select class="col-md-6" name="gender" label="Gender" :options="[
                'male' => 'Male',
                'female' => 'Female',
                'other' => 'Other',
            ]" required />
        </div>

        <div class="row">
            <x-select class="col-md-6" name="blood_group" label="Blood Group" :options="[
                'O+' => 'O+',
                'A+' => 'A+',
                'B+' => 'B+',
                'AB+' => 'AB+',
                'O-' => 'O-',
                'A-' => 'A-',
                'B-' => 'B-',
                'AB-' => 'AB-',
            ]" />

            <x-input type="text" class="col-md-6" label="Post Code" name="post_code" />
        </div>

        <div class="row">
            <x-input type="text" class="col-md-6" label="Present Address" name="present_address" />
            <x-input type="text" class="col-md-6" label="Permanent Address" name="permanent_address" />

        </div>

        <div class="row">
            <x-input type="text" class="col-md-6" label="Father Name" name="father_name" />
            <x-input type="text" class="col-md-6" label="Mother Name" name="mother_name" />
        </div>

        <div class="row">
            <div class="col-md-6">
                <label class="form-label required">{{ translate('Student Unique ID') }}</label>
                <div class="input-group">
                    <input type="text" name="unique_id" id="code-generate" class="form-control" autocomplete="off" required>
                    <button type="button" class="btn btn-dark" onclick="generateCode()">Generate</button>
                </div>
            </div>

            <x-input type="number" class="col-md-6" label="Alternative Phone" name="guardian_number" />
        </div>

        <div class="row">
            <x-textarea class="col-md-6" label="Additional Information" name="additional_info" />
            <x-input type="text" class="col-md-6" label="Birth Registration Number (BRN)" name="brn" />
        </div>

        <div class="row">
            <x-input type="file" class="col-md-6" label="Student Profile Image" name="photo" required />
            <x-input type="file" class="col-md-6" label="Documents" name="documents[]" note='(Upload certificates, ID & other docs)' multiple />
        </div>

        <div class="row">
            <x-select class="col-md-6" name="status" label="Status" :options="[
                '1' => 'Active',
                '0' => 'Inactive',
            ]" required />

            <x-select class="col-md-6" name="shift_id" label="Shift" :options="$shifts->pluck('name', 'id')->toArray()" required />
        </div>

        <button type="submit" class="btn btn-dark rounded-6 mt-3">Save Student</button>
    </form>
@endsection


@push('js')
    <script>
        function ajaxSetup() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        }

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#class-select').on('change', function() {
                var classId = $(this).val();

                if (classId) {

                    // Section AJAX
                    $.post("{{ route('get-sections') }}", {
                        class_id: classId
                    }, function(response) {
                        var sectionSelect = $('#section-select');
                        sectionSelect.empty();
                        $.each(response.sections, function(i, section) {
                            sectionSelect.append('<option value="' + section.id + '">' +
                                section.name + '</option>');
                        });
                        $('#section-wrapper').show();
                    });

                    // Subject AJAX


                } else {
                    $('#section-wrapper').hide();
                    $('#section-select').empty();
                }
            });
        });
    </script>

@endpush
