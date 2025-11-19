<script type="text/javascript">
    "use strict";

    $(document).ready(function() {

        if ($('.chosen-select').length > 0) {
            $('.chosen-select').each(function() {
                $(this).chosen({
                    allow_single_deselect: true,
                    no_results_text: "Oops, no match found!",
                    width: "100%"
                });
            });
        }


        if ($(".owl-carousel").length > 0) {
            $(".owl-carousel").each(function() {
                $(this).owlCarousel({
                    loop: true,
                    margin: 10,
                    nav: true,
                    dots: false,
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 3
                        },
                        1000: {
                            items: 5
                        }
                    }
                });
            });
        }


        if ($('.tinymce-textarea').length > 0) {
            $('.tinymce-textarea').each(function() {
                tinymce.init({
                    selector: '.tinymce-textarea',
                    plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
                    toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen preview save print | insertfile image media template link anchor codesample | ltr rtl',
                    height: $(this).data('height') || 730
                });
            });
        }

        if ($('.quill').length > 0) {
            $('.quill').each(function() {
                let $editor = $(this);
                let fieldName = $editor.data('name');

                // Initialize Quill
                let quill = new Quill(this, {
                    theme: 'snow',
                    placeholder: 'Start typing here...',
                    modules: {
                        toolbar: [
                            ['bold', 'italic', 'underline'],
                            [{
                                'list': 'ordered'
                            }, {
                                'list': 'bullet'
                            }],
                            ['link', 'image', 'code-block'],
                            ['clean']
                        ]
                    }
                });

                // Set initial content from the corresponding hidden input
                let initialContent = $('input[name="' + fieldName + '"]').val();
                quill.root.innerHTML = initialContent;

                // Update hidden input on change
                quill.on('text-change', function() {
                    $('input[name="' + fieldName + '"]').val(quill.root.innerHTML);
                });
            });
        }

        const sortable = $('.sortable');
        if (sortable.length) {
            const axis = sortable.data('axis') ?? 'x';
            const config = (axis === 'xy') ? {
                tolerance: "pointer",
                scroll: true
            } : {
                axis
            };

            sortable.sortable(config);
        }

        const masonry = $('.masonry-layout');
        if (masonry.length) {
            masonry.isotope({
                itemSelector: masonry.data('item'),
                percentPosition: true,
                masonry: {
                    columnWidth: masonry.data('sizer')
                }
            });
        }

    });


    $(function() {
        // Date range picker
        if ($('.daterangepicker:not(.initJs)').length) {
            $('.daterangepicker:not(.initJs)').daterangepicker();
            $('.daterangepicker:not(.initJs)').addClass('initJs');
        }

        // icon picker
        if ($('.icon-picker:not(.initJs)').length) {
            $('.icon-picker:not(.initJs)').iconpicker();
            $('.icon-picker:not(.initJs)').addClass('initJs');
        }



        //Select 2
        if ($('#ajaxModal select.sch_select2:not(.initJs)').length) {
            $('#ajaxModal select.sch_select2:not(.initJs)').select2({
                dropdownParent: $('#ajaxModal')
            });
            $('#ajaxModal select.sch_select2:not(.initJs)').addClass('initJs');
        }
        if ($('#right-modal select.sch_select2:not(.initJs)').length) {
            $('#right-modal select.sch_select2:not(.initJs)').select2({
                dropdownParent: $('#right-modal')
            });
            $('#right-modal select.sch_select2:not(.initJs)').addClass('initJs');
        }
        if ($('select.demo:not(.initJs)').length) {
            $('select.demo:not(.initJs)').select2();
            $('select.demo:not(.initJs)').addClass('initJs');
        }

        if ($('#ajaxModal select.select2:not(.initJs)').length) {
            $('#ajaxModal select.select2:not(.initJs)').select2({
                dropdownParent: $('#ajaxModal')
            });
            $('#ajaxModal select.select2:not(.initJs)').addClass('initJs');
        }
        if ($('#right-modal select.select2:not(.initJs)').length) {
            $('#right-modal select.select2:not(.initJs)').select2({
                dropdownParent: $('#right-modal')
            });
            $('#right-modal select.select2:not(.initJs)').addClass('initJs');
        }
        if ($('select.select2:not(.initJs)').length) {
            $('select.select2:not(.initJs)').select2();
            $('select.select2:not(.initJs)').addClass('initJs');
        }

        //Text editor
        if ($('.summernote').length) {
            $('.summernote').each(function() {
                $(this).summernote({
                    height: 250, // editor height
                    minHeight: null,
                    maxHeight: null,
                    focus: false,
                    toolbar: [
                        // customize toolbar buttons if needed
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['fontsize', 'color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['insert', ['link', 'picture', 'video']],
                        ['view', ['fullscreen', 'codeview']]
                    ]
                });
            });
        }


        $('.tagify:not(.initJs)').each(function(index, element) {
            var tagify = new Tagify(element, {
                placeholder: 'Enter your keywords'
            });
            $(element).addClass('initJs');
        });

        var formElement;
        if ($('.ajaxForm:not(.initialized)').length > 0) {
            $('.ajaxForm:not(.initialized)').ajaxForm({
                beforeSend: function(data, form) {
                    var formElement = $(form);
                },
                uploadProgress: function(event, position, total, percentComplete) {},
                complete: function(xhr) {

                    setTimeout(function() {
                        distributeServerResponse(xhr.responseText);
                    }, 400);

                    if ($('.ajaxForm.resetable').length > 0) {
                        $('.ajaxForm.resetable')[0].reset();
                    }
                },
                error: function(e) {
                    console.log(e);
                }
            });
            $('.ajaxForm:not(.initialized)').addClass('initialized');
        }
    });
</script>
