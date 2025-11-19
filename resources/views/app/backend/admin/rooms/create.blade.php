@php
    $rooms = App\Models\Room::where('status', 1)->get();
@endphp

<form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <x-input type="text" name="room_name" label="{{ translate('Room Name') }}" required />
    <x-select name="status" label="{{ translate('Status') }}" required :options="['1' => 'Active', '0' => 'Inactive']" />
    <button type="submit" class="btn btn-dark rounded-6">{{ translate('Save') }}</button>

</form>

@include('core::modal')
