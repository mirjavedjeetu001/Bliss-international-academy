@extends('master.backend-clean')

@section('title', 'Edit Site Settings')

@section('content')
<div class="container mt-4">
    <h2>Edit Site Settings</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('admin.site-settings.update', $setting->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="logo" class="form-label">Logo</label>
            <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
            @if($setting->logo_path)
                <img src="{{ asset('storage/' . $setting->logo_path) }}" alt="Current Logo" style="max-width: 100px; margin-top: 10px;">
            @endif
        </div>

        <h4>Social Media Links</h4>
        <div class="mb-3">
            <label for="facebook_url" class="form-label">Facebook URL</label>
            <input type="url" class="form-control" id="facebook_url" name="facebook_url" value="{{ $setting->facebook_url }}">
        </div>
        <div class="mb-3">
            <label for="twitter_url" class="form-label">Twitter URL</label>
            <input type="url" class="form-control" id="twitter_url" name="twitter_url" value="{{ $setting->twitter_url }}">
        </div>
        <div class="mb-3">
            <label for="instagram_url" class="form-label">Instagram URL</label>
            <input type="url" class="form-control" id="instagram_url" name="instagram_url" value="{{ $setting->instagram_url }}">
        </div>
        <div class="mb-3">
            <label for="linkedin_url" class="form-label">LinkedIn URL</label>
            <input type="url" class="form-control" id="linkedin_url" name="linkedin_url" value="{{ $setting->linkedin_url }}">
        </div>
        <div class="mb-3">
            <label for="youtube_url" class="form-label">YouTube URL</label>
            <input type="url" class="form-control" id="youtube_url" name="youtube_url" value="{{ $setting->youtube_url }}">
        </div>

        <h4>Contact Information</h4>
        <div class="mb-3">
            <label for="contact_email" class="form-label">Contact Email</label>
            <input type="email" class="form-control" id="contact_email" name="contact_email" value="{{ $setting->contact_email }}">
        </div>
        <div class="mb-3">
            <label for="contact_phone" class="form-label">Contact Phone</label>
            <input type="text" class="form-control" id="contact_phone" name="contact_phone" value="{{ $setting->contact_phone }}">
        </div>
        <div class="mb-3">
            <label for="contact_address" class="form-label">Contact Address</label>
            <textarea class="form-control" id="contact_address" name="contact_address" rows="3">{{ $setting->contact_address }}</textarea>
        </div>

        <h4>Footer</h4>
        <div class="mb-3">
            <label for="footer_text" class="form-label">Footer Text</label>
            <textarea class="form-control" id="footer_text" name="footer_text" rows="3">{{ $setting->footer_text }}</textarea>
        </div>
        <div class="mb-3">
            <label for="footer_copyright" class="form-label">Footer Copyright</label>
            <input type="text" class="form-control" id="footer_copyright" name="footer_copyright" value="{{ $setting->footer_copyright }}">
        </div>
        <div class="mb-3">
            <label for="footer_registration_number" class="form-label">Footer Registration Number</label>
            <input type="text" class="form-control" id="footer_registration_number" name="footer_registration_number" value="{{ $setting->footer_registration_number }}" placeholder="Cambridge Registration Number BD000">
        </div>

        <h4>Footer Section Titles</h4>
        <div class="mb-3">
            <label for="footer_important_links_title" class="form-label">Important Links Title</label>
            <input type="text" class="form-control" id="footer_important_links_title" name="footer_important_links_title" value="{{ $setting->footer_important_links_title }}" placeholder="Important Links">
        </div>
        <div class="mb-3">
            <label for="footer_useful_links_title" class="form-label">Useful Links Title</label>
            <input type="text" class="form-control" id="footer_useful_links_title" name="footer_useful_links_title" value="{{ $setting->footer_useful_links_title }}" placeholder="Useful Links">
        </div>
        <div class="mb-3">
            <label for="footer_satkhira_campus_title" class="form-label">Satkhira Campus Title</label>
            <input type="text" class="form-control" id="footer_satkhira_campus_title" name="footer_satkhira_campus_title" value="{{ $setting->footer_satkhira_campus_title }}" placeholder="Satkhira Campus">
        </div>
        <div class="mb-3">
            <label for="footer_debhata_campus_title" class="form-label">Debhata Campus Title</label>
            <input type="text" class="form-control" id="footer_debhata_campus_title" name="footer_debhata_campus_title" value="{{ $setting->footer_debhata_campus_title }}" placeholder="Debhata Campus">
        </div>
        <div class="mb-3">
            <label for="footer_important_links" class="form-label">Footer Important Links (JSON format)</label>
            <textarea class="form-control" id="footer_important_links" name="footer_important_links" rows="5" placeholder='[{"title": "Link Title", "url": "https://example.com"}]'>{{ $setting->footer_important_links }}</textarea>
            <small class="form-text text-muted">Enter links in JSON format for important links section</small>
        </div>
        <div class="mb-3">
            <label for="footer_useful_links" class="form-label">Footer Useful Links (JSON format)</label>
            <textarea class="form-control" id="footer_useful_links" name="footer_useful_links" rows="5" placeholder='[{"title": "Link Title", "url": "/page/123"}]'>{{ $setting->footer_useful_links }}</textarea>
            <small class="form-text text-muted">Enter links in JSON format for useful links section</small>
        </div>
        <div class="mb-3">
            <label for="footer_satkhira_info" class="form-label">Satkhira Campus Info (JSON format)</label>
            <textarea class="form-control" id="footer_satkhira_info" name="footer_satkhira_info" rows="5" placeholder='{"emis": "20807041", "code": "480675", "address": "Kharibila, Bypass Road, Satkhira Sadar, Satkhira-9400", "phone": "01919888316", "email": "info@bliss.edu.bd"}'>{{ $setting->footer_satkhira_info }}</textarea>
            <small class="form-text text-muted">Enter campus information in JSON format</small>
        </div>
        <div class="mb-3">
            <label for="footer_debhata_info" class="form-label">Debhata Campus Info (JSON format)</label>
            <textarea class="form-control" id="footer_debhata_info" name="footer_debhata_info" rows="5" placeholder='{"emis": "208050212", "code": "463289", "address": "Sekendra, Debhata, Satkhira", "phone": "01926261818", "email": "blimia bd@gmail.com"}'>{{ $setting->footer_debhata_info }}</textarea>
            <small class="form-text text-muted">Enter campus information in JSON format</small>
        </div>

        <button type="submit" class="btn btn-primary">Update Settings</button>
    </form>
</div>
@endsection