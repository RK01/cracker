<div class="faculty-sidebar" id="facultySidebar">
    <div class="faculty-sidebar-header">
        <h6><i class="fas fa-user-tie me-2"></i>Student Dashboard</h6>
        <small>Manage Your Content</small>
    </div>
    <div class="list-group list-group-flush p-2">

        <a href="{{ route('student.dashboard') }}"
            class="list-group-item list-group-item-action border-0 rounded mb-1 {{ request()->routeIs('student.dashboard') ? 'active bg-primary' : '' }}">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>

        <a href="{{ route('student.courses') }}"
            class="list-group-item list-group-item-action border-0 rounded mb-1 {{ request()->routeIs('student.courses') ? 'active bg-primary' : '' }}">
            <i class="bi bi-book me-2"></i> Courses
        </a>

        <a href="{{ route('student.announcements') }}"
            class="list-group-item list-group-item-action border-0 rounded mb-1 {{ request()->routeIs('student.announcements') ? 'active bg-primary' : '' }}">
            <i class="bi bi-megaphone me-2"></i> Announcements
        </a>
        @if(hasPurchasedAnyCourse())
        <a href="{{ route('student.assignments') }}"
            class="list-group-item list-group-item-action border-0 rounded mb-1 {{ request()->routeIs('student.assignments') ? 'active bg-primary' : '' }}">
            <i class="bi bi-journal-text me-2"></i> Assignments
        </a>

        <a href="{{ route('student.materials') }}"
            class="list-group-item list-group-item-action border-0 rounded mb-1 {{ request()->routeIs('student.materials') ? 'active bg-primary' : '' }}">
            <i class="bi bi-file-earmark-pdf me-2"></i> Study Materials
        </a>
        
        <a href="{{ route('student.exams') }}"
            class="list-group-item list-group-item-action border-0 rounded mb-1 {{ request()->routeIs('student.exams') ? 'active bg-primary' : '' }}">
            <i class="bi bi-clipboard-check me-2"></i> Online Exams
        </a>

        {{--<a href="{{ route('student.enrollment') }}"
            class="list-group-item list-group-item-action border-0 rounded mb-1 {{ request()->routeIs('student.enrollment') ? 'active bg-primary' : '' }}">
            <i class="bi bi-journal-check me-2"></i> Enrollment
        </a>--}}

        <a href="{{ route('student.attendance') }}"
            class="list-group-item list-group-item-action border-0 rounded mb-1 {{ request()->routeIs('student.attendance') ? 'active bg-primary' : '' }}">
            <i class="bi bi-calendar-check me-2"></i> Attendance
        </a>

        <a href="{{ route('student.doubts.and.queries') }}"
            class="list-group-item list-group-item-action border-0 rounded mb-1 {{ request()->routeIs('student.doubts.and.queries') ? 'active bg-primary' : '' }}">
            <i class="bi bi-chat-dots me-2"></i> Doubts & Queries
        </a>

        <a href="{{ route('student.recorded') }}"
            class="list-group-item list-group-item-action border-0 rounded mb-1 {{ request()->routeIs('student.recorded') ? 'active bg-primary' : '' }}">
            <i class="bi bi-play-btn me-2"></i> Recorded Classes
        </a>

        <a href="{{ route('student.certificates') }}"
            class="list-group-item list-group-item-action border-0 rounded mb-1 {{ request()->routeIs('student.certificates') ? 'active bg-primary' : '' }}">
            <i class="bi bi-patch-check me-2"></i> Certificates
        </a>

        <a href="{{ route('student.live') }}"
            class="list-group-item list-group-item-action border-0 rounded mb-1 {{ request()->routeIs('student.live') ? 'active bg-primary' : '' }}">
            <i class="bi bi-camera-video me-2"></i> Live Classes
        </a>

        @endif
        <div class="mt-4 pt-3 border-top px-3 small text-muted text-uppercase fw-bold" style="font-size: 0.7rem;">Account</div>
        <a href="{{ route('student.profile')}}"
            class="list-group-item list-group-item-action border-0 rounded mb-1 {{ request()->routeIs('student.profile') ? 'active bg-primary' : '' }}">
            <i class="bi bi-person me-2"></i> Profile
        </a>
        <a href="{{ route('student.orders')}}"
            class="list-group-item list-group-item-action border-0 rounded mb-1 {{ request()->routeIs('student.orders') ? 'active bg-primary' : '' }}">
            <i class="bi bi-bag me-2"></i> My Orders
        </a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="list-group-item list-group-item-action border-0 rounded text-danger bg-transparent w-100">
                <i class="bi bi-box-arrow-left me-2"></i> Logout
            </button>
        </form>
    </div>
</div>