<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;
use App\Models\Partner;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        // Get statistics
        $totalContacts = Contact::count();
        $totalPartners = Partner::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total');

        // Get monthly sales data for the current year
        $currentYear = date('Y');
        $monthlySales = Order::select(
            DB::raw("CAST(strftime('%m', created_at) AS INTEGER) as month"),
            DB::raw('SUM(total) as total_sales')
        )
            ->whereYear('created_at', $currentYear)
            ->where('payment_status', 'paid')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('total_sales', 'month')
            ->toArray();

        // Fill in missing months with 0
        $salesData = [];
        for ($i = 1; $i <= 12; $i++) {
            $salesData[] = $monthlySales[$i] ?? 0;
        }

        return view('admin.dashboard', compact(
            'totalContacts',
            'totalPartners',
            'totalOrders',
            'totalRevenue',
            'salesData'
        ));
    }

    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }
}
