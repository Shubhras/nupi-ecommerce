<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PartnerController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'brand_name' => 'required|string|max:255',
            'business_type' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:20', // Relaxed max for international
            'brand_email' => 'required|email|max:255',
            'role' => 'required|string|max:255',
            'branches' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            Partner::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your partnership request has been submitted successfully.'
            ]);
        } catch (\Exception $e) {
            \Log::error('Partner storage error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }
}