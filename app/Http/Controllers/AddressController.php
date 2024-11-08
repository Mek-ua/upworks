<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AddressController extends Controller
{
    /**
     * List all addresses.
     */
  
    public function index()
    {
        $addresses = Address::all();
        return response()->json($addresses, Response::HTTP_OK);
    }
    /**
     * Show a specific address by ID.
     */
    public function show($id)
    {
        $address = Address::findOrFail($id);
        return response()->json($address, 200);
    }
}
