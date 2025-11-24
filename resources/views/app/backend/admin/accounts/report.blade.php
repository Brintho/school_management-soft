@extends('layouts::backend')
@push('title', translate('Account Report'))

@push('breadcrumb')
@endpush

@section('content')
    <div class="card">

        {{-- Header --}}
        <div class="card-header bg-white border-color p-10 border-bottom-0">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                <p class="fs-16 fw-500 text-secondary mb-0">{{ translate('Account Report') }}</p>

                <div class="chart-control d-flex align-items-center flex-wrap gap-8">

                    {{-- Date Range Filter --}}
                    <div class="d-flex gap-2">
                        <input type="date" id="fromDate" class="form-control fs-12" />
                        <input type="date" id="toDate" class="form-control fs-12" />
                    </div>

                    {{-- Search --}}
                    <div class="message-search">
                        <form action="#" class="w-100">
                            <input type="search" class="form-control fs-12 border rounded-6" id="search" placeholder="{{ translate('Search...') }}">
                            <label for="search">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.66732 14.4997C3.90065 14.4997 0.833984 11.433 0.833984 7.66634C0.833984 3.89967 3.90065 0.833008 7.66732 0.833008C11.434 0.833008 14.5007 3.89967 14.5007 7.66632C14.5007 11.433 11.434 14.4997 7.66732 14.4997Z" fill="#515155" />
                                    <path
                                        d="M14.6671 15.1663C14.5404 15.1663 14.4137 15.1196 14.3137 15.0196L12.0005 13C11.8072 12.8067 11.8072 12.4867 12.0005 12.2933C12.1938 12.1 12.5138 12.1 12.7072 12.2933L15.0204 14.313C15.2137 14.5063 15.2137 14.8263 15.0204 15.0196C14.9204 15.1196 14.7937 15.1663 14.6671 15.1663Z"
                                        fill="#515155" />
                                </svg>
                            </label>
                        </form>
                    </div>
                    <x-btn-canvas :title="translate('Add Income')" :url="path(['backend::admin.accounts.income_entries.create'])" />
                    <x-btn-canvas :title="translate('Add Expense')" :url="path(['backend::admin.accounts.expense_entries.create'])" />

                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="table-responsive fill p-3">
            <table id="reportTable" class="table align-middle fs-12 text-secondary student-table align-middle table-bordered mb-0">
                <thead class="table-light">
                    <tr class="fs-12 fw-400 text-uppercase">
                        <th scope="col">{{ translate('Date') }}</th>
                        {{-- <th scope="col">{{ translate('Title') }}</th> --}}
                        <th scope="col">{{ translate('Description') }}</th>
                        <th scope="col">{{ translate('Debit (-)') }}</th>
                        <th scope="col">{{ translate('Credit (+)') }}</th>
                        <th scope="col">{{ translate('Net Balance') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($entries as $e)
                        <tr>
                            <td>{{ date('d-m-Y', strtotime($e['date'])) }}</td>
                            <td>{{ $e['description'] }}</td>

                            {{-- Debit (Expense) --}}
                            <td class="text-danger">
                                {{ $e['debit'] > 0 ? '- $' . number_format($e['debit'], 2) : '' }}
                            </td>

                            {{-- Credit (Income) --}}
                            <td class="text-primary">
                                {{ $e['credit'] > 0 ? '+ $' . number_format($e['credit'], 2) : '' }}
                            </td>

                            {{-- Net Result --}}
                            <td>
                                @if ($e['net'] > 0)
                                    <span class="text-success">$ {{ number_format($e['net'], 2) }}</span>
                                @elseif($e['net'] < 0)
                                    <span class="text-danger">$ {{ number_format($e['net'], 2) }}</span>
                                @else
                                    <span>$ 0</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
@endsection


@push('js')
    <!-- DataTables & Export Buttons -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

    <script>
        $(document).ready(function() {

            let table = $('#reportTable').DataTable({
                paging: false,
                info: false,
                searching: false,
                ordering: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy',
                    'csv',
                    'excel',
                    {
                        extend: 'pdfHtml5',
                        title: '',
                        orientation: 'portrait',
                        pageSize: 'A4',
                        customize: function(doc) {
                            let from = $('#fromDate').val() || '--';
                            let to = $('#toDate').val() || '--';

                            doc.content.splice(0, 0, {
                                text: 'School Name: Your School\nAccount Report\nDate Range: ' + from + ' to ' + to,
                                fontSize: 12,
                                alignment: 'center',
                                margin: [0, 0, 0, 10],
                                bold: true
                            });

                            doc.footer = function(page, pages) {
                                return {
                                    text: 'Page ' + page + ' of ' + pages,
                                    alignment: 'right',
                                    margin: [10, 10]
                                };
                            };
                        }
                    },
                    {
                        extend: 'print',
                        title: '',
                        customize: function(win) {
                            $(win.document.body).prepend(
                                '<h3 class="text-center">Account Report</h3>'
                            );
                        }
                    }
                ]
            });



            // Date Range Filter
            $("#fromDate, #toDate").on("change", function() {
                let from = $("#fromDate").val();
                let to = $("#toDate").val();

                $.fn.dataTable.ext.search.push(function(settings, data) {
                    let date = data[0].split("-").reverse().join("-");
                    if (!from && !to) return true;
                    if (from && date < from) return false;
                    if (to && date > to) return false;
                    return true;
                });

                table.draw();
                $.fn.dataTable.ext.search.pop();
            });

        });
    </script>
@endpush
