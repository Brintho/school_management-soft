@extends('layouts::backend')
@push('title', translate('classes'))

@push('breadcrumb')
@endpush

@section('content')
    <div class="card">
        <div class="card-header bg-white border-color p-10 border-bottom-0">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                <p class="fs-16 fw-500 text-secondary mb-0">{{ translate('All classes') }}</p>

                <div class="chart-control d-flex align-items-center flex-wrap gap-8">
                    <div class="message-search">
                        <form action="#" class="w-100">
                            <input type="search" class="form-control fs-12 border rounded-6" id="search"
                                placeholder="{{ translate('Search by title') }}">
                            <label for="search">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.66732 14.4997C3.90065 14.4997 0.833984 11.433 0.833984 7.66634C0.833984 3.89967 3.90065 0.833008 7.66732 0.833008C11.434 0.833008 14.5007 3.89967 14.5007 7.66634C14.5007 11.433 11.434 14.4997 7.66732 14.4997Z"
                                        fill="#515155"></path>
                                    <path
                                        d="M14.6671 15.1663C14.5404 15.1663 14.4137 15.1196 14.3137 15.0196L12.0005 13C11.8072 12.8067 11.8072 12.4867 12.0005 12.2933C12.1938 12.1 12.5138 12.1 12.7072 12.2933L15.0204 14.313C15.2137 14.5063 15.2137 14.8263 15.0204 15.0196C14.9204 15.1196 14.7937 15.1663 14.6671 15.1663Z"
                                        fill="#515155"></path>
                                </svg>
                            </label>
                        </form>
                    </div>
                    <x-btn-canvas :title="translate('Add class')" :url="path(['backend::admin.classes.create'])" />
                </div>
            </div>
        </div>

        <!-- Packages Table -->
        <div class="table-responsive fill">
            <table
                class="table align-middle fs-12 text-secondary student-table align-middle table-bordered all-studentTable mb-0">
                <thead class="table-light">
                    <tr class="fs-12 fw-400 text-uppercase">
                        <th scope="col">
                            <div class="d-flex align-items-center gap-6">
                                <input type="checkbox" id="name" class="form-check-input m-0">
                                <label for="name" class="form-check-label">{{ translate('#') }}</label>
                            </div>
                        </th>
                        <th scope="col">{{ translate('Name') }}</th>
                        <th scope="col">{{ translate('Section') }}</th>
                        <th scope="col">{{ translate('Capacity') }}</th>
                        <th scope="col">{{ translate('Description') }}</th>
                        <th scope="col">{{ translate('Status') }}</th>
                        <th scope="col">
                            <span class="d-flex justify-content-end">{{ translate('Action') }}</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classes as $key => $class)
                        <tr>
                            <td class="d-flex align-items-center gap-2">
                                <input type="checkbox" id="row{{ $key }}"
                                    class="form-check-input rowCheckbox mt-0">
                                <label for="row{{ $key }}"
                                    class="form-check-label fs-12 mb-0">{{ $key + 1 }}</label>
                            </td>
                            <td>{{ $class->name }}</td>
                            <td>
                                @if ($class->sections->count() > 0)
                                    @foreach ($class->sections as $section)
                                        {{ $section->name }}<br>
                                    @endforeach
                                @else
                                    N/A
                                @endif
                            </td>

                            <td>{{ $class->capacity }}</td>
                            <td>{{ $class->description }}</td>
                            <td>
                                @if ($class->status == 1)
                                    <span
                                        class="badge badge-complete fs-10 fw-500 rounded-4">{{ translate('Active') }}</span>
                                @else
                                    <span
                                        class="badge badge-cancel fs-10 fw-500 rounded-4">{{ translate('Inactive') }}</span>
                                @endif
                            </td>

                            <td>
                                <x-dropdown>
                                    <x-drop-canvas :title="translate('Edit')" :url="path(['backend::admin.classes.edit', 'id' => $class->id])" :icon="'fi fi-rr-file-edit'" divider />
                                    <x-drop-delete :url="route('classes.delete', $class->id)" />
                                </x-dropdown>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="pagination-wraper p-12 d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div class="showing-pagination d-flex align-items-center gap-8">
                    <span class="fs-12">{{ translate('Showing') }}
                        {{ $classes->firstItem() }}–{{ $classes->lastItem() }} {{ translate('of') }}
                        {{ $classes->total() }}</span>
                </div>
                <div class="pagination">
                    {{ $classes->links() }}
                </div>
            </div>

        </div>
    </div>


    {{-- @php
        $boys = 100;
        $girls = 40;
        $others = 30;
    @endphp

    <div class="classes-box">
        <div class="card">
            <div class="card-header bg-white p-10 border-bottom-0">
                <div class="d-flex align-items-center justify-content-between">
                    <p class="fs-16 fw-500 text-secondary mb-0">One</p>
                    <div class="classes-action">
                        <div class="dropdown d-flex justify-content-end">
                            <button class="btn btn-white border rounded-8 dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M15.4189 10.0001C15.4189 10.2303 15.2323 10.4169 15.0021 10.4169C14.7719 10.4169 14.5853 10.2303 14.5853 10.0001C14.5853 9.76988 14.7719 9.58325 15.0021 9.58325C15.2323 9.58325 15.4189 9.76988 15.4189 10.0001"
                                        stroke="#0E0F14" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M10.4168 10.0001C10.4168 10.2303 10.2302 10.4169 9.99997 10.4169C9.76976 10.4169 9.58313 10.2303 9.58313 10.0001C9.58313 9.76988 9.76976 9.58325 9.99997 9.58325C10.2302 9.58325 10.4168 9.76988 10.4168 10.0001"
                                        stroke="#0E0F14" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M5.41473 10.0001C5.41473 10.2303 5.22811 10.4169 4.99789 10.4169C4.76768 10.4169 4.58105 10.2303 4.58105 10.0001C4.58105 9.76988 4.76768 9.58325 4.99789 9.58325C5.22811 9.58325 5.41473 9.76988 5.41473 10.0001"
                                        stroke="#0E0F14" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </button>
                            <ul class="dropdown-menu rounded-6 dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">View</a></li>
                                <li><a class="dropdown-item" href="#">Edit</a></li>
                                <li><a class="dropdown-item" href="#">Delete</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="classes-content">
                    <h2 class="fs-30 fw-semibold lh-1 d-flex align-items-center gap-2 mb-30">
                        <span class="stu-num">10</span>
                        <span class="fs-16">STUDENTS</span>
                        <span class="stu-icon ms-auto">
                            <img src="assets/images/education.svg" alt="Job Portal">
                        </span>
                    </h2>

                    <div class="classes-circle d-flex align-items-center gap-3 flex-wrap">
                        <div class="chart-container">
                            <canvas id="boysChart"></canvas>
                            <div class="label-text">Boys<br><strong id="boysCount">50</strong></div>
                        </div>

                        <div class="chart-container">
                            <canvas id="girlsChart"></canvas>
                            <div class="label-text">Girls<br><strong id="girlsCount">0</strong></div>
                        </div>

                        <div class="chart-container">
                            <canvas id="naChart"></canvas>
                            <div class="label-text">N/A<br><strong id="naCount">0</strong></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection

@push('js')
    <script></script>
@endpush
