 @extends('layouts::backend')
 @push('title', translate('Add/update attendance'))

 @section('content')
     <div class="table-area">
         <div class="row row-20">
             <div class="col-12">
                 <div class="card">
                     <div class="card-header bg-white border-color p-10 border-bottom-0">
                         <div class="d-flex align-items-center justify-content-center">
                             <div class="attendance-text text-center">
                                 <p class="sub-text">
                                     <span class="taken"><img src="{{ asset('assets/backend/images/check.svg') }}" alt=""> Already taken</span><span class="depertment">CSE</span></span><span class="section"><small>Magna</small> 23 Nov, 2025</span>
                                 </p>
                                 <h4>Update Attendance</h4>
                                 <p class="marks-note">
                                     <span><img src="{{ asset('assets/backend/images/present.svg') }}" alt=""> Present</span>
                                     <span><img src="{{ asset('assets/backend/images/absent.svg') }}" alt=""> Absent</span>
                                 </p>
                             </div>
                         </div>
                     </div>
                     <!-- Student Table -->
                     <div class="table-responsive">
                         <table class="table align-middle fs-12 text-secondary student-table align-middle table-bordered all-studentTable mb-0">
                             <thead class="table-light">
                                 <tr class="fs-12 fw-400 text-uppercase">
                                     <th scope="col">
                                         <div class="d-flex align-items-center gap-6">
                                             <input type="checkbox" id="name" class="form-check-input m-0 selectAll">
                                             <label for="name" class="form-check-label">ID</label>
                                         </div>
                                     </th>
                                     <th scope="col ">Image</th>
                                     <th scope="col ">Name</th>
                                     <th scope="col ">Subject</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <tr>
                                     <td class="d-flex align-items-center gap-2">
                                         <input type="checkbox" id="author01" class="form-check-input rowCheckbox mt-0">
                                         <label for="author01" class="form-check-label fs-12 mb-0 d-flex align-items-center justify-content-between">01</label>
                                     </td>
                                     <td>
                                         <div class="d-flex align-items-center gap-8">
                                             <figure>
                                                 <img src="assets/images/students/student-01.jpg" class="rounded-circle img-fluid" alt="OnlineEdu">
                                             </figure>
                                         </div>
                                     </td>

                                     <td>
                                         <div class="form-check-label fs-12">
                                             <span class="d-block fw-500 mb-6">Ronald Richards</span>
                                         </div>
                                     </td>
                                     <td>
                                         <div class="form-check-label fs-12">
                                             <span class="d-block fw-500 mb-6">Bangla</span>
                                         </div>
                                     </td>

                                 </tr>

                             </tbody>
                         </table>
                         <div class="pagination-wraper p-12 d-flex align-items-center justify-content-between flex-wrap gap-2">
                             <div class="showing-pagination d-flex align-items-center gap-8">
                                 <span class="fs-12">Showing</span>
                                 <select name="" id="" class="nice-control">
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
                                 <span class="fs-12">of 50</span>
                             </div>
                             <div class="pagination">
                                 <ul>
                                     <li>
                                         <a href="#">
                                             <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                 <path fill-rule="evenodd" clip-rule="evenodd"
                                                     d="M9.75592 0.245054C10.0814 0.570491 10.0814 1.09813 9.75592 1.42357L5.34518 5.83431L9.75592 10.2451C10.0814 10.5705 10.0814 11.0981 9.75592 11.4236C9.43048 11.749 8.90285 11.749 8.57741 11.4236L3.57741 6.42357C3.25197 6.09813 3.25197 5.57049 3.57741 5.24505L8.57741 0.245054C8.90285 -0.0803827 9.43049 -0.0803827 9.75592 0.245054Z"
                                                     fill="#515155" />
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
                                             <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                 <path fill-rule="evenodd" clip-rule="evenodd"
                                                     d="M2.24408 11.7569C1.91864 11.4315 1.91864 10.9038 2.24408 10.5784L6.65482 6.16764L2.24408 1.7569C1.91864 1.43146 1.91864 0.903825 2.24408 0.578388C2.56952 0.252951 3.09715 0.252951 3.42259 0.578388L8.42259 5.57839C8.74803 5.90382 8.74803 6.43146 8.42259 6.7569L3.42259 11.7569C3.09715 12.0823 2.56951 12.0823 2.24408 11.7569Z"
                                                     fill="#515155" />
                                             </svg>
                                         </a>
                                     </li>
                                 </ul>
                             </div>
                         </div>
                         <!-- Pagination Action -->
                         <div class="pagination-action-wraper">
                             <div class="pagin-action-items">
                                 <div class="selected-item">
                                     <span class="checked-count">0</span> of <span class="total-count">0</span> selected
                                     <button type="button" class="clear-selection">
                                         <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <path fill-rule="evenodd" clip-rule="evenodd"
                                                 d="M0.241433 10.5957C-0.0798388 10.917 -0.0797893 11.4378 0.241531 11.7591C0.562852 12.0803 1.08376 12.0803 1.40503 11.759L6.0001 7.16347L10.5956 11.7586C10.9168 12.0798 11.4378 12.0798 11.759 11.7586C12.0803 11.4373 12.0803 10.9164 11.759 10.5952L7.16351 5.99999L11.7587 1.40431C12.0799 1.08302 12.0799 0.562144 11.7586 0.240905C11.4373 -0.0803426 10.9163 -0.0802934 10.5951 0.241003L5.99994 4.83659L1.40447 0.241398C1.08318 -0.0798655 0.56226 -0.0798655 0.240972 0.241398C-0.080324 0.56267 -0.080324 1.08354 0.240972 1.40482L4.83662 6.00007L0.241433 10.5957Z"
                                                 fill="#515155" />
                                         </svg>
                                     </button>
                                 </div>
                                 <div class="dropdown export">
                                     <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                         <span>
                                             <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                 <path
                                                     d="M8.1665 3.93758H5.83317C5.27317 3.93758 4.229 3.93758 4.229 2.33341C4.229 0.729248 5.27317 0.729248 5.83317 0.729248H8.1665C8.7265 0.729248 9.77067 0.729248 9.77067 2.33341C9.77067 2.89341 9.77067 3.93758 8.1665 3.93758ZM5.83317 1.60425C5.25567 1.60425 5.104 1.60425 5.104 2.33341C5.104 3.06258 5.25567 3.06258 5.83317 3.06258H8.1665C8.89567 3.06258 8.89567 2.91091 8.89567 2.33341C8.89567 1.60425 8.744 1.60425 8.1665 1.60425H5.83317Z"
                                                     fill="#0E0F14" />
                                                 <path
                                                     d="M8.16667 13.2709H5.25C1.97167 13.2709 1.3125 11.7659 1.3125 9.33338V5.83338C1.3125 3.17338 2.275 2.03588 4.64333 1.91338C4.87083 1.90171 5.0925 2.08254 5.10417 2.32754C5.11583 2.57254 4.92917 2.77088 4.69 2.78254C3.03333 2.87588 2.1875 3.37171 2.1875 5.83338V9.33338C2.1875 11.4917 2.61333 12.3959 5.25 12.3959H8.16667C8.40583 12.3959 8.60417 12.5942 8.60417 12.8334C8.60417 13.0725 8.40583 13.2709 8.16667 13.2709Z"
                                                     fill="#0E0F14" />
                                                 <path
                                                     d="M12.2502 9.1875C12.011 9.1875 11.8127 8.98917 11.8127 8.75V5.83333C11.8127 3.37167 10.9669 2.87583 9.31019 2.7825C9.07103 2.77083 8.88436 2.56083 8.89603 2.32167C8.90769 2.0825 9.11769 1.89583 9.35686 1.9075C11.7252 2.03583 12.6877 3.17333 12.6877 5.8275V8.74417C12.6877 8.98917 12.4894 9.1875 12.2502 9.1875Z"
                                                     fill="#0E0F14" />
                                                 <path
                                                     d="M8.75 11.5208C8.51083 11.5208 8.3125 11.3224 8.3125 11.0833V9.33325C8.3125 9.09409 8.51083 8.89575 8.75 8.89575H10.5C10.7392 8.89575 10.9375 9.09409 10.9375 9.33325C10.9375 9.57242 10.7392 9.77075 10.5 9.77075H9.1875V11.0833C9.1875 11.3224 8.98917 11.5208 8.75 11.5208Z"
                                                     fill="#0E0F14" />
                                                 <path
                                                     d="M12.2501 13.2709C12.1393 13.2709 12.0284 13.23 11.9409 13.1425L8.46428 9.66586C8.29511 9.4967 8.29511 9.2167 8.46428 9.04753C8.63344 8.87836 8.91344 8.87836 9.08261 9.04753L12.5593 12.5242C12.7284 12.6934 12.7284 12.9734 12.5593 13.1425C12.4718 13.23 12.3609 13.2709 12.2501 13.2709Z"
                                                     fill="#0E0F14" />
                                             </svg>
                                         </span>
                                         Export
                                     </button>
                                     <ul class="dropdown-menu">
                                         <li><a class="dropdown-item" href="#">Excel</a></li>
                                         <li><a class="dropdown-item" href="#">Pdf</a></li>
                                         <li><a class="dropdown-item" href="#">Psd</a></li>
                                         <li><a class="dropdown-item" href="#">Xd</a></li>
                                     </ul>
                                 </div>
                                 <button type="button" class="pagin-delete">
                                     <span>
                                         <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <path
                                                 d="M11.375 3.20825L11.0135 9.05623C10.9211 10.5503 10.875 11.2974 10.5005 11.8345C10.3153 12.1001 10.0769 12.3242 9.80041 12.4926C9.24122 12.8333 8.49275 12.8333 6.99574 12.8333C5.49682 12.8333 4.74734 12.8333 4.18778 12.4919C3.91113 12.3232 3.67267 12.0987 3.48756 11.8327C3.11318 11.2948 3.06801 10.5466 2.97769 9.05045L2.625 3.20825"
                                                 stroke="#F63A45" stroke-linecap="round" />
                                             <path
                                                 d="M1.75 3.20842H12.25M9.36582 3.20842L8.96764 2.38692C8.7031 1.84123 8.5708 1.56838 8.34266 1.39822C8.29208 1.36047 8.23848 1.3269 8.18242 1.29782C7.92978 1.16675 7.62656 1.16675 7.02012 1.16675C6.39847 1.16675 6.08767 1.16675 5.83081 1.30332C5.77389 1.33359 5.71957 1.36852 5.66842 1.40776C5.43762 1.58482 5.3087 1.86765 5.05086 2.43332L4.69754 3.20842"
                                                 stroke="#F63A45" stroke-linecap="round" />
                                             <path d="M5.5415 9.625V6.125" stroke="#F63A45" stroke-linecap="round" />
                                             <path d="M8.4585 9.625V6.125" stroke="#F63A45" stroke-linecap="round" />
                                         </svg>
                                     </span>
                                     Delete
                                 </button>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 @endsection
