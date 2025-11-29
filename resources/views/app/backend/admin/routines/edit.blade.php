@php
    $classes = App\Models\Classes::get();
    // $subjects = App\Models\Subject::get();
    $rooms = App\Models\Room::get();
    $shifts = App\Models\Shift::get();
    $users = App\Models\User::where('role_id', 3)->where('status', 'active')->get();
    $routine = App\Models\Routine::findOrFail($id);

@endphp

<form action="{{ route('routines.update', $routine->id) }}" method="POST">
    @csrf

    <x-select name="class_id" label="Select Class" :options="$classes->pluck('name', 'id')" id="class-select" data-value="{{ $routine->class_id }}" required />
    @if ($routine->section_id)
        <div id="section-wrapper">
            <x-select name="section_id" label="Select Section" :options="[]" id="section-select" data-value="{{ $routine->section_id }}" />
        </div>
    @endif
    <div id="subject-wrapper">
        <x-select name="subject_id" label="Select Subject" :options="[]" id="subject-select" required data-value="{{ $routine->subject_id }}" />
    </div>
    <x-select name="teacher_id" label="Select Teacher" :options="$users->pluck('name', 'id')" required data-value="{{ $routine->teacher_id }}" />
    <x-select name="proxy_teacher_id" label="Proxy Teacher" :options="$users->pluck('name', 'id')" data-value="{{ $routine->proxy_teacher_id }}" />
    <x-select name="room_id" label="Select Room" :options="$rooms->pluck('room_name', 'id')" required data-value="{{ $routine->room_id }}" />
    <x-select name="shift_id" label="Select Shift" :options="$shifts->pluck('name', 'id')" required data-value="{{ $routine->shift_id }}" />

    <x-select name="day" label="Select Day" :options="[
        'Saturday' => 'Saturday',
        'Sunday' => 'Sunday',
        'Monday' => 'Monday',
        'Tuesday' => 'Tuesday',
        'Wednesday' => 'Wednesday',
        'Thursday' => 'Thursday',
        'Friday' => 'Friday',
    ]" data-value="{{ isset($day) ? $day : now()->englishDayOfWeek }}" required />

    {{-- {{ date("dd-mm-YYYY", strtotime($date_from_controller)); --}}
    <x-input type="date" name="date" label="Class Date" required data-value="{{ date('Y-m-d', strtotime($routine->date)) }}" />

    <x-input type="time" name="class_start" label="Class Start Time" required data-value="{{ \Carbon\Carbon::parse($routine->class_start)->format('H:i') }}" />

    <x-input type="time" name="class_end" label="Class End Time" required data-value="{{ $routine->class_end }}" />

    <x-select name="status" label="Status" :options="['1' => 'Active', '0' => 'Inactive']" required data-value="{{ $routine->status }}" />

    <button type="submit" class="btn btn-dark rounded-6">Save Routine</button>
</form>
@include('core::modal')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#class-select').on('change', function() {

            var classId = $(this).val();

            if (classId) {

                // ----------- Load Sections --------------
                $.post("{{ route('get-sections') }}", {
                    class_id: classId
                }, function(response) {

                    var sectionSelect = $('#section-select');
                    var selectedSection = sectionSelect.attr('data-value'); // <-- correct

                    sectionSelect.empty();

                    $.each(response.sections, function(i, section) {
                        sectionSelect.append(
                            '<option value="' + section.id + '">' + section.name + '</option>'
                        );
                    });

                    $('#section-wrapper').show();

                    // set selected value
                    if (selectedSection) {
                        sectionSelect.val(selectedSection);
                    }
                });

                // ----------- Load Subjects --------------
                $.post("{{ route('get-subjects') }}", {
                    class_id: classId
                }, function(response) {

                    var subjectSelect = $('#subject-select');
                    var selectedSubject = subjectSelect.attr('data-value'); // <-- correct

                    subjectSelect.empty();

                    $.each(response.subjects, function(i, subject) {
                        subjectSelect.append(
                            '<option value="' + subject.id + '">' + subject.name + '</option>'
                        );
                    });

                    $('#subject-wrapper').show();

                    // set selected value
                    if (selectedSubject) {
                        subjectSelect.val(selectedSubject);
                    }
                });

            } else {
                $('#section-wrapper').hide();
                $('#subject-wrapper').hide();
            }
        });

        // trigger on page load
        $('#class-select').trigger('change');
    });
</script>
