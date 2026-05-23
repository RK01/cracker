@extends('layouts.faculty')
@section('content')
<!-- Main Content -->
<div class="faculty-main" id="facultyMain">
  <!-- Top Bar -->
  <div class="faculty-topbar">
    <div class="faculty-topbar-title">
      <h4><i class="fas fa-video me-2"></i>Upload Video Lectures</h4>
      <small>Add new video lectures to your courses</small>
    </div>
  </div>

  <!-- Upload Form -->
  <div class="row">
    <div class="col-lg-8">
      <div class="form-section">
        <h5 class="form-section-title">
          <i class="fas fa-cloud-upload-alt me-2"></i>Upload New Lecture
        </h5>

        <form method="POST" action="{{ route('faculty.video-lectures.store') }}" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-lg-4">
              <div class="mb-3">
                <label class="form-label">Course</label>
                <select id="course_id" name="course_id" class="form-select @error('course_id') is-invalid @enderror" required>
                  <option disabled selected>Choose Course</option>
                  @foreach($courses as $course)
                  <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>{{ $course->name }}</option>
                  @endforeach
                </select>
                @error('course_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
            </div>

            <div class="col-lg-4">
              <div class="mb-3">
                <label class="form-label">Sub Category Course</label>
                <select id="sub_cat_course_id" name="sub_cat_course_id" class="form-select @error('sub_cat_course_id') is-invalid @enderror" required>
                  <option disabled selected>Choose Course</option>
                  @foreach(mySubCourestIds() as $CategoryName)
                  <option value="{{ $CategoryName }}" {{ old('sub_cat_course_id') == $CategoryName ? 'selected' : '' }}>{{ getSubCatCourseNameById($CategoryName) }}</option>
                  @endforeach
                </select>
                @error('sub_cat_course_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
            </div>

            <div class="col-lg-4">
              <div class="mb-3">
                <label class="form-label">Subject</label>
                <select id="subject_id" name="subject_id" class="form-select @error('subject_id') is-invalid @enderror" required>
                  <option disabled selected>Choose Subject</option>
                  <option value="{{ mySubjectId() }}" {{ old('subject_id') == mySubjectId() ? 'selected' : '' }}>{{ getSubjectNameById(mySubjectId()) }}</option>
                </select>
                @error('subject_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Chapter/Topic</label>
                <input type="text" name="chapter" class="form-control @error('chapter') is-invalid @enderror" placeholder="e.g., Calculus - Integration Techniques" value="{{ old('chapter') }}" required>
                @error('chapter')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
            </div>

            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Video Title</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter lecture title" value="{{ old('title') }}" required>
                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="Add lecture description, key points covered, etc." required>{{ old('description') }}</textarea>
            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Select Video File</label>
            <input type="file" name="video" class="form-control @error('video') is-invalid @enderror" accept="video/*" required>
            @error('video')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Visibility</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="visibility" id="publicVideo" value="public" {{ old('visibility', 'public') == 'public' ? 'checked' : '' }}>
              <label class="form-check-label" for="publicVideo">
                <i class="fas fa-globe me-2"></i>Public - All enrolled students can access
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="visibility" id="privateVideo" value="private" {{ old('visibility') == 'private' ? 'checked' : '' }}>
              <label class="form-check-label" for="privateVideo">
                <i class="fas fa-lock me-2"></i>Private - Only selected students
              </label>
            </div>
          </div>

          <button type="submit" class="btn btn-gold">
            <i class="fas fa-upload me-2"></i>Upload Video Lecture
          </button>
          <button type="reset" class="btn btn-outline-primary-faculty ms-2">
            <i class="fas fa-undo me-2"></i>Clear
          </button>
        </form>
      </div>
    </div>

    <!-- Upload Progress -->
    <div class="col-lg-4">
      <div class="form-section" style="height: 95%;">
        <h5 class="form-section-title">
          <i class="fas fa-info-circle me-2"></i>Upload Guidelines
        </h5>

        <div class="alert alert-info mb-3">
          <strong>File Requirements:</strong>
          <ul class="mb-0 mt-2">
            <li>Supported formats: MP4, MKV, AVI, MOV</li>
            <li>Maximum file size: 500 MB</li>
            <li>Minimum resolution: 720p</li>
            <li>Frame rate: 24/30/60 FPS</li>
          </ul>
        </div>

        <div class="alert alert-warning">
          <strong>Tips for better uploads:</strong>
          <ul class="mb-0 mt-2">
            <li>Use clear audio without background noise</li>
            <li>Ensure proper lighting</li>
            <li>Add subtitles for accessibility</li>
            <li>Use high-quality screen recordings</li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- Uploaded Lectures -->
  <div class="form-section mt-4">
    <h5 class="form-section-title">
      <i class="fas fa-list me-2"></i>Your Uploaded Lectures
    </h5>

    <table class="table table-hover ">
      <thead class="table-info">
        <tr>
          <th>Chapter & Title</th>
          <th>Visibility</th>
          <th>Views</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse($getAllVideoLectures as $lecture)
        <tr>
          <td>
            <div class="d-flex flex-column">
              <span class="badge bg-light text-dark border mb-1" style="width: fit-content;">
                {{ $lecture->chapter }}
              </span>
              <strong>{{ $lecture->title }}</strong>
            </div>
          </td>
          <td>
            @if($lecture->visibility == 'public')
            <span class="text-success"><i class="fas fa-globe me-1"></i> Public</span>
            @else
            <span class="text-muted"><i class="fas fa-lock me-1"></i> Private</span>
            @endif
          </td>
          <td>{{ number_format($lecture->views) }}</td>
          <td>
            @if($lecture->status == 'published')
            <span class="table-badge success">Published</span>
            @else
            <span class="table-badge warning">Draft</span>
            @endif
          </td>
          <td>
            <div class="dropdown">
              <button class="btn btn-sm btn-outline-primary-faculty dropdown-toggle" type="button" data-bs-toggle="dropdown">
                Actions
              </button>
              <ul class="dropdown-menu">
                {{--<li>
                        <a class="dropdown-item" href="{{ route('faculty.lectures.edit', $lecture->id) }}">
                <i class="fas fa-edit me-2"></i>Edit
                </a>
                </li>--}}
                <li>
                  <form action="{{ route('faculty.lectures.manageStatus', [$lecture->id, $lecture->status == 'published' ? 'draft' : 'published']) }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item">
                      <i class="fas fa-sync me-2"></i>Mark as {{ $lecture->status == 'published' ? 'Draft' : 'Publish' }}
                    </button>
                  </form>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li>
                  <form action="{{ route('faculty.lectures.destroy', $lecture->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="dropdown-item text-danger">
                      <i class="fas fa-trash me-2"></i>Delete
                    </button>
                  </form>
                </li>
              </ul>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="5" class="text-center py-4 text-muted">
            No video lectures found. Start by uploading your first lecture.
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<script>
  document.getElementById('sidebarToggle').addEventListener('click', function() {
    document.getElementById('facultySidebar').classList.toggle('show');
    document.getElementById('facultyMain').classList.toggle('sidebar-active');
  });

  document.querySelectorAll('.faculty-menu-item').forEach(item => {
    item.addEventListener('click', function() {
      if (window.innerWidth <= 768) {
        document.getElementById('facultySidebar').classList.remove('show');
        document.getElementById('facultyMain').classList.remove('sidebar-active');
      }
    });
  });

  // File upload handling
  const uploadArea = document.getElementById('videoUploadArea');
  const fileInput = document.getElementById('videoFile');

  uploadArea.addEventListener('click', () => fileInput.click());

  uploadArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    uploadArea.classList.add('active');
  });

  uploadArea.addEventListener('dragleave', () => {
    uploadArea.classList.remove('active');
  });

  uploadArea.addEventListener('drop', (e) => {
    e.preventDefault();
    uploadArea.classList.remove('active');
    fileInput.files = e.dataTransfer.files;
  });

  document.getElementById('videoUploadForm').addEventListener('submit', function(e) {
    e.preventDefault();
    alert('Video lecture uploaded successfully!');
  });
</script>

@endsection