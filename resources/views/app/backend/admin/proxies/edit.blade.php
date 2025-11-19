@php
    $teachers = App\Models\User::where('role_id', '3')->get();
    $proxy = App\Models\Proxy::findOrFail($id);

@endphp
<form action="{{ route('proxies.update', $proxy->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="input-field mb-3">
        <x-select class="custom-selectTo" name="teacher_id" label="{{ translate('Teacher') }}" :options="collect($teachers)->pluck('name', 'id')"
            :data-value="$proxy->teacher_id" required />
    </div>
    <button type="submit" class="btn btn-dark rounded-6">{{ translate('Save') }}</button>

</form>



@include('core::modal')
