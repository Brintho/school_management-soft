@extends('layouts::backend')
@push('title', translate('Routines'))

@push('breadcrumb')
@endpush



@section('content')
    <div class="card">
        <div class="card-header bg-white border-color p-10 border-bottom-0">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                <p class="fs-16 fw-500 text-secondary mb-0">{{ translate('All Routines') }}</p>

                <div class="chart-control d-flex align-items-center flex-wrap gap-8">
                    <div class="message-search">
                        <form action="#" class="w-100">
                            <input type="search" class="form-control fs-12 border rounded-6" id="search"
                                placeholder="{{ translate('Search by class, subject, teacher') }}">
                            <label for="search">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.66732 14.4997C3.90065 14.4997 0.833984 11.433 0.833984 7.66634C0.833984 3.89967 3.90065 0.833008 7.66732 0.833008C11.434 0.833008 14.5007 3.89967 14.5007 7.66634C14.5007 11.433 11.434 14.4997 7.66732 14.4997Z"
                                        fill="#515155"></path>
                                    <path
                                        d="M14.6671 15.1663C14.5404 15.1663 14.4137 15.1196 14.3137 15.0196L12.0005 13C11.8072 12.8067 11.8072 12.4867 12.0005 12.2933C12.1938 12.1 12.5138 12.1 12.7072 12.2933L15.0204 14.313C15.2137 14.5063 15.2137 14.8263 15.0204 15.0196C14.9204 15.1196 14.7937 15.1663 14.6671 15.1663Z"
                                        fill="#515155"></path>
                                </svg>
                            </label>
                        </form>
                    </div>
                    <x-btn-canvas :title="translate('Add Routine')" :url="path(['backend::admin.routines.create'])" />
                </div>
            </div>
        </div>

        <!-- Routine Table -->
        <div class="routine-wrapper">

            @php
                $days = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
            @endphp

            @foreach ($days as $day)
                <div class="day-row d-flex border mb-2 routine-day-box">

                    <div class="day-name p-3 text-center align-items-center d-flex justify-content-center border-end">
                        <strong>{{ $day }}</strong>
                    </div>

                    <div class="routine-slots flex-grow-1 d-flex align-items-center p-2 gap-2 flex-wrap">

                        <button type="button" data-modal="r-canvas"
                            data-url="{{ path(['backend::admin.routines.create', 'day' => $day]) }}"
                            data-title="Add Routine" class="btn">
                            <div class="add-slot-btn routine-box-btn d-flex align-items-center justify-content-center"
                                data-day="{{ $day }}">
                                <i class="fa-solid fa-plus fs-20"></i>
                            </div>
                        </button>

                        <!-- Routine Data -->
                        @if (isset($routines[$day]))
                            @foreach ($routines[$day]->groupBy('class_id') as $classId => $classRoutines)
                                @php
                                    $className = optional($classRoutines->first()->classes)->name;
                                    $hasSection = $classRoutines->whereNotNull('section_id')->count() > 0;
                                @endphp

                                <div class="routine-box">
                                    <!-- Class Header -->
                                    <small class="class-name d-flex justify-content-center align-items-center">
                                        <span class="ms-auto">{{ $className }}</span>
                                        <a href="#" class="ms-auto">
                                            <i class="fa-plus fa-solid"></i>
                                        </a>
                                    </small>

                                    <!-- Show routines -->
                                    @if ($hasSection)
                                        <div class="section-content">
                                            @foreach ($classRoutines->groupBy('section_id') as $sectionId => $sectionRoutines)
                                                @php
                                                    $sectionName = optional($sectionRoutines->first()->section)->name;
                                                @endphp
                                                <div class="section-class">
                                                    <div class="routine-sections">
                                                        <small>Section {{ $sectionName }}</small>

                                                    </div>

                                                    @foreach ($sectionRoutines as $routine)
                                                        <div class="routine-details d-flex  justify-content-space-between">

                                                            <div>
                                                                Room: {{ $routine->room->room_name ?? '' }} <br>
                                                                Subject: {{ $routine->subject->name ?? '' }} <br>
                                                                Teacher: {{ $routine->teacher->name ?? '' }}<br>
                                                                {{ \Carbon\Carbon::parse($routine->class_start)->format('g:i A') }}
                                                                -
                                                                {{ \Carbon\Carbon::parse($routine->class_end)->format('g:i A') }}
                                                                <br>
                                                                @if ($routine->proxy_teacher_id)
                                                                    Proxy: {{ $routine->proxyTeacher->name ?? '' }}
                                                                    <br>
                                                                @endif


                                                                {{ date($routine->date) }}
                                                            </div>
                                                            <x-dropdown>
                                                                <x-drop-canvas :title="translate('Edit')" :url="path([
                                                                    'backend::admin.routines.edit',
                                                                    'id' => $routine->id,
                                                                ])"
                                                                    :icon="'fi fi-rr-file-edit'" divider />
                                                                <x-drop-delete :url="route('routines.delete', $routine->id)" />
                                                            </x-dropdown>

                                                            {{-- <x-hover-action :editUrl="path(['backend::admin.routines.edit', 'id' => $routine->id])" :deleteUrl="route('routines.delete', $routine->id)" /> --}}


                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div>
                                            @foreach ($classRoutines as $routine)
                                                <div class="routine-details p-3">
                                                    Room: {{ $routine->room->room_name ?? '' }} <br>
                                                    Subject: {{ $routine->subject->name ?? '' }} <br>
                                                    Teacher: {{ $routine->teacher->name ?? '' }} <br>
                                                    {{ \Carbon\Carbon::parse($routine->class_start)->format('g:i A') }}
                                                    -
                                                    {{ \Carbon\Carbon::parse($routine->class_end)->format('g:i A') }}

                                                    <br>
                                                    @if ($routine->proxy_teacher_id)
                                                        Proxy:{{ $routine->proxyTeacher->name ?? '' }}
                                                        <br>
                                                    @endif


                                                    {{ date($routine->date) }}
                                                    <x-dropdown>
                                                        <x-drop-canvas :title="translate('Edit')" :url="path([
                                                            'backend::admin.routines.edit',
                                                            'id' => $routine->id,
                                                        ])" :icon="'fi fi-rr-file-edit'"
                                                            divider />
                                                        <x-drop-delete :url="route('routines.delete', $routine->id)" />
                                                    </x-dropdown>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            @endforeach


        </div>

    </div>
@endsection
