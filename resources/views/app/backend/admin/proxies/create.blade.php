@php
    $teachers = App\Models\User::where('role_id', '3')->get();

@endphp
<form action="{{ route('proxies.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="input-field mb-3">
        <x-select class="custom-selectTo" name="teacher_id" label="{{ translate('Teacher') }}" :options="collect($teachers)->pluck('name', 'id')"
            required />
    </div>
    <button type="submit" class="btn btn-dark rounded-6">{{ translate('Save') }}</button>

</form>



@include('core::modal')
