<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class SkillController extends Controller
{
    /**
     * List all skills.
     */
    public function index()
    {
        $addresses = Skill::all();
        return response()->json($addresses, Response::HTTP_OK);
    }

    /**
     * Show a specific skill by ID.
     */
    public function show($id)
    {
        $skill = Skill::findOrFail($id);
        return response()->json($skill, 200);
    }
}
