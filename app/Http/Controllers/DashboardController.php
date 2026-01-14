<?php

namespace App\Http\Controllers;

use App\Models\OnSiteForm;
use App\Models\Customer;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        $stats = [
            'total_forms' => OnSiteForm::count(),
            'total_customers' => Customer::count(),
            'total_tidak_puas' => OnSiteForm::where('assessment', 'tidak_puas')->count(),
            'total_puas' => OnSiteForm::where('assessment', 'puas')->count(),
            'total_sangat_puas' => OnSiteForm::where('assessment', 'sangat_puas')->count(),
        ];

        $recentForms = OnSiteForm::with(['customer', 'user'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Assessment distribution for chart
        $assessmentData = [
            'labels' => ['Tidak Puas', 'Puas', 'Sangat Puas'],
            'data' => [
                $stats['total_tidak_puas'],
                $stats['total_puas'],
                $stats['total_sangat_puas'],
            ],
        ];

        return view('dashboard', compact('stats', 'recentForms', 'assessmentData'));
    }
}
