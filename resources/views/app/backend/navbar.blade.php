<div class="top-header">

    <div class="position-relative d-flex align-items-center gap-2">
        <a href="javascript:void(0);" class="sidebar_toggle">
            <img src="{{ asset('assets/backend/images/arrow-left.svg') }}" alt="OnlineEdu" />
        </a>

        <div>
            <h4 class="mb-0 fw-500 fs-18 text-secondary">@stack('title')</h4>
            <p>@stack('breadcrumb')</p>
        </div>
    </div>

    <div class="search-bar">
        <form action="">
            <input type="search" class="form-control" id="search-bar" placeholder="Search" />
            <label for="search-bar">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M7.66683 14.4997C3.90016 14.4997 0.833496 11.433 0.833496 7.66634C0.833496 3.89967 3.90016 0.833008 7.66683 0.833008C11.4335 0.833008 14.5002 3.89967 14.5002 7.66634C14.5002 11.433 11.4335 14.4997 7.66683 14.4997ZM7.66683 1.83301C4.44683 1.83301 1.8335 4.45301 1.8335 7.66634C1.8335 10.8797 4.44683 13.4997 7.66683 13.4997C10.8868 13.4997 13.5002 10.8797 13.5002 7.66634C13.5002 4.45301 10.8868 1.83301 7.66683 1.83301Z"
                        fill="#0E0F14" />
                    <path d="M14.6666 15.1663C14.5399 15.1663 14.4132 15.1196 14.3132 15.0196L12 13C11.8067 12.8067 11.8067 12.4867 12 12.2933C12.1933 12.1 12.5133 12.1 12.7067 12.2933L15.0199 14.313C15.2132 14.5063 15.2132 14.8263 15.0199 15.0196C14.9199 15.1196 14.7932 15.1663 14.6666 15.1663Z"
                        fill="#0E0F14" />
                </svg>
            </label>
        </form>
    </div>
    <div class="actions d-flex align-items-center gap-8">
        <div class="dropdown">
            <a href="javascript:void(0);" class="icon-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_278_2410)">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M15.5953 12.3708C15.2051 11.6986 14.625 9.79664 14.625 7.3125C14.625 4.2059 12.1066 1.6875 9 1.6875C5.8934 1.6875 3.375 4.2059 3.375 7.3125C3.375 9.79734 2.79422 11.6986 2.40398 12.3708C2.20115 12.7186 2.19967 13.1483 2.40012 13.4975C2.60056 13.8467 2.97235 14.0622 3.375 14.0625H6.24445C6.512 15.3717 7.66376 16.3119 9 16.3119C10.3362 16.3119 11.488 15.3717 11.7555 14.0625H14.625C15.0275 14.062 15.3991 13.8464 15.5994 13.4972C15.7996 13.1481 15.7981 12.7185 15.5953 12.3708ZM9 15.1875C8.28506 15.1873 7.64785 14.7366 7.40953 14.0625H10.5905C10.3522 14.7366 9.71494 15.1873 9 15.1875ZM3.375 12.9375C3.91641 12.0066 4.5 9.84937 4.5 7.3125C4.5 4.82722 6.51472 2.8125 9 2.8125C11.4853 2.8125 13.5 4.82722 13.5 7.3125C13.5 9.84727 14.0822 12.0045 14.625 12.9375H3.375Z"
                            fill="#191B19" />
                        <circle cx="14" cy="4" r="2.5" fill="#F63A45" stroke="#FEFEFE" />
                    </g>
                    <defs>
                        <clipPath id="clip0_278_2410">
                            <rect width="18" height="18" fill="white" />
                        </clipPath>
                    </defs>
                </svg>
            </a>

            <div class="dropdown-menu dropdown-menu-end notifaction-box">
                <div class="d-flex align-items-center justify-content-between gap-2 mb-20">
                    <h4 class="fs-16 fw-500 text-secondary">Notification</h4>
                    <button type="button" class="notif-remove">Remove all</button>
                </div>
                <div class="notif-items">
                    <div class="notif-single mb-18">
                        <figure>
                            <img src="assets/images/avatar/notif-author1.png" alt="OnlineEdu" />
                        </figure>
                        <div class="notif-info">
                            <h4 class="fs-14 fw-500 text-secondary d-flex align-items-center justify-content-between gap-3 mb-4">
                                Transfer Success <time datetime="">2m</time>
                            </h4>
                            <p class="fs-12 mb-4">
                                You have successfully sent <strong>Jonathan</strong>
                            </p>
                            <ins class="fs-12 text-secondary fw-500 text-decoration-none">$10.00</ins>
                        </div>
                    </div>
                    <div class="notif-single mb-18">
                        <figure>
                            <img src="assets/images/avatar/notif-author2.png" alt="OnlineEdu" />
                        </figure>
                        <div class="notif-info">
                            <h4 class="fs-14 fw-500 text-secondary d-flex align-items-center justify-content-between gap-3 mb-4">
                                Transfer Success <time datetime="">20m</time>
                            </h4>
                            <p class="fs-12 mb-4">
                                You have successfully sent <strong>Jonathan</strong>
                            </p>
                            <ins class="fs-12 text-secondary fw-500 text-decoration-none">$15.00</ins>
                        </div>
                    </div>
                    <div class="notif-single mb-18">
                        <span class="avatar">
                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M13.4665 4.02338V7.31671H12.1665V4.02338C12.1665 3.78938 11.9585 3.67671 11.8198 3.67671C11.7765 3.67671 11.7332 3.68538 11.6898 3.70271L4.81718 6.29404C4.35785 6.46738 4.06318 6.90071 4.06318 7.39471V7.97538C3.27452 8.56471 2.76318 9.50937 2.76318 10.5754V7.39471C2.76318 6.36337 3.39585 5.44471 4.35785 5.08071L11.2392 2.48071C11.4298 2.41138 11.6292 2.37671 11.8198 2.37671C12.6865 2.37671 13.4665 3.07871 13.4665 4.02338Z"
                                    fill="#0E0F14" />
                                <path
                                    d="M19.2299 13.1667V14.0334C19.2299 14.2674 19.0479 14.4581 18.8053 14.4667H17.5399C17.0806 14.4667 16.6646 14.1287 16.6299 13.6781C16.6039 13.4094 16.7079 13.1581 16.8813 12.9847C17.0373 12.8201 17.2539 12.7334 17.4879 12.7334H18.7966C19.0479 12.7421 19.2299 12.9327 19.2299 13.1667Z"
                                    fill="#0E0F14" />
                                <path
                                    d="M17.4792 11.8236H18.3632C18.8398 11.8236 19.2298 11.4336 19.2298 10.9569V10.5756C19.2298 8.78156 17.7652 7.31689 15.9712 7.31689H6.02185C5.28518 7.31689 4.60918 7.55956 4.06318 7.97556C3.27452 8.56489 2.76318 9.50956 2.76318 10.5756V16.4082C2.76318 18.2022 4.22785 19.6669 6.02185 19.6669H15.9712C17.7652 19.6669 19.2298 18.2022 19.2298 16.4082V16.2436C19.2298 15.7669 18.8398 15.3769 18.3632 15.3769H17.6092C16.7772 15.3769 15.9798 14.8656 15.7632 14.0596C15.5812 13.4009 15.7978 12.7682 16.2312 12.3436C16.5518 12.0142 16.9938 11.8236 17.4792 11.8236ZM12.7298 11.6502H6.66318C6.30785 11.6502 6.01318 11.3556 6.01318 11.0002C6.01318 10.6449 6.30785 10.3502 6.66318 10.3502H12.7298C13.0852 10.3502 13.3798 10.6449 13.3798 11.0002C13.3798 11.3556 13.0852 11.6502 12.7298 11.6502Z"
                                    fill="#0E0F14" />
                            </svg>
                        </span>
                        <div class="notif-info">
                            <h4 class="fs-14 fw-500 text-secondary d-flex align-items-center justify-content-between gap-3 mb-4">
                                Transfer Success <time datetime="">30m</time>
                            </h4>
                            <p class="fs-12 mb-4">
                                You have successfully sent <strong>Jonathan</strong>
                            </p>
                            <ins class="fs-12 text-secondary fw-500 text-decoration-none">$20.00</ins>
                        </div>
                    </div>
                    <div class="notif-single">
                        <span class="avatar">
                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M13.4665 4.02338V7.31671H12.1665V4.02338C12.1665 3.78938 11.9585 3.67671 11.8198 3.67671C11.7765 3.67671 11.7332 3.68538 11.6898 3.70271L4.81718 6.29404C4.35785 6.46738 4.06318 6.90071 4.06318 7.39471V7.97538C3.27452 8.56471 2.76318 9.50937 2.76318 10.5754V7.39471C2.76318 6.36337 3.39585 5.44471 4.35785 5.08071L11.2392 2.48071C11.4298 2.41138 11.6292 2.37671 11.8198 2.37671C12.6865 2.37671 13.4665 3.07871 13.4665 4.02338Z"
                                    fill="#0E0F14" />
                                <path
                                    d="M19.2299 13.1667V14.0334C19.2299 14.2674 19.0479 14.4581 18.8053 14.4667H17.5399C17.0806 14.4667 16.6646 14.1287 16.6299 13.6781C16.6039 13.4094 16.7079 13.1581 16.8813 12.9847C17.0373 12.8201 17.2539 12.7334 17.4879 12.7334H18.7966C19.0479 12.7421 19.2299 12.9327 19.2299 13.1667Z"
                                    fill="#0E0F14" />
                                <path
                                    d="M17.4792 11.8236H18.3632C18.8398 11.8236 19.2298 11.4336 19.2298 10.9569V10.5756C19.2298 8.78156 17.7652 7.31689 15.9712 7.31689H6.02185C5.28518 7.31689 4.60918 7.55956 4.06318 7.97556C3.27452 8.56489 2.76318 9.50956 2.76318 10.5756V16.4082C2.76318 18.2022 4.22785 19.6669 6.02185 19.6669H15.9712C17.7652 19.6669 19.2298 18.2022 19.2298 16.4082V16.2436C19.2298 15.7669 18.8398 15.3769 18.3632 15.3769H17.6092C16.7772 15.3769 15.9798 14.8656 15.7632 14.0596C15.5812 13.4009 15.7978 12.7682 16.2312 12.3436C16.5518 12.0142 16.9938 11.8236 17.4792 11.8236ZM12.7298 11.6502H6.66318C6.30785 11.6502 6.01318 11.3556 6.01318 11.0002C6.01318 10.6449 6.30785 10.3502 6.66318 10.3502H12.7298C13.0852 10.3502 13.3798 10.6449 13.3798 11.0002C13.3798 11.3556 13.0852 11.6502 12.7298 11.6502Z"
                                    fill="#0E0F14" />
                            </svg>
                        </span>
                        <div class="notif-info">
                            <h4 class="fs-14 fw-500 text-secondary d-flex align-items-center justify-content-between gap-3 mb-4">
                                Transfer Success <time datetime="">30m</time>
                            </h4>
                            <p class="fs-12 mb-4">
                                You have successfully sent <strong>Jonathan</strong>
                            </p>
                            <ins class="fs-12 text-secondary fw-500 text-decoration-none">$50.00</ins>
                        </div>
                    </div>
                </div>
                <a href="javascript:void(0);" class="nofif-button">See more Notification</a>
            </div>
        </div>
        <div class="dropdown">
            <a href="javascript:void(0);" class="icon-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14.1667 17.0834H5.83341C3.33341 17.0834 1.66675 15.8334 1.66675 12.9167V7.08342C1.66675 4.16675 3.33341 2.91675 5.83341 2.91675H14.1667C16.6667 2.91675 18.3334 4.16675 18.3334 7.08342V12.9167C18.3334 15.8334 16.6667 17.0834 14.1667 17.0834Z" stroke="#191B19"
                        stroke-width="1.3" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M14.1666 7.5L11.5582 9.58333C10.6999 10.2667 9.29158 10.2667 8.43325 9.58333L5.83325 7.5" stroke="#191B19" stroke-width="1.3" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
        </div>
        <select name="" id="" class="nice-control select-black">
            <option value="" selected>Add Course</option>
            <option value="">Course One</option>
            <option value="">Course Two</option>
            <option value="">Course Three</option>
        </select>
    </div>
</div>
