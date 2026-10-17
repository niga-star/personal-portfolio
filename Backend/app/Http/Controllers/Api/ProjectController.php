<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Public list of projects (SRS 5.1 - GET /api/v1/projects)
     */
    public function index(Request $request): JsonResponse
    {
        $query = Project::with('skills')->orderBy('sort_order', 'asc')->orderBy('created_at', 'desc');

        // Reactive Category Filter (Full-Stack, Backend, Frontend, Tools)
        if ($request->filled('category') && strtolower($request->category) !== 'all') {
            $category = $request->category;
            $query->where(function ($q) use ($category) {
                $q->where('category', 'like', "%{$category}%");
            });
        }

        if ($request->boolean('featured_only')) {
            $query->where('is_featured', true);
        }

        $projects = $query->get();

        return response()->json([
            'status' => 'success',
            'count' => $projects->count(),
            'data' => $projects,
        ]);
    }

    /**
     * Public single project / Case Study (SRS 5.1 - GET /api/v1/projects/{slug})
     */
    public function show(string $slug): JsonResponse
    {
        $project = Project::with('skills')->where('slug', $slug)->firstOrFail();

        return response()->json([
            'status' => 'success',
            'data' => $project,
        ]);
    }

    /**
     * Admin: Store new project (SRS 5.2 - POST /api/v1/admin/projects)
     */
    public function store(ProjectRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(5);
        $skillIds = $validated['skill_ids'] ?? [];
        unset($validated['skill_ids']);

        $project = Project::create($validated);
        if (! empty($skillIds)) {
            $project->skills()->sync($skillIds);
        }

        return response()->json([
            'message' => 'ፕሮጀክት በተሳካ ሁኔታ ተፈጥሯል (Project created successfully)',
            'data' => $project->load('skills'),
        ], 201);
    }

    /**
     * Admin: Update existing project (SRS 5.2 - PUT /api/v1/admin/projects/{id})
     */
    public function update(ProjectRequest $request, int $id): JsonResponse
    {
        $project = Project::findOrFail($id);

        $validated = $request->validated();

        if (isset($validated['title']) && $validated['title'] !== $project->title) {
            $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(4);
        }

        $skillIds = $validated['skill_ids'] ?? null;
        unset($validated['skill_ids']);

        $project->update($validated);

        if ($skillIds !== null) {
            $project->skills()->sync($skillIds);
        }

        return response()->json([
            'message' => 'ፕሮጀክት በተሳካ ሁኔታ ተሻሽሏል (Project updated successfully)',
            'data' => $project->load('skills'),
        ]);
    }

    /**
     * Admin: Delete project (SRS 5.2 - DELETE /api/v1/admin/projects/{id})
     */
    public function destroy(int $id): JsonResponse
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return response()->json([
            'message' => 'ፕሮጀክት ተሰርዟል (Project deleted successfully)',
        ]);
    }
}
