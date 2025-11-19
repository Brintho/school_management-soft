<script>
    'use strict'

    function loadImage(elem, preview) {
        const file = elem.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            $(preview).attr('src', e.target.result);
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>


<script>
    $(document).ready(function() {
        $('.image-upload-area, .file-upload-btn').click(function() {
            var fileInput = $(this).siblings('input[type="file"]');
            if (fileInput.length) {
                fileInput.click();
            }
        });

        $('.image-upload-area ~ input[type="file"]').on('change', function() {
            loadImage($(this), $(this).data('previewer'));
        });


        $(document).on('click', '[data-btn]', function() {
            let action = $(this).data('btn');
            let table = $(this).data('table');
            let tableElement = document.getElementById(table);

            if (!tableElement) {
                error('Table not found');
                return;
            }

            if (action === "pdf") {
                exportToPDF(table);
            } else if (action === "print") {
                printTable(table);
            }
        });

        function exportToPDF(tableId) {
            let now = new Date();
            let timestamp = now.getFullYear() + "_" +
                (now.getMonth() + 1).toString().padStart(2, '0') + "_" +
                now.getDate().toString().padStart(2, '0') + "_" +
                now.getHours().toString().padStart(2, '0') + "_" +
                now.getMinutes().toString().padStart(2, '0');

            let formattedTableName = tableId.replace(/(^\w|-\w)/g, (match) => match.replace("-", "_").toUpperCase());
            let fileName = `${formattedTableName}_${timestamp}.pdf`;

            let tableElement = document.getElementById(tableId);
            success('Please wait pdf is downloading.');

            let clonedTable = tableElement.cloneNode(true);

            $(clonedTable).find('.print-d-none').remove();

            let opt = {
                margin: 0.25,
                filename: fileName,
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2,
                    useCORS: true
                },
                jsPDF: {
                    unit: 'in',
                    format: 'A4',
                    orientation: 'portrait'
                }
            };

            html2pdf().from(clonedTable).set(opt).save().then(() => {});
        }


        function printTable(table) {
            let tableElement = $('#' + table);
            let originalContent = $('body').html();
            let printContent = tableElement.prop('outerHTML');

            $('body').html(printContent);
            window.print();
            location.reload();
        }
    });
</script>

<script>
    "use strict";

    $(function() {
        $('a[href="#"]').on('click', function(event) {
            event.preventDefault();
        });
    });

    function redirectTo(url) {
        $(location).attr('href', url);
    }

    function ajaxCall(route, method = "GET", data = {}) {
        $.ajax({
            type: method,
            url: route,
            data: data,
            success: function(response) {
                distributeServerResponse(response);
            },
            error: function(xhr, status, error) {
                distributeServerResponse({
                    error: 'Something went wrong'
                });
                console.log(xhr);
                console.log(error);
                console.log(status);
            }
        });
    }

    function distributeServerResponse(response) {
        // Reload or redirect if needed
        if (response.reload) location.reload();
        if (response.redirectTo) window.location.href = response.redirectTo;

        // Show/hide elements
        if (response.show) $(response.show).show();
        if (response.hide) $(response.hide).hide();
        if (response.fadeIn) $(response.fadeIn).fadeIn();
        if (response.fadeOut) $(response.fadeOut).fadeOut();

        // Update element content
        if (response.html) $(response.html.elem).empty(response.append?.empty || false).html(response.html.content);
        if (response.text) $(response.text.elem).empty(response.append?.empty || false).text(response.text.content);
        if (response.append) $(response.append.elem).empty(response.append?.empty || false).append(response.append.content);
        if (response.prepend) $(response.prepend.elem).empty(response.append?.empty || false).prepend(response.prepend.content);
        if (response.after) $(response.after.elem).empty(response.append?.empty || false).after(response.after.content);


        // Manage CSS classes
        if (response.addClass) $(response.addClass.elem).addClass(response.addClass.content);
        if (response.removeClass) $(response.removeClass.elem).removeClass(response.removeClass.content);
        if (response.toggleClass) $(response.toggleClass.elem).toggleClass(response.toggleClass.content);

        // Show messages
        if (response.error) error(response.error);
        if (response.warning) warning(response.warning);
        if (response.success) success(response.success);

        if (response.print) console.log(response);
        if (response.catch) return response.catch;

        // Handle form validation errors
        if (response.validationError) {
            $('.form-validation-error-label').remove();
            Object.entries(response.validationError).forEach(([key, messages]) => {
                $("[name='" + key + "']").after(`<small class="text-danger form-validation-error-label">${messages[0]}</small>`);
            });
        }

        if (response.validationError) {
            $('.form-validation-error-label').remove();
            Object.entries(response.validationError).forEach(([key, messages]) => {
                $("[name='" + key + "']").after(`<small class="text-danger form-validation-error-label">${messages[0]}</small>`);
            });
        }


        // Call a function if specified
        if (response.fn) eval(response.fn);

        // Update browser history
        if (response.pushState) history.pushState({}, response.pushState.title, response.pushState.url);
    }

    function loadView(url, element, check_already_loaded) {
        if ($(element).text() == '' && check_already_loaded || !check_already_loaded) {
            $.ajax({
                url: url,
                success: function(response) {
                    $(element).html(response);
                }
            });
        }
    }

    function downloadTableAsCSV(elem, filename = 'data.csv') {
        var table = document.querySelector(elem);
        var csv = [];

        var rows = table.rows;
        for (var i = 0; i < rows.length; i++) {
            var row = [],
                cols = rows[i].cells;

            for (var j = 0; j < cols.length; j++) {
                row.push(cols[j].innerText);
            }

            csv.push(row.join(','));
        }

        var csvData = csv.join('\n');

        var blob = new Blob([csvData], {
            type: 'text/csv'
        });

        var link = document.createElement('a');
        link.href = window.URL.createObjectURL(blob);
        link.download = filename + '.csv';
        document.body.appendChild(link);
        link.trigger('click');
        document.body.removeChild(link);
    }
</script>


<script>
    "use strict";

    $(document).ready(function() {
        $('.checkPropagation').on('click', function(event) {
            var action = $(this).attr('action');
            var onclickFunction = $(this).attr('onclick');
            var onChange = $(this).attr('onchange');
            var tag = $(this).prop("tagName").toLowerCase();
            if (tag != 'a' && action) {
                $(location).attr('href', $(this).attr('action'));
                return false;
            } else if (onclickFunction) {
                if (onclickFunction) {
                    onclickFunction;
                }
                return false;
            } else if (tag == 'a') {
                return true;
            }
        });

        $('.copy-session').on('click', function() {
            var textToCopy = $(this).attr('data-bs-original-title');

            var $temp = $('<input>');
            $('body').append($temp);
            $temp.val(textToCopy).select();
            document.execCommand('copy');
            $temp.remove();

            success('Copied: ' + textToCopy);
        });

        $('.copy-text').on('click', function() {
            var textToCopy = $(this).text().trim();

            if (navigator.clipboard) {
                navigator.clipboard.writeText(textToCopy).then(function() {
                    success('Copied: ' + textToCopy);
                }).catch(function(err) {
                    error('Could not copy text', );
                });
            } else {
                var $temp = $('<input>');
                $('body').append($temp);
                $temp.val(textToCopy).select();
                document.execCommand('copy');
                $temp.remove();
                success('Copied: ' + textToCopy);
            }
        });
    });

    // dropdown menu
    $(document).ready(function() {
        $('.option-menu').click(function(e) {
            e.preventDefault();

            $('.option-dropdown-menu').not($(this).find('.option-dropdown-menu')).removeClass('active');
            $(this).find('.option-dropdown-menu').toggleClass('active');
        });

        $(document).click(function(e) {
            if (!$(e.target).closest('.option-menu').length) {
                $('.option-dropdown-menu').removeClass('active');
            }
        });
    });
</script>
