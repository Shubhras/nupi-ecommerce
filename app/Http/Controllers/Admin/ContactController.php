<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{
    public function index()
    {
        return view('admin.contacts.index');
    }

    public function list()
    {
        $contacts = Contact::query();

        return DataTables::of($contacts)
            ->addIndexColumn()
            ->editColumn('created_at', function ($row) {
                return $row->created_at->format('Y-m-d H:i:s');
            })
            ->make(true);
    }
}
