<?php

namespace App\Http\Controllers;

use App\Models\OnSiteForm;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display report page with filters
     */
    public function index(Request $request)
    {
        $query = OnSiteForm::with('customer');
        
        // Filter by assessment
        if ($request->filled('assessment') && $request->assessment !== 'semua') {
            $query->where('assessment', $request->assessment);
        }
        
        // Filter by date range
        if ($request->filled('start_date')) {
            $query->whereDate('form_date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('form_date', '<=', $request->end_date);
        }
        
        $forms = $query->orderBy('form_date', 'desc')->get();
        
        // Calculate statistics
        $stats = [
            'total' => $forms->count(),
            'sangat_puas' => $forms->where('assessment', 'sangat_puas')->count(),
            'puas' => $forms->where('assessment', 'puas')->count(),
            'tidak_puas' => $forms->where('assessment', 'tidak_puas')->count(),
        ];
        
        return view('reports.index', compact('forms', 'stats'));
    }
    
    /**
     * Print report
     */
    public function print(Request $request)
    {
        $query = OnSiteForm::with('customer');
        
        // Filter by assessment
        if ($request->filled('assessment') && $request->assessment !== 'semua') {
            $query->where('assessment', $request->assessment);
        }
        
        // Filter by date range
        if ($request->filled('start_date')) {
            $query->whereDate('form_date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('form_date', '<=', $request->end_date);
        }
        
        $forms = $query->orderBy('form_date', 'desc')->get();
        
        // Calculate statistics
        $stats = [
            'total' => $forms->count(),
            'sangat_puas' => $forms->where('assessment', 'sangat_puas')->count(),
            'puas' => $forms->where('assessment', 'puas')->count(),
            'tidak_puas' => $forms->where('assessment', 'tidak_puas')->count(),
        ];
        
        $filterInfo = $this->getFilterInfo($request);
        
        return view('reports.print', compact('forms', 'stats', 'filterInfo'));
    }
    
    /**
     * Export to CSV
     */
    public function export(Request $request)
    {
        $query = OnSiteForm::with('customer');
        
        if ($request->filled('assessment') && $request->assessment !== 'semua') {
            $query->where('assessment', $request->assessment);
        }
        
        if ($request->filled('start_date')) {
            $query->whereDate('form_date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('form_date', '<=', $request->end_date);
        }
        
        $forms = $query->orderBy('form_date', 'desc')->get();
        
        $filename = 'laporan_assessment_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];
        
        $callback = function() use ($forms) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for Excel UTF-8 compatibility
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Header
            fputcsv($file, [
                'No',
                'Tanggal',
                'Customer',
                'Email',
                'Layanan',
                'Kapasitas',
                'Alamat',
                'Assessment',
                'Complaint',
                'Action'
            ]);
            
            // Data
            foreach ($forms as $index => $form) {
                fputcsv($file, [
                    $index + 1,
                    $form->form_date ? $form->form_date->format('d/m/Y') : '-',
                    $form->customer->customer_name ?? '-',
                    $form->customer->email ?? '-',
                    $form->customer->layanan_service ?? '-',
                    $form->customer->kapasitas_capacity ?? '-',
                    $form->customer->fullAddress ?? '-',
                    $this->getAssessmentLabel($form->assessment),
                    $form->complaint ?? '-',
                    $form->action ?? '-'
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
    
    /**
     * Get filter info for display
     */
    private function getFilterInfo(Request $request)
    {
        $info = [];
        
        if ($request->filled('assessment') && $request->assessment !== 'semua') {
            $info['Assessment'] = $this->getAssessmentLabel($request->assessment);
        } else {
            $info['Assessment'] = 'Semua';
        }
        
        if ($request->filled('start_date')) {
            $info['Dari Tanggal'] = date('d/m/Y', strtotime($request->start_date));
        }
        
        if ($request->filled('end_date')) {
            $info['Sampai Tanggal'] = date('d/m/Y', strtotime($request->end_date));
        }
        
        return $info;
    }
    
    /**
     * Get assessment label
     */
    private function getAssessmentLabel($value)
    {
        return match($value) {
            'sangat_puas' => 'Sangat Puas',
            'puas' => 'Puas',
            'tidak_puas' => 'Tidak Puas',
            default => $value
        };
    }
}
