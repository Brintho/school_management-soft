@php
    $package = App\Models\Package::find($id);
    $packageFeatures = App\Models\packageFeatures::where('package_id', $id)->orderBy('sort_order', 'asc')->get();
    $packages_data = App\Models\Package::all();
@endphp

<style>
    .sort-section:hover {}
</style>

<form action="{{ route('package.features.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')

    <input type="hidden" name="package_id" value="{{ $package->id }}">

    <div class="input-field mb-3">
        <label for="title" class="form-label fs-14 fw-500 text-secondary mb-8">{{ translate('Title') }}</label>
        <input type="text" class="form-control border rounded-6" id="title" name="title">
    </div>

    <button type="submit" class="btn btn-dark rounded-6">{{ translate('Save') }}</button>
</form>

<ul id="feature-list" class="list-unstyled mb-0 mt-4">
    @foreach ($packageFeatures as $feature)
        <li class="draggable-item mb-6 cursor-pointer" id="{{ $feature->id }}">
            <div class="crm-alert sort-section p-2 d-flex gap-3 align-items-center rounded border bg-white">
                <x-btn-canvas :title="translate('Edit')" :icon="'fi fi-rr-magic-wand'" :url="path(['app.superAdmin.packageFeatures.edit', 'id' => $feature->id])" :class="''" />

                <span class="cursor-move">
                    <i class="fi-rr-apps-sort text-muted"></i>
                </span>

                <div class="d-flex align-items-center gap-2">
                    <span class="fw-500">{{ $feature->title }}</span>
                </div>
            </div>
        </li>
    @endforeach
</ul>

<script type="text/javascript">
    $(function() {
        $("#feature-list").sortable({
            placeholder: "ui-state-highlight",
            cursor: "move",
            opacity: 0.8,
            update: function(event, ui) {
                autoUpdateFeatureSort("{{ $package->id }}");
            }
        });
    });

    function autoUpdateFeatureSort(package_id) {
        let itemArray = [];
        $('#feature-list .draggable-item').each(function() {
            itemArray.push(this.id);
        });

        if (!itemArray.length) {
            return error("{{ translate('Unable to sort items') }}");
        }

        let itemJSON = JSON.stringify(itemArray);

        $.ajax({
            url: "{{ route('package.feature.sort') }}",
            type: 'POST',
            data: {
                items: itemJSON,
                packageId: package_id,
            },

            success: function(response) {
                if (response.success) {
                    return success(response.success);
                }

                return error('{{ translate('Something went wrong') }}');
            }
        });
    }
</script>

@include('core::modal')
