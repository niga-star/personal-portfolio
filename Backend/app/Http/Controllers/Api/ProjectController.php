<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'summary' => ['required', 'string', 'max:500'],
            'description' => ['required', 'string'],
            'problem_solved' => ['nullable', 'string'],
            'database_architecture' => ['nullable', 'string'],
            'thumbnail_url' => ['nullable', 'url'],
            'live_demo_url' => ['nullable', 'url'],
            'github_url' => ['nullable', 'url'],
            'is_featured' => ['boolean'],
            'sort_order' => ['integer'],
            'skill_ids' => ['nullable', 'array'],
            'skill_ids.*' => ['exists:skills,id'],
        ]);

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
    public function update(Request $request, int $id): JsonResponse
    {
        $project = Project::findOrFail($id);

        $validated = $request->validate([
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'category' => ['sometimes', 'required', 'string', 'max:100'],
            'summary' => ['sometimes', 'required', 'string', 'max:500'],
            'description' => ['sometimes', 'required', 'string'],
            'problem_solved' => ['nullable', 'string'],
            'database_architecture' => ['nullable', 'string'],
            'thumbnail_url' => ['nullable', 'string'],
            'live_demo_url' => ['nullable', 'string'],
            'github_url' => ['nullable', 'string'],
            'is_featured' => ['boolean'],
            'sort_order' => ['integer'],
            'skill_ids' => ['nullable', 'array'],
            'skill_ids.*' => ['exists:skills,id'],
        ]);

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
