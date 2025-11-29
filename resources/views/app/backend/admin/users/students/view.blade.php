@extends('layouts::backend')
@push('title', translate('View Students'))

@push('breadcrumb')
@endpush

@section('content')
<div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-20">
    <div class="mb-0">
        <p class="fs-16 fw-500 text-secondary mb-6">{{ translate('Manage Student') }}</p>
        <ul class="page-path">
            <li>
                <a href="#">Dashboard</a>
                <span>
                    <svg width="5" height="10" viewBox="0 0 5 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.5 1.25L4.25 5L0.5 8.75" stroke="#515155" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </span>
            </li>
            <li>
                <a href="#">Manage Student</a>
                <span>
                    <svg width="5" height="10" viewBox="0 0 5 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.5 1.25L4.25 5L0.5 8.75" stroke="#515155" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </span>
            </li>
            <li>View Info</li>
        </ul>
    </div>

    <div class="chart-control d-flex align-items-center flex-wrap gap-8">
        <a class="btn btn-dark" href="{{ route('students') }}">
            {{ translate('Back') }}
        </a>
    </div>
</div>

<!-- Student Info -->
<div class="row">
    <div class="col-xl-3 col-lg-3 col-md-3">
        <div class="user-infoSidebar">
            <div class="user-infoBody">
                <div class="user-info">
                    <figure>
                        <img src="{{ $student->photo }}" alt="">
                    </figure>
                    <h4 class="fs-18 text-secondary">{{ $student->name }}</h4>
                    <p class="mb-20">{{ $student->email }}</p>
                    <span class="badge">Student</span>
                </div>
                <div class="user-nav">
                    <ul>
                        <li class="active"><a href="#">Profile</a></li>
                        <li><a href="#">Award</a></li>
                        <li><a href="#">Attendance</a></li>
                        <li><a href="#">Timesheet</a></li>
                        <li><a href="#">Assigned Task</a></li>
                        <li><a href="#">Apprisal</a></li>
                        <li><a href="#">Performance</a></li>
                        <li><a href="#">Leave</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-9 col-lg-9 col-md-9">
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
                <div class="col-md-6">
                    <label class="form-label required">{{ translate('Student Unique ID') }}</label>
                    <div class="input-group">
                        <input type="text" name="unique_id" id="code-generate" class="form-control" value="{{ $student->student->unique_id }}" autocomplete="off" required>
                        <button type="button" class="btn btn-dark" onclick="generateCode()">Generate</button>
                    </div>
                </div>
                <x-input type="text" class="col-md-6" label="Birth Registration Number (BRN)" name="brn" value="{{ $student->brn }}" />
            </div>



            <!-- <div class="row">
                <div class="col-md-6">
                    <label class="form-label required">{{ translate('Student Unique ID') }}</label>
                    <div class="input-group">
                        <input type="text" name="unique_id" id="code-generate" class="form-control" autocomplete="off" required>
                        <button type="button" class="btn btn-dark" onclick="generateCode()">Generate</button>
                    </div>
                </div>

                <x-input type="number" class="col-md-6" label="Alternative Phone" name="guardian_number" />
            </div> -->




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

            <button type="submit" class="btn btn-dark rounded-6 mt-3">Save Changes</button>
        </form>
    </div>
</div>


@endsection