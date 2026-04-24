@extends('layouts.admin')

@section('styles')
    <link href="{{ asset('css/thankyou.css') }}" rel="stylesheet">
    <style>
        /* Admin specific overrides for the invoice look */
        .admin-invoice-wrapper {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 0 auto;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #eee;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .invoice-logo {
            max-width: 150px;
        }

        .invoice-title {
            color: var(--primary-color);
            font-weight: 800;
            text-align: right;
        }

        .invoice-details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .detail-box h5 {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 15px;
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
        }

        .order-items-table {
            width: 100%;
            margin-bottom: 30px;
            border-collapse: collapse;
        }

        .order-items-table th {
            background-color: #f8f9fa;
            color: var(--primary-color);
            padding: 12px;
            text-align: left;
            border-bottom: 2px solid #dee2e6;
        }

        .order-items-table td {
            padding: 12px;
            border-bottom: 1px solid #dee2e6;
            vertical-align: middle;
        }

        .item-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }

        .invoice-summary {
            display: flex;
            justify-content: flex-end;
        }

        .summary-box {
            width: 300px;
            background-color: #fcf3e9;
            padding: 20px;
            border-radius: 10px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .summary-row.total {
            font-weight: 800;
            font-size: 1.2rem;
            color: var(--primary-color);
            border-top: 1px solid #ddd;
            padding-top: 10px;
            margin-top: 10px;
        }

        .badge-status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8em;
            text-transform: uppercase;
        }

        .status-completed,
        .status-paid {
            background-color: #d4edda;
            color: #155724;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-failed {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Order Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Orders</a></li>
                        <li class="breadcrumb-item active">#NUPI-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="admin-invoice-wrapper">
                <div class="invoice-header">
                    <div>
                        <img src="{{ asset('images/logo.png') }}" alt="NUPI Logo" class="invoice-logo">
                    </div>
                    <div class="text-end" style="text-align: right;">
                        <h2 class="invoice-title">INVOICE</h2>
                        <p class="text-muted">#NUPI-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
                        <p class="text-muted">{{ $order->created_at->format('F d, Y h:i A') }}</p>

                        @php
                            $statusClass = 'status-' . strtolower($order->payment_status);
                        @endphp
                        <span class="badge-status {{ $statusClass }}">{{ $order->payment_status }}</span>
                    </div>
                </div>

                <!-- Customer & Shipping Details -->
                <div class="invoice-details-grid">
                    <div class="detail-box">
                        <h5>Billed To:</h5>
                        <p>
                            <strong>{{ $order->full_name }}</strong><br>
                            {{ $order->email }}<br>
                            {{ $order->phone }}
                        </p>
                    </div>

                    <div class="detail-box">
                        <h5>Shipped To:</h5>
                        <p>
                            {{ $order->address }}<br>
                            {{ $order->city }}, {{ $order->state }}<br>
                            {{ $order->country }} - {{ $order->zip_code }}
                        </p>
                    </div>

                    <div class="detail-box">
                        <h5>Payment Method:</h5>
                        <p>
                            {{ ucfirst($order->payment_method) }}
                            @if($order->payment_method == 'card' && $order->card_last4)
                                (**** {{ $order->card_last4 }})
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Order Items -->
                <h5>Order Items</h5>
                <table class="order-items-table">
                    <thead>
                        <tr>
                            <th style="width: 80px;">Image</th>
                            <th>Product</th>
                            <th class="text-center">Qty</th>
                            <th class="text-right">Price</th>
                            <th class="text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td>
                                    <img src="{{ asset('images/coffee_pouch_mockup.png') }}" class="item-image" alt="Product">
                                </td>
                                <td>
                                    <strong>{{ $item->product_name }}</strong>
                                    @if(isset($item->variant_name))
                                        <br><small class="text-muted">{{ $item->variant_name }}</small>
                                    @endif
                                </td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                <td class="text-right">${{ number_format($item->price, 2) }}</td>
                                <td class="text-right">${{ number_format($item->total, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Summary -->
                <div class="invoice-summary">
                    <div class="summary-box">
                        <div class="summary-row">
                            <span>Subtotal:</span>
                            <span>${{ number_format($order->subtotal, 2) }}</span>
                        </div>
                        <div class="summary-row">
                            <span>Tax:</span>
                            <span>${{ number_format($order->tax, 2) }}</span>
                        </div>
                        <div class="summary-row">
                            <span>Shipping:</span>
                            <span>${{ number_format($order->shipping, 2) }}</span>
                        </div>
                        <div class="summary-row total">
                            <span>Total:</span>
                            <span>${{ number_format($order->total, 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Print Button -->
                <div class="text-center mt-5 no-print">
                    <button onclick="window.print()" class="btn btn-default"><i class="fas fa-print"></i> Print
                        Invoice</button>
                </div>
            </div>
        </div>
    </section>
@endsection