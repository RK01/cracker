@extends('layouts.app')
@section('content')

<section class="page-hero text-white text-center py-5">
  <div class="container py-4">
    <span class="badge bg-warning text-dark mb-3">Get In Touch</span>
    <h1 class="display-4 fw-bold">Contact Us</h1>
    <p class="lead opacity-75">We're here to help — reach out anytime</p>
  </div>
</section>

<!-- Contact -->
<section id="contact" class="py-5 bg-white">
  <div class="container py-4">
    <div class="section-title">
      <h2>Get in <span class="accent">Touch</span></h2>
      <div class="line"></div>
    </div>
    <div class="row g-5">
      <div class="col-md-6">
        <div class="mb-4">
          <div class="d-flex gap-3 mb-4">
            <div class="rounded-3 d-flex align-items-center justify-content-center bg-primary bg-opacity-10 contact-box"><i class="bi bi-geo-alt-fill text-white"></i></div>
            <div>
              <h6 class="fw-semibold mb-0">Address</h6><small class="text-muted">123 Education Lane, Knowledge City,
                India — 110001</small>
            </div>
          </div>
          <div class="d-flex gap-3 mb-4">
            <div class="rounded-3 d-flex align-items-center justify-content-center bg-primary bg-opacity-10 contact-box"><i class="bi bi-telephone-fill text-white"></i></div>
            <div>
              <h6 class="fw-semibold mb-0">Phone</h6><small class="text-muted">+91 12345 67890 / +91 98765 43210</small>
            </div>
          </div>
          <div class="d-flex gap-3 mb-4">
            <div class="rounded-3 d-flex align-items-center justify-content-center bg-primary bg-opacity-10 contact-box"><i class="bi bi-envelope-fill text-white"></i></div>
            <div>
              <h6 class="fw-semibold mb-0">Email</h6><small class="text-muted">info@excellenceacademy.edu.in</small>
            </div>
          </div>
          <div class="d-flex gap-3 mb-4">
            <div class="rounded-3 d-flex align-items-center justify-content-center bg-primary bg-opacity-10 contact-box"><i class="bi bi-clock-fill text-white"></i></div>
            <div>
              <h6 class="fw-semibold mb-0">Office Hours</h6><small class="text-muted">Mon–Sat: 8:00 AM – 7:00 PM</small>
            </div>
          </div>
        </div>
        <div class="rounded-3 overflow-hidden border videos-tag">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3504.5!2d77.2!3d28.6!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjjCsDM2JzAwLjAiTiA3N8KwMTInMDAuMCJF!5e0!3m2!1sen!2sin!4v1" width="100%" height="100%" style="border:0" allowfullscreen="" loading="lazy"></iframe>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card border rounded-4 p-4">
          <h5 class="fw-bold mb-3">Send us a Message</h5>
          <form onsubmit="submitContact(event)">
            <div class="mb-3"><label class="form-label fw-medium small">Name</label><input type="text" class="form-control rounded-3 py-2" placeholder="Your name" required=""></div>
            <div class="mb-3"><label class="form-label fw-medium small">Email</label><input type="email" class="form-control rounded-3 py-2" placeholder="your@email.com" required=""></div>
            <div class="mb-3"><label class="form-label fw-medium small">Message</label><textarea class="form-control rounded-3 py-2" rows="5" placeholder="How can we help you?" required=""></textarea>
            </div>
            <button type="submit" class="btn btn-gold w-100 py-3 fs-5"><i class="bi bi-send me-2"></i>Send
              Message</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection