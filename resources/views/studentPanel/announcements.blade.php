@extends('layouts.student')
@section('content')
<!-- Announcements Content -->
<div class="container py-4">
  <div class="faculty-topbar">
     <div class="faculty-topbar-title">
       <h4><i class="fas fa-video me-2"></i>Upload Video Lectures</h4>
       <small>Add new video lectures to your courses</small>
     </div>
   </div>
  <!-- Announcement Stats -->
  <div class="row mb-4">
    <div class="col-md-3 mb-3">
      <div class="card shadow-sm text-center">
        <div class="card-body">
          <div class="text-primary mb-2" style="font-size: 2rem;"><i class="bi bi-bell"></i></div>
          <h4 class="mb-1">{{ $stats['total'] }}</h4>
          <small class="text-muted">Total Announcements</small>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card shadow-sm text-center">
        <div class="card-body">
          <div class="text-danger mb-2" style="font-size: 2rem;"><i class="bi bi-exclamation-triangle"></i></div>
          <h4 class="mb-1">{{ $stats['important'] }}</h4>
          <small class="text-muted">Important</small>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card shadow-sm text-center">
        <div class="card-body">
          <div class="text-warning mb-2" style="font-size: 2rem;"><i class="bi bi-calendar-event"></i></div>
          <h4 class="mb-1">{{ $stats['this_week'] }}</h4>
          <small class="text-muted">This Week</small>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card shadow-sm text-center">
        <div class="card-body">
          <div class="text-success mb-2" style="font-size: 2rem;"><i class="bi bi-check-circle"></i></div>
          <h4 class="mb-1">{{ $stats['read'] }}</h4>
          <small class="text-muted">Read</small>
        </div>
      </div>
    </div>
  </div>

  <!-- Announcement Filters -->
  <div class="card shadow-sm mb-4">
    <div class="card-body">
      <div class="row align-items-center">
        <div class="col-md-6">
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
            <input type="text" class="form-control" placeholder="Search announcements..." id="searchInput">
          </div>
        </div>
        <div class="col-md-6">
          <div class="d-flex gap-2 justify-content-end">
            <select class="form-select form-select-sm" style="width: auto;" id="categoryFilter">
              <option value="all">All Categories</option>
              <option value="academic">Academic</option>
              <option value="exam">Exam</option>
              <option value="event">Event</option>
              <option value="general">General</option>
            </select>
            <select class="form-select form-select-sm" style="width: auto;" id="priorityFilter">
              <option value="all">All Priority</option>
              <option value="high">High Priority</option>
              <option value="normal">Normal</option>
            </select>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Announcements List -->
  <div class="announcements-list">
    @foreach($announcements as $item)
    @php
    // Dynamic classes based on category
    $bgColor = [
    'exam' => 'bg-danger',
    'event' => 'bg-warning',
    'academic' => 'bg-info',
    'general' => 'bg-secondary'
    ][$item->category] ?? 'bg-primary';
    @endphp
    <!-- Important Announcement -->
    <div class="card {{ $item->priority == 'high' ? 'border-danger' : '' }} mb-3 announcement-card" data-category="exam" data-priority="high">
      <div class="card-header {{ $bgColor }} {{ $item->category == 'event' ? 'text-dark' : 'text-white' }} d-flex justify-content-between align-items-center">
        <div>
          <i class="bi bi-exclamation-triangle-fill me-2"></i>
          <strong>{{ $item->announcement_title }}</strong>
        </div>
        <small class="badge {{ $item->priority == 'high' ? 'text-danger' : 'text-light' }}">{{ ucfirst($item->priority) }}</small>
      </div>
      <div class="card-body">
        <p class="card-text">{{ $item->announcement_message }}</p>
        <div class="row align-items-center">
          <div class="col-md-8">
            <small class="text-muted">
              <i class="bi bi-calendar"></i> Posted: {{ $item->created_at->format('M d, Y') }}<br>
              <i class="bi bi-person"></i> By: {{ userNameById($item->posted_by) }}
            </small>
          </div>
          @php
          $user = auth()->user();
          @endphp
          <div class="col-md-4 text-end">
            <button
              type="button"
              class="btn btn-outline-{{ str_replace('bg-', '', $bgColor) }} btn-sm me-2"
              onclick="markAsRead(this, {{ $item->id }})"
              {{ $user->readAnnouncements->contains($item->id) ? 'disabled' : '' }}>
              @if($user->readAnnouncements->contains($item->id))
              <i class="bi bi-check-all"></i> Read
              @else
              <i class="bi bi-check"></i> Mark Read
              @endif
            </button>
            <button class="btn btn-{{ str_replace('bg-', '', $bgColor) }} btn-sm">
              <i class="bi bi-eye"></i> <a href="{{ asset('storage/announcements/' . $item->file) }}" class="text-decoration-none text-warning" target="_blank">View Document</a>
            </button>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="d-flex justify-content-end mt-3">
    {{ $announcements->withQueryString()->links('pagination::bootstrap-5') }}
  </div>
</div>
<script>
  document.getElementById('categoryFilter').addEventListener('change', function() {
    applyFilters();
  });

  document.getElementById('priorityFilter').addEventListener('change', function() {
    applyFilters();
  });

  function applyFilters() {
    let category = document.getElementById('categoryFilter').value;
    let priority = document.getElementById('priorityFilter').value;

    // URL update karke page reload karega with filters
    window.location.href = `{{ route('student.announcements') }}?category=${category}&priority=${priority}`;
  }

  // Client-side search (optional)
  document.getElementById('searchInput').addEventListener('keyup', function() {
    let value = this.value.toLowerCase();
    document.querySelectorAll('.announcement-card').forEach(card => {
      let title = card.querySelector('strong').innerText.toLowerCase();
      card.style.display = title.includes(value) ? 'block' : 'none';
    });
  });



  function markAsRead(button, announcementId) {
    button.disabled = true;
    button.innerHTML ='<span class="spinner-border spinner-border-sm"></span>';
    fetch(`/student/announcements/${announcementId}/read`, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        }
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {

          button.classList.remove(
            'btn-outline-info',
            'btn-outline-danger',
            'btn-outline-warning',
            'btn-outline-secondary'
          );

          button.classList.add('btn-success');
          button.innerHTML ='<i class="bi bi-check-all"></i> Read';
        }
      })
      .catch(error => {
        console.log(error);
        button.disabled = false;
        button.innerHTML = '<i class="bi bi-check"></i> Mark Read';
      });
  }
</script>
@endsection