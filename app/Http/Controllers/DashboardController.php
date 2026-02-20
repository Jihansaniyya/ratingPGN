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
            'total_users' => User::count(),
            'total_tidak_puas' => OnSiteForm::where('assessment', 'tidak_puas')->count(),
            'total_puas' => OnSiteForm::where('assessment', 'puas')->count(),
            'total_sangat_puas' => OnSiteForm::where('assessment', 'sangat_puas')->count(),
        ];

        $recentForms = OnSiteForm::with(['customer', 'user'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('dashboard', compact('stats', 'recentForms'));
    }
}
