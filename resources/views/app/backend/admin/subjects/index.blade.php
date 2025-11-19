@extends('layouts::backend')
@push('title', translate('subjects'))

@push('breadcrumb')
@endpush

@section('content')
    <div class="card">
        <div class="card-header bg-white border-color p-10 border-bottom-0">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                <p class="fs-16 fw-500 text-secondary mb-0">{{ translate('All Subjects') }}</p>

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
                    <x-btn-canvas :title="translate('Add Subject')" :url="path(['backend::admin.subjects.create'])" />
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
                        <th scope="col">{{ translate('Class Name') }}</th>
                        <th scope="col">{{ translate('Subject Name') }}</th>
                        <th scope="col">{{ translate('Subject Category') }}</th>
                        <th scope="col">{{ translate('Marks') }}</th>
                        <th scope="col">{{ translate('Status') }}</th>
                        <th scope="col">
                            <span class="d-flex justify-content-end">{{ translate('Action') }}</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subjects as $key => $subject)
                        <tr>
                            <td class="d-flex align-items-center gap-2">
                                <input type="checkbox" id="row{{ $key }}"
                                    class="form-check-input rowCheckbox mt-0">
                                <label for="row{{ $key }}"
                                    class="form-check-label fs-12 mb-0">{{ $key + 1 }}</label>
                            </td>
                            <td>{{ $subject->classes->name }}</td>
                            <td>{{ $subject->name }}</td>
                            <td>{{ $subject->category }}</td>
                            <td>{{ $subject->marks }}</td>
                            <td>
                                @if ($subject->status == 1)
                                    <span
                                        class="badge badge-complete fs-10 fw-500 rounded-4">{{ translate('Active') }}</span>
                                @else
                                    <span
                                        class="badge badge-cancel fs-10 fw-500 rounded-4">{{ translate('Inactive') }}</span>
                                @endif
                            </td>

                            <td>
                                <x-dropdown>
                                    <x-drop-canvas :title="translate('Edit')" :url="path(['backend::admin.subjects.edit', 'id' => $subject->id])" :icon="'fi fi-rr-file-edit'" divider />
                                    <x-drop-delete :url="route('subjects.delete', $subject->id)" />
                                </x-dropdown>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="pagination-wraper p-12 d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div class="showing-pagination d-flex align-items-center gap-8">
                    <span class="fs-12">{{ translate('Showing') }}
                        {{ $subjects->firstItem() }}–{{ $subjects->lastItem() }} {{ translate('of') }}
                        {{ $subjects->total() }}</span>
                </div>
                <div class="pagination">
                    {{ $subjects->links() }}
                </div>
            </div>

        </div>
    </div>
@endsection
