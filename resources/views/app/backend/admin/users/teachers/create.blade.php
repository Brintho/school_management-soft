@extends('layouts::backend')
@push('title', translate('Add Teacher'))

@section('content')
    <form action="{{ route('teachers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <x-input type="hidden" name="school_id" value="{{ auth()->user()->school_id }}" />

        <div class="row">
            <x-input type="text" class="col-md-6" label="Name" name="name" required />
            <x-input type="text" class="col-md-6" label="Phone" name="phone" required />
        </div>

        <div class="row">
            <x-input type="email" class="col-md-6" label="Email" name="email" required />
            <x-input type="password" class="col-md-6" label="Password" name="password" required />
        </div>

        <div class="row">
            <x-input type="text" class="col-md-6" label="Present Address" name="present_address" required />
            <x-input type="text" class="col-md-6" label="Permanent Address" name="permanent_address" />
        </div>

        <div class="row">
            <x-select class="col-md-6" name="gender" label="Gender" :options="[
                'male' => 'Male',
                'female' => 'Female',
                'other' => 'Other',
            ]" required />

            <x-input type="date" class="col-md-6" label="Date of Birth" name="dob" required />
        </div>

        <div class="row">
            <x-input type="text" class="col-md-6" label="Religion" name="religion" />
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
        </div>

        <div class="row">
            <x-input type="text" class="col-md-6" label="Father Name" name="father_name" />
            <x-input type="text" class="col-md-6" label="Education" name="education" />
        </div>

        <div class="row">
            <x-input type="text" class="col-md-6" label="NID" name="nid" />
            <x-input type="text" class="col-md-6" label="Experience" name="experience" />
        </div>

        <div class="row">
            <x-input type="date" class="col-md-6" label="Joining Date" name="joining_date" required />

            <x-input type="number" class="col-md-6" label="Monthly Salary" name="monthly_salary" />
        </div>
        <div class="row">
            <x-select class="col-md-6" name="status" label="Status" :options="[
                '1' => 'Active',
                '0' => 'Inactive',
            ]" />
            <x-select class="col-md-6" name="shift_id" label="Shift" :options="$shifts->pluck('name', 'id')->toArray()" required />

        </div>
        <div class="row">
            <x-input type="file" class="col-md-6" label="Photo" name="photo" required />

            <div class="col-md-6">
                <x-input type="file" label="Documents" name="documents[]" note='(Upload certificates, ID & other docs)' multiple />
            </div>
        </div>

        <button type="submit" class="btn btn-dark rounded-6 mt-3">Save Teacher</button>
    </form>
@endsection
