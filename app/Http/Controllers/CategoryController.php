<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * List all categories.
     * 
     * This method is useful for clients to select a job category 
     * and for freelancers to filter job listings by category.
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories, 200);
    }

    /**
     * Show a specific category by ID.
     * 
     * This method is helpful if you need details on a particular category.
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category, 200);
    }
}
