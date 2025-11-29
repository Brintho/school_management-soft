@extends('layouts::backend')
@push('title', translate('View Teachers'))

@push('breadcrumb')
@endpush

@section('content')
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-20">
        <div class="mb-0">
            <p class="fs-16 fw-500 text-secondary mb-6">{{ translate('Manage Teacher') }}</p>
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
                    <a href="#">Manage Teacher</a>
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
            <a class="btn btn-dark" href="{{ route('teachers') }}">
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
                            <img src="{{ $teacher->photo }}" alt="">
                        </figure>
                        <h4 class="fs-18 text-secondary">{{ $teacher->name }}</h4>
                        <p class="mb-20">{{ $teacher->email }}</p>
                        <span class="badge">Teacher</span>
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
            <form action="{{ route('teachers.update', $teacher->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <x-input type="hidden" name="school_id" value="{{ auth()->user()->school_id }}" />

                <div class="row">
                    <x-input type="text" class="col-md-6" label="Name" name="name" required value="{{ $teacher->name }}" />

                    <x-input type="text" class="col-md-6" label="Phone" name="phone" required value="{{ $teacher->phone }}" />
                </div>

                <div class="row">
                    <x-input type="email" class="col-md-6" label="Email" name="email" required value="{{ $teacher->email }}" />
                    <x-input type="number" class="col-md-6" label="Monthly Salary" name="monthly_salary" value="{{ $teacher->teacher->monthly_salary }}" />

                </div>

                <div class="row">
                    <x-input type="text" class="col-md-6" label="Present Address" name="present_address" required value="{{ $teacher->present_address }}" />
                    <x-input type="text" class="col-md-6" label="Permanent Address" name="permanent_address" value="{{ $teacher->permanent_address }}" />
                </div>

                <div class="row">
                    <x-select class="col-md-6" name="gender" label="Gender" :options="['male' => 'Male', 'female' => 'Female', 'other' => 'Other']" required data-value="{{ $teacher->gender }}" />
                    <x-input type="date" class="col-md-6" label="Date of Birth" name="dob" required value="{{ $teacher->dob }}" />
                </div>

                <div class="row">
                    <x-input type="text" class="col-md-6" label="Religion" name="religion" value="{{ $teacher->religion }}" />
                    <x-select class="col-md-6" name="blood_group" label="Blood Group" :options="[
                        'O+' => 'O+',
                        'A+' => 'A+',
                        'B+' => 'B+',
                        'AB+' => 'AB+',
                        'O-' => 'O-',
                        'A-' => 'A-',
                        'B-' => 'B-',
                        'AB-' => 'AB-',
                    ]" data-value="{{ $teacher->blood_group }}" />
                </div>

                <div class="row">
                    <x-input type="text" class="col-md-6" label="Father Name" name="father_name" value="{{ $teacher->teacher->father_name }}" />
                    <x-input type="text" class="col-md-6" label="Education" name="education" value="{{ $teacher->teacher->education }}" />
                </div>

                <div class="row">
                    <x-input type="text" class="col-md-6" label="NID" name="nid" value="{{ $teacher->nid }}" />
                    <x-input type="text" class="col-md-6" label="Experience" name="experience" value="{{ $teacher->teacher->experience }}" />
                </div>

                <div class="row">
                    <x-input type="date" class="col-md-6" label="Joining Date" name="joining_date" required value="{{ $teacher->teacher->joining_date }}" />
                    <x-select class="col-md-6" name="shift_id" label="Shift" :options="$shifts->pluck('name', 'id')->toArray()" data-value="{{ $teacher->shift_id }}" />
                </div>
                <div class="row">
                    <x-select class="col-md-6" name="status" label="Status" :options="[
                        '1' => 'Active',
                        '0' => 'Inactive',
                    ]" data-value="{{ $teacher->status }}" />
                    <div class="input-field  col-md-6">
                        <x-input type="file" label="Documents" name="documents[]" note='(Upload certificates, ID & other docs)' multiple />
                    </div>
                </div>
                <div class="row">
                    <x-input type="file" class="col-md-6" label="Photo" name="photo" />
                </div>

                <button type="submit" class="btn btn-dark rounded-6">Update Teacher</button>
            </form>
        </div>

    </div>
@endsection
