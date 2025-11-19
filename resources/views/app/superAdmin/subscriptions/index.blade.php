@extends('layouts::backend')
@push('title', translate('Users'))

@push('breadcrumb')
@endpush

@section('content')
    <div class="card">
        <div class="card-header bg-white border-color p-10 border-bottom-0">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                <p class="fs-16 fw-500 text-secondary mb-0">{{ translate('All Subscriptions') }}</p>

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
                    <x-btn-canvas :title="translate('Add Subscription')" :url="path(['app.superAdmin.subscriptions.create'])" />
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
                        <th scope="col">{{ translate('Name & Email') }}</th>
                        <th scope="col">{{ translate('Phone') }}</th>
                        <th scope="col">{{ translate('Address') }}</th>

                        <th scope="col">
                            <span class="d-flex justify-content-end">{{ translate('Action') }}</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subscriptions as $subscription)
                        <tr>
                            <td class="d-flex align-items-center gap-2">
                                <input type="checkbox" id="row{{ $loop->iteration }}"
                                    class="form-check-input rowCheckbox mt-0">
                                <label for="row{{ $loop->iteration }}"
                                    class="form-check-label fs-12 mb-0">{{ $loop->iteration }}</label>
                            </td>

                            <td>
                                <div class="d-flex align-items-center gap-8">
                                    <figure>
                                        <img src="{{ $subscription->photo }}" class="rounded-circle img-fluid"
                                            width="45" height="45" alt="subscription">
                                    </figure>
                                    <div class="form-check-label fs-12">
                                        <span class="d-block fw-500 mb-6">{{ $subscription->name ?? 'N/A' }}</span>
                                        <span class="text-body">{{ $subscription->email ?? 'N/A' }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $subscription->phone }}</td>
                            <td>{{ $subscription->address }}</td>

                            <td>
                                <x-dropdown>
                                    <x-drop-canvas :title="translate('Edit')" :url="path(['app.superAdmin.subscriptions.edit', 'id' => $subscription->id])" :icon="'fi fi-rr-file-edit'" divider />
                                    <x-drop-delete :url="route('subscriptions.delete', $subscription->id)" />
                                </x-dropdown>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="pagination-wraper p-12 d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div class="showing-pagination d-flex align-items-center gap-8">
                    <span class="fs-12">{{ translate('Showing') }}
                        {{ $subscriptions->firstItem() }}–{{ $subscriptions->lastItem() }} {{ translate('of') }}
                        {{ $subscriptions->total() }}</span>
                </div>
                <div class="pagination">
                    {{ $subscriptions->links() }}
                </div>
            </div>

        </div>
    </div>
@endsection
