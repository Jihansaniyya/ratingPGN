@extends('layouts.app')

@section('title', 'Edit Form On Site Customer')

@section('content')
<div class="page-header">
    <h1 class="page-title">
        <i class="fas fa-edit"></i>
        Edit Form On Site Customer
    </h1>
    <a href="{{ route('forms.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i> Kembali
    </a>
</div>

<form action="{{ route('forms.update', $form) }}" method="POST" id="onSiteForm">
    @csrf
    @method('PUT')
    
    <!-- Customer Detail Section -->
    <div class="form-section">
        <h4 class="form-section-title">
            <i class="fas fa-user me-2"></i> Customer Detail
        </h4>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Customer Name <span class="text-danger">*</span></label>
                <input type="text" name="customer_name" class="form-control @error('customer_name') is-invalid @enderror" 
                       value="{{ old('customer_name', $form->customer->customer_name) }}" required>
                @error('customer_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Layanan / Service <span class="text-danger">*</span></label>
                <input type="text" name="layanan_service" class="form-control @error('layanan_service') is-invalid @enderror" 
                       value="{{ old('layanan_service', $form->customer->layanan_service) }}" required>
                @error('layanan_service')
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
                    <option value="{{ $form->customer->provinsi }}" selected>{{ $form->customer->provinsi }}</option>
                </select>
                @error('provinsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Kota / Kabupaten <span class="text-danger">*</span></label>
                <select name="kota_kabupaten" id="kota_kabupaten" class="form-select @error('kota_kabupaten') is-invalid @enderror" required>
                    <option value="">-- Pilih Kota/Kabupaten --</option>
                    <option value="{{ $form->customer->kota_kabupaten }}" selected>{{ $form->customer->kota_kabupaten }}</option>
                </select>
                @error('kota_kabupaten')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
                <select name="kecamatan" id="kecamatan" class="form-select @error('kecamatan') is-invalid @enderror" required>
                    <option value="">-- Pilih Kecamatan --</option>
                    <option value="{{ $form->customer->kecamatan }}" selected>{{ $form->customer->kecamatan }}</option>
                </select>
                @error('kecamatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Kelurahan <span class="text-danger">*</span></label>
                <select name="kelurahan" id="kelurahan" class="form-select @error('kelurahan') is-invalid @enderror" required>
                    <option value="">-- Pilih Kelurahan --</option>
                    <option value="{{ $form->customer->kelurahan }}" selected>{{ $form->customer->kelurahan }}</option>
                </select>
                @error('kelurahan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-12 mb-3">
                <label class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                <textarea name="alamat_lengkap" class="form-control @error('alamat_lengkap') is-invalid @enderror" 
                          rows="2" placeholder="Nama jalan, nomor rumah, RT/RW, dll..." required>{{ old('alamat_lengkap', $form->customer->alamat_lengkap) }}</textarea>
                @error('alamat_lengkap')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label">Kapasitas / Capacity <span class="text-danger">*</span></label>
                <input type="text" name="kapasitas_capacity" class="form-control @error('kapasitas_capacity') is-invalid @enderror" 
                       value="{{ old('kapasitas_capacity', $form->customer->kapasitas_capacity) }}" required>
                @error('kapasitas_capacity')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">No. Telp (PIC) <span class="text-danger">*</span></label>
                <input type="text" name="no_telp_pic" class="form-control @error('no_telp_pic') is-invalid @enderror" 
                       value="{{ old('no_telp_pic', $form->customer->no_telp_pic) }}" required>
                @error('no_telp_pic')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">E-mail <span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                       value="{{ old('email', $form->customer->email) }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <!-- Maintenance Device Section -->
    <div class="form-section">
        <h4 class="form-section-title">
            <i class="fas fa-tools me-2"></i> Maintenance Device
        </h4>
        <div id="devices-container">
            @forelse($form->maintenanceDevices as $index => $device)
            <div class="row device-row mb-2">
                <div class="col-md-5">
                    <input type="text" name="devices[{{ $index }}][device_name]" class="form-control" 
                           placeholder="Device Name" value="{{ $device->device_name }}">
                </div>
                <div class="col-md-5">
                    <input type="text" name="devices[{{ $index }}][serial_number]" class="form-control" 
                           placeholder="Serial Number" value="{{ $device->serial_number }}">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger btn-remove-device" onclick="removeDevice(this)">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
            @empty
            <div class="row device-row mb-2">
                <div class="col-md-5">
                    <input type="text" name="devices[0][device_name]" class="form-control" placeholder="Device Name">
                </div>
                <div class="col-md-5">
                    <input type="text" name="devices[0][serial_number]" class="form-control" placeholder="Serial Number">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger btn-remove-device" onclick="removeDevice(this)" disabled>
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
            @endforelse
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
            <label class="form-label fw-bold">Activity</label>
            <div class="row">
                <div class="col-md-4 mb-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="activity_survey" value="1" id="survey"
                               {{ $form->activity_survey ? 'checked' : '' }}>
                        <label class="form-check-label" for="survey">Survey</label>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="activity_activation" value="1" id="activation"
                               {{ $form->activity_activation ? 'checked' : '' }}>
                        <label class="form-check-label" for="activation">Activation</label>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="activity_upgrade" value="1" id="upgrade"
                               {{ $form->activity_upgrade ? 'checked' : '' }}>
                        <label class="form-check-label" for="upgrade">Upgrade</label>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="activity_downgrade" value="1" id="downgrade"
                               {{ $form->activity_downgrade ? 'checked' : '' }}>
                        <label class="form-check-label" for="downgrade">Downgrade</label>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="activity_troubleshoot" value="1" id="troubleshoot"
                               {{ $form->activity_troubleshoot ? 'checked' : '' }}>
                        <label class="form-check-label" for="troubleshoot">Troubleshoot</label>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="activity_preventive_maintenance" value="1" id="preventive"
                               {{ $form->activity_preventive_maintenance ? 'checked' : '' }}>
                        <label class="form-check-label" for="preventive">Preventive Maintenance</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Complaint</label>
            <textarea name="complaint" class="form-control" rows="3" 
                      placeholder="Masukkan keluhan customer...">{{ old('complaint', $form->complaint) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Action</label>
            <textarea name="action" class="form-control" rows="3" 
                      placeholder="Masukkan tindakan yang dilakukan...">{{ old('action', $form->action) }}</textarea>
        </div>
    </div>

    <!-- Assessment Section -->
    <div class="form-section">
        <h4 class="form-section-title">
            <i class="fas fa-star me-2"></i> Assessment
        </h4>
        <div class="row justify-content-center">
            <div class="col-md-4 mb-3">
                <label class="assessment-option tidak-puas w-100 {{ $form->assessment == 'tidak_puas' ? 'selected' : '' }}" 
                       onclick="selectAssessment(this, 'tidak_puas')">
                    <input type="radio" name="assessment" value="tidak_puas" required
                           {{ $form->assessment == 'tidak_puas' ? 'checked' : '' }}>
                    <i class="fas fa-frown d-block"></i>
                    <span class="fw-bold">Tidak Puas</span>
                </label>
            </div>
            <div class="col-md-4 mb-3">
                <label class="assessment-option puas w-100 {{ $form->assessment == 'puas' ? 'selected' : '' }}" 
                       onclick="selectAssessment(this, 'puas')">
                    <input type="radio" name="assessment" value="puas"
                           {{ $form->assessment == 'puas' ? 'checked' : '' }}>
                    <i class="fas fa-meh d-block"></i>
                    <span class="fw-bold">Puas</span>
                </label>
            </div>
            <div class="col-md-4 mb-3">
                <label class="assessment-option sangat-puas w-100 {{ $form->assessment == 'sangat_puas' ? 'selected' : '' }}" 
                       onclick="selectAssessment(this, 'sangat_puas')">
                    <input type="radio" name="assessment" value="sangat_puas"
                           {{ $form->assessment == 'sangat_puas' ? 'checked' : '' }}>
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
            <i class="fas fa-signature me-2"></i> Tanda Tangan
        </h4>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Lokasi</label>
                <input type="text" name="location" class="form-control" 
                       value="{{ old('location', $form->location) }}" placeholder="Contoh: Jakarta">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Tanggal</label>
                <input type="date" name="form_date" class="form-control" 
                       value="{{ old('form_date', $form->form_date ? $form->form_date->format('Y-m-d') : '') }}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        Pihak Pertama<br>
                        <strong>PT TELEMEDIA DINAMIKA SARANA</strong>
                    </div>
                    <div class="card-body text-center">
                        @if($form->signature_first_party)
                            <img src="{{ $form->signature_first_party }}" alt="Signature" class="img-fluid" style="max-height: 150px;">
                        @else
                            <p class="text-muted">Tidak ada tanda tangan</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-header bg-secondary text-white text-center">
                        Pihak Kedua
                    </div>
                    <div class="card-body">
                        <div class="mb-2">
                            <input type="text" name="second_party_name" class="form-control" 
                                   placeholder="Nama Pihak Kedua" value="{{ old('second_party_name', $form->second_party_name) }}">
                        </div>
                        @if($form->signature_second_party)
                            <div class="text-center">
                                <img src="{{ $form->signature_second_party }}" alt="Signature" class="img-fluid" style="max-height: 150px;">
                            </div>
                        @else
                            <p class="text-muted text-center">Tidak ada tanda tangan</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="form-section text-center">
        <button type="submit" class="btn btn-primary btn-lg px-5">
            <i class="fas fa-save me-2"></i> Update Form
        </button>
        <a href="{{ route('forms.show', $form) }}" class="btn btn-secondary btn-lg px-5 ms-2">
            <i class="fas fa-times me-2"></i> Batal
        </a>
    </div>
</form>
@endsection

@push('scripts')
<script>
    let deviceIndex = {{ $form->maintenanceDevices->count() ?: 1 }};
    
    // API Base URL for Indonesia regions
    const API_BASE = 'https://www.emsifa.com/api-wilayah-indonesia/api';

    // Store current values for pre-selection
    const currentProvinsi = "{{ $form->customer->provinsi }}";
    const currentKota = "{{ $form->customer->kota_kabupaten }}";
    const currentKecamatan = "{{ $form->customer->kecamatan }}";
    const currentKelurahan = "{{ $form->customer->kelurahan }}";

    // Load provinces on page load
    document.addEventListener('DOMContentLoaded', function() {
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
                const selected = prov.name === currentProvinsi ? 'selected' : '';
                select.innerHTML += `<option value="${prov.name}" data-id="${prov.id}" ${selected}>${prov.name}</option>`;
            });
            // Trigger change to load cities if province is pre-selected
            if (currentProvinsi) {
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
        kecSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
        kelSelect.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';

        if (provId) {
            try {
                const response = await fetch(`${API_BASE}/regencies/${provId}.json`);
                const cities = await response.json();
                cities.forEach(city => {
                    const selected = city.name === currentKota ? 'selected' : '';
                    kotaSelect.innerHTML += `<option value="${city.name}" data-id="${city.id}" ${selected}>${city.name}</option>`;
                });
                // Trigger change to load districts if city is pre-selected
                if (currentKota) {
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
        const kecSelect = document.getElementById('kecamatan');
        const kelSelect = document.getElementById('kelurahan');

        // Reset dependent dropdowns
        kecSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
        kelSelect.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';

        if (cityId) {
            try {
                const response = await fetch(`${API_BASE}/districts/${cityId}.json`);
                const districts = await response.json();
                districts.forEach(dist => {
                    const selected = dist.name === currentKecamatan ? 'selected' : '';
                    kecSelect.innerHTML += `<option value="${dist.name}" data-id="${dist.id}" ${selected}>${dist.name}</option>`;
                });
                // Trigger change to load villages if district is pre-selected
                if (currentKecamatan) {
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

        if (distId) {
            try {
                const response = await fetch(`${API_BASE}/villages/${distId}.json`);
                const villages = await response.json();
                villages.forEach(vil => {
                    const selected = vil.name === currentKelurahan ? 'selected' : '';
                    kelSelect.innerHTML += `<option value="${vil.name}" ${selected}>${vil.name}</option>`;
                });
            } catch (error) {
                console.error('Error loading villages:', error);
            }
        }
    });

    function addDevice() {
        const container = document.getElementById('devices-container');
        const html = `
            <div class="row device-row mb-2">
                <div class="col-md-5">
                    <input type="text" name="devices[${deviceIndex}][device_name]" class="form-control" placeholder="Device Name">
                </div>
                <div class="col-md-5">
                    <input type="text" name="devices[${deviceIndex}][serial_number]" class="form-control" placeholder="Serial Number">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger btn-remove-device" onclick="removeDevice(this)">
                        <i class="fas fa-trash"></i>
                    </button>
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

    // Initialize remove buttons state
    updateRemoveButtons();
</script>
@endpush
