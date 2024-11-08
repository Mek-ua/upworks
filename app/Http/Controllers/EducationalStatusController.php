<?php

namespace App\Http\Controllers;

use App\Models\EducationalStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EducationalStatusController extends Controller
{
    /**
     * List all educational statuses.
     */
    public function index()
    {
        $statuses = EducationalStatus::all();
        return response()->json($statuses, Response::HTTP_OK);
    }

    /**
     * Show a specific educational status by ID.
     */
    public function show($id)
    {
        $status = EducationalStatus::findOrFail($id);
        return response()->json($status, 200);
    }
}
