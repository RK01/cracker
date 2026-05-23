  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow-sm">
    <div class="container-fluid">
      <a class="navbar-brand d-flex align-items-center gap-2" href="../index.html">
        <img src="../img/logo.png" alt="Logo" width="40" height="40" style="object-fit:contain">
        <div><span class="fw-bold fs-6 text-white d-block" style="line-height:1">Competition</span><small class="fw-bold" style="color:var(--accent);font-size:.65rem">CRACKER</small></div>
      </a>
      <button class="navbar-toggler" type="button" id="sidebarToggle">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="ms-auto d-flex align-items-center">
        <div class="faculty-profile-menu">
          <button class="faculty-profile-btn">
            <div class="faculty-profile-avatar">DR</div>
            <span>{{ auth()->user()->name }}</span>
            <i class="fas fa-chevron-down"></i>
          </button>
        </div>
      </div>
    </div>
  </nav>