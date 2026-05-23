@extends('layouts.faculty')
@section('content')
<!-- Main Content -->
<div class="faculty-main" id="facultyMain">
  <!-- Top Bar -->
  <div class="faculty-topbar">
    <div class="faculty-topbar-title">
      <h4><i class="fas fa-file-upload me-2"></i>Upload Resources</h4>
      <small>Share notes, assignments, PDFs, and other study materials</small>
    </div>
  </div>
  <div class="row g-3 mb-4">
    <div class="col-md-6">
      <div class="card border-0 shadow-sm p-3">
        <div class="d-flex align-items-center">
          <div class="bg-primary text-white p-3 rounded me-3"><i class="fas fa-file-pdf me-2"></i></div>
          <div><small class="text-muted">Total Study Materials</small>
            <h5 class="mb-0 fw-bold">{{$totalstudyMaterials}}</h5>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card border-0 shadow-sm p-3">
        <div class="d-flex align-items-center">
          <div class="bg-success text-white p-3 rounded me-3"> <i class="fas fa-tasks me-2"></i></div>
          <div><small class="text-muted">Total Assignments</small>
            <h5 class="mb-0 fw-bold">{{$totalstudyAssignments}}</h5>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-8">
      <!-- Tab Navigation -->
      <div class="form-section mb-0" style="border-radius: 10px 10px 0px 0px;padding-bottom: 0;margin: 0;padding: 0px 0px 0px 0px;">
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item w-50 bg-primary text-light" style="border-radius: 10px 0px 0px 0px;">
            <a class="nav-link active" data-bs-toggle="tab" href="#notesTab" style="background: unset;color:white;padding: 15px;border-radius: 10px 10px 0px 0px;">
              <i class="fas fa-file-pdf me-2"></i>Upload Study Materials
            </a>
          </li>
          <li class="nav-item w-50 bg-success text-light" style="border-radius: 0px 10px 0px 0px;">
            <a class="nav-link" data-bs-toggle="tab" href="#assignmentsTab" style="background: unset;color:white;padding: 15px;border-radius: 10px 10px 0px 0px;">
              <i class="fas fa-tasks me-2"></i>Upload Assignments
            </a>
          </li>
        </ul>
      </div>
      <!-- Tab Content -->
      <div class="tab-content">
        <!-- Notes Tab -->
        <div class="tab-pane fade show active" id="notesTab">
          <div class="form-section" style="border-radius: 0px 0px 10px 10px; margin-top: 0;">
            <form method="POST" action="{{ route('faculty.study-materials.store') }}" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col-lg-12">

                  <div class="row">
                    <div class="col-lg-4">
                      <!-- Title -->
                      <div class="mb-3">
                        <label class="form-label">Note Title</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Enter note title">
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>

                    <!-- Type -->
                    <div class="col-lg-4">
                      <div class="mb-3">
                        <label class="form-label">Type</label>
                        <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                          <option value="">Select Type</option>
                          <option value="notes" {{ old('type') == 'notes' ? 'selected' : '' }}>Notes</option>
                          <option value="assignment" {{ old('type') == 'assignment' ? 'selected' : '' }}>Assignment</option>
                          <option value="reference" {{ old('type') == 'reference' ? 'selected' : '' }}>Reference</option>
                        </select>
                        @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                      </div>
                    </div>

                    <!-- Due Date -->
                    <div class="col-lg-4">
                      <div class="mb-3">
                        <label class="form-label">Due Date</label>
                        <input type="date" class="form-control @error('due_date') is-invalid @enderror" value="{{ old('due_date') }}" name="due_date" id="due_date">
                        @error('due_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                      </div>
                    </div>
                  </div>

                  <!-- Course -->
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="mb-3">
                        <label class="form-label">Course</label>
                        <select id="course_id" name="course_id" class="form-select @error('course_id') is-invalid @enderror" required>
                          <option disabled>Choose Course</option>
                          @foreach($courses as $course)
                          <option value="{{ $course->id }}" {{ old('course_id', auth()->user()->course_id) == $course->id ? 'selected' : '' }}>{{ $course->name }}</option>
                          @endforeach
                        </select>
                        @error('course_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                      </div>
                    </div>

                    <div class="col-lg-4">
                      <div class="mb-3">
                        <label class="form-label">Sub Catogery Course</label>
                        <select id="sub_cat_course_id" name="sub_cat_course_id" class="form-select @error('sub_cat_course_id') is-invalid @enderror" required>
                          <option disabled>Choose Course</option>
                          @foreach(mySubCourestIds() ?? [] as $CategoryName)
                          <option value="{{ $CategoryName }}" {{ old('sub_cat_course_id') == $CategoryName ? 'selected' : '' }}> {{ getSubCatCourseNameById($CategoryName) }}</option>
                          @endforeach
                        </select>
                        @error('sub_cat_course_id')<div class="invalid-feedback"> {{ $message }} </div>@enderror
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="mb-3">
                        <label class="form-label">Subject</label>
                        <select id="subject_id" name="subject_id" class="form-select @error('subject_id') is-invalid @enderror" required>
                          <option disabled>Choose subject</option>
                          <option value="{{ mySubjectId() }}" {{ old('subject_id', mySubjectId()) == mySubjectId() ? 'selected' : '' }}>
                            {{ getSubjectNameById(mySubjectId()) }}
                          </option>
                        </select>
                        @error('subject_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                      </div>
                    </div>
                  </div>



                  <!-- Description -->
                  <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3" required>{{ old('description') }}</textarea>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>

                  <!-- File Upload -->
                  <div class="mb-3">
                    <label class="form-label">Upload PDF</label>
                    <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" accept="application/pdf">
                    @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <small class="text-muted">PDF only (Max 50MB)</small>
                  </div>

                  <button type="submit" class="btn btn-gold">
                    <i class="fas fa-upload me-2"></i>Upload Notes
                  </button>

                </div>
              </div>
            </form>
          </div>
        </div>

        <!-- Assignments Tab -->
        <div class="tab-pane fade" id="assignmentsTab">
          <div class="form-section" style="border-radius: 0 0 8px 8px; margin-top: 0;">
            <form method="POST" action="{{ route('faculty.assignments.store') }}" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col-lg-12">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="mb-3">
                        <label class="form-label">Assignments Title</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter note title" value="{{ old('title') }}" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div> @enderror
                      </div>
                    </div>

                    <div class="col-lg-4">
                      <div class="mb-3">
                        <label class="form-label">Assignments Type</label>
                        <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                          <option value="">Select Type</option>
                          <option value="notes" {{ old('type') == 'notes' ? 'selected' : '' }}> Notes </option>
                          <option value="assignment" {{ old('type') == 'assignment' ? 'selected' : '' }}> Assignment </option>
                          <option value="reference" {{ old('type') == 'reference' ? 'selected' : '' }}> Reference </option>
                        </select>
                        @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                      </div>
                    </div>

                    <div class="col-lg-4">
                      <div class="mb-3">
                        <label class="form-label">Due Date</label>
                        <input type="date" class="form-control @error('due_date') is-invalid @enderror" name="due_date" id="due_date" value="{{ old('due_date') }}">
                        @error('due_date')<div class="invalid-feedback">{{ $message }}</div> @enderror
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="mb-3">
                        <label class="form-label">Course</label>
                        <select id="course_id" name="course_id" class="form-select @error('course_id') is-invalid @enderror" required>
                          <option disabled>Choose Course</option>
                          @foreach($courses as $course)
                          <option value="{{ $course->id }}" {{ old('course_id', auth()->user()->course_id) == $course->id ? 'selected' : '' }}> {{ $course->name }} </option>
                          @endforeach
                        </select>
                        @error('course_id') <div class="invalid-feedback">{{ $message }}</div>@enderror
                      </div>
                    </div>

                    <div class="col-lg-4">
                      <div class="mb-3">
                        <label class="form-label">Sub Category Course</label>
                        <select id="sub_cat_course_id" name="sub_cat_course_id" class="form-select @error('sub_cat_course_id') is-invalid @enderror" required>
                          <option disabled>Choose Course</option>
                          @foreach(mySubCourestIds() ?? [] as $CategoryName)
                          <option value="{{ $CategoryName }}" {{ old('sub_cat_course_id') == $CategoryName ? 'selected' : '' }}> {{ getSubCatCourseNameById($CategoryName) }}</option>
                          @endforeach
                        </select>
                        @error('sub_cat_course_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                      </div>
                    </div>

                    <div class="col-lg-4">
                      <div class="mb-3">
                        <label class="form-label">Subject</label>
                        <select id="subject_id" name="subject_id" class="form-select @error('subject_id') is-invalid @enderror" required>
                          <option disabled>Choose Subject</option>
                          <option value="{{ mySubjectId() }}" {{ old('subject_id', mySubjectId()) == mySubjectId() ? 'selected' : '' }}>{{ getSubjectNameById(mySubjectId()) }}</option>
                        </select>
                        @error('subject_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                      </div>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3" required>{{ old('description') }}</textarea>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Upload PDF</label>
                    <input type="file" name="assignmentFile" id="assignmentFile" class="form-control @error('assignmentFile') is-invalid @enderror" accept="application/pdf" required>
                    <small class="text-muted">PDF only (Max 50MB)</small>
                    @error('assignmentFile')<div class="invalid-feedback">{{ $message }}</div> @enderror
                  </div>
                  <button type="submit" class="btn btn-primary">Create Assignment</button>

                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- Study Materials Tab -->
      </div>
    </div>
    <div class="col-lg-4">
      <div class="form-section" style="height: 95%;">
        <h5 class="form-section-title">
          <i class="fas fa-lightbulb me-2"></i>Quick Tips
        </h5>
        <div class="alert alert-info">
          <strong>Test Creation Tips:</strong>
          <ul class="mb-0 mt-2 small">
            <li>Use diverse question types</li>
            <li>Set realistic time limits</li>
            <li>Include difficulty variation</li>
            <li>Add clear instructions</li>
            <li>Test before publishing</li>
          </ul>
        </div>

      </div>

    </div>
  </div>



  <!-- Resources List -->
  <div class="form-section mt-4">
    <h5 class="form-section-title">
      <i class="fas fa-list me-2"></i>Your Uploaded Resources
    </h5>


    <div class="faculty-table-container">
      <table class="table table-hover align-middle">
        <thead class="table-light">
          <tr>
            <th>Type</th>
            <th>Title</th>
            <th>Course & Category</th>
            <th>Description</th>
            <th>Dates</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
      
        <tbody>
          {{-- Loop directly through the paginated data --}}
          @forelse($combined as $material)
         
          <tr>
            <!-- Type Section -->
            <td style="white-space: nowrap;">
              @if($material['type'] == 'assignment')
              <i class="fas fa-tasks text-warning"></i>
              @else
              <i class="fas fa-book text-info"></i>
              @endif
              <span class="ms-1">{{ ucwords($material['type']) }}</span>
            </td>

            <!-- Title Section -->
            <td>
              <span class="fw-bold text-dark">{{ ucwords($material['title']) }}</span>
              <br>
              <small class="text-muted">Size: {{ number_format($material['file_size'] / 1024, 2) }} KB</small>
            </td>

            <!-- Course & Sub-Category -->
            <td>
              <span class="badge bg-primary">{{ getCourseNameById($material['course_id']) }}</span>
              <br>
              <small class="text-muted italic">{{ $material['sub_cat_course_id'] == 3 ? 'Two Year Integrated' : 'One Year Integrated' }}</small>
            </td>

            <!-- Description (Shortened for UI) -->
            <td title="{{ $material['description'] }}">
              {{ Str::limit($material['description'], 50) }}
            </td>

            <!-- Dates -->
            <td>
              <div style="font-size: 0.85rem;">
                <strong>Posted:</strong> {{ \Carbon\Carbon::parse($material['created_at'])->format('d M, Y') }}<br>
                <strong class="text-danger">Due:</strong> {{ \Carbon\Carbon::parse($material['due_date'])->format('d M, Y') }}
              </div>
            </td>

            <!-- Action Section (View File) -->
            <td class="text-center align-middle">
              @if(!empty($material['file_path']))
              @php
              $extension = pathinfo($material['file_path'], PATHINFO_EXTENSION);
              $icon = 'fa-file-alt';
              $color = 'btn-outline-secondary';

              if($extension == 'pdf') { $icon = 'fa-file-pdf'; $color = 'btn-outline-danger'; }
              if(in_array($extension, ['doc', 'docx'])) { $icon = 'fa-file-word'; $color = 'btn-outline-primary'; }
              if($extension == 'zip') { $icon = 'fa-file-archive'; $color = 'btn-outline-warning'; }
              @endphp

              <a href="{{ asset('storage/' . $material['file_path']) }}"
                target="_blank"
                class="btn btn-sm {{ $color }} border-2 rounded-pill px-3 fw-bold shadow-sm"
                title="View Document">
                <i class="fas {{ $icon }} me-1"></i> View
              </a>
              @else
              <div class="d-flex flex-column align-items-center text-muted opacity-50">
                <i class="fas fa-ban mb-1"></i>
                <span style="font-size: 0.7rem;">No File</span>
              </div>
              @endif
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="text-center py-4 text-muted">
              <i class="fas fa-folder-open fa-2x mb-2"></i><br>
              No resources uploaded yet.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>

      <!-- Pagination Links (If you are using Laravel Pagination) -->
      <div class="mt-3">
        {{-- $combined->links() --}}
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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

  // File upload handlers
  function setupFileUpload(areaId, inputId) {
    const area = document.getElementById(areaId);
    const input = document.getElementById(inputId);

    area.addEventListener('click', () => input.click());

    area.addEventListener('dragover', (e) => {
      e.preventDefault();
      area.classList.add('active');
    });

    area.addEventListener('dragleave', () => {
      area.classList.remove('active');
    });

    area.addEventListener('drop', (e) => {
      e.preventDefault();
      area.classList.remove('active');
      input.files = e.dataTransfer.files;
    });
  }

  setupFileUpload('pdfUploadArea', 'pdfFile');
  setupFileUpload('assignmentUploadArea', 'assignmentFile');
  setupFileUpload('materialsUploadArea', 'materialsFile');

  document.getElementById('notesForm').addEventListener('submit', function(e) {
    e.preventDefault();
    alert('Notes uploaded successfully!');
  });

  document.getElementById('assignmentForm').addEventListener('submit', function(e) {
    e.preventDefault();
    alert('Assignment created successfully!');
  });

  document.getElementById('materialsForm').addEventListener('submit', function(e) {
    e.preventDefault();
    alert('Materials uploaded successfully!');
  });
</script>
@endsection