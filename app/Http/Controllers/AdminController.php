<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\JobPost;
use App\Models\Contract;
use App\Models\Payment;
use App\Models\Category;

class AdminController extends Controller
{
    public function listUsers()
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    /**
     * List all job posts with client information.
     */
    public function listJobs()
    {
        $jobs = JobPost::with('client')->get();
        return response()->json($jobs, 200);
    }

    /**
     * List all contracts with related information.
     */
    public function listContracts()
    {
        $contracts = Contract::with(['client', 'freelancer', 'jobPost'])->get();
        return response()->json($contracts, 200);
    }

    /**
     * List all payments with user and contract information.
     */
    public function listPayments()
    {
        $payments = Payment::with(['user', 'contract'])->get();
        return response()->json($payments, 200);
    }

    /**
     * List all job categories.
     */
    public function listCategories()
    {
        $categories = Category::all();
        return response()->json($categories, 200);
    }
}
