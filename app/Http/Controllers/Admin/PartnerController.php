<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PartnerController extends Controller
{
    public function index()
    {
        return view('admin.partners.index');
    }

    public function list()
    {
        $partners = Partner::query();

        return DataTables::of($partners)
            ->addIndexColumn()
            ->editColumn('created_at', function ($row) {
                return $row->created_at->format('Y-m-d H:i:s');
            })
            ->make(true);
    }
}
