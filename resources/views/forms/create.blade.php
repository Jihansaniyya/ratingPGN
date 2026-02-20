@extends('layouts.app')

@section('title', 'Buat Form On Site Customer')

@section('content')
<div class="page-header">
    <h1 class="page-title">
        <i class="fas fa-plus-circle"></i>
        Form On Site Customer
    </h1>
    <a href="{{ route('forms.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i> Kembali
    </a>
</div>

<form action="{{ route('forms.store') }}" method="POST" id="onSiteForm" enctype="multipart/form-data">
    @csrf
    
    @if($errors->any())
        <div class="alert alert-danger mb-4">
            <h6><i class="fas fa-exclamation-triangle me-2"></i>Terdapat kesalahan pada form, mohon perbaiki:</h6>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <!-- Customer Detail Section -->
    <div class="form-section">
        <h4 class="form-section-title">
            <i class="fas fa-user me-2"></i> Customer Detail
        </h4>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Customer Name <span class="text-danger">*</span></label>
                <input type="text" name="customer_name" class="form-control @error('customer_name') is-invalid @enderror" 
                       value="{{ old('customer_name') }}" required>
                @error('customer_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Layanan / Service <span class="text-danger">*</span></label>
                <select name="layanan_service" class="form-select @error('layanan_service') is-invalid @enderror" required>
                    <option value="">-- Pilih Produk --</option>
                    <optgroup label="GASNET PRIMECODE PRODUCT">
                        <option value="DEDICATED INTERNATIONAL" {{ old('layanan_service') == 'DEDICATED INTERNATIONAL' ? 'selected' : '' }}>DEDICATED INTERNATIONAL</option>
                        <option value="DEDICATED LOCAL" {{ old('layanan_service') == 'DEDICATED LOCAL' ? 'selected' : '' }}>DEDICATED LOCAL</option>
                        <option value="DEDICATED MIX" {{ old('layanan_service') == 'DEDICATED MIX' ? 'selected' : '' }}>DEDICATED MIX</option>
                        <option value="INTERNET ON DEMAND" {{ old('layanan_service') == 'INTERNET ON DEMAND' ? 'selected' : '' }}>INTERNET ON DEMAND</option>
                    </optgroup>
                    <optgroup label="GASNET MAXX CODE PRODUCT">
                        <option value="GET MAXX 3" {{ old('layanan_service') == 'GET MAXX 3' ? 'selected' : '' }}>GET MAXX 3 (Broadband Ratio 1:8)</option>
                        <option value="GET MAXX 2" {{ old('layanan_service') == 'GET MAXX 2' ? 'selected' : '' }}>GET MAXX 2 (Broadband Ratio 1:4)</option>
                        <option value="GET MAXX 1" {{ old('layanan_service') == 'GET MAXX 1' ? 'selected' : '' }}>GET MAXX 1 (Broadband Ratio 1:2)</option>
                    </optgroup>
                    <optgroup label="GASNET SIMPLE CODE PRODUCT">
                        <option value="GASNET SIMPLE ON NETWORK" {{ old('layanan_service') == 'GASNET SIMPLE ON NETWORK' ? 'selected' : '' }}>GASNET SIMPLE ON NETWORK</option>
                        <option value="GASNET SIMPLE ON SECURITY" {{ old('layanan_service') == 'GASNET SIMPLE ON SECURITY' ? 'selected' : '' }}>GASNET SIMPLE ON SECURITY</option>
                    </optgroup>
                    <optgroup label="GASNET PLUS+ CODE PRODUCT">
                        <option value="MANAGED MAIL" {{ old('layanan_service') == 'MANAGED MAIL' ? 'selected' : '' }}>MANAGED MAIL</option>
                        <option value="HOSTING" {{ old('layanan_service') == 'HOSTING' ? 'selected' : '' }}>HOSTING</option>
                        <option value="DOMAIN" {{ old('layanan_service') == 'DOMAIN' ? 'selected' : '' }}>DOMAIN</option>
                        <option value="IP PUBLIC" {{ old('layanan_service') == 'IP PUBLIC' ? 'selected' : '' }}>IP PUBLIC</option>
                    </optgroup>
                    <optgroup label="Cloud Service">
                        <option value="HARDWARE" {{ old('layanan_service') == 'HARDWARE' ? 'selected' : '' }}>HARDWARE</option>
                        <option value="SOFTWARE" {{ old('layanan_service') == 'SOFTWARE' ? 'selected' : '' }}>SOFTWARE</option>
                        <option value="PROFESIONAL SERVICE" {{ old('layanan_service') == 'PROFESIONAL SERVICE' ? 'selected' : '' }}>PROFESIONAL SERVICE</option>
                    </optgroup>
                    <optgroup label="GASNET ONAIR CODE PRODUCT">
                        <option value="CO-LOCATION" {{ old('layanan_service') == 'CO-LOCATION' ? 'selected' : '' }}>CO-LOCATION</option>
                        <option value="VIRTUAL PRIVATE SERVER" {{ old('layanan_service') == 'VIRTUAL PRIVATE SERVER' ? 'selected' : '' }}>VIRTUAL PRIVATE SERVER</option>
                        <option value="PRIVATE LINK TO CLOUD" {{ old('layanan_service') == 'PRIVATE LINK TO CLOUD' ? 'selected' : '' }}>PRIVATE LINK TO CLOUD</option>
                    </optgroup>
                    <optgroup label="Synergy Product">
                        <option value="METRO ETHERNET" {{ old('layanan_service') == 'METRO ETHERNET' ? 'selected' : '' }}>METRO ETHERNET</option>
                        <option value="IP TRANSIT" {{ old('layanan_service') == 'IP TRANSIT' ? 'selected' : '' }}>IP TRANSIT</option>
                        <option value="PGAS IX" {{ old('layanan_service') == 'PGAS IX' ? 'selected' : '' }}>PGAS IX</option>
                        <option value="LOCAL IX" {{ old('layanan_service') == 'LOCAL IX' ? 'selected' : '' }}>LOCAL IX</option>
                        <option value="MIX (IPTR + PGAS IX + LOCAL IX)" {{ old('layanan_service') == 'MIX (IPTR + PGAS IX + LOCAL IX)' ? 'selected' : '' }}>MIX (IPTR + PGAS IX + LOCAL IX)</option>
                        <option value="GOOGLE CACHE" {{ old('layanan_service') == 'GOOGLE CACHE' ? 'selected' : '' }}>GOOGLE CACHE</option>
                        <option value="MANAGED VIDEO CONFERENCE" {{ old('layanan_service') == 'MANAGED VIDEO CONFERENCE' ? 'selected' : '' }}>MANAGED VIDEO CONFERENCE</option>
                    </optgroup>
                </select>
                @error('layanan_service')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">CID <span class="text-danger">*</span></label>
                <input type="text" name="cid" class="form-control @error('cid') is-invalid @enderror" 
                       value="{{ old('cid') }}" placeholder="Masukkan CID" required>
                @error('cid')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Address Section with Dropdowns -->
            <div class="col-12 mb-3">
                <label class="form-label fw-bold"><i class="fas fa-map-marker-alt me-1"></i> Alamat</label>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Provinsi <span class="text-danger">*</span></label>
                <select name="provinsi" id="provinsi" class="form-select @error('provinsi') is-invalid @enderror" required>
                    <option value="">-- Pilih Provinsi --</option>
                </select>
                @error('provinsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Kota / Kabupaten <span class="text-danger">*</span></label>
                <select name="kota_kabupaten" id="kota_kabupaten" class="form-select @error('kota_kabupaten') is-invalid @enderror" required disabled>
                    <option value="">-- Pilih Kota/Kabupaten --</option>
                </select>
                @error('kota_kabupaten')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
                <select name="kecamatan" id="kecamatan" class="form-select @error('kecamatan') is-invalid @enderror" required disabled>
                    <option value="">-- Pilih Kecamatan --</option>
                </select>
                @error('kecamatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Kelurahan <span class="text-danger">*</span></label>
                <select name="kelurahan" id="kelurahan" class="form-select @error('kelurahan') is-invalid @enderror" required disabled>
                    <option value="">-- Pilih Kelurahan --</option>
                </select>
                @error('kelurahan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-12 mb-3">
                <label class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                <textarea name="alamat_lengkap" class="form-control @error('alamat_lengkap') is-invalid @enderror" 
                          rows="2" placeholder="Nama jalan, nomor rumah, RT/RW, dll..." required>{{ old('alamat_lengkap') }}</textarea>
                @error('alamat_lengkap')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label">Kapasitas / Capacity <span class="text-danger">*</span></label>
                <input type="text" name="kapasitas_capacity" class="form-control @error('kapasitas_capacity') is-invalid @enderror" 
                       value="{{ old('kapasitas_capacity') }}" required>
                @error('kapasitas_capacity')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">No. Telp (PIC) <span class="text-danger">*</span></label>
                <input type="text" name="no_telp_pic" class="form-control @error('no_telp_pic') is-invalid @enderror" 
                       value="{{ old('no_telp_pic') }}" required>
                @error('no_telp_pic')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">E-mail <span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                       value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <!-- Maintenance Device Section -->
    <div class="form-section">
        <h4 class="form-section-title">
            <i class="fas fa-tools me-2"></i> Maintenance Device <span class="text-danger">*</span>
        </h4>
        <div id="devices-container">
            @if(old('devices'))
                @foreach(old('devices') as $i => $device)
                <div class="device-row mb-3 p-3 border rounded bg-light">
                    <div class="row">
                        <div class="col-md-5 mb-2">
                            <label class="form-label">Device Name <span class="text-danger">*</span></label>
                            <input type="text" name="devices[{{ $i }}][device_name]" class="form-control" placeholder="Masukkan nama device" value="{{ $device['device_name'] ?? '' }}" required>
                        </div>
                        <div class="col-md-5 mb-2">
                            <label class="form-label">Serial Number <span class="text-danger">*</span></label>
                            <input type="text" name="devices[{{ $i }}][serial_number]" class="form-control" placeholder="Masukkan serial number" value="{{ $device['serial_number'] ?? '' }}" required>
                        </div>
                        <div class="col-md-2 mb-2 d-flex align-items-end">
                            <button type="button" class="btn btn-danger btn-remove-device w-100" onclick="removeDevice(this)" {{ $loop->count == 1 ? 'disabled' : '' }}>
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label"><i class="fas fa-box me-1"></i> Foto Produk <span class="text-danger">*</span></label>
                            <input type="file" name="devices[{{ $i }}][product_photo]" class="form-control" accept="image/jpeg,image/png,image/jpg" required>
                            <small class="text-muted">Format: JPG, PNG. Maks: 2MB</small>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label"><i class="fas fa-sticky-note me-1"></i> Keterangan <span class="text-danger">*</span></label>
                            <textarea name="devices[{{ $i }}][keterangan]" class="form-control" rows="2" placeholder="Masukkan keterangan device..." required>{{ $device['keterangan'] ?? '' }}</textarea>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
            <div class="device-row mb-3 p-3 border rounded bg-light">
                <div class="row">
                    <div class="col-md-5 mb-2">
                        <label class="form-label">Device Name <span class="text-danger">*</span></label>
                        <input type="text" name="devices[0][device_name]" class="form-control" placeholder="Masukkan nama device" required>
                    </div>
                    <div class="col-md-5 mb-2">
                        <label class="form-label">Serial Number <span class="text-danger">*</span></label>
                        <input type="text" name="devices[0][serial_number]" class="form-control" placeholder="Masukkan serial number" required>
                    </div>
                    <div class="col-md-2 mb-2 d-flex align-items-end">
                        <button type="button" class="btn btn-danger btn-remove-device w-100" onclick="removeDevice(this)" disabled>
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label"><i class="fas fa-box me-1"></i> Foto Produk <span class="text-danger">*</span></label>
                        <input type="file" name="devices[0][product_photo]" class="form-control" accept="image/jpeg,image/png,image/jpg" required>
                        <small class="text-muted">Format: JPG, PNG. Maks: 2MB</small>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label"><i class="fas fa-sticky-note me-1"></i> Keterangan <span class="text-danger">*</span></label>
                        <textarea name="devices[0][keterangan]" class="form-control" rows="2" placeholder="Masukkan keterangan device..." required></textarea>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <button type="button" class="btn btn-outline-primary mt-2" onclick="addDevice()">
            <i class="fas fa-plus me-2"></i> Tambah Device
        </button>
    </div>

    <!-- Technical Detail Section -->
    <div class="form-section">
        <h4 class="form-section-title">
            <i class="fas fa-cogs me-2"></i> Technical Detail
        </h4>
        
        <div class="mb-4">
            <label class="form-label fw-bold">Activity <span class="text-danger">*</span></label>
            <small class="text-muted d-block mb-2">Pilih minimal satu aktivitas</small>
            <div class="row" id="activity-group">
                <div class="col-md-4 mb-2">
                    <div class="form-check">
                        <input class="form-check-input activity-checkbox" type="checkbox" name="activity_survey" value="1" id="survey" {{ old('activity_survey') ? 'checked' : '' }}>
                        <label class="form-check-label" for="survey">Survey</label>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="form-check">
                        <input class="form-check-input activity-checkbox" type="checkbox" name="activity_activation" value="1" id="activation" {{ old('activity_activation') ? 'checked' : '' }}>
                        <label class="form-check-label" for="activation">Activation</label>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="form-check">
                        <input class="form-check-input activity-checkbox" type="checkbox" name="activity_upgrade" value="1" id="upgrade" {{ old('activity_upgrade') ? 'checked' : '' }}>
                        <label class="form-check-label" for="upgrade">Upgrade</label>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="form-check">
                        <input class="form-check-input activity-checkbox" type="checkbox" name="activity_downgrade" value="1" id="downgrade" {{ old('activity_downgrade') ? 'checked' : '' }}>
                        <label class="form-check-label" for="downgrade">Downgrade</label>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="form-check">
                        <input class="form-check-input activity-checkbox" type="checkbox" name="activity_troubleshoot" value="1" id="troubleshoot" {{ old('activity_troubleshoot') ? 'checked' : '' }}>
                        <label class="form-check-label" for="troubleshoot">Troubleshoot</label>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="form-check">
                        <input class="form-check-input activity-checkbox" type="checkbox" name="activity_preventive_maintenance" value="1" id="preventive" {{ old('activity_preventive_maintenance') ? 'checked' : '' }}>
                        <label class="form-check-label" for="preventive">Preventive Maintenance</label>
                    </div>
                </div>
            </div>
            <div id="activity-error" class="text-danger small mt-1" style="display: none;">Pilih minimal satu aktivitas</div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Complaint <span class="text-danger">*</span></label>
            <textarea name="complaint" class="form-control @error('complaint') is-invalid @enderror" rows="3" placeholder="Masukkan keluhan customer..." required>{{ old('complaint') }}</textarea>
            @error('complaint')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Action <span class="text-danger">*</span></label>
            <textarea name="action" class="form-control @error('action') is-invalid @enderror" rows="3" placeholder="Masukkan tindakan yang dilakukan..." required>{{ old('action') }}</textarea>
            @error('action')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Assessment Section -->
    <div class="form-section">
        <h4 class="form-section-title">
            <i class="fas fa-star me-2"></i> Assessment
        </h4>
        <div class="row justify-content-center">
            <div class="col-md-4 mb-3">
                <label class="assessment-option tidak-puas w-100 {{ old('assessment') == 'tidak_puas' ? 'selected' : '' }}" onclick="selectAssessment(this, 'tidak_puas')">
                    <input type="radio" name="assessment" value="tidak_puas" required {{ old('assessment') == 'tidak_puas' ? 'checked' : '' }}>
                    <i class="fas fa-frown d-block"></i>
                    <span class="fw-bold">Tidak Puas</span>
                </label>
            </div>
            <div class="col-md-4 mb-3">
                <label class="assessment-option puas w-100 {{ old('assessment') == 'puas' ? 'selected' : '' }}" onclick="selectAssessment(this, 'puas')">
                    <input type="radio" name="assessment" value="puas" {{ old('assessment') == 'puas' ? 'checked' : '' }}>
                    <i class="fas fa-meh d-block"></i>
                    <span class="fw-bold">Puas</span>
                </label>
            </div>
            <div class="col-md-4 mb-3">
                <label class="assessment-option sangat-puas w-100 {{ old('assessment') == 'sangat_puas' ? 'selected' : '' }}" onclick="selectAssessment(this, 'sangat_puas')">
                    <input type="radio" name="assessment" value="sangat_puas" {{ old('assessment') == 'sangat_puas' ? 'checked' : '' }}>
                    <i class="fas fa-smile-beam d-block"></i>
                    <span class="fw-bold">Sangat Puas</span>
                </label>
            </div>
        </div>
        @error('assessment')
            <div class="text-danger text-center">{{ $message }}</div>
        @enderror
    </div>

    <!-- Signature Section -->
    <div class="form-section">
        <h4 class="form-section-title">
            <i class="fas fa-signature me-2"></i> Tanda Tangan <span class="text-danger">*</span>
        </h4>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Lokasi <span class="text-danger">*</span></label>
                <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location') }}" placeholder="Contoh: Jakarta" required>
                @error('location')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Tanggal <span class="text-danger">*</span></label>
                <input type="date" name="form_date" class="form-control @error('form_date') is-invalid @enderror" value="{{ old('form_date', date('Y-m-d')) }}" required>
                @error('form_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row align-items-stretch">
            <div class="col-md-6 mb-3 d-flex">
                <div class="card w-100 @error('signature_first_party') border-danger @enderror">
                    <div class="card-header bg-primary text-white text-center">
                        Pihak Pertama <span class="text-warning">*</span><br>
                        <strong>PT TELEMEDIA DINAMIKA SARANA</strong>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <div class="mb-2">
                            <input type="text" name="first_party_name" class="form-control @error('first_party_name') is-invalid @enderror" placeholder="Nama Pihak Pertama *" value="{{ old('first_party_name') }}" required>
                            @error('first_party_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="signature-pad flex-grow-1" id="signaturePad1">
                            <canvas id="canvas1"></canvas>
                        </div>
                        <input type="hidden" name="signature_first_party" id="signature_first_party" required>
                        @error('signature_first_party')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                        <button type="button" class="btn btn-sm btn-outline-secondary mt-2" onclick="clearSignature(1)">
                            <i class="fas fa-eraser me-1"></i> Hapus
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3 d-flex">
                <div class="card w-100 @error('signature_second_party') border-danger @enderror">
                    <div class="card-header bg-secondary text-white text-center">
                        Pihak Kedua <span class="text-warning">*</span><br>
                        <strong>&nbsp;</strong>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <div class="mb-2">
                            <input type="text" name="second_party_name" class="form-control @error('second_party_name') is-invalid @enderror" placeholder="Nama Pihak Kedua *" value="{{ old('second_party_name') }}" required>
                            @error('second_party_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="signature-pad flex-grow-1" id="signaturePad2">
                            <canvas id="canvas2"></canvas>
                        </div>
                        <input type="hidden" name="signature_second_party" id="signature_second_party" required>
                        @error('signature_second_party')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                        <button type="button" class="btn btn-sm btn-outline-secondary mt-2" onclick="clearSignature(2)">
                            <i class="fas fa-eraser me-1"></i> Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="form-section text-center">
        <button type="submit" class="btn btn-primary btn-lg px-5">
            <i class="fas fa-save me-2"></i> Simpan Form
        </button>
        <a href="{{ route('forms.index') }}" class="btn btn-secondary btn-lg px-5 ms-2">
            <i class="fas fa-times me-2"></i> Batal
        </a>
    </div>
</form>
@endsection

@push('styles')
<style>
    .signature-pad canvas {
        border: 1px solid #e3e6f0;
        border-radius: 5px;
        cursor: crosshair;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script>
    let deviceIndex = {{ old('devices') ? count(old('devices')) : 1 }};
    let signaturePad1, signaturePad2;
    let _formSubmitted = false;

    // API Base URL for Indonesia regions
    const API_BASE = 'https://www.emsifa.com/api-wilayah-indonesia/api';

    // Old values for re-populating after validation error
    let oldProvinsi = @json(old('provinsi', ''));
    let oldKota = @json(old('kota_kabupaten', ''));
    let oldKecamatan = @json(old('kecamatan', ''));
    let oldKelurahan = @json(old('kelurahan', ''));

    // Initialize signature pads and load provinces
    document.addEventListener('DOMContentLoaded', function() {
        const canvas1 = document.getElementById('canvas1');
        const canvas2 = document.getElementById('canvas2');
        
        // Set canvas dimensions
        canvas1.width = canvas1.parentElement.offsetWidth - 4;
        canvas1.height = 150;
        canvas2.width = canvas2.parentElement.offsetWidth - 4;
        canvas2.height = 150;

        signaturePad1 = new SignaturePad(canvas1, {
            backgroundColor: 'rgb(255, 255, 255)',
            penColor: 'rgb(0, 0, 0)'
        });
        
        signaturePad2 = new SignaturePad(canvas2, {
            backgroundColor: 'rgb(255, 255, 255)',
            penColor: 'rgb(0, 0, 0)'
        });

        // Save signature data on form submit
        document.getElementById('onSiteForm').addEventListener('submit', function() {
            if (!signaturePad1.isEmpty()) {
                document.getElementById('signature_first_party').value = signaturePad1.toDataURL();
            }
            if (!signaturePad2.isEmpty()) {
                document.getElementById('signature_second_party').value = signaturePad2.toDataURL();
            }
        });

        // Restore draft if available (auto-save on refresh)
        restoreDraft(signaturePad1, signaturePad2);

        // Auto-save on signature strokes
        signaturePad1.addEventListener('endStroke', function() { saveDraft(); });
        signaturePad2.addEventListener('endStroke', function() { saveDraft(); });

        // Load provinces
        loadProvinces();
    });

    // Load Provinces
    async function loadProvinces() {
        try {
            const response = await fetch(`${API_BASE}/provinces.json`);
            const provinces = await response.json();
            const select = document.getElementById('provinsi');
            select.innerHTML = '<option value="">-- Pilih Provinsi --</option>';
            provinces.forEach(prov => {
                const selected = (oldProvinsi && prov.name === oldProvinsi) ? 'selected' : '';
                select.innerHTML += `<option value="${prov.name}" data-id="${prov.id}" ${selected}>${prov.name}</option>`;
            });
            // If old province exists, trigger loading cities
            if (oldProvinsi) {
                select.dispatchEvent(new Event('change'));
            }
        } catch (error) {
            console.error('Error loading provinces:', error);
        }
    }

    // Load Cities/Regencies
    document.getElementById('provinsi').addEventListener('change', async function() {
        const selectedOption = this.options[this.selectedIndex];
        const provId = selectedOption.dataset.id;
        const kotaSelect = document.getElementById('kota_kabupaten');
        const kecSelect = document.getElementById('kecamatan');
        const kelSelect = document.getElementById('kelurahan');

        // Reset dependent dropdowns
        kotaSelect.innerHTML = '<option value="">-- Pilih Kota/Kabupaten --</option>';
        kotaSelect.disabled = true;
        kecSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
        kecSelect.disabled = true;
        kelSelect.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';
        kelSelect.disabled = true;

        // Reset lokasi field when province changes (only if not re-populating)
        if (!oldKota) {
            document.querySelector('input[name="location"]').value = '';
        }

        if (provId) {
            try {
                const response = await fetch(`${API_BASE}/regencies/${provId}.json`);
                const cities = await response.json();
                cities.forEach(city => {
                    const selected = (oldKota && city.name === oldKota) ? 'selected' : '';
                    kotaSelect.innerHTML += `<option value="${city.name}" data-id="${city.id}" ${selected}>${city.name}</option>`;
                });
                kotaSelect.disabled = false;
                // If old city exists, trigger loading districts
                if (oldKota) {
                    kotaSelect.dispatchEvent(new Event('change'));
                }
            } catch (error) {
                console.error('Error loading cities:', error);
            }
        }
    });

    // Load Districts
    document.getElementById('kota_kabupaten').addEventListener('change', async function() {
        const selectedOption = this.options[this.selectedIndex];
        const cityId = selectedOption.dataset.id;
        const cityName = selectedOption.value;
        const kecSelect = document.getElementById('kecamatan');
        const kelSelect = document.getElementById('kelurahan');

        // Reset dependent dropdowns
        kecSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
        kecSelect.disabled = true;
        kelSelect.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';
        kelSelect.disabled = true;

        // Auto-fill lokasi berdasarkan kota yang dipilih (only if not re-populating)
        const locationInput = document.querySelector('input[name="location"]');
        if (!oldKota || locationInput.value === '') {
            if (cityName) {
                let cleanCityName = cityName.replace(/^(KOTA |KABUPATEN |KAB\. )/i, '');
                locationInput.value = cleanCityName;
            } else {
                locationInput.value = '';
            }
        }

        if (cityId) {
            try {
                const response = await fetch(`${API_BASE}/districts/${cityId}.json`);
                const districts = await response.json();
                districts.forEach(dist => {
                    const selected = (oldKecamatan && dist.name === oldKecamatan) ? 'selected' : '';
                    kecSelect.innerHTML += `<option value="${dist.name}" data-id="${dist.id}" ${selected}>${dist.name}</option>`;
                });
                kecSelect.disabled = false;
                // If old district exists, trigger loading villages
                if (oldKecamatan) {
                    kecSelect.dispatchEvent(new Event('change'));
                }
            } catch (error) {
                console.error('Error loading districts:', error);
            }
        }
    });

    // Load Villages
    document.getElementById('kecamatan').addEventListener('change', async function() {
        const selectedOption = this.options[this.selectedIndex];
        const distId = selectedOption.dataset.id;
        const kelSelect = document.getElementById('kelurahan');

        // Reset dependent dropdown
        kelSelect.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';
        kelSelect.disabled = true;

        if (distId) {
            try {
                const response = await fetch(`${API_BASE}/villages/${distId}.json`);
                const villages = await response.json();
                villages.forEach(vil => {
                    const selected = (oldKelurahan && vil.name === oldKelurahan) ? 'selected' : '';
                    kelSelect.innerHTML += `<option value="${vil.name}" ${selected}>${vil.name}</option>`;
                });
                kelSelect.disabled = false;
            } catch (error) {
                console.error('Error loading villages:', error);
            }
        }
    });

    function clearSignature(padNumber) {
        if (padNumber === 1) {
            signaturePad1.clear();
        } else {
            signaturePad2.clear();
        }
    }

    function addDevice() {
        const container = document.getElementById('devices-container');
        const html = `
            <div class="device-row mb-3 p-3 border rounded bg-light">
                <div class="row">
                    <div class="col-md-5 mb-2">
                        <label class="form-label">Device Name <span class="text-danger">*</span></label>
                        <input type="text" name="devices[${deviceIndex}][device_name]" class="form-control" placeholder="Masukkan nama device" required>
                    </div>
                    <div class="col-md-5 mb-2">
                        <label class="form-label">Serial Number <span class="text-danger">*</span></label>
                        <input type="text" name="devices[${deviceIndex}][serial_number]" class="form-control" placeholder="Masukkan serial number" required>
                    </div>
                    <div class="col-md-2 mb-2 d-flex align-items-end">
                        <button type="button" class="btn btn-danger btn-remove-device w-100" onclick="removeDevice(this)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label"><i class="fas fa-box me-1"></i> Foto Produk <span class="text-danger">*</span></label>
                        <input type="file" name="devices[${deviceIndex}][product_photo]" class="form-control" accept="image/jpeg,image/png,image/jpg" required>
                        <small class="text-muted">Format: JPG, PNG. Maks: 2MB</small>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label"><i class="fas fa-sticky-note me-1"></i> Keterangan <span class="text-danger">*</span></label>
                        <textarea name="devices[${deviceIndex}][keterangan]" class="form-control" rows="2" placeholder="Masukkan keterangan device..." required></textarea>
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        deviceIndex++;
        updateRemoveButtons();
    }

    function removeDevice(btn) {
        btn.closest('.device-row').remove();
        updateRemoveButtons();
    }

    function updateRemoveButtons() {
        const rows = document.querySelectorAll('.device-row');
        rows.forEach((row, index) => {
            const btn = row.querySelector('.btn-remove-device');
            btn.disabled = rows.length === 1;
        });
    }

    function selectAssessment(element, value) {
        document.querySelectorAll('.assessment-option').forEach(opt => {
            opt.classList.remove('selected');
        });
        element.classList.add('selected');
        element.querySelector('input').checked = true;
    }

    // Form validation before submit
    document.getElementById('onSiteForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = this;

        // Validate at least one activity is checked
        const activityCheckboxes = document.querySelectorAll('.activity-checkbox');
        const isAnyActivityChecked = Array.from(activityCheckboxes).some(cb => cb.checked);
        
        if (!isAnyActivityChecked) {
            document.getElementById('activity-error').style.display = 'block';
            document.getElementById('activity-group').scrollIntoView({ behavior: 'smooth', block: 'center' });
            return false;
        } else {
            document.getElementById('activity-error').style.display = 'none';
        }

        // Validate signatures
        if (signaturePad1.isEmpty()) {
            Swal.fire({
                icon: 'warning',
                title: 'Tanda Tangan Kosong',
                text: 'Tanda tangan Pihak Pertama wajib diisi!',
                confirmButtonColor: '#2c5282',
            });
            document.getElementById('signaturePad1').scrollIntoView({ behavior: 'smooth', block: 'center' });
            return false;
        }
        
        if (signaturePad2.isEmpty()) {
            Swal.fire({
                icon: 'warning',
                title: 'Tanda Tangan Kosong',
                text: 'Tanda tangan Pihak Kedua wajib diisi!',
                confirmButtonColor: '#2c5282',
            });
            document.getElementById('signaturePad2').scrollIntoView({ behavior: 'smooth', block: 'center' });
            return false;
        }

        // Save signature data
        document.getElementById('signature_first_party').value = signaturePad1.toDataURL();
        document.getElementById('signature_second_party').value = signaturePad2.toDataURL();

        // Confirmation alert
        Swal.fire({
            title: 'Kirim Form?',
            text: 'Apakah Anda yakin ingin mengirim form ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#2c5282',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fas fa-check me-1"></i> Ya, Kirim!',
            cancelButtonText: 'Batal',
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                _formSubmitted = true;
                clearTimeout(_draftTimer);
                localStorage.removeItem('formDraft_create');
                form.submit();
            }
        });
    });

    // Hide activity error when any checkbox is checked
    document.querySelectorAll('.activity-checkbox').forEach(cb => {
        cb.addEventListener('change', function() {
            const isAnyChecked = Array.from(document.querySelectorAll('.activity-checkbox')).some(c => c.checked);
            document.getElementById('activity-error').style.display = isAnyChecked ? 'none' : 'block';
        });
    });

    // === Auto-Save Draft Functions ===
    const DRAFT_KEY = 'formDraft_create';

    function saveDraft() {
        if (_formSubmitted) return;
        try {
            const draft = { _timestamp: Date.now() };

            // Text inputs, textareas, selects
            document.querySelectorAll('#onSiteForm input[type="text"], #onSiteForm input[type="email"], #onSiteForm input[type="date"], #onSiteForm textarea, #onSiteForm select').forEach(el => {
                if (el.name && el.type !== 'hidden' && el.type !== 'file') {
                    draft[el.name] = el.value;
                }
            });

            // Activity checkboxes
            document.querySelectorAll('.activity-checkbox').forEach(el => {
                if (el.name) draft[el.name] = el.checked;
            });

            // Assessment radio
            const assessment = document.querySelector('[name="assessment"]:checked');
            if (assessment) draft.assessment = assessment.value;

            // Devices
            draft.devices = [];
            document.querySelectorAll('.device-row').forEach(row => {
                draft.devices.push({
                    device_name: row.querySelector('[name*="[device_name]"]')?.value || '',
                    serial_number: row.querySelector('[name*="[serial_number]"]')?.value || '',
                    keterangan: row.querySelector('[name*="[keterangan]"]')?.value || ''
                });
            });

            // Signatures (save separately to avoid quota issues)
            try {
                if (typeof signaturePad1 !== 'undefined' && !signaturePad1.isEmpty()) {
                    draft.signature1 = signaturePad1.toDataURL();
                }
                if (typeof signaturePad2 !== 'undefined' && !signaturePad2.isEmpty()) {
                    draft.signature2 = signaturePad2.toDataURL();
                }
            } catch(sigErr) {
                console.warn('Could not save signatures to draft:', sigErr);
            }

            localStorage.setItem(DRAFT_KEY, JSON.stringify(draft));
        } catch (e) {
            console.error('Error saving draft:', e);
        }
    }

    function restoreDraft(pad1, pad2) {
        const data = localStorage.getItem(DRAFT_KEY);
        if (!data) return;

        // Only restore on page refresh, NOT on fresh navigation
        const navEntries = performance.getEntriesByType('navigation');
        const isReload = navEntries.length > 0 && navEntries[0].type === 'reload';
        const hasOldValues = !!@json(old('_token'));

        // Restore only if page was refreshed or has validation errors (old values)
        if (!isReload && !hasOldValues) {
            // Fresh navigation (e.g. clicked "Buat Form" from menu) - clear draft
            localStorage.removeItem(DRAFT_KEY);
            return;
        }

        try {
            const draft = JSON.parse(data);

            // Check if draft is too old (older than 24 hours)
            if (draft._timestamp && (Date.now() - draft._timestamp > 24 * 60 * 60 * 1000)) {
                localStorage.removeItem(DRAFT_KEY);
                return;
            }

            let hasData = false;

            // Text inputs & textareas
            ['customer_name', 'cid', 'alamat_lengkap', 'kapasitas_capacity',
             'no_telp_pic', 'email', 'location', 'form_date',
             'first_party_name', 'second_party_name', 'complaint', 'action'].forEach(name => {
                if (draft[name] !== undefined && draft[name] !== '') {
                    const el = document.querySelector(`[name="${name}"]`);
                    if (el) {
                        el.value = draft[name];
                        hasData = true;
                    }
                }
            });

            // Layanan service select
            if (draft.layanan_service) {
                const el = document.querySelector('[name="layanan_service"]');
                if (el) {
                    el.value = draft.layanan_service;
                    hasData = true;
                }
            }

            // Address: override old* variables for cascade loading
            if (draft.provinsi && !oldProvinsi) { oldProvinsi = draft.provinsi; hasData = true; }
            if (draft.kota_kabupaten && !oldKota) { oldKota = draft.kota_kabupaten; }
            if (draft.kecamatan && !oldKecamatan) { oldKecamatan = draft.kecamatan; }
            if (draft.kelurahan && !oldKelurahan) { oldKelurahan = draft.kelurahan; }

            // Activity checkboxes
            ['activity_survey', 'activity_activation', 'activity_upgrade',
             'activity_downgrade', 'activity_troubleshoot', 'activity_preventive_maintenance'].forEach(name => {
                if (draft[name] !== undefined) {
                    const el = document.querySelector(`[name="${name}"]`);
                    if (el) {
                        el.checked = draft[name];
                        if (draft[name]) hasData = true;
                    }
                }
            });

            // Assessment
            if (draft.assessment) {
                document.querySelectorAll('.assessment-option').forEach(opt => opt.classList.remove('selected'));
                const el = document.querySelector(`[name="assessment"][value="${draft.assessment}"]`);
                if (el) {
                    el.checked = true;
                    hasData = true;
                    const label = el.closest('.assessment-option');
                    if (label) label.classList.add('selected');
                }
            }

            // Devices
            if (draft.devices && draft.devices.length > 0) {
                let existingRows = document.querySelectorAll('.device-row');
                for (let i = existingRows.length; i < draft.devices.length; i++) {
                    addDevice();
                }
                const rows = document.querySelectorAll('.device-row');
                draft.devices.forEach((device, i) => {
                    if (rows[i]) {
                        const dn = rows[i].querySelector('[name*="[device_name]"]');
                        const sn = rows[i].querySelector('[name*="[serial_number]"]');
                        const kt = rows[i].querySelector('[name*="[keterangan]"]');
                        if (dn) { dn.value = device.device_name; if (device.device_name) hasData = true; }
                        if (sn) sn.value = device.serial_number;
                        if (kt) kt.value = device.keterangan;
                    }
                });
            }

            // Signatures
            if (draft.signature1 && pad1) {
                const img1 = new Image();
                img1.onload = function() {
                    pad1.canvas.getContext('2d').drawImage(img1, 0, 0, pad1.canvas.width, pad1.canvas.height);
                    pad1._isEmpty = false;
                };
                img1.src = draft.signature1;
                hasData = true;
            }
            if (draft.signature2 && pad2) {
                const img2 = new Image();
                img2.onload = function() {
                    pad2.canvas.getContext('2d').drawImage(img2, 0, 0, pad2.canvas.width, pad2.canvas.height);
                    pad2._isEmpty = false;
                };
                img2.src = draft.signature2;
            }

            // Show notification only if we actually restored data
            if (hasData && typeof Swal !== 'undefined') {
                Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true,
                }).fire({ icon: 'info', title: 'Draft berhasil dipulihkan' });
            }
        } catch (e) {
            console.error('Error restoring draft:', e);
        }
    }

    // Auto-save: on input, change, and right before page unload
    let _draftTimer;
    function debouncedSaveDraft() {
        clearTimeout(_draftTimer);
        _draftTimer = setTimeout(saveDraft, 300);
    }

    document.getElementById('onSiteForm').addEventListener('input', debouncedSaveDraft);
    document.getElementById('onSiteForm').addEventListener('change', debouncedSaveDraft);

    // Force-save draft immediately when leaving/refreshing page (but not after submit)
    window.addEventListener('beforeunload', function() {
        if (_formSubmitted) {
            // Double-ensure draft is removed after submit
            localStorage.removeItem('formDraft_create');
        } else {
            saveDraft();
        }
    });

    // Also save on visibility change (switching tabs)
    document.addEventListener('visibilitychange', function() {
        if (document.visibilityState === 'hidden' && !_formSubmitted) {
            saveDraft();
        }
    });
</script>
@endpush
