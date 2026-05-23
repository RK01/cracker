@extends('layouts.faculty')
@section('content')
<div class="faculty-main" id="facultyMain">
  <div class="faculty-topbar">
    <div class="faculty-topbar-title">
      <h4><i class="fas fa-file-alt me-2"></i>Create Online Tests</h4>
      <small>Design and publish new tests for your students</small>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-8">
      <div class="form-section">
        <h5 class="form-section-title">
          <i class="fas fa-plus-circle me-2"></i>Create New Test
        </h5>
        <form action="{{ route('faculty.tests.store') }}" method="POST">
          @csrf
          <div class="card shadow-sm mb-4 border-0">
            <div class="card-body">
              <div class="row">
                <!-- Test Title -->
                <div class="col-md-6 mb-3">
                  <div class="mb-3">
                    <label class="form-label fw-bold">Test Title</label>
                    <input type="text" name="title" value="{{ old('title') }}" placeholder="Enter Test Title" class="form-control @error('title') is-invalid @enderror" required>
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>

                <!-- Duration -->
                <div class="col-md-6 mb-3">
                  <label class="form-label fw-bold">Duration (Minutes)</label>
                  <input type="number" name="duration_minutes" value="{{ old('duration_minutes') }}" class="form-control @error('duration_minutes') is-invalid @enderror" placeholder="180" required>
                  @error('duration_minutes')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <!-- Course -->
                <div class="col-md-6 mb-3">
                  <label class="form-label">Course</label>
                  <select id="course_id" name="course_id" class="form-select @error('course_id') is-invalid @enderror" required readonly>
                    <option disabled selected>Choose Course</option>
                    @foreach($courses as $course)
                    <option value="{{ $course->id }}" @selected($course->id == (old('course_id') ?? auth()->user()->course_id))>
                      {{ $course->name }}
                    </option>
                    @endforeach
                  </select>
                  @error('course_id')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <!-- Sub Category Course -->
                <div class="col-md-6 mb-3">
                  <label class="form-label"> Sub Category Course</label>
                  <select id="sub_cat_course_id" name="sub_cat_course_id" class="form-select @error('sub_cat_course_id') is-invalid @enderror" required readonly>
                    <option disabled selected>Choose Sub Category Course</option>
                    @foreach($courseSubCategory ?? [] as $subCategory)
                    <option value="{{ $subCategory->id }}" @selected(old('sub_cat_course_id')==$subCategory->id)>
                      {{ $subCategory->name }}
                    </option>
                    @endforeach
                  </select>
                  @error('sub_cat_course_id')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <!-- No of Question -->
                <div class="col-md-6 mb-3">
                  <label class="form-label fw-bold">No of Question</label>
                  <input type="number" id="question_count" name="question_count" value="{{ old('question_count') }}" placeholder="Enter No of Question" class="form-control @error('question_count') is-invalid @enderror" min="1" required>
                  @error('question_count')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

              </div>

              <!-- Description -->
              <div class="mb-3">
                <label class="form-label fw-bold">Description</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="Enter test description..." required>{{ old('description') }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>

          <div id="questions_container"></div>

          <div class="text-center mb-4">
            <button type="submit" class="btn btn-success btn-lg px-5">
              <i class="fas fa-save me-2"></i>Create Test
            </button>
          </div>
        </form>
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
        {{--<div class="form-section mt-3">
          <h6 class="fw-bold mb-3">Test Statistics</h6>
          <div class="mb-3 p-3" style="background: var(--faculty-bg); border-radius: 10px;">
            <p class="mb-1 small"><strong>Total Tests:</strong> 8</p>
            <p class="mb-1 small"><strong>Active:</strong> 2</p>
            <p class="mb-0 small"><strong>Completed:</strong> 6</p>
          </div>
        </div>--}}
        <div class="row">
          <div class="col-md-12">

          </div>
        </div>

      </div>
    </div>
    <div class="form-section mt-4">
      <h5 class="form-section-title">
        <i class="fas fa-list me-2"></i>Your Tests
      </h5>
      <div class="faculty-table-container">
        <div class="table-responsive">
          <div class="table-responsive">
            <table class="table table-hover align-middle shadow-sm border">
              <thead class="table-light">
                <tr>
                  <th>Sr.No.</th>
                  <th>Test Title</th>
                  <th>Course & Category</th>
                  <th>Duration</th>
                  <th>Description</th>
                  <th>Created Date</th>
                  {{-- <th class="text-center">Action</th> --}}
                </tr>
              </thead>
              <tbody>
                @forelse($allTestRecords as $test)
                <tr>
                  <!-- Test ID -->
                  <td><span class="fw-bold">#{{ $test->id }}</span></td>

                  <!-- Title -->
                  <td>
                    <div class="fw-bold text-primary">{{ $test->title }}</div>
                  </td>

                  <!-- Course Info -->
                  <td>
                    <span class="badge bg-info text-dark">{{ getCourseNameById($test->course_id) }}</span>
                    <br>
                    <small class="text-muted">{{ getSubCatCourseNameById($test->sub_cat_course_id) }}</small>
                  </td>

                  <!-- Duration -->
                  <td>
                    <span class="badge bg-light text-dark border">
                      <i class="far fa-clock me-1 text-danger"></i> {{ $test->duration_minutes }} Min
                    </span>
                  </td>

                  <!-- Description -->
                  <td title="{{ $test->description }}">
                    {{ Str::limit($test->description, 40) }}
                  </td>

                  <!-- Created At -->
                  <td>
                    <div style="font-size: 0.85rem;">
                      {{ \Carbon\Carbon::parse($test->created_at)->format('d M, Y') }}<br>
                      <small class="text-muted">{{ \Carbon\Carbon::parse($test->created_at)->format('h:i A') }}</small>
                    </div>
                  </td>

                  {{--<td class="text-center">
                    
                    <div class="dropdown">
                        <button class="btn btn-sm btn-light border" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu" >
                            <li><a href="#" class="btn btn-sm btn-outline-primary" title="View Details"><i class="fas fa-eye"></i></a></li>
                            <li> <a href="#" class="btn btn-sm btn-outline-warning" title="Edit Test"><i class="fas fa-edit"></i></a></li>
                            <li> <button class="btn btn-sm btn-outline-danger" title="Delete Test"><i class="fas fa-trash"></i></button></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-envelope me-2"></i> Message</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-ban me-2"></i> Block</a></li>
                        </ul>
                    </div>
                  </td>--}}
                </tr>
                @empty
                <tr>
                  <td colspan="7" class="text-center py-5 text-muted">
                    <i class="fas fa-clipboard-list d-block mb-2 fa-3x"></i>
                    No tests created yet.
                  </td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection
  @section('scripts')

  <script>
    const questionInput = document.getElementById('question_count');
    const container = document.getElementById('questions_container');
    questionInput.addEventListener('input', function() {
      let count = parseInt(this.value) || 0;
      container.innerHTML = '';
      for (let i = 1; i <= count; i++) {
        let html = `
            <div class="card shadow-sm mb-4 border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Question ${i}</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            Question Text
                        </label>
                        <textarea
                            name="questions[${i}][text]"
                            class="form-control"
                            rows="3"
                            placeholder="Enter Question ${i}"
                            required></textarea>
                    </div>
                    <div class="row">
        `;
        for (let j = 1; j <= 4; j++) {
          html += `
                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        Option ${j}
                    </label>
                    <div class="input-group">
                        <div class="input-group-text">
                            <input
                                type="radio"
                                name="questions[${i}][correct]"
                                value="${j}"
                                required>
                        </div>
                        <input
                            type="text"
                            name="questions[${i}][options][${j}]"
                            class="form-control"
                            placeholder="Enter option ${j}"
                            required>
                    </div>
                </div>
            `;
        }

        html += `
                    </div>
                </div>
            </div>
        `;

        container.innerHTML += html;
      }

    });
  </script>
  @endsection