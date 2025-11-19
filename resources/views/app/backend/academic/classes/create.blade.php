<form action="">
    <div class="input-filed mb-3">
        <label for="class_name" class="form-label fs-14 fw-500 text-secondary mb-8">Name Of Class</label>
        <input type="text" class="form-control border rounded-6" id="class_name" name="class_name"
            placeholder="Name Of Class">
    </div>
    <div class="input-filed mb-3">
        <label for="monthly_tuition_fees" class="form-label fs-14 fw-500 text-secondary mb-8">Monthly
            Tuition Fees</label>
        <input type="number" class="form-control border rounded-6" id="monthly_tuition_fees"
            name="monthly_tuition_fees" placeholder="Monthly Tuition Fees">
    </div>
    <div class="input-filed mb-3 mb-3">
        <div class="d-flex align-items-center justify-content-between ">
            <label for="select_class_teacher" class="form-label fs-14 fw-500 text-secondary mb-8">Select Class Teacher
            </label>
            <div class="mb-8">
                <x-btn-modal :title="'Add Teacher '" :url="path(['backend::academic.techers.create', 'new' => 'CheckIt Out!'])" />
            </div>
        </div>

        <select class="form-select form-select-md" name="teacher_name" id="teacher_name">
            <option selected>Select one</option>
            <option value="">New Delhi</option>
            <option value="">Istanbul</option>
            <option value="">Jakarta</option>
        </select>
    </div>



</form>

@include('core::modal')
