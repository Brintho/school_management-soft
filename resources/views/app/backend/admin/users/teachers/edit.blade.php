@extends('layouts::backend')
@push('title', translate('Edit Teacher'))

@section('content')
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
            <x-input type="number" class="col-md-6" label="Monthly Salary" name="monthly_salary"
                value="{{ $teacher->teacher->monthly_salary }}" />

        </div>

        <div class="row">
            <x-input type="text" class="col-md-6" label="Present Address" name="present_address" required
                value="{{ $teacher->present_address }}" />
            <x-input type="text" class="col-md-6" label="Permanent Address" name="permanent_address"
                value="{{ $teacher->permanent_address }}" />
        </div>

        <div class="row">
            <x-select class="col-md-6" name="gender" label="Gender" :options="['male' => 'Male', 'female' => 'Female', 'other' => 'Other']" required
                data-value="{{ $teacher->gender }}" />
            <x-input type="date" class="col-md-6" label="Date of Birth" name="dob" required
                value="{{ $teacher->dob }}" />
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
            ]"
                data-value="{{ $teacher->blood_group }}" />
        </div>

        <div class="row">
            <x-input type="text" class="col-md-6" label="Father Name" name="father_name"
                value="{{ $teacher->teacher->father_name }}" />
            <x-input type="text" class="col-md-6" label="Education" name="education"
                value="{{ $teacher->teacher->education }}" />
        </div>

        <div class="row">
            <x-input type="text" class="col-md-6" label="NID" name="nid" value="{{ $teacher->nid }}" />
            <x-input type="text" class="col-md-6" label="Experience" name="experience"
                value="{{ $teacher->teacher->experience }}" />
        </div>

        <div class="row">
            <x-input type="date" class="col-md-6" label="Joining Date" name="joining_date" required
                value="{{ $teacher->teacher->joining_date }}" />
            <x-select class="col-md-6" name="shift_id" label="Shift" :options="$shifts->pluck('name', 'id')->toArray()"
                data-value="{{ $teacher->shift_id }}" />


        </div>
        <div class="row">
            <x-select class="col-md-6" name="status" label="Status" :options="[
                '1' => 'Active',
                '0' => 'Inactive',
            ]"
                data-value="{{ $teacher->status }}" />
            <div class="input-field  col-md-6">
                <x-input type="file" label="Documents" name="documents[]" note='(Upload certificates, ID & other docs)'
                    multiple />
            </div>
        </div>
        <div class="row">
            <x-input type="file" class="col-md-6" label="Photo" name="photo" />


        </div>


        <button type="submit" class="btn btn-dark rounded-6">Update Teacher</button>
    </form>
@endsection
