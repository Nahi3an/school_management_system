<aside class="sidebar-wrapper">
    <div class="iconmenu">
        <div class="nav-toggle-box">
            <div class="nav-toggle-icon"><i class="bi bi-list"></i></div>
        </div>
        <ul class="nav nav-pills flex-column">
            <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboards">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#dashboard" type="button"><i
                        class="bi bi-house-door-fill"></i></button>
            </li>
        </ul>
    </div>
    <div class="textmenu">
        <div class="brand-logo">
            <img src="{{ asset('adminAsset/assets') }}/images/brand-logo-2.png" width="140" alt="" />
        </div>
        <div class="tab-content">
            <div class="tab-pane fade" id="dashboard">
                <div class="list-group list-group-flush">
                    <div class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-0">Dashboards</h5>
                        </div>
                        <small class="mb-0">Some placeholder content</small>
                    </div>
                    <a href="{{ route('dashboard') }}" class="list-group-item"><i
                            class="bi bi-cart-plus"></i>Dashboard</a>
                    <a href="{{ route('add.teacher') }}" class="list-group-item"><i class="bi bi-wallet"></i>Add
                        Teacher</a>
                    <a href="{{ route('all.teacher') }}" class="list-group-item"><i class="bi bi-bar-chart-line"></i>All
                        Teachers</a>

                </div>
            </div>

        </div>
    </div>
</aside>
