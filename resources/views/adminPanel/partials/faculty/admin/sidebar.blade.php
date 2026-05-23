<div class="content-header px-4 py-2" style="background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(226, 232, 240, 0.8);">
    <nav class="navbar navbar-expand navbar-theme p-0">
        
        <!-- Sidebar Toggle Icon Matrix -->
        <a class="sidebar-toggle d-flex align-items-center justify-content-center rounded-3 me-3 text-secondary transition-all" style="width: 38px; height: 38px; background-color: #f8fafc; border: 1px solid #e2e8f0; cursor: pointer;">
            <i class="bi bi-list fs-5 toggle-icon" role="button" aria-label="Toggle sidebar" aria-expanded="false"></i>
        </a>
        
        <!-- Advanced Minimal Search Core -->
        <form class="d-none d-sm-inline-block position-relative ms-1">
            <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y text-muted ms-3" style="font-size: 0.85rem;"></i>
            <input class="form-control form-control-lite border-0 rounded-3 bg-light" type="text" placeholder="Search projects..." style="padding: 9px 12px 9px 36px; font-size: 0.85rem; width: 240px; background-color: #f1f5f9 !important; border: 1px solid transparent !important; transition: all 0.2s ease;" onfocus="this.style.backgroundColor='#ffffff'; this.style.borderColor='#cbd5e1'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'" onblur="this.style.backgroundColor='#f1f5f9'; this.style.borderColor='transparent'; this.style.boxShadow='none'">
        </form>

        <div class="navbar-collapse collapse">
            <ul class="navbar-nav ms-auto align-items-center">
                
                <!-- Messages Stream Dropdown -->
                <li class="nav-item dropdown active me-2">
                    <a class="nav-link dropdown-toggle d-flex align-items-center justify-content-center rounded-3 position-relative text-secondary transition-all" href="#" id="messagesDropdown" data-bs-toggle="dropdown" style="width: 38px; height: 38px; background-color: #f8fafc; border: 1px solid #e2e8f0;">
                        <i class="bi bi-envelope fs-5" style="color: #475569;"></i>
                        <span class="position-absolute translate-middle badge rounded-pill bg-danger border border-white" style="top: 8px; right: -2px; font-size: 0.65rem; padding: 4px 6px;">4</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end border-0 shadow-sm py-0 mt-2" aria-labelledby="messagesDropdown" style="border-radius: 12px; width: 320px; overflow: hidden; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.08) !important;">
                        <div class="dropdown-menu-header px-3 py-2.5 bg-light border-bottom text-dark fw-semibold small" style="letter-spacing: -0.1px;">
                            4 New Messages
                        </div>
                        <div class="list-group list-group-flush">
                            <a href="#" class="list-group-item list-group-item-action border-bottom px-3 py-2.5 transition-all" style="border-color: #f1f5f9 !important;">
                                <div class="d-flex align-items-center">
                                    <img src="img/avatars/avatar-5.jpg" class="avatar img-fluid rounded-circle me-3" alt="Michelle Bilodeau" style="width: 36px; height: 36px; object-fit: cover; border: 1px solid #e2e8f0;">
                                    <div class="flex-grow-1">
                                        <div class="text-dark fw-semibold small">Michelle Bilodeau</div>
                                        <div class="text-muted text-truncate small my-0.5" style="max-width: 200px; font-size: 0.78rem;">Nam pretium turpis et arcu.</div>
                                        <div class="text-muted style-date" style="font-size: 0.7rem;"><i class="bi bi-clock me-1"></i>5m ago</div>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action border-bottom px-3 py-2.5 transition-all" style="border-color: #f1f5f9 !important;">
                                <div class="d-flex align-items-center">
                                    <img src="img/avatars/avatar-3.jpg" class="avatar img-fluid rounded-circle me-3" alt="Kathie Burton" style="width: 36px; height: 36px; object-fit: cover; border: 1px solid #e2e8f0;">
                                    <div class="flex-grow-1">
                                        <div class="text-dark fw-semibold small">Kathie Burton</div>
                                        <div class="text-muted text-truncate small my-0.5" style="max-width: 200px; font-size: 0.78rem;">Pellentesque auctor neque.</div>
                                        <div class="text-muted style-date" style="font-size: 0.7rem;"><i class="bi bi-clock me-1"></i>30m ago</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="dropdown-menu-footer text-center bg-light border-top py-2">
                            <a href="#" class="text-primary small fw-medium text-decoration-none">Show all messages</a>
                        </div>
                    </div>
                </li>

                <!-- Notifications Stream Dropdown -->
                <li class="nav-item dropdown me-2">
                    <a class="nav-link dropdown-toggle d-flex align-items-center justify-content-center rounded-3 position-relative text-secondary transition-all" href="#" id="alertsDropdown" data-bs-toggle="dropdown" style="width: 38px; height: 38px; background-color: #f8fafc; border: 1px solid #e2e8f0;">
                        <i class="bi bi-bell fs-5" style="color: #475569;"></i>
                        <span class="position-absolute translate-middle badge rounded-pill bg-warning border border-white" style="top: 8px; right: -2px; font-size: 0.65rem; padding: 4px 6px;">4</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end border-0 shadow-sm py-0 mt-2" aria-labelledby="alertsDropdown" style="border-radius: 12px; width: 300px; overflow: hidden; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.08) !important;">
                        <div class="dropdown-menu-header px-3 py-2.5 bg-light border-bottom text-dark fw-semibold small">4 New Notifications</div>
                        <div class="list-group list-group-flush">
                            <a href="#" class="list-group-item list-group-item-action d-flex align-items-start border-bottom px-3 py-2.5" style="border-color: #f1f5f9 !important;">
                                <div class="bg-light-danger text-danger rounded-circle p-1.5 d-flex align-items-center justify-content-center me-3" style="background-color: #fef2f2; width: 32px; height: 32px;">
                                    <i class="bi bi-arrow-repeat fs-6"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="text-dark fw-medium small">Update completed</div>
                                    <div class="text-muted" style="font-size: 0.72rem;"><i class="bi bi-clock me-1"></i>2h ago</div>
                                </div>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action d-flex align-items-start border-bottom px-3 py-2.5" style="border-color: #f1f5f9 !important;">
                                <div class="bg-light-warning text-warning rounded-circle p-1.5 d-flex align-items-center justify-content-center me-3" style="background-color: #fefce8; width: 32px; height: 32px;">
                                    <i class="bi bi-envelope-open fs-6"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="text-dark fw-medium small">New message received</div>
                                    <div class="text-muted" style="font-size: 0.72rem;"><i class="bi bi-clock me-1"></i>6h ago</div>
                                </div>
                            </a>
                        </div>
                        <div class="dropdown-menu-footer text-center bg-light border-top py-2">
                            <a href="#" class="text-primary small fw-medium text-decoration-none">Show all notifications</a>
                        </div>
                    </div>
                </li>

                <!-- Global Management Settings / Profile Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center justify-content-center rounded-3 text-secondary transition-all" href="#" id="userDropdown" data-bs-toggle="dropdown" style="width: 38px; height: 38px; background-color: #f8fafc; border: 1px solid #e2e8f0;">
                        <i class="bi bi-gear fs-5" style="color: #475569;"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end border-0 shadow-sm p-2 mt-2" aria-labelledby="userDropdown" style="border-radius: 12px; width: 210px; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.08) !important;">
                        <a class="dropdown-item rounded-2 px-3 py-2 my-0.5 small text-secondary d-flex align-items-center transition-all hover-bg-light" href="#"><i class="bi bi-person me-2 fs-6"></i> View Profile</a>
                        <a class="dropdown-item rounded-2 px-3 py-2 my-0.5 small text-secondary d-flex align-items-center transition-all hover-bg-light" href="#"><i class="bi bi-chat-dots me-2 fs-6"></i> Contacts</a>
                        <a class="dropdown-item rounded-2 px-3 py-2 my-0.5 small text-secondary d-flex align-items-center transition-all hover-bg-light" href="#"><i class="bi bi-pie-chart me-2 fs-6"></i> Analytics</a>
                        <a class="dropdown-item rounded-2 px-3 py-2 my-0.5 small text-secondary d-flex align-items-center transition-all hover-bg-light" href="#"><i class="bi bi-sliders me-2 fs-6"></i> Settings</a>
                        
                        <div class="dropdown-divider my-2" style="border-top: 1px solid #f1f5f9;"></div>

                        <!-- Native Form Integration Token Unaltered -->
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item rounded-2 px-3 py-2.5 text-danger fw-medium d-flex align-items-center transition-all {{ request()->routeIs('faculty.logout') ? 'active' : '' }}" style="background-color: #fef2f2; font-size: 0.85rem;">
                            <i class="bi bi-box-arrow-right me-2 fs-6"></i> Sign out
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