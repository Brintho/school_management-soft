@php
    $classes = App\Models\Classes::all();
    $subject = App\Models\Subject::findOrFail($id);
@endphp

<form action="{{ route('subjects.update', $subject->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="input-field mb-3">
        <label for="class_id" class="form-label fs-14 fw-500 text-secondary mb-8 required ">{{ translate('Select Class') }}</label>
        <select id="class_id" name="class_id" class="form-control border rounded-6" required>
            <option value="">{{ translate('Select Class') }}</option>
            @foreach ($classes as $class)
                <option value="{{ $class->id }}" {{ $subject->class_id == $class->id ? 'selected' : '' }}>
                    {{ $class->name }}
                </option>
            @endforeach
        </select>
    </div>

    <x-input name="name" label="{{ translate('Subject Name') }}" :value="$subject->name" required />
    <x-input name="marks" label="{{ translate('Marks') }}" :value="$subject->marks" type="number" required />
    <x-select name="category" label="{{ translate('Category') }}" :options="['compulsory' => translate('Compulsory'), 'optional' => translate('Optional')]" :data-value="$subject->category" required />
    <x-select name="status" label="{{ translate('Status') }}" :options="['1' => translate('Active'), '0' => translate('Inactive')]" :data-value="$subject->status" />
    <button type="submit" class="btn btn-dark rounded-6">{{ translate('Update') }}</button>
</form>

@include('core::modal')
