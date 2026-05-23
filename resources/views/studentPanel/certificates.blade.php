@extends('layouts.student')
@section('content')

<!-- Certificates Content -->
<div class="container py-4">

  <!-- Certificates Grid -->
  <div class="row" id="certificatesGrid">
    @forelse($certificates as $cert)
    <div class="col-md-6 col-lg-4 mb-4 certificate-card">
      <div class="card h-100 shadow-sm {{ $cert->type == 'achievement' ? 'border-warning' : '' }}">
        <div class="card-body text-center">
          <div class="certificate-icon mb-3">
            @php
            $icon = [
            'achievement' => ['bi-trophy', 'text-warning'],
            'course' => ['bi-mortarboard', 'text-info'],
            'exam' => ['bi-pencil-square', 'text-success'],
            'competition' => ['bi-star', 'text-primary']
            ][$cert->type] ?? ['bi-award', 'text-secondary'];
            @endphp
            <i class="bi {{ $icon[0] }} {{ $icon[1] }}" style="font-size: 3rem;"></i>
          </div>
          <h6 class="card-title">{{ $cert->title }}</h6>
          <p class="card-text small text-muted mb-2">{{ $cert->issue_month }} {{ $cert->issue_year }}</p>
          <div class="mb-3">
            <span class="badge {{ str_replace('text', 'bg', $icon[1]) }}">{{ ucfirst($cert->type) }}</span>
          </div>
          <p class="card-text small">{{ $cert->description }}</p>
          <div class="d-flex gap-2 justify-content-center">
            <button class="btn btn-outline-{{ str_replace('text-', '', $icon[1]) }} btn-sm"
              onclick="viewCertificate('{{ asset('storage/' . $cert->file_path) }}')">
              <i class="bi bi-eye"></i> View
            </button>
            <a href="{{ route('certificate.download', $cert->id) }}" class="btn btn-primary btn-sm">
              <i class="bi bi-download"></i> Download
            </a>
          </div>
        </div>
      </div>
    </div>
    @empty
    <div class="col-12">
      <p class="text-muted text-center">No certificates found.</p>
    </div>
    @endforelse
  </div>
  <div class="d-flex justify-content-end mt-3">
    {{ $certificates->withQueryString()->links('pagination::bootstrap-5') }}
  </div>
</div>

<!-- Certificate Preview Modal -->
<div class="modal fade" id="certificateModal" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Certificate Preview</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center">
        <div id="certificatePreview" class="certificate-preview">
          <!-- Certificate will be rendered here -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="downloadCurrentCertificate()">
          <i class="bi bi-download"></i> Download Certificate
        </button>
      </div>
    </div>
  </div>
</div>

<script>
  function viewCertificate(fileUrl) {
    const previewDiv = document.getElementById('certificatePreview');
    // Check if it's PDF or Image
    if (fileUrl.endsWith('.pdf')) {
      previewDiv.innerHTML = `<embed src="${fileUrl}" type="application/pdf" width="100%" height="500px" />`;
    } else {
      previewDiv.innerHTML = `<img src="${fileUrl}" class="img-fluid" />`;
    }

    // Show Modal
    var myModal = new bootstrap.Modal(document.getElementById('certificateModal'));
    myModal.show();
  }
</script>
@endsection