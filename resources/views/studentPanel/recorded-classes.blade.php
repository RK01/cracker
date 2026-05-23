@extends('layouts.student')

@section('content')
<section class="recorded-classes">
  <div class="container py-4">
    <!-- Search and Filters -->
    <div class="card shadow-sm mb-4">
      <div class="card-body">
        <form action="{{ url()->current() }}" method="GET" id="filterForm">
          <div class="row g-3">
            <div class="col-md-5">
              <div class="input-group">
                <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                <input type="text" name="search" class="form-control border-start-0"
                  placeholder="Search by title or chapter..." value="{{ request('search') }}">
              </div>
            </div>
            <div class="col-md-4">
              <select name="subject" class="form-select" onchange="document.getElementById('filterForm').submit()">
                <option value="">All Subjects</option>
                {{-- Loop through subjects if you pass them from controller, or hardcode --}}
                <option value="9" {{ request('subject') == '9' ? 'selected' : '' }}>Physics</option>
                <option value="10" {{ request('subject') == '10' ? 'selected' : '' }}>Chemistry</option>
              </select>
            </div>
            <div class="col-md-3">
              <select name="sort" class="form-select" onchange="document.getElementById('filterForm').submit()">
                <option value="date" {{ request('sort') == 'date' ? 'selected' : '' }}>Latest First</option>
                <option value="views" {{ request('sort') == 'views' ? 'selected' : '' }}>Most Viewed</option>
              </select>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Recorded Classes Grid -->
    <div class="row" id="recordedClasses">
      @forelse($getAllVideoLectures as $lecture)
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100 shadow-sm border-0">
          <div class="ratio ratio-16x9">
            <!-- Video Preview Area -->
            <div class="bg-primary d-flex align-items-center justify-content-center text-white position-relative"
              style="cursor: pointer;"
              onclick="watchVideo({{ json_encode($lecture) }})">

              <i class="bi bi-play-circle" style="font-size: 3rem;"></i>

              <div class="position-absolute bottom-0 end-0 bg-dark bg-opacity-75 text-white p-1 small m-2 rounded">
                {{ $lecture->duration ?? 'HD' }}
              </div>
            </div>
          </div>

          <div class="card-body">
            <!-- Chapter as a subtitle or prefix -->
            <h6 class="card-title mb-1 text-truncate">
              {{ $lecture->chapter }}: {{ $lecture->title }}
            </h6>

            <p class="card-text small text-muted mb-2">
              {{ getSubjectNameById($lecture->subject_id) }} •
              {{ $lecture->created_at->format('M d, Y') }} •
              {{ number_format($lecture->views) }} views
            </p>

            <div class="d-flex justify-content-between align-items-center mt-3">
              <div class="small text-muted">
                <i class="bi bi-eye"></i> {{ number_format($lecture->views) }} views
              </div>
              <button class="btn btn-warning btn-sm" onclick="watchVideo({{ json_encode($lecture) }})">
                <i class="bi bi-play"></i> Watch
              </button>
            </div>
          </div>
        </div>
      </div>
      @empty
      <div class="col-12 text-center py-5">
        <i class="bi bi-camera-video-off display-1 text-muted"></i>
        <h5 class="mt-3 text-muted">No lectures found matching your criteria.</h5>
        <a href="{{ url()->current() }}" class="btn btn-link">Clear all filters</a>
      </div>
      @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
      {{ $getAllVideoLectures->appends(request()->input())->links('pagination::bootstrap-5') }}
    </div>
  </div>
</section>

<!-- Video Player Modal -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content bg-dark text-white border-0">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="videoTitle">Video Title</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" onclick="stopVideo()"></button>
      </div>
      <div class="modal-body p-0">
        <div class="ratio ratio-16x9 bg-black">
          <video id="mainVideoPlayer" controls controlsList="nodownload">
            <source id="videoSource" src="" type="video/mp4">
            Your browser does not support the video tag.
          </video>
        </div>
        <div class="p-4">
          <h6>Description</h6>
          <p id="videoDescription" class="text-secondary small"></p>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function watchVideo(lecture) {
    const modalElement = document.getElementById('videoModal');
    const modal = new bootstrap.Modal(modalElement);

    // Update Title & Description
    document.getElementById('videoTitle').innerText = lecture.chapter + ": " + lecture.title;
    document.getElementById('videoDescription').innerText = lecture.description;

    // Update Video Path
    const videoPlayer = document.getElementById('mainVideoPlayer');
    const videoSource = document.getElementById('videoSource');

    // Assuming video_path is stored as "videos/filename.mp4" in 'public' disk
    videoSource.src = `{{ asset('storage') }}/${lecture.video_path}`;

    videoPlayer.load();
    modal.show();

    // Auto-play (Note: Browser policies might block auto-play without mute)
    videoPlayer.play().catch(error => console.log("Autoplay blocked"));
  }

  function stopVideo() {
    const videoPlayer = document.getElementById('mainVideoPlayer');
    videoPlayer.pause();
    videoPlayer.currentTime = 0;
  }

  // Stop video if user clicks outside the modal
  document.getElementById('videoModal').addEventListener('hidden.bs.modal', function() {
    stopVideo();
  });
</script>

<style>
  .group:hover i {
    transform: scale(1.2);
    transition: transform 0.2s ease-in-out;
  }

  .card {
    transition: transform 0.2s;
  }

  .card:hover {
    transform: translateY(-5px);
  }

  video {
    outline: none;
  }
</style>
@endsection