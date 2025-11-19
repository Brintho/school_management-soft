@php
    $classes = App\Models\Classes::get();
    // $subjects = App\Models\Subject::get();
    $rooms = App\Models\Room::get();
    $shifts = App\Models\Shift::get();
    $users = App\Models\User::where('role_id', 3)->where('status', 'active')->get();

@endphp

<form action="{{ route('routines.store') }}" method="POST">
    @csrf

    <x-select name="class_id" label="Select Class" :options="$classes->pluck('name', 'id')" id="class-select" required />
    <div id="section-wrapper" style="display:none;">
        <x-select name="section_id" label="Select Section" :options="[]" id="section-select" />
    </div>
    <div id="subject-wrapper" style="display:none;">
        <x-select name="subject_id" label="Select Subject" :options="[]" id="subject-select" required />
    </div>
    <x-select name="teacher_id" label="Select Teacher" :options="$users->pluck('name', 'id')" required />
    <x-select name="proxy_teacher_id" label="Proxy Teacher" :options="$users->pluck('name', 'id')" />
    <x-select name="room_id" label="Select Room" :options="$rooms->pluck('room_name', 'id')" required />
    <x-select name="shift_id" label="Select Shift" :options="$shifts->pluck('name', 'id')" required />

    <x-select name="day" label="Select Day" :options="[
        'Saturday' => 'Saturday',
        'Sunday' => 'Sunday',
        'Monday' => 'Monday',
        'Tuesday' => 'Tuesday',
        'Wednesday' => 'Wednesday',
        'Thursday' => 'Thursday',
        'Friday' => 'Friday',
    ]" data-value="{{ isset($day) ? $day : now()->englishDayOfWeek }}" required />


    <x-input type="date" name="date" label="Class Date" required />
    <x-input type="time" name="class_start" label="Class Start Time" required />
    <x-input type="time" name="class_end" label="Class End Time" required />

    <x-select name="status" label="Status" :options="['1' => 'Active', '0' => 'Inactive']" required />

    <button type="submit" class="btn btn-dark rounded-6">Save Routine</button>
</form>
@include('core::modal')

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
                $.post("{{ route('get-subjects') }}", {
                    class_id: classId
                }, function(response) {
                    var subjectSelect = $('#subject-select');
                    subjectSelect.empty();
                    $.each(response.subjects, function(i, subject) {
                        subjectSelect.append('<option value="' + subject.id + '">' +
                            subject.name + '</option>');
                    });
                    $('#subject-wrapper').show();
                });

            } else {
                $('#section-wrapper').hide();
                $('#section-select').empty();

                $('#subject-wrapper').hide();
                $('#subject-select').empty();
            }
        });
    });
</script>
