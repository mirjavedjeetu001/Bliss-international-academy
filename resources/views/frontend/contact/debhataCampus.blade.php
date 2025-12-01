@extends('master.frontend')

@section('title', 'Contact Us - Debhata Campus - Bliss International Academy')

@section('content')
<div class="contact-page">
    <div class="container">
        <!-- Page Header -->
        <div class="page-header text-center mb-5">
            <h2 class="section-header">Contact Us - Debhata Campus</h2>
            <p class="lead">We'd love to hear from you! Please reach out to us for any queries regarding admissions, academics, or general information.</p>
        </div>

        <div class="row">
            <!-- Contact Information -->
            <div class="col-lg-4 mb-4">
                <div class="contact-info-card">
                    <h3 class="section-header">Debhata Campus</h3>
                    
                    <div class="campus-info">
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <strong>Address:</strong><br>
                                Sekendra, Debhata, Satkhira
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <div>
                                <strong>Phone:</strong><br>
                                01926261818
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <strong>Email:</strong><br>
                                blimia bd@gmail.com<br>
                                info@blms.edu.bd
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-clock"></i>
                            <div>
                                <strong>Office Hours:</strong><br>
                                Sunday–Thursday, 8 AM – 2 PM
                            </div>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="quick-links mt-4">
                        <h4>Quick Links</h4>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('frontend.contact.satkhira') }}">Satkhira Campus</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-8">
                <div class="contact-form-card">
                    <h3 class="section-header">Send us a Message</h3>
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('frontend.contact.submit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="campus" value="debhata">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" name="phone" value="{{ old('phone') }}" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="subject" class="form-label">Subject <span class="text-danger">*</span></label>
                                <select class="form-select @error('subject') is-invalid @enderror" 
                                        id="subject" name="subject" required>
                                    <option value="">Select a subject</option>
                                    <option value="General Inquiry" {{ old('subject') == 'General Inquiry' ? 'selected' : '' }}>General Inquiry</option>
                                    <option value="Admission" {{ old('subject') == 'Admission' ? 'selected' : '' }}>Admission</option>
                                    <option value="Support" {{ old('subject') == 'Support' ? 'selected' : '' }}>Support</option>
                                    <option value="Other" {{ old('subject') == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('message') is-invalid @enderror" 
                                      id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Google Map Section -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="map-section">
                    <h3 class="section-header text-center mb-4">Find Debhata Campus on Map</h3>
                    <div class="map-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5297.699942730709!2d88.98392798327141!3d22.624011150407586!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39ff59dd420a0fa9%3A0x36da8beb5732a2ab!2sBliss%20International%20School!5e1!3m2!1sen!2sbd!4v1757317266785!5m2!1sen!2sbd" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.contact-page {
    padding: 60px 0;
    background-color: #f8f9fa;
}

.contact-info-card, .contact-form-card {
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    height: 100%;
}

.campus-info {
    border-bottom: 1px solid #eee;
    padding-bottom: 20px;
}

.campus-title {
    color: #2c3e50;
    font-size: 1.2rem;
    margin-bottom: 15px;
    font-weight: 600;
}

.contact-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 15px;
}

.contact-item i {
    color: #3498db;
    margin-right: 15px;
    margin-top: 5px;
    width: 20px;
}

.contact-item div {
    flex: 1;
}

.quick-links h4 {
    color: #2c3e50;
    font-size: 1.1rem;
    margin-bottom: 10px;
}

.quick-links ul li {
    margin-bottom: 5px;
}

.quick-links ul li a {
    color: #3498db;
    text-decoration: none;
}

.quick-links ul li a:hover {
    text-decoration: underline;
}

.form-label {
    font-weight: 600;
    color: #2c3e50;
}

.btn-primary {
    background-color: #3498db;
    border-color: #3498db;
    padding: 12px 40px;
    font-weight: 600;
}

.btn-primary:hover {
    background-color: #2980b9;
    border-color: #2980b9;
}

.map-section {
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.map-container {
    border-radius: 10px;
    overflow: hidden;
}

.alert {
    border-radius: 8px;
}

@media (max-width: 768px) {
    .contact-page {
        padding: 40px 0;
    }
    
    .contact-info-card, .contact-form-card {
        padding: 20px;
        margin-bottom: 20px;
    }
}
</style>
@endsection
