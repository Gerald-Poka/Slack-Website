<!-- Notifications -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="notifications">
    <div class="offcanvas-header py-0">
        <h5 class="offcanvas-title py-3">Activity</h5>
        <button type="button" class="btn btn-light btn-sm btn-icon border-transparent rounded-pill" data-bs-dismiss="offcanvas">
            <i class="ph-x"></i>
        </button>
    </div>

    <div class="offcanvas-body p-0">
        <div class="bg-light fw-medium py-2 px-3">New notifications</div>
        <div class="p-3">
            <div class="d-flex align-items-start mb-3">
                <a href="#" class="status-indicator-container me-3">
                    <img src="{{ asset('assets/images/demo/users/face1.jpg') }}" class="w-40px h-40px rounded-pill" alt="">
                    <span class="status-indicator bg-success"></span>
                </a>
                <div class="flex-fill">
                    <a href="#" class="fw-semibold">James</a> has completed the task <a href="#">Submit documents</a> from <a href="#">Onboarding</a> list

                    <div class="bg-light rounded p-2 my-2">
                        <label class="form-check ms-1">
                            <input type="checkbox" class="form-check-input" checked disabled>
                            <del class="form-check-label">Submit personal documents</del>
                        </label>
                    </div>

                    <div class="fs-sm text-muted mt-1">2 hours ago</div>
                </div>
            </div>

            <div class="d-flex align-items-start mb-3">
                <a href="#" class="status-indicator-container me-3">
                    <img src="{{ asset('assets/images/demo/users/face3.jpg') }}" class="w-40px h-40px rounded-pill" alt="">
                    <span class="status-indicator bg-warning"></span>
                </a>
                <div class="flex-fill">
                    <a href="#" class="fw-semibold">Margo</a> has added 4 users to <span class="fw-semibold">Customer enablement</span> channel
                    <div class="fs-sm text-muted mt-1">3 hours ago</div>
                </div>
            </div>
        </div>

        <div class="bg-light fw-medium py-2 px-3">Older notifications</div>
        <div class="p-3">
            <div class="d-flex align-items-start mb-3">
                <a href="#" class="status-indicator-container me-3">
                    <img src="{{ asset('assets/images/demo/users/face25.jpg') }}" class="w-40px h-40px rounded-pill" alt="">
                    <span class="status-indicator bg-success"></span>
                </a>
                <div class="flex-fill">
                    <a href="#" class="fw-semibold">Nick</a> requested your feedback and approval in support request <a href="#">#458</a>
                    <div class="fs-sm text-muted mt-1">3 days ago</div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /notifications -->
