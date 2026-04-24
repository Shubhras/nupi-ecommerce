<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function index()
    {
        return view('admin.orders.index');
    }

    public function list()
    {
        $orders = Order::query();

        return DataTables::of($orders)
            ->addIndexColumn()
            ->editColumn('id', function ($row) {
                return '#NUPI-' . str_pad($row->id, 5, '0', STR_PAD_LEFT);
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at->format('Y-m-d H:i:s');
            })
            ->editColumn('total', function ($row) {
                return '$' . number_format($row->total, 2);
            })
            ->filterColumn('total', function ($query, $keyword) {
                $query->whereRaw("total like ?", ["%{$keyword}%"]);
            })
            ->addColumn('status', function ($row) {
                $status = ucfirst($row->payment_status);
                $badgeClass = match ($status) {
                    'Completed', 'Paid' => 'badge-success',
                    'Pending' => 'badge-warning',
                    'Failed', 'Cancelled' => 'badge-danger',
                    default => 'badge-secondary',
                };
                return '<span class="badge ' . $badgeClass . '">' . $status . '</span>';
            })
            ->filterColumn('status', function ($query, $keyword) {
                $query->whereRaw("payment_status like ?", ["%{$keyword}%"]);
            })
            ->addColumn('action', function ($row) {
                $viewBtn = '<a href="' . route('admin.orders.show', $row->id) . '" class="btn btn-info btn-sm" title="View"><i class="fas fa-eye"></i></a>';
                $deleteBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-danger btn-sm delete-order ml-1" title="Delete"><i class="fas fa-trash"></i></a>';
                return $viewBtn . ' ' . $deleteBtn;
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function show($id)
    {
        $order = Order::with('items')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function destroy($id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->delete();

            return response()->json([
                'success' => true,
                'message' => 'Order deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting order.'
            ], 500);
        }
    }
}
