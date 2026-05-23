<!-- Sidebar -->
<div class="faculty-sidebar" id="facultySidebar">
    <div class="faculty-sidebar-header">
        <h6><i class="fas fa-user-tie me-2"></i>Faculty Panel</h6>
        <small>Manage Your Content</small>
    </div>

    <nav class="faculty-menu">
        <a href="{{ route('faculty.dashboard') }}" class="faculty-menu-item {{ request()->routeIs('faculty.dashboard') ? 'active' : '' }}">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('faculty.profile') }}" class="faculty-menu-item {{ request()->routeIs('faculty.profile') ? 'active' : '' }}">
            <i class="fas fa-user-circle"></i>
            <span>My Profile</span>
        </a>

        <a href="{{ route('faculty.courses') }}" class="faculty-menu-item {{ request()->routeIs('faculty.courses') ? 'active' : '' }}">
            <i class="fas fa-book"></i>
            <span>Courses & Subjects</span>
        </a>

        <a href="{{ route('faculty.resources') }}" class="faculty-menu-item {{ request()->routeIs('faculty.resources') ? 'active' : '' }}">
            <i class="fas fa-file-upload"></i>
            <span>Upload Resources</span>
        </a>

        <a href="{{ route('faculty.assignments') }}" class="faculty-menu-item {{ request()->routeIs('faculty.assignments') ? 'active' : '' }}">
            <i class="fas fa-tasks"></i>
            <span>Manage Assignments</span>
        </a>

        <a href="{{ route('faculty.create-tests') }}" class="faculty-menu-item {{ request()->routeIs('faculty.create-tests') ? 'active' : '' }}">
            <i class="fas fa-file-alt"></i>
            <span>Create Tests</span>
        </a>

         <a href="{{ route('faculty.test-result') }}" class="faculty-menu-item {{ request()->routeIs('faculty.test-result') ? 'active' : '' }}">
            <i class="fas fa-check-circle"></i>
            <span>Test Result</span>
        </a>
       
        <a href="{{ route('faculty.attendance') }}" class="faculty-menu-item {{ request()->routeIs('faculty.attendance') ? 'active' : '' }}">
            <i class="fas fa-clipboard-list"></i>
            <span>Attendance</span>
        </a>
       
        <a href="{{ route('faculty.announcements') }}" class="faculty-menu-item {{ request()->routeIs('faculty.announcements') ? 'active' : '' }}"active">
            <i class="fas fa-bullhorn"></i>
            <span>Announcements</span>
        </a>      

        <a href="{{ route('faculty.student.queries') }}" class="faculty-menu-item {{ request()->routeIs('faculty.student.queries') ? 'active' : '' }}">
            <i class="fas fa-comments"></i>
            <span>Student Queries</span>
        </a>

        <a href="{{ route('faculty.video-lectures') }}" class="faculty-menu-item {{ request()->routeIs('faculty.video-lectures') ? 'active' : '' }}">
            <i class="fas fa-video"></i>
            <span>Video Lectures</span>
        </a>

        <a href="{{ route('faculty.performance') }}" class="faculty-menu-item {{ request()->routeIs('faculty.performance') ? 'active' : '' }}">
            <i class="fas fa-chart-line"></i>
            <span>Student Performance</span>
        </a>

        <a href="{{ route('faculty.live-classes') }}" class="faculty-menu-item {{ request()->routeIs('faculty.live-classes') ? 'active' : '' }}">
            <i class="fas fa-video"></i>
            <span>Live Classes</span>
        </a>

        <a href="{{ route('logout') }}" 
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="faculty-menu-item {{ request()->routeIs('faculty.logout') ? 'active' : '' }}"
           style="border-top: 1px solid #e5e7eb; margin-top: 20px; padding-top: 20px;">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </nav>
</div>