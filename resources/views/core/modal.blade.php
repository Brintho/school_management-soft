<!-- Loading Placeholder -->
<div class="placeholder-content d-none">
    <div class="d-flex justify-content-center align-items-center flex-column" id="loading-placeholder">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <p class="py-3 text-center">Loading, please wait...</p>
    </div>
</div>

<!-- Modal Structure -->
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fw-medium fs-6" id="modalLabel"></h1>
                <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fi fi-br-cross-small"></i>
                </button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>


<!-- delete modal start -->
<div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="delete-modal-label" aria-hidden="true">
    <div class="modal-dialog sm-modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h5 class="text-danger">Are you sure?</h5>
            </div>

            <div class="modal-body">
                <div class="sm-modal-content border-0 text-center">
                    <p class="fw-medium fs-12px text-secondary">
                        <span class="d-block">If you choose "Confirm"</span>
                        <span>You will not be able to undo this action.</span>
                    </p>
                </div>


                <div class="d-flex align-items-center justify-content-center mt-3 gap-2">
                    <button type="button" data-bs-dismiss="modal" class="btn btn-light-dark">
                        Cancel
                    </button>

                    <form method="post">@csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            Confirm
                        </button>
                    </form>
                </div>
            </div>

            <div class="modal-footer"></div>
        </div>
    </div>
</div>



<!-- confirm modal start -->
<div class="modal fade" id="confirmable" tabindex="-1" aria-labelledby="confirmable-label" aria-hidden="true">
    <div class="modal-dialog sm-modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h5 class="text-danger">Are you sure?</h5>
            </div>

            <div class="modal-body">
                <div class="sm-modal-content border-0 text-center">
                    <p class="fw-medium fs-12px text-secondary">
                        <span class="d-block">If you choose "Confirm"</span>
                        <span>You will not be able to undo this action.</span>
                    </p>
                </div>


                <div class="d-flex align-items-center justify-content-center mt-3 gap-2">
                    <form method="post">@csrf
                        <button type="submit" class="btn btn-danger">
                            Confirm
                        </button>
                    </form>

                    <button type="button" data-bs-dismiss="modal" class="btn btn-light-dark">
                        Cancel
                    </button>
                </div>
            </div>

            <div class="modal-footer"></div>
        </div>
    </div>
</div>


<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title title fs-16px" id="offcanvasRightLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-flex justify-content-center align-items-center">

    </div>
</div>


<script>
    $(document).ready(function() {

        // normal modal
        $('button[data-modal="modal"]').on('click', function() {
            const button = $(this);
            const url = button.data('url');
            const title = button.data('title') || button.text().trim();
            const size = button.data('size') || '';

            const modal = $('#modal');
            const modalBody = modal.find('.modal-body');
            const modalDialog = modal.find('.modal-dialog');

            modalBody.html($('.placeholder-content').html());

            modal.find('.modal-title').text(title);
            modalDialog.attr('class', `modal-dialog modal-dialog-centered ${size}`);

            modal.modal('show');

            $.get(url)
                .done(function(response) {
                    modalBody.html(response);
                })
                .fail(function() {
                    modalBody.html(
                        '<p class="text-center text-danger">Failed to load content.</p>');
                });
        });


        // delete modal
        $('button[data-modal="delete"]').on('click', function() {
            const $this = $(this);
            const url = $this.data('url');

            const confirmModal = $('#delete-modal');
            const confirmForm = confirmModal.find('form');

            confirmForm.attr('action', url);
            confirmModal.modal('show');
        });


        // confirmable modal
        $('button[data-modal="confirmable"]').on('click', function() {
            const $this = $(this);
            const url = $this.data('url');

            const confirmModal = $('#confirmable');
            const confirmForm = confirmModal.find('form');

            confirmForm.attr('action', url);
            confirmModal.modal('show');
        });


        // right canvas
        $('button[data-modal="r-canvas"]').on('click', function() {
            const buttonData = getOffcanvasData($(this));
            openOffcanvas(buttonData);
        });

        function getOffcanvasData(button) {
            return {
                url: button.data('url'),
                title: button.data('title') || button.text().trim(),
                size: button.data('size') || ''
            };
        }

        function openOffcanvas(data) {
            const modal = $('#offcanvasRight');
            const modalBody = modal.find('.offcanvas-body');

            modalBody.html($('.placeholder-content').html());

            modal.find('.offcanvas-title').text(data.title);

            modal.offcanvas('show');

            if (data.url) {
                $.get(data.url)
                    .done(function(response) {
                        modalBody.removeClass('d-flex align-items-center justify-content-center').html(
                            response);
                    })
                    .fail(function() {
                        modalBody.html('<p class="text-center text-danger">Failed to load content.</p>');
                    });
            }
        }

    });
</script>
