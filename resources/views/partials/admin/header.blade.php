<nav class="sidebar px-3 py-4 d-flex flex-column" style="width: 260px; height: 100vh; background: linear-gradient(180deg, #0f1016 0%, #151724 100%); border-right: 1px solid rgba(255, 255, 255, 0.06); position: fixed; top: 0; left: 0; z-index: 1040; overflow-y: auto;">
    
    <!-- Premium Brand Logo Matrix Area -->
    <div class="brand mb-4 px-2" style="background: white;display: flex;justify-content: center;align-items: center; box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px inset, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px inset; border-radius: 100px 0px 910px 100px;">
        <div class="app-brand d-flex align-items-center justify-content-start">
            <a href="{{route('admin.dashboard')}}" class="app-brand-link d-flex align-items-center gap-2 text-decoration-none">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="app-brand-logo demo" style="max-height: 140px; object-fit: contain; filter: drop-shadow(0 2px 8px rgba(99, 102, 241, 0.3));" />
            </a>
        </div>
    </div>
    <p class="text-light mb-5 brand-logo-subtext" style="font-size: 0.95rem; opacity: 0;">
        Competition <span class="animated-cracker-node">CRACKER</span>
    </p>

    <!-- Main Navigation Architecture Group -->
    <div class="navigation-menu-wrapper flex-grow-1">
        <h6 class="text-uppercase tracking-wider fw-bold mb-3 px-3 text-secondary" style="font-size: 0.68rem; letter-spacing: 1.5px; color: #4f5675 !important;">Main Navigation</h6>
        
        <ul class="nav flex-column mb-4 gap-2">
            
            <!-- 1. Create Faculty Profile Link Element -->
            <li class="nav-item">
                <a href="{{route('admin.add.faculty')}}" class="nav-link d-flex align-items-center px-3 py-2.5 rounded-3 sidebar-anchor {{ request()->routeIs('admin.add.faculty') ? 'active-anchor' : '' }}">
                    <i class="bi bi-plus-circle-fill me-2.5 fs-6 icon-glow"></i>&nbsp;
                    <span class="fw-medium">Create Faculty Profile</span>
                </a>
            </li>

            <!-- 2. Faculty Listing Element -->
            <li class="nav-item">
                <a href="{{route('admin.faculty.list')}}" class="nav-link d-flex align-items-center px-3 py-2.5 rounded-3 sidebar-anchor {{ request()->routeIs('admin.faculty.list') ? 'active-anchor' : '' }}">
                    <i class="bi bi-person-badge-fill me-2.5 fs-6 icon-glow"></i>&nbsp;
                    <span class="fw-medium">Faculty List</span>
                </a>
            </li>

            <!-- 3. Student Listing Element -->
            <li class="nav-item">
                <a href="{{route('admin.student.list')}}" class="nav-link d-flex align-items-center px-3 py-2.5 rounded-3 sidebar-anchor {{ request()->routeIs('admin.student.list') ? 'active-anchor' : '' }}">
                    <i class="bi bi-people-fill me-2.5 fs-6 icon-glow"></i> &nbsp;
                    <span class="fw-medium">Student List</span>
                </a>
            </li>

            <!-- 4. Course Details CRUD System Link Element -->
            <li class="nav-item">
                <a href="{{ route('admin.course-details.index') }}" class="nav-link d-flex align-items-center px-3 py-2.5 rounded-3 sidebar-anchor {{ request()->routeIs('admin.course-details.*') ? 'active-anchor' : '' }}">
                    <i class="bi bi-collection-play-fill me-2.5 fs-6 icon-glow"></i> &nbsp;
                    <span class="fw-medium">Course Details</span>
                </a>
            </li>

            <!-- 5. Dynamic Course Subjects Mapping Element -->
            <li class="nav-item">
                <a href="{{ route('admin.subjects.index') }}" class="nav-link d-flex align-items-center px-3 py-2.5 rounded-3 sidebar-anchor {{ request()->routeIs('admin.subjects.*') ? 'active-anchor' : '' }}">
                    <i class="bi bi-journal-bookmark-fill me-2.5 fs-6 icon-glow"></i> &nbsp;
                    <span class="fw-medium">Manage Subjects</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.assignments.inspect') }}" class="nav-link d-flex align-items-center px-3 py-2.5 rounded-3 sidebar-anchor {{ request()->routeIs('admin.assignments.*') ? 'active-anchor' : '' }}">
                    <i class="bi bi-shield-check me-2.5 fs-6 icon-glow"></i> &nbsp;
                    <span class="fw-medium">Inspect Assignments</span>
                </a>
            </li>

            <!-- INTEGRATED LAYER: 6. Collapsible Study Material Workspace -->
            <li class="nav-item">
                @php
                    $isStudyMaterialActive = request()->routeIs('admin.study-materials.*');
                @endphp
                <a class="nav-link d-flex justify-content-between align-items-center px-3 py-2.5 rounded-3 sidebar-anchor {{ $isStudyMaterialActive ? 'active-anchor' : '' }}" 
                   data-bs-toggle="collapse" 
                   href="#studyMaterialMenu" 
                   role="button" 
                   aria-expanded="{{ $isStudyMaterialActive ? 'true' : 'false' }}" 
                   aria-controls="studyMaterialMenu">
                    <span class="d-flex align-items-center">
                        <i class="bi bi-folder-fill me-2.5 fs-6 icon-glow"></i> &nbsp;
                        <span class="fw-medium">Study Material</span>
                    </span>
                    <i class="bi bi-chevron-down small toggle-arrow transition-all" style="{{ $isStudyMaterialActive ? 'transform: rotate(180deg);' : '' }}"></i>
                </a>
                
                <!-- Inner Child Link Nodes List Tree -->
                <div class="collapse ps-3 mt-1 {{ $isStudyMaterialActive ? 'show' : '' }}" id="studyMaterialMenu">
                    <ul class="nav flex-column gap-1 border-start ms-2 ps-2" style="border-color: rgba(255, 255, 255, 0.08) !important;">
                        
                        <!-- Link Sub-item 1: Active Materials Repository -->
                        <li class="nav-item">
                            <a href="{{ route('admin.study-materials.active') }}" 
                               class="nav-link py-2 px-3 rounded-3 small sub-anchor d-flex align-items-center gap-2 {{ request()->routeIs('admin.study-materials.active') ? 'text-white fw-bold' : 'text-secondary' }}"
                               style="font-size: 0.82rem;">
                                <i class="bi bi-file-earmark-check-fill fs-6 text-primary"></i> 
                                Active Materials
                            </a>
                        </li>
                        
                        <!-- Link Sub-item 2: Transmission Log Database -->
                        <li class="nav-item">
                            <a href="{{ route('admin.study-materials.logs') }}" 
                               class="nav-link py-2 px-3 rounded-3 small sub-anchor d-flex align-items-center gap-2 {{ request()->routeIs('admin.study-materials.logs') ? 'text-white fw-bold' : 'text-secondary' }}"
                               style="font-size: 0.82rem;">
                                <i class="bi bi-clock-history fs-6 text-success"></i> 
                                Download Logs
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.test.inspect') }}" class="nav-link d-flex align-items-center px-3 py-2.5 rounded-3 sidebar-anchor {{ request()->routeIs('admin.test.*') ? 'active-anchor' : '' }}">
                    <i class="bi bi-file-text me-2.5 fs-6 icon-glow"></i> &nbsp;
                    <span class="fw-medium">Inspect Test</span>
                </a>
            </li>

        </ul>
    </div>

    <!-- Operational Sign-out Matrix Base Footer -->
    <div class="sidebar-footer mt-auto pt-3" style="border-top: 1px solid rgba(255, 255, 255, 0.06);">
        <ul class="nav flex-column list-unstyled m-0 p-0">
            <li>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="nav-link d-flex align-items-center px-3 py-2.5 rounded-3 logout-anchor">
                    <i class="bi bi-power me-2.5 fs-5"></i> &nbsp;
                    <span class="fw-medium">Sign out Control</span>
                </a>

                <!-- Native Authentication Security Form Token -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</nav>