@extends('layouts::backend')
@push('title', translate('Add/update attendance'))

@section('content')
    <form action="{{ route('attendance.filter.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row" id="#">
            <x-input type="date" class="col-md-6" label="Date of Birth" name="date" required />
            @php
                $options = [];

                if ($data && $data->count()) {
                    foreach ($data as $r) {
                        $className = $r->classes?->name ?? 'N/A';
                        $sectionName = $r->section?->name ?? 'N/A';
                        $subjectName = $r->subject?->name ?? 'N/A';

                        $options[$r->id] = $className . ' → Sec: ' . $sectionName . ' → ' . $subjectName;
                    }
                }
            @endphp

            <x-select class="col-md-6" name="routine_id" label="Class - Section - Subject" :options="$options" required />


        </div>

        <div class="d-flex justify-content-end">

            <button type="submit" class="btn btn-dark rounded-6 mt-3">Submit</button>
        </div>
    </form>
@endsection
