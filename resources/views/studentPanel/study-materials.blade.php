@extends('layouts.student')
@section('content')
<!-- Study Materials Content -->
<div class="container py-4">
  <!-- Search and Filters -->
  <div class="card shadow-sm mb-4">
    <div class="card-body">
      <form action="" method="get">
        <div class="row g-3">
          <div class="col-md-4">
            <input type="text" class="form-control" placeholder="Search materials..." id="searchInput" name="search">
          </div>
          <div class="col-md-2">
            <select class="form-select" id="subjectFilter" name="subject">
              <option value="">All Subjects</option>
              <option value="physics">Physics</option>
              <option value="chemistry">Chemistry</option>
              <option value="mathematics">Mathematics</option>
              <option value="biology">Biology</option>
            </select>
          </div>
          <div class="col-md-2">
            <select class="form-select" id="typeFilter" name="type">
              <option value="">All Types</option>
              <option value="pdf">PDF</option>
              <option value="ppt">PPT</option>
              <option value="notes">Notes</option>
              <option value="worksheet">Worksheet</option>
            </select>
          </div>
          <div class="col-md-2">
            <select class="form-select" id="classFilter" name="class">
              <option value="">All Classes</option>
              <option value="11">Class 11</option>
              <option value="12">Class 12</option>
              <option value="jee">JEE</option>
              <option value="neet">NEET</option>
            </select>
          </div>
          <div class="col-md-2">
            <a href="{{route('student.materials')}}" class="btn btn-warning w-100">
              <i class="bi bi-funnel"></i> Clear Filters
            </a>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Quick Stats -->
  <div class="row mb-4">
    <div class="col-md-3 mb-3">
      <div class="card shadow-sm text-center">
        <div class="card-body">
          <div class="text-primary mb-2" style="font-size: 2rem;"><i class="bi bi-file-earmark-pdf"></i></div>
          <h4 class="mb-1">{{$stats['pdf']}}</h4>
          <small class="text-muted">PDF Files</small>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card shadow-sm text-center">
        <div class="card-body">
          <div class="text-success mb-2" style="font-size: 2rem;"><i class="bi bi-file-earmark-ppt"></i></div>
          <h4 class="mb-1">{{$stats['ppt']}}</h4>
          <small class="text-muted">PPT Slides</small>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card shadow-sm text-center">
        <div class="card-body">
          <div class="text-warning mb-2" style="font-size: 2rem;"><i class="bi bi-journal-text"></i></div>
          <h4 class="mb-1">{{$stats['notes']}}</h4>
          <small class="text-muted">Notes</small>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card shadow-sm text-center">
        <div class="card-body">
          <div class="text-info mb-2" style="font-size: 2rem;"><i class="bi bi-clipboard-data"></i></div>
          <h4 class="mb-1">{{$stats['worksheet']}}</h4>
          <small class="text-muted">Worksheets</small>
        </div>
      </div>
    </div>
  </div>


  <!-- Study Materials Grid -->
  <div class="row" id="materialsGrid">
    <div class="row" id="materialsGrid">
      @foreach($materials as $item)
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body text-center">
            @php
            // Dynamic styling based on type
            $config = [
            'pdf' => ['icon' => 'bi-file-earmark-pdf', 'color' => 'text-primary', 'bg' => 'bg-primary'],
            'ppt' => ['icon' => 'bi-file-earmark-ppt', 'color' => 'text-success', 'bg' => 'bg-success'],
            'notes' => ['icon' => 'bi-journal-text', 'color' => 'text-warning', 'bg' => 'bg-warning'],
            'worksheet' => ['icon' => 'bi-clipboard-data', 'color' => 'text-info', 'bg' => 'bg-info'],
            ][$item->type] ?? ['icon' => 'bi-file-earmark', 'color' => 'text-secondary', 'bg' => 'bg-secondary'];
            @endphp

            <div class="{{ $config['color'] }} mb-3" style="font-size: 3rem;">
              <i class="bi {{ $config['icon'] }}"></i>
            </div>

            <h6 class="card-title">{{ ucwords($item->title) }}</h6>
            <p class="card-text small text-muted mb-2">{{ Str::limit($item->description, 50) }}</p>

            <div class="mb-3">
              <span class="badge {{ $config['bg'] }} me-1">{{ ucfirst($item->subject) }}</span>
              <span class="badge bg-secondary">{{ strtoupper($item->target_class) }}</span>
            </div>

            <div class="small text-muted mb-3">
              <i class="bi bi-calendar"></i> Updated: {{ $item->updated_at->format('M d, Y') }}<br>
              <i class="bi bi-file-earmark"></i> {{ $item->page_count ?? '1' }} pages • {{ $item->file_size }}
            </div>

            <a href="{{ asset('storage/' . $item['file_path']) }}" target="_blank" class="btn btn-warning btn-sm w-100">
              <i class="bi bi-download"></i> Download {{ strtoupper($item->type) }}
            </a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>

  <!-- Download History -->
  <div class="card shadow-sm mt-4">
    <div class="card-header bg-light">
      <h5 class="mb-0"><i class="bi bi-clock-history"></i> Recent Downloads</h5>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Material</th>
              <th>Type</th>
              <th>Subject</th>
              <th>Downloaded On</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="downloadHistory">
            @forelse($recentDownloads as $log)
            <tr>
              <td>{{ ucwords($log->material->title) ?? 'N/A' }}</td>
              <td>
                @php
                $type = $log->material?->type;

                $badgeClass = [
                'pdf' => 'bg-primary',
                'ppt' => 'bg-success',
                'notes' => 'bg-warning',
                'worksheet' => 'bg-info'
                ][$type] ?? 'bg-secondary';
                @endphp
                <span class="badge {{ $badgeClass }}">{{ strtoupper($log->material->type ?? 'FILE') }}</span>
              </td>
              <td>{{ ucfirst($log->material->subject ?? 'N/A') }}</td>
              <td>{{ $log->downloaded_at->format('M d, Y') }}</td>
              <td>
                @if($log->material)
                <a href="{{ asset('storage/' . $item['file_path']) }}" class="btn btn-outline-primary btn-sm">
                  <i class="bi bi-download"></i> Download Again
                </a>
                @endif
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="5" class="text-center text-muted">No recent downloads found.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script>
  function downloadAgain(materialId) {
    window.location.href = `/student/study-materials/download/${materialId}`;
  }
  $(document).ready(function() {
    function fetchMaterials() {
      let search = $('#searchInput').val();
      let subject = $('#subjectFilter').val();
      let type = $('#typeFilter').val();
      let classVal = $('#classFilter').val();

      $.ajax({
        url: "{{ route('student.materials') }}",
        type: "GET",
        data: {
          search: search,
          subject: subject,
          type: type,
          class: classVal
        },
        beforeSend: function() {
          $('#materialsGrid').html('<div class="col-12 text-center"><div class="spinner-border text-warning"></div></div>');
        },
        success: function(response) {
          // Agar aap partial use nahi kar rahe, toh response se grid nikaalein
          let newGrid = $(response).find('#materialsGrid').html();
          if (newGrid === undefined) {
            // Agar Controller se direct HTML aa raha hai
            $('#materialsGrid').html(response);
          } else {
            $('#materialsGrid').html(newGrid);
          }
        },
        error: function(err) {
          console.log("Filter Error:", err);
        }
      });
    }

    // Event listeners
    $('#subjectFilter, #typeFilter, #classFilter').on('change', fetchMaterials);
    $('#searchInput').on('keyup', function() {
      clearTimeout(this.interval);
      this.interval = setTimeout(fetchMaterials, 500);
    });
  });
</script>
@endsection