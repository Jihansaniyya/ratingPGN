<?php

namespace App\Http\Controllers;

use App\Models\OnSiteForm;
use App\Models\User;
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
            'total_petugas' => User::where('role', 'petugas')->count(),
            'total_tidak_puas' => OnSiteForm::where('assessment', 'tidak_puas')->count(),
            'total_puas' => OnSiteForm::where('assessment', 'puas')->count(),
            'total_sangat_puas' => OnSiteForm::where('assessment', 'sangat_puas')->count(),
        ];

        // Activity statistics
        $activityStats = [
            'survey' => OnSiteForm::where('activity_survey', true)->count(),
            'activation' => OnSiteForm::where('activity_activation', true)->count(),
            'upgrade' => OnSiteForm::where('activity_upgrade', true)->count(),
            'downgrade' => OnSiteForm::where('activity_downgrade', true)->count(),
            'troubleshoot' => OnSiteForm::where('activity_troubleshoot', true)->count(),
            'preventive_maintenance' => OnSiteForm::where('activity_preventive_maintenance', true)->count(),
        ];

        $recentForms = OnSiteForm::with(['customer', 'user'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('dashboard', compact('stats', 'activityStats', 'recentForms'));
    }
}
