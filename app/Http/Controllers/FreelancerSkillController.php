<?php

namespace App\Http\Controllers;

use App\Models\Freelancer;
use App\Models\Skill;
use Illuminate\Http\Request;

class FreelancerSkillController extends Controller
{
    /**
     * List all skills for a specific freelancer.
     */
    public function index($freelancerId)
    {
        $freelancer = Freelancer::with('skills')->findOrFail($freelancerId);
        return response()->json($freelancer->skills, 200);
    }

    /**
     * Assign skills to a freelancer.
     */
    public function assignSkills(Request $request, $freelancerId)
    {
        $freelancer = Freelancer::findOrFail($freelancerId);

        $request->validate([
            'skill_ids' => 'required|array',
            'skill_ids.*' => 'exists:skills,id'
        ]);

        $freelancer->skills()->syncWithoutDetaching($request->skill_ids);

        return response()->json(['message' => 'Skills assigned successfully', 'skills' => $freelancer->skills], 200);
    }

    /**
     * Remove a specific skill from a freelancer.
     */
    public function removeSkill($freelancerId, $skillId)
    {
        $freelancer = Freelancer::findOrFail($freelancerId);

        $freelancer->skills()->detach($skillId);

        return response()->json(['message' => 'Skill removed successfully', 'skills' => $freelancer->skills], 200);
    }
}
