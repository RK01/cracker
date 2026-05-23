 <nav class="sidebar">
     <div class="brand mb-4">
         <div class="app-brand justify-content-center">
             <a href="index.html" class="app-brand-link gap-2">
                 <img src="{{ asset('img/logo.png') }}" alt="" class="app-brand-logo demo" />
             </a>
         </div>
     </div>

     <h6 class="text-muted text-uppercase small mb-2">Main</h6>
     <ul class="nav flex-column mb-3">
         {{--<li class="nav-item">
             <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                 href="#dashboardsMenu" role="button" aria-expanded="false" aria-controls="dashboardsMenu">
                 <span><i class="bi bi-house me-2"></i> Dashboards</span>
                 <i class="bi bi-chevron-down"></i>
             </a>
             <div class="collapse ps-4" id="dashboardsMenu">
                 <a href="#" class="nav-link"><i class="bi bi-speedometer2 me-2"></i>Default</a>
                 <a href="#" class="nav-link"><i class="bi bi-graph-up me-2"></i>Analytics</a>
                 <a href="#" class="nav-link"><i class="bi bi-cart me-2"></i>E-commerce</a>
             </div>
         </li>--}}
         <li class="nav-item"><a href="{{route('admin.add.faculty')}}" class="nav-link"><i class="bi bi-file-text me-2"></i> Create Faculty Profile</a></li>
         <li class="nav-item"><a href="{{route('admin.faculty.list')}}" class="nav-link"><i class="bi bi-shield-lock me-2"></i> Faculty List</a></li>
         <li class="nav-item"><a href="{{route('admin.student.list')}}" class="nav-link"><i class="bi bi-shield-lock me-2"></i> Student List</a></li>
     </ul>

     
     <ul class="nav flex-column">
         <li>
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
         </li>
     </ul>
 </nav>