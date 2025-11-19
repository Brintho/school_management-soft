@extends('layouts::backend')
@push('title', translate('Edit Student'))

@section('content')
    <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <x-input type="text" class="col-md-6" label="Name" name="name" required value="{{ $student->name }}" />
            <x-input type="email" class="col-md-6" label="Email" name="email" required value="{{ $student->email }}" />
        </div>

        <div class="row">
            <x-input type="text" class="col-md-6" label="Phone" name="phone" required value="{{ $student->phone }}" />
            <x-input type="text" class="col-md-6" label="Alternative Phone" name="guardian_number" value="{{ $student->student->guardian_number }}" />
        </div>

        <div class="row">
            <x-select class="col-md-6" id="class-select" name="class_id" label="Class" :options="$classes->pluck('name', 'id')->toArray()" data-value="{{ $student->student->class_id }}" required />
            <div id="section-wrapper" class="col-md-6">
                <x-select name="section_id" id="section-select" label="Section" :options="$sections->pluck('name', 'id')->toArray()" data-value="{{ $student->student->section_id }}" required />
            </div>
        </div>

        <div class="row">
            <x-input type="date" class="col-md-6" label="Birthday" name="dob" value="{{ $student->dob }}" />
            <x-select class="col-md-6" name="gender" label="Gender" :options="['male' => 'Male', 'female' => 'Female', 'other' => 'Other']" data-value="{{ $student->gender }}" required />
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
            ]" data-value="{{ $student->student->blood_group }}" />

            <x-input type="text" class="col-md-6" label="Post Code" name="post_code" value="{{ $student->post_code }}" />
        </div>

        <div class="row">
            <x-input type="text" class="col-md-6" label="Present Address" name="present_address" value="{{ $student->present_address }}" />

            <x-input type="text" class="col-md-6" label="Permanent Address" name="permanent_address" value="{{ $student->permanent_address }}" />
        </div>

        <div class="row">
            <x-input type="text" class="col-md-6" label="Father Name" name="father_name" value="{{ $student->student->father_name }}" />

            <x-input type="text" class="col-md-6" label="Mother Name" name="mother_name" value="{{ $student->student->mother_name }}" />
        </div>

        <div class="row">
            <x-input type="text" class="col-md-6" label="Student Unique ID" name="unique_id" value="{{ $student->student->unique_id }}" required />

            <x-input type="text" class="col-md-6" label="Birth Registration Number (BRN)" name="brn" value="{{ $student->brn }}" />
        </div>

        <div class="row">
            <x-textarea class="col-md-6" label="Additional Information" name="additional_info" value="{{ $student->student->additional_info }}">
            </x-textarea>

            <x-select class="col-md-6" name="shift_id" label="Shift" :options="$shifts->pluck('name', 'id')->toArray()" data-value="{{ $student->student->shift_id }}" required />
        </div>

        <div class="row">
            <x-input type="file" class="col-md-6" label="Profile Image" name="photo" />
            <x-input type="file" class="col-md-6" label="Documents" name="documents[]" multiple />
        </div>

        <div class="row">
            <x-select class="col-md-6" name="status" label="Status" :options="['1' => 'Active', '0' => 'Inactive']" data-value="{{ $student->status }}" />
        </div>

        <button type="submit" class="btn btn-dark rounded-6 mt-3">Update Student</button>
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
