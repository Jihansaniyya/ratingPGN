<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\OnSiteForm;
use App\Models\MaintenanceDevice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OnSiteFormController extends Controller
{
    /**
     * Display a listing of the forms.
     */
    public function index(Request $request)
    {
        $query = OnSiteForm::with(['customer', 'user', 'maintenanceDevices']);
        
        // Filter by assessment
        if ($request->has('filter') && $request->filter) {
            $query->where('assessment', $request->filter);
        }
        
        // Filter by date range
        if ($request->filled('start_date')) {
            $query->whereDate('form_date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('form_date', '<=', $request->end_date);
        }
        
        // Search by customer name
        if ($request->has('search') && $request->search) {
            $query->whereHas('customer', function($q) use ($request) {
                $q->where('customer_name', 'like', '%' . $request->search . '%');
            });
        }
        
        $forms = $query->orderBy('created_at', 'desc')->paginate(10);

        // Calculate statistics for the chart
        $statsQuery = OnSiteForm::query();
        
        // Apply same filters to stats
        if ($request->has('filter') && $request->filter) {
            $statsQuery->where('assessment', $request->filter);
        }
        if ($request->filled('start_date')) {
            $statsQuery->whereDate('form_date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $statsQuery->whereDate('form_date', '<=', $request->end_date);
        }
        if ($request->has('search') && $request->search) {
            $statsQuery->whereHas('customer', function($q) use ($request) {
                $q->where('customer_name', 'like', '%' . $request->search . '%');
            });
        }
        
        $stats = [
            'total' => $statsQuery->count(),
            'sangat_puas' => (clone $statsQuery)->where('assessment', 'sangat_puas')->count(),
            'puas' => (clone $statsQuery)->where('assessment', 'puas')->count(),
            'tidak_puas' => (clone $statsQuery)->where('assessment', 'tidak_puas')->count(),
        ];

        return view('forms.index', compact('forms', 'stats'));
    }

    /**
     * Show the form for creating a new on-site form.
     */
    public function create()
    {
        $customers = Customer::all();
        return view('forms.create', compact('customers'));
    }

    /**
     * Store a newly created form in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // Customer data
            'cid' => 'required|string|max:255',
            'customer_name' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kota_kabupaten' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
            'alamat_lengkap' => 'required|string',
            'layanan_service' => 'required|string|max:255',
            'kapasitas_capacity' => 'required|string|max:255',
            'no_telp_pic' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            
            // Maintenance devices
            'devices' => 'nullable|array',
            'devices.*.device_name' => 'required_with:devices|string|max:255',
            'devices.*.serial_number' => 'required_with:devices|string|max:255',
            'devices.*.product_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'devices.*.keterangan' => 'nullable|string',
            
            // Activities
            'activity_survey' => 'nullable|boolean',
            'activity_activation' => 'nullable|boolean',
            'activity_upgrade' => 'nullable|boolean',
            'activity_downgrade' => 'nullable|boolean',
            'activity_troubleshoot' => 'nullable|boolean',
            'activity_preventive_maintenance' => 'nullable|boolean',
            
            // Technical details
            'complaint' => 'required|string',
            'action' => 'required|string',
            'assessment' => 'required|in:tidak_puas,puas,sangat_puas',
            
            // Signatures (required - must be base64 data URI)
            'signature_first_party' => ['required', 'string', 'regex:/^data:image\/png;base64,/'],
            'signature_second_party' => ['required', 'string', 'regex:/^data:image\/png;base64,/'],
            'first_party_name' => 'required|string|max:255',
            'second_party_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'form_date' => 'required|date',
        ], [
            // Customer data
            'cid.required' => 'CID wajib diisi.',
            'customer_name.required' => 'Nama pelanggan wajib diisi.',
            'provinsi.required' => 'Provinsi wajib dipilih.',
            'kota_kabupaten.required' => 'Kota/Kabupaten wajib dipilih.',
            'kecamatan.required' => 'Kecamatan wajib dipilih.',
            'kelurahan.required' => 'Kelurahan wajib dipilih.',
            'alamat_lengkap.required' => 'Alamat lengkap wajib diisi.',
            'layanan_service.required' => 'Layanan/Service wajib dipilih.',
            'kapasitas_capacity.required' => 'Kapasitas wajib diisi.',
            'no_telp_pic.required' => 'No. Telepon PIC wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid. Contoh: nama@email.com',
            
            // Maintenance devices
            'devices.*.device_name.required_with' => 'Nama device wajib diisi untuk setiap device.',
            'devices.*.serial_number.required_with' => 'Serial number wajib diisi untuk setiap device.',
            'devices.*.product_photo.image' => 'File foto produk harus berupa gambar.',
            'devices.*.product_photo.mimes' => 'Foto produk harus berformat JPG atau PNG.',
            'devices.*.product_photo.max' => 'Ukuran foto produk maksimal 2MB.',
            
            // Complaint & Action
            'complaint.required' => 'Complaint wajib diisi.',
            'action.required' => 'Action wajib diisi.',
            
            // Assessment
            'assessment.required' => 'Penilaian (Assessment) wajib dipilih.',
            'assessment.in' => 'Penilaian harus salah satu dari: Tidak Puas, Puas, atau Sangat Puas.',
            
            // Signatures
            'signature_first_party.required' => 'Tanda tangan Pihak Pertama wajib diisi.',
            'signature_first_party.regex' => 'Format tanda tangan Pihak Pertama tidak valid.',
            'signature_second_party.required' => 'Tanda tangan Pihak Kedua wajib diisi.',
            'signature_second_party.regex' => 'Format tanda tangan Pihak Kedua tidak valid.',
            'first_party_name.required' => 'Nama Pihak Pertama wajib diisi.',
            'second_party_name.required' => 'Nama Pihak Kedua wajib diisi.',
            'location.required' => 'Lokasi wajib diisi.',
            'form_date.required' => 'Tanggal wajib diisi.',
            'form_date.date' => 'Format tanggal tidak valid.',
        ]);

        DB::beginTransaction();

        try {
            // Create or update customer
            $customer = Customer::updateOrCreate(
                ['cid' => $validated['cid']],
                [
                    'customer_name' => $validated['customer_name'],
                    'provinsi' => $validated['provinsi'],
                    'kota_kabupaten' => $validated['kota_kabupaten'],
                    'kecamatan' => $validated['kecamatan'],
                    'kelurahan' => $validated['kelurahan'],
                    'alamat_lengkap' => $validated['alamat_lengkap'],
                    'layanan_service' => $validated['layanan_service'],
                    'kapasitas_capacity' => $validated['kapasitas_capacity'],
                    'no_telp_pic' => $validated['no_telp_pic'],
                    'email' => $validated['email'],
                ]
            );

            // Create the on-site form
            $form = OnSiteForm::create([
                'customer_cid' => $customer->cid,
                'user_id' => auth()->id(), // If using authentication
                'activity_survey' => $request->boolean('activity_survey'),
                'activity_activation' => $request->boolean('activity_activation'),
                'activity_upgrade' => $request->boolean('activity_upgrade'),
                'activity_downgrade' => $request->boolean('activity_downgrade'),
                'activity_troubleshoot' => $request->boolean('activity_troubleshoot'),
                'activity_preventive_maintenance' => $request->boolean('activity_preventive_maintenance'),
                'complaint' => $validated['complaint'] ?? null,
                'action' => $validated['action'] ?? null,
                'assessment' => $validated['assessment'],
                'signature_first_party' => $validated['signature_first_party'] ?? null,
                'signature_second_party' => $validated['signature_second_party'] ?? null,
                'first_party_name' => $validated['first_party_name'] ?? null,
                'second_party_name' => $validated['second_party_name'] ?? null,
                'location' => $validated['location'] ?? null,
                'form_date' => $validated['form_date'] ?? now(),
            ]);

            // Create maintenance devices
            if (!empty($validated['devices'])) {
                foreach ($validated['devices'] as $index => $device) {
                    if (!empty($device['device_name']) && !empty($device['serial_number'])) {
                        $productPhotoPath = null;
                        
                        // Handle product photo upload
                        if ($request->hasFile("devices.{$index}.product_photo")) {
                            $productPhotoPath = $request->file("devices.{$index}.product_photo")->store('device-photos', 'public');
                        }
                        
                        MaintenanceDevice::create([
                            'on_site_form_id' => $form->id,
                            'device_name' => $device['device_name'],
                            'serial_number' => $device['serial_number'],
                            'product_photo' => $productPhotoPath,
                            'keterangan' => $device['keterangan'] ?? null,
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()->route('forms.show', $form)
                ->with('success', 'Form On Site Customer berhasil disimpan!');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Gagal menyimpan form: ' . $e->getMessage());
            return back()->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified form.
     */
    public function show(OnSiteForm $form)
    {
        $form->load(['customer', 'user', 'maintenanceDevices']);
        return view('forms.show', compact('form'));
    }

    /**
     * Show the form for editing.
     */
    public function edit(OnSiteForm $form)
    {
        // Hanya dapat mengedit form milik sendiri
        if ($form->user_id !== auth()->id()) {
            return redirect()->route('forms.index')
                ->with('error', 'Anda hanya dapat mengedit form yang Anda buat sendiri.');
        }
        
        $form->load(['customer', 'maintenanceDevices']);
        return view('forms.edit', compact('form'));
    }

    /**
     * Update the specified form in storage.
     */
    public function update(Request $request, OnSiteForm $form)
    {
        // Hanya dapat mengedit form milik sendiri
        if ($form->user_id !== auth()->id()) {
            return redirect()->route('forms.index')
                ->with('error', 'Anda hanya dapat mengedit form yang Anda buat sendiri.');
        }
        
        $validated = $request->validate([
            'cid' => 'required|string|max:255',
            'customer_name' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kota_kabupaten' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
            'alamat_lengkap' => 'required|string',
            'layanan_service' => 'required|string|max:255',
            'kapasitas_capacity' => 'required|string|max:255',
            'no_telp_pic' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'devices' => 'nullable|array',
            'devices.*.device_name' => 'required_with:devices|string|max:255',
            'devices.*.serial_number' => 'required_with:devices|string|max:255',
            'devices.*.product_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'devices.*.existing_product_photo' => 'nullable|string|regex:/^device-photos\\//',
            'devices.*.keterangan' => 'nullable|string',
            'complaint' => 'required|string',
            'action' => 'required|string',
            'assessment' => 'required|in:tidak_puas,puas,sangat_puas',
            'signature_first_party' => ['required', 'string', 'regex:/^data:image\\/png;base64,/'],
            'signature_second_party' => ['required', 'string', 'regex:/^data:image\\/png;base64,/'],
            'first_party_name' => 'required|string|max:255',
            'second_party_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'form_date' => 'required|date',
        ], [
            // Customer data
            'cid.required' => 'CID wajib diisi.',
            'customer_name.required' => 'Nama pelanggan wajib diisi.',
            'provinsi.required' => 'Provinsi wajib dipilih.',
            'kota_kabupaten.required' => 'Kota/Kabupaten wajib dipilih.',
            'kecamatan.required' => 'Kecamatan wajib dipilih.',
            'kelurahan.required' => 'Kelurahan wajib dipilih.',
            'alamat_lengkap.required' => 'Alamat lengkap wajib diisi.',
            'layanan_service.required' => 'Layanan/Service wajib dipilih.',
            'kapasitas_capacity.required' => 'Kapasitas wajib diisi.',
            'no_telp_pic.required' => 'No. Telepon PIC wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid. Contoh: nama@email.com',
            
            // Maintenance devices
            'devices.*.device_name.required_with' => 'Nama device wajib diisi untuk setiap device.',
            'devices.*.serial_number.required_with' => 'Serial number wajib diisi untuk setiap device.',
            'devices.*.product_photo.image' => 'File foto produk harus berupa gambar.',
            'devices.*.product_photo.mimes' => 'Foto produk harus berformat JPG atau PNG.',
            'devices.*.product_photo.max' => 'Ukuran foto produk maksimal 2MB.',
            
            // Complaint & Action
            'complaint.required' => 'Complaint wajib diisi.',
            'action.required' => 'Action wajib diisi.',
            
            // Assessment
            'assessment.required' => 'Penilaian (Assessment) wajib dipilih.',
            'assessment.in' => 'Penilaian harus salah satu dari: Tidak Puas, Puas, atau Sangat Puas.',
            
            // Signatures
            'signature_first_party.required' => 'Tanda tangan Pihak Pertama wajib diisi.',
            'signature_first_party.regex' => 'Format tanda tangan Pihak Pertama tidak valid.',
            'signature_second_party.required' => 'Tanda tangan Pihak Kedua wajib diisi.',
            'signature_second_party.regex' => 'Format tanda tangan Pihak Kedua tidak valid.',
            'first_party_name.required' => 'Nama Pihak Pertama wajib diisi.',
            'second_party_name.required' => 'Nama Pihak Kedua wajib diisi.',
            'location.required' => 'Lokasi wajib diisi.',
            'form_date.required' => 'Tanggal wajib diisi.',
            'form_date.date' => 'Format tanggal tidak valid.',
        ]);

        DB::beginTransaction();

        try {
            // Update customer
            $form->customer->update([
                'cid' => $validated['cid'],
                'customer_name' => $validated['customer_name'],
                'provinsi' => $validated['provinsi'],
                'kota_kabupaten' => $validated['kota_kabupaten'],
                'kecamatan' => $validated['kecamatan'],
                'kelurahan' => $validated['kelurahan'],
                'alamat_lengkap' => $validated['alamat_lengkap'],
                'layanan_service' => $validated['layanan_service'],
                'kapasitas_capacity' => $validated['kapasitas_capacity'],
                'no_telp_pic' => $validated['no_telp_pic'],
                'email' => $validated['email'],
            ]);

            // Update form
            $form->update([
                'activity_survey' => $request->boolean('activity_survey'),
                'activity_activation' => $request->boolean('activity_activation'),
                'activity_upgrade' => $request->boolean('activity_upgrade'),
                'activity_downgrade' => $request->boolean('activity_downgrade'),
                'activity_troubleshoot' => $request->boolean('activity_troubleshoot'),
                'activity_preventive_maintenance' => $request->boolean('activity_preventive_maintenance'),
                'complaint' => $validated['complaint'] ?? null,
                'action' => $validated['action'] ?? null,
                'assessment' => $validated['assessment'],
                'signature_first_party' => $validated['signature_first_party'],
                'signature_second_party' => $validated['signature_second_party'],
                'first_party_name' => $validated['first_party_name'],
                'second_party_name' => $validated['second_party_name'] ?? null,
                'location' => $validated['location'] ?? null,
                'form_date' => $validated['form_date'] ?? now(),
            ]);

            // Update devices — collect old photos, then compare
            $oldPhotos = $form->maintenanceDevices->pluck('product_photo')->filter()->toArray();
            $keptPhotos = [];
            $form->maintenanceDevices()->delete();
            if (!empty($validated['devices'])) {
                foreach ($validated['devices'] as $index => $device) {
                    if (!empty($device['device_name']) && !empty($device['serial_number'])) {
                        $productPhotoPath = null;
                        
                        // Handle product photo upload
                        if ($request->hasFile("devices.{$index}.product_photo")) {
                            $productPhotoPath = $request->file("devices.{$index}.product_photo")->store('device-photos', 'public');
                        } elseif (!empty($device['existing_product_photo'])) {
                            // Keep existing photo if no new one uploaded
                            $productPhotoPath = $device['existing_product_photo'];
                            $keptPhotos[] = $productPhotoPath;
                        }
                        
                        MaintenanceDevice::create([
                            'on_site_form_id' => $form->id,
                            'device_name' => $device['device_name'],
                            'serial_number' => $device['serial_number'],
                            'product_photo' => $productPhotoPath,
                            'keterangan' => $device['keterangan'] ?? null,
                        ]);
                    }
                }
            }

            // Delete old photos that were not kept
            foreach ($oldPhotos as $oldPhoto) {
                if (!in_array($oldPhoto, $keptPhotos) && Storage::disk('public')->exists($oldPhoto)) {
                    Storage::disk('public')->delete($oldPhoto);
                }
            }

            DB::commit();

            return redirect()->route('forms.show', $form)
                ->with('success', 'Form berhasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Gagal memperbarui form: ' . $e->getMessage());
            return back()->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui data. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified form from storage.
     * Hanya Admin yang dapat menghapus form
     */
    public function destroy(OnSiteForm $form)
    {
        // Hanya admin yang dapat menghapus form
        if (!auth()->user()->isAdmin()) {
            return redirect()->route('forms.index')
                ->with('error', 'Hanya Admin yang dapat menghapus form.');
        }
        
        // Delete device photos from disk
        foreach ($form->maintenanceDevices as $device) {
            if ($device->product_photo && Storage::disk('public')->exists($device->product_photo)) {
                Storage::disk('public')->delete($device->product_photo);
            }
        }
        
        $form->maintenanceDevices()->delete();
        $form->delete();
        return redirect()->route('forms.index')
            ->with('success', 'Form berhasil dihapus!');
    }

    /**
     * Export form to PDF
     */
    public function exportPdf(OnSiteForm $form)
    {
        $form->load(['customer', 'user', 'maintenanceDevices']);
        return view('forms.pdf', compact('form'));
    }

    /**
     * Search customers for autocomplete
     */
    public function searchCustomers(Request $request)
    {
        $query = $request->get('query', '');
        
        if (strlen($query) < 1) {
            return response()->json([]);
        }

        $customers = Customer::where('customer_name', 'like', '%' . $query . '%')
            ->select('customer_name')
            ->distinct()
            ->limit(10)
            ->get()
            ->pluck('customer_name');

        return response()->json($customers);
    }

    /**
     * Search users for autocomplete
     */
    public function searchUsers(Request $request)
    {
        $query = $request->get('query', '');
        
        if (strlen($query) < 1) {
            return response()->json([]);
        }

        $users = \App\Models\User::where('name', 'like', '%' . $query . '%')
            ->select('name')
            ->distinct()
            ->limit(10)
            ->get()
            ->pluck('name');

        return response()->json($users);
    }
}
