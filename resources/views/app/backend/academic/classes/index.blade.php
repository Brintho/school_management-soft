@extends('layouts::backend')
@push('title', 'Class')

@push('breadcrumb')
@endpush

@section('content')
    <div class="table-area">
        <div class="row row-20">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-white border-color p-10 border-bottom-0">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                            <p class="fs-16 fw-500 text-secondary mb-0">Student Performance</p>
                            <div>
                                <div class="chart-control d-flex align-items-center flex-wrap gap-8">
                                    <div class="message-search">
                                        <form action="#" class="w-100">
                                            <input type="search" class="form-control fs-12 border rounded-6" id="search"
                                                placeholder="Search">
                                            <label for="search">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M7.66732 14.4997C3.90065 14.4997 0.833984 11.433 0.833984 7.66634C0.833984 3.89967 3.90065 0.833008 7.66732 0.833008C11.434 0.833008 14.5007 3.89967 14.5007 7.66634C14.5007 11.433 11.434 14.4997 7.66732 14.4997ZM7.66732 1.83301C4.44732 1.83301 1.83398 4.45301 1.83398 7.66634C1.83398 10.8797 4.44732 13.4997 7.66732 13.4997C10.8873 13.4997 13.5007 10.8797 13.5007 7.66634C13.5007 4.45301 10.8873 1.83301 7.66732 1.83301Z"
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
                                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="lh-1">
                                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M10.5003 7.58341H3.50033C3.15033 7.58341 2.91699 7.35008 2.91699 7.00008C2.91699 6.65008 3.15033 6.41675 3.50033 6.41675H10.5003C10.8503 6.41675 11.0837 6.65008 11.0837 7.00008C11.0837 7.35008 10.8503 7.58341 10.5003 7.58341Z"
                                                        fill="#0E0F14"></path>
                                                    <path
                                                        d="M8.75033 11.0834H5.25033C4.90033 11.0834 4.66699 10.8501 4.66699 10.5001C4.66699 10.1501 4.90033 9.91675 5.25033 9.91675H8.75033C9.10033 9.91675 9.33366 10.1501 9.33366 10.5001C9.33366 10.8501 9.10033 11.0834 8.75033 11.0834Z"
                                                        fill="#0E0F14"></path>
                                                    <path
                                                        d="M12.2503 4.08341H1.75033C1.40033 4.08341 1.16699 3.85008 1.16699 3.50008C1.16699 3.15008 1.40033 2.91675 1.75033 2.91675H12.2503C12.6003 2.91675 12.8337 3.15008 12.8337 3.50008C12.8337 3.85008 12.6003 4.08341 12.2503 4.08341Z"
                                                        fill="#0E0F14"></path>
                                                </svg>
                                            </span>
                                            Filter
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                            <li><a class="dropdown-item" href="#">Another action</a></li>
                                            <li><a class="dropdown-item" href="#">Something else here</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <x-btn-canvas :title="'Add Class'" :url="path(['backend::academic.classes.create', 'new' => 'CheckIt Out!'])" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Student Table -->
                    <div class="table-responsive">
                        <table
                            class="table align-middle fs-12 text-secondary student-table align-middle table-bordered all-studentTable mb-0">
                            <thead class="table-light">
                                <tr class="fs-12 fw-400 text-uppercase">
                                    <th scope="col">
                                        <div class="d-flex align-items-center gap-6">
                                            <input type="checkbox" id="name" class="form-check-input m-0">
                                            <label for="name" class="form-check-label">#</label>
                                        </div>
                                    </th>
                                    <th scope="col ">Name</th>
                                    <th scope="col">Start Date</th>
                                    <th scope="col">location</th>
                                    <th scope="col">Active</th>
                                    <th scope="col">progess</th>
                                    <th scope="col">STATUS</th>
                                    <th scope="col">
                                        <span class="d-flex justify-content-end">Action</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="d-flex align-items-center gap-2">
                                        <input type="checkbox" id="author01" class="form-check-input rowCheckbox mt-0">
                                        <label for="author01"
                                            class="form-check-label fs-12 mb-0 d-flex align-items-center justify-content-between">01</label>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-8">
                                            <figure>
                                                <img src="assets/images/students/student-01.jpg"
                                                    class="rounded-circle img-fluid" alt="OnlineEdu">
                                            </figure>
                                            <div class="form-check-label fs-12">
                                                <span class="d-block fw-500 mb-6">Ronald Richards</span>
                                                <span class="text-body">ronald@gmail.com</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>14 January 2025</td>
                                    <td>
                                        <p class="table-location">708-D Fairground Rd, Lucasville, OH 45648</p>
                                    </td>
                                    <td>
                                        <div class="form-switch dtable-switch p-0">
                                            <input class="form-check-input" type="checkbox" role="switch" id="dswitch4"
                                                checked="">
                                        </div>
                                    </td>
                                    <td>
                                        <span class="spinner-border spinner-border-sm ms-1" role="status"></span>
                                    </td>
                                    <td>
                                        <span class="badge badge-pending fs-10 fw-500 rounded-4">Pending</span>
                                    </td>
                                    <td>
                                        <div class="dropdown d-flex justify-content-end">
                                            <button class="btn btn-white border rounded-8 dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M11.375 5.25L7 9.625L2.625 5.25" stroke="#0E0F14"
                                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                    </path>
                                                </svg>
                                            </button>
                                            <ul class="dropdown-menu rounded-12 profile-dropdown-action" style="">
                                                <li><a class="dropdown-item" href="javascript:void(0);">Edit
                                                        Profile</a></li>
                                                <li><a class="dropdown-item" href="javascript:void(0);">Settings</a></li>
                                                <li class="divider"><a class="dropdown-item"
                                                        href="javascript:void(0);">Help &amp; Support</a></li>
                                                <li><a class="dropdown-item" href="javascript:void(0);">Privacy</a></li>
                                                <li class="divider"><a class="dropdown-item"
                                                        href="javascript:void(0);">Another action</a></li>
                                                <li><a class="dropdown-item delete" href="javascript:void(0);">Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div
                            class="pagination-wraper p-12 d-flex align-items-center justify-content-between flex-wrap gap-2">
                            <div class="showing-pagination d-flex align-items-center gap-8">
                                <span class="fs-12">Showing</span>
                                <select name="" id="" class="nice-control" style="display: none;">
                                    <option value="" selected="">10</option>
                                    <option value="">1</option>
                                    <option value="">2</option>
                                    <option value="">3</option>
                                    <option value="">4</option>
                                    <option value="">5</option>
                                    <option value="">6</option>
                                    <option value="">7</option>
                                    <option value="">8</option>
                                    <option value="">9</option>
                                    <option value="">10</option>
                                    <option value="">11</option>
                                    <option value="">12</option>
                                    <option value="">13</option>
                                    <option value="">14</option>
                                    <option value="">15</option>
                                    <option value="">16</option>
                                    <option value="">17</option>
                                    <option value="">18</option>
                                    <option value="">19</option>
                                    <option value="">20</option>
                                    <option value="">21</option>
                                    <option value="">22</option>
                                </select>
                                <div class="nice-select nice-control" tabindex="0"><span class="current">10</span>
                                    <ul class="list">
                                        <li data-value="" class="option selected">10</li>
                                        <li data-value="" class="option">1</li>
                                        <li data-value="" class="option">2</li>
                                        <li data-value="" class="option">3</li>
                                        <li data-value="" class="option">4</li>
                                        <li data-value="" class="option">5</li>
                                        <li data-value="" class="option">6</li>
                                        <li data-value="" class="option">7</li>
                                        <li data-value="" class="option">8</li>
                                        <li data-value="" class="option">9</li>
                                        <li data-value="" class="option">10</li>
                                        <li data-value="" class="option">11</li>
                                        <li data-value="" class="option">12</li>
                                        <li data-value="" class="option">13</li>
                                        <li data-value="" class="option">14</li>
                                        <li data-value="" class="option">15</li>
                                        <li data-value="" class="option">16</li>
                                        <li data-value="" class="option">17</li>
                                        <li data-value="" class="option">18</li>
                                        <li data-value="" class="option">19</li>
                                        <li data-value="" class="option">20</li>
                                        <li data-value="" class="option">21</li>
                                        <li data-value="" class="option">22</li>
                                    </ul>
                                </div>
                                <span class="fs-12">of 50</span>
                            </div>
                            <div class="pagination">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M9.75592 0.245054C10.0814 0.570491 10.0814 1.09813 9.75592 1.42357L5.34518 5.83431L9.75592 10.2451C10.0814 10.5705 10.0814 11.0981 9.75592 11.4236C9.43048 11.749 8.90285 11.749 8.57741 11.4236L3.57741 6.42357C3.25197 6.09813 3.25197 5.57049 3.57741 5.24505L8.57741 0.245054C8.90285 -0.0803827 9.43049 -0.0803827 9.75592 0.245054Z"
                                                    fill="#515155"></path>
                                            </svg>
                                        </a>
                                    </li>
                                    <li class="active"><span>1</span></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">...</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
                                    <li>
                                        <a href="#">
                                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M2.24408 11.7569C1.91864 11.4315 1.91864 10.9038 2.24408 10.5784L6.65482 6.16764L2.24408 1.7569C1.91864 1.43146 1.91864 0.903825 2.24408 0.578388C2.56952 0.252951 3.09715 0.252951 3.42259 0.578388L8.42259 5.57839C8.74803 5.90382 8.74803 6.43146 8.42259 6.7569L3.42259 11.7569C3.09715 12.0823 2.56951 12.0823 2.24408 11.7569Z"
                                                    fill="#515155"></path>
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
