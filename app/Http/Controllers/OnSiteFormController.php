<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\OnSiteForm;
use App\Models\MaintenanceDevice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        
        // Get statistics
        $stats = [
            'total' => OnSiteForm::count(),
            'sangat_puas' => OnSiteForm::where('assessment', 'sangat_puas')->count(),
            'puas' => OnSiteForm::where('assessment', 'puas')->count(),
            'tidak_puas' => OnSiteForm::where('assessment', 'tidak_puas')->count(),
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
            
            // Activities
            'activity_survey' => 'nullable|boolean',
            'activity_activation' => 'nullable|boolean',
            'activity_upgrade' => 'nullable|boolean',
            'activity_downgrade' => 'nullable|boolean',
            'activity_troubleshoot' => 'nullable|boolean',
            'activity_preventive_maintenance' => 'nullable|boolean',
            
            // Technical details
            'complaint' => 'nullable|string',
            'action' => 'nullable|string',
            'assessment' => 'required|in:tidak_puas,puas,sangat_puas',
            
            // Signatures (required)
            'signature_first_party' => 'required|string',
            'signature_second_party' => 'required|string',
            'first_party_name' => 'required|string|max:255',
            'second_party_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'form_date' => 'required|date',
        ]);

        DB::beginTransaction();

        try {
            // Create or find customer
            $customer = Customer::create([
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

            // Create the on-site form
            $form = OnSiteForm::create([
                'customer_id' => $customer->id,
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
                foreach ($validated['devices'] as $device) {
                    if (!empty($device['device_name']) && !empty($device['serial_number'])) {
                        MaintenanceDevice::create([
                            'on_site_form_id' => $form->id,
                            'device_name' => $device['device_name'],
                            'serial_number' => $device['serial_number'],
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()->route('forms.show', $form)
                ->with('success', 'Form On Site Customer berhasil disimpan!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
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
            'complaint' => 'nullable|string',
            'action' => 'nullable|string',
            'assessment' => 'required|in:tidak_puas,puas,sangat_puas',
            'signature_first_party' => 'required|string',
            'signature_second_party' => 'required|string',
            'first_party_name' => 'required|string|max:255',
            'second_party_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'form_date' => 'required|date',
        ]);

        DB::beginTransaction();

        try {
            // Update customer
            $form->customer->update([
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
                'second_party_name' => $validated['second_party_name'] ?? null,
                'location' => $validated['location'] ?? null,
                'form_date' => $validated['form_date'] ?? now(),
            ]);

            // Update devices
            $form->maintenanceDevices()->delete();
            if (!empty($validated['devices'])) {
                foreach ($validated['devices'] as $device) {
                    if (!empty($device['device_name']) && !empty($device['serial_number'])) {
                        MaintenanceDevice::create([
                            'on_site_form_id' => $form->id,
                            'device_name' => $device['device_name'],
                            'serial_number' => $device['serial_number'],
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()->route('forms.show', $form)
                ->with('success', 'Form berhasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
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
}
