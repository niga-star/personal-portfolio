<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Public list of skills grouped by category (SRS 5.1 - GET /api/v1/skills)
     */
    public function index(): JsonResponse
    {
        $skills = Skill::orderBy('sort_order', 'asc')->get();

        $grouped = [
            'backend' => $skills->where('category', 'backend')->values(),
            'frontend' => $skills->where('category', 'frontend')->values(),
            'database' => $skills->where('category', 'database')->values(),
            'tools' => $skills->where('category', 'tools')->values(),
        ];

        return response()->json([
            'status' => 'success',
            'count' => $skills->count(),
            'data' => $skills,
            'grouped' => $grouped,
        ]);
    }

    /**
     * Admin: Store skill
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:skills,name'],
            'category' => ['required', 'in:backend,frontend,database,tools'],
            'proficiency_percentage' => ['required', 'integer', 'min:1', 'max:100'],
            'icon_class' => ['nullable', 'string', 'max:100'],
            'sort_order' => ['integer'],
        ]);

        $skill = Skill::create($validated);

        return response()->json([
            'message' => 'ክህሎት በተሳካ ሁኔታ ተመዝግቧል (Skill created successfully)',
            'data' => $skill,
        ], 201);
    }

    /**
     * Admin: Update skill
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $skill = Skill::findOrFail($id);

        $validated = $request->validate([
            'name' => ['sometimes', 'required', 'string', 'max:100', 'unique:skills,name,' . $id],
            'category' => ['sometimes', 'required', 'in:backend,frontend,database,tools'],
            'proficiency_percentage' => ['sometimes', 'required', 'integer', 'min:1', 'max:100'],
            'icon_class' => ['nullable', 'string', 'max:100'],
            'sort_order' => ['integer'],
        ]);

        $skill->update($validated);

        return response()->json([
            'message' => 'ክህሎት ተሻሽሏል (Skill updated successfully)',
            'data' => $skill,
        ]);
    }

    /**
     * Admin: Delete skill
     */
    public function destroy(int $id): JsonResponse
    {
        $skill = Skill::findOrFail($id);
        $skill->delete();

        return response()->json([
            'message' => 'ክህሎት ተሰርዟል (Skill deleted successfully)',
        ]);
    }
}
