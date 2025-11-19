@extends('layouts::backend')
@push('title', translate('School'))

@section('content')
    <div class="card">
        <div class="card-header bg-white border-color p-10 border-bottom-0">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                <p class="fs-16 fw-500 text-secondary mb-0">{{ translate('School List') }}</p>
                <div>
                    <div class="chart-control d-flex align-items-center flex-wrap gap-8">
                        <div class="message-search">
                            <form action="#" class="w-100">
                                <input type="search" class="form-control fs-12 border rounded-6" id="search"
                                    placeholder="{{ translate('Search') }}">
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

                        <div class="dropdown filtr-btn">
                            <button
                                class="btn btn-light bg-white border rounded-8 fs-12 fw-500 dropdown-toggle d-flex align-items-center gap-1"
                                type="button" data-bs-toggle="dropdown">
                                <span class="lh-1">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7.66732 14.4997C3.90065 14.4997 0.833984 11.433 0.833984 7.66634C0.833984 3.89967 3.90065 0.833008 7.66732 0.833008C11.434 0.833008 14.5007 3.89967 14.5007 7.66634C14.5007 11.433 11.434 14.4997 7.66732 14.4997Z"
                                            fill="#515155"></path>
                                        <path
                                            d="M14.6671 15.1663C14.5404 15.1663 14.4137 15.1196 14.3137 15.0196L12.0005 13C11.8072 12.8067 11.8072 12.4867 12.0005 12.2933C12.1938 12.1 12.5138 12.1 12.7072 12.2933L15.0204 14.313C15.2137 14.5063 15.2137 14.8263 15.0204 15.0196C14.9204 15.1196 14.7937 15.1663 14.6671 15.1663Z"
                                            fill="#515155"></path>
                                    </svg>
                                </span>
                                {{ translate('Filter') }}
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">{{ translate('Action') }}</a></li>
                                <li><a class="dropdown-item" href="#">{{ translate('Another Action') }}</a></li>
                                <li><a class="dropdown-item" href="#">{{ translate('Something Else') }}</a></li>
                            </ul>
                        </div>

                        <a class="btn btn-dark" href="{{ route('schools.create') }}">
                            {{ translate('Add School') }}
                        </a>

                    </div>
                </div>
            </div>
        </div>

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
                        <th scope="col">{{ translate('Title') }}</th>
                        <th scope="col">{{ translate('Email') }}</th>
                        <th scope="col">{{ translate('Phone') }}</th>
                        <th scope="col">{{ translate('Country') }}</th>
                        <th scope="col">{{ translate('Website') }}</th>
                        <th scope="col">{{ translate('Present Address') }}</th>
                        <th scope="col">{{ translate('Admission') }}</th>
                        <th scope="col">{{ translate('Logo') }}</th>
                        <th scope="col">{{ translate('Status') }}</th>
                        <th class="text-end" scope="col">{{ translate('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($schools as $key => $school)
                        <tr>
                            <td class="d-flex align-items-center gap-2">
                                <input type="checkbox" id="row{{ $key }}"
                                    class="form-check-input rowCheckbox mt-0">
                                <label for="row{{ $key }}"
                                    class="form-check-label fs-12 mb-0">{{ $key + 1 }}</label>
                            </td>
                            <td>{{ $school->school_name ?? translate('N/A') }}</td>
                            <td>{{ $school->email ?? translate('N/A') }}</td>
                            <td>{{ $school->phone ?? translate('N/A') }}</td>
                            <td>{{ $school->country ?? translate('N/A') }}</td>
                            <td>{{ $school->website ?? translate('N/A') }}</td>
                            <td>{{ $school->present_address ?? translate('N/A') }}</td>
                            <td>
                                @if ($school->is_admission_going)
                                    <span class="badge bg-success-subtle text-success">{{ translate('Yes') }}</span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger">{{ translate('No') }}</span>
                                @endif
                            </td>
                            <td>
                                @if ($school->logo)
                                    <img src="{{ $school->logo }}" width="35" height="35" class="rounded-circle">
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td>
                                @if ($school->status == 'active')
                                    <span class="badge badge-complete">{{ translate('Active') }}</span>
                                @elseif ($school->status == 'pending')
                                    <span class="badge badge-pending">{{ translate('Pending') }}</span>
                                @else
                                    <span class="badge badge-cancel">{{ translate('Inactive') }}</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <x-dropdown>
                                    <x-drop-item :title="translate('Edit')" :url="route('schools.edit', $school->id)" :icon="'fi fi-rr-file-edit'" />

                                    <x-drop-delete :url="route('schools.delete', $school->id)" />
                                </x-dropdown>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%" class="text-center">{{ translate('No Data Found') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="pagination-wraper p-12 d-flex justify-content-between flex-wrap gap-2">
                <span class="fs-12">
                    {{ translate('Showing') }} {{ $schools->firstItem() }} {{ translate('to') }}
                    {{ $schools->lastItem() }} {{ translate('of') }} {{ $schools->total() }}
                </span>
                {{ $schools->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
