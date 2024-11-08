<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    /**
     * List all payment methods (active and inactive).
     */
    public function index()
    {
        $paymentMethods = PaymentMethod::all();
        return response()->json($paymentMethods, 200);
    }

    /**
     * Show details of a specific payment method by ID.
     */
    public function show($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        return response()->json($paymentMethod, 200);
    }

    /**
     * Create a new payment method (admin only).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:payment_methods,name',
            'status' => 'boolean'
        ]);

        $paymentMethod = PaymentMethod::create([
            'name' => $validated['name'],
            'status' => $validated['status'] ?? 1, // Default to active if not specified
        ]);

        return response()->json(['message' => 'Payment method created successfully', 'payment_method' => $paymentMethod], 201);
    }

    /**
     * Update an existing payment method.
     */
    public function update(Request $request, $id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255|unique:payment_methods,name,' . $id,
            'status' => 'boolean'
        ]);

        $paymentMethod->update($validated);

        return response()->json(['message' => 'Payment method updated successfully', 'payment_method' => $paymentMethod], 200);
    }

    /**
     * Toggle the active/inactive status of a payment method.
     */
    public function toggleStatus($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        $paymentMethod->status = !$paymentMethod->status; // Toggle status
        $paymentMethod->save();

        return response()->json(['message' => 'Payment method status updated successfully', 'payment_method' => $paymentMethod], 200);
    }

    /**
     * Delete a payment method (admin only).
     */
    public function destroy($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        $paymentMethod->delete();

        return response()->json(['message' => 'Payment method deleted successfully'], 200);
    }
}
