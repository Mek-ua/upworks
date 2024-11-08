<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PaymentController extends Controller
{
    /**
     * Make a payment for a specific contract.
     */
    public function makePayment(Request $request)
    {
        $validated = $request->validate([
            'contract_id' => 'required|exists:contracts,id',
            'amount' => 'required|numeric|min:0.01',
            'payment_method_id' => 'required|exists:payment_methods,id'
        ]);

        $contract = Contract::findOrFail($validated['contract_id']);

        // Calculate total amount including service fee
        $serviceFee = $validated['amount'] * 0.1; // Example service fee of 10%
        $totalAmount = $validated['amount'] + $serviceFee;

        // Create the payment record
        $payment = Payment::create([
            'contract_id' => $contract->id,
            'amount' => $validated['amount'],
            'service_fee' => $serviceFee,
            'total_amount' => $totalAmount,
            'payment_status' => 'pending',
            'payment_date' => now(),
            'payment_method_id' => $validated['payment_method_id'],
        ]);

        // Update payment status to completed (or integrate with real payment processing logic)
        $payment->update(['payment_status' => 'completed']);

        return response()->json(['message' => 'Payment made successfully', 'payment' => $payment], 201);
    }

    /**
     * View payment history for a specific user (client or freelancer).
     */
    public function viewPayments($userId)
    {
        $user = Auth::user();

        // Ensure the authenticated user is the requested user or has admin privileges
        if ($user->id != $userId && $user->role_id !== 1) {
            return response()->json(['error' => 'Unauthorized access to payment history.'], 403);
        }

        // Retrieve payments for contracts involving this user as client or freelancer
        $payments = Payment::whereHas('contract', function ($query) use ($userId) {
            $query->where('client_id', $userId)->orWhere('freelancer_id', $userId);
        })->get();

        return response()->json(['payments' => $payments], 200);
    }

    /**
     * Request a refund for a specific payment.
     */
    public function refund($paymentId)
    {
        $payment = Payment::findOrFail($paymentId);

        // Ensure refund request is made by the client who made the payment
        if (Auth::user()->client->id !== $payment->contract->client_id) {
            return response()->json(['error' => 'You are not authorized to request a refund for this payment.'], 403);
        }

        // Ensure the payment is eligible for a refund
        if ($payment->payment_status !== 'completed') {
            return response()->json(['error' => 'Only completed payments are eligible for refunds.'], 400);
        }

        // Process refund (marking as refunded for demonstration purposes)
        $payment->update(['payment_status' => 'refunded']);

        return response()->json(['message' => 'Refund requested successfully', 'payment' => $payment], 200);
    }
}
