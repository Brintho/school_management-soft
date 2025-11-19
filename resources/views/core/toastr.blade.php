<div class="toast-container position-fixed"></div>

<script>
    "Use strict";

    function toastrMsg(type, border, icon, header, message) {
        var toastr = `
            <div class="toast bg-${type}-subtle border-${type}-subtle slide text-12" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-body d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-1">
                        <div class="toast-icon-holder"><i class="${icon} text-${type} fs-6 d-flex"></i></div>
                        <span class="text-${type} fw-medium">${message}</span>
                    </div>

                    <button type="button" class="bg-transparent d-inline-flex text-${type} fs-6" data-bs-dismiss="toast">
                        <i class="fi fi-rr-circle-xmark"></i>
                    </button>
                </div>
            </div>
            `;

        $('.toast-container').prepend(toastr);
        const toast = new bootstrap.Toast('.toast');
        toast.show();
    }

    function success(message) {
        toastrMsg('success', '', 'fi-sr-badge-check', 'Success !', message);
    }

    function warning(message) {
        toastrMsg('warning', '', 'fi-sr-exclamation', 'Attention !', message);
    }

    function error(message) {
        toastrMsg('danger', '', 'fi-sr-triangle-warning', 'An Error Occurred !', message);
    }

    function dark(message) {
        toastrMsg('dark', '', '', '', message);
    }
</script>

@php
    $alertTypes = ['success', 'error', 'warning', 'info', 'dark', 'light'];
@endphp

@foreach ($alertTypes as $type)
    @if ($message = Session::get($type))
        <script>
            {{ $type }}("{{ $message }}");
        </script>
        @php Session::forget($type); @endphp
    @endif
@endforeach

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            error("{{ $error }}");
        </script>
    @endforeach
@endif
