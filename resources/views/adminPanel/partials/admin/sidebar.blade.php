<div class="bg-white content-header ps-3 py-0">
    <nav class="navbar navbar-expand navbar-theme">
        <a class="sidebar-toggle d-flex me-2">
            <i class="bi bi-list toggle-icon" role="button" aria-label="Toggle sidebar"
                aria-expanded="false"></i>
        </a>
        <form class="d-none d-sm-inline-block">
            <input class="form-control form-control-lite" type="text" placeholder="Search projects...">
        </form>
        <div class="navbar-collapse collapse">
            <ul class="navbar-nav ms-auto">
                <!-- Messages -->
                <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle position-relative" href="#" id="messagesDropdown"
                        data-bs-toggle="dropdown">
                        <i class="bi bi-envelope-fill"></i>
                        <span
                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">4</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0"
                        aria-labelledby="messagesDropdown">
                        <div class="dropdown-menu-header">
                            4 New Messages
                        </div>
                        <div class="list-group">
                            <a href="#" class="list-group-item">
                                <div class="d-flex align-items-center">
                                    <img src="img/avatars/avatar-5.jpg"
                                        class="avatar img-fluid rounded-circle me-2" alt="Michelle Bilodeau">
                                    <div>
                                        <div class="text-dark">Michelle Bilodeau</div>
                                        <div class="text-muted small">Nam pretium turpis et arcu.</div>
                                        <div class="text-muted small">5m ago</div>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="list-group-item">
                                <div class="d-flex align-items-center">
                                    <img src="img/avatars/avatar-3.jpg"
                                        class="avatar img-fluid rounded-circle me-2" alt="Kathie Burton">
                                    <div>
                                        <div class="text-dark">Kathie Burton</div>
                                        <div class="text-muted small">Pellentesque auctor neque.</div>
                                        <div class="text-muted small">30m ago</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="dropdown-menu-footer text-center">
                            <a href="#" class="text-muted">Show all messages</a>
                        </div>
                    </div>
                </li>

                <!-- Notifications -->
                <li class="nav-item dropdown ms-lg-2">
                    <a class="nav-link dropdown-toggle position-relative" href="#" id="alertsDropdown"
                        data-bs-toggle="dropdown">
                        <i class="bi bi-bell-fill"></i>
                        <span
                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning">4</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0"
                        aria-labelledby="alertsDropdown">
                        <div class="dropdown-menu-header">4 New Notifications</div>
                        <div class="list-group">
                            <a href="#" class="list-group-item d-flex align-items-center">
                                <i class="bi bi-arrow-repeat text-danger me-2"></i>
                                <div>
                                    <div class="text-dark">Update completed</div>
                                    <div class="text-muted small">2h ago</div>
                                </div>
                            </a>
                            <a href="#" class="list-group-item d-flex align-items-center">
                                <i class="bi bi-envelope-open text-warning me-2"></i>
                                <div>
                                    <div class="text-dark">New message received</div>
                                    <div class="text-muted small">6h ago</div>
                                </div>
                            </a>
                        </div>
                        <div class="dropdown-menu-footer text-center">
                            <a href="#" class="text-muted">Show all notifications</a>
                        </div>
                    </div>
                </li>

                <!-- Settings -->
                <li class="nav-item dropdown ms-lg-2">
                    <a class="nav-link dropdown-toggle position-relative" href="#" id="userDropdown"
                        data-bs-toggle="dropdown">
                        <i class="bi bi-gear-fill"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#"><i class="bi bi-person-fill me-2"></i> View
                            Profile</a>
                        <a class="dropdown-item" href="#"><i class="bi bi-chat-dots-fill me-2"></i> Contacts</a>
                        <a class="dropdown-item" href="#"><i class="bi bi-pie-chart-fill me-2"></i>
                            Analytics</a>
                        <a class="dropdown-item" href="#"><i class="bi bi-sliders me-2"></i> Settings</a>
                        <div class="dropdown-divider"></div>


                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="dropdown-item {{ request()->routeIs('faculty.logout') ? 'active' : '' }}"
                            style="border-top: 1px solid #e5e7eb; margin-top: 20px; padding-top: 20px;">
                            <i class="fas fa-sign-out-alt"></i>
                            <i class="bi bi-box-arrow-right me-2"></i> Sign out
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>