<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExperienceRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Experience;
use App\Models\ProfileSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ProfileController extends Controller
{
    /**
     * Get Complete Portfolio Profile & Settings (Zero Hardcoding)
     */
    public function index(): JsonResponse
    {
        $profile = ProfileSetting::first();
        $experiences = Experience::orderBy('sort_order', 'asc')->get();

        return response()->json([
            'status' => 'success',
            'data' => [
                'profile' => $profile,
                'experiences' => $experiences,
            ],
        ]);
    }

    /**
     * Admin: Update Profile Settings & Stats
     */
    public function update(ProfileUpdateRequest $request): JsonResponse
    {
        $profile = ProfileSetting::firstOrCreate(['id' => 1]);
        $validated = $request->validated();

        $profile->update($validated);

        return response()->json([
            'message' => 'የግል መረጃ እና ማስተካከያዎች ተሻሽለዋል (Profile settings updated successfully)',
            'data' => $profile,
        ]);
    }

    /**
     * Admin: Store experience
     */
    public function storeExperience(ExperienceRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $exp = Experience::create($validated);

        return response()->json([
            'message' => 'ልምድ በተሳካ ሁኔታ ተመዝግቧል (Experience added)',
            'data' => $exp,
        ], 201);
    }

    /**
     * Admin: Update experience
     */
    public function updateExperience(ExperienceRequest $request, int $id): JsonResponse
    {
        $exp = Experience::findOrFail($id);
        $validated = $request->validated();
        $exp->update($validated);

        return response()->json([
            'message' => 'ልምድ ተሻሽሏል (Experience updated)',
            'data' => $exp,
        ]);
    }

    /**
     * Admin: Delete experience
     */
    public function destroyExperience(int $id): JsonResponse
    {
        $exp = Experience::findOrFail($id);
        $exp->delete();

        return response()->json([
            'message' => 'ልምድ ተሰርዟል (Experience deleted)',
        ]);
    }

    /**
     * FR-06: Download CV (PDF)
     */
    public function downloadCv(): BinaryFileResponse|JsonResponse
    {
        $path = storage_path('app/public/cv/developer-cv.pdf');

        if (! file_exists($path)) {
            // Generate a placeholder PDF file if none exists
            if (! is_dir(dirname($path))) {
                mkdir(dirname($path), 0777, true);
            }
            $dummyPdfContent = "%PDF-1.4\n1 0 obj<</Type/Catalog/Pages 2 0 R>>endobj\n2 0 obj<</Type/Pages/Kids[3 0 R]/Count 1>>endobj\n3 0 obj<</Type/Page/MediaBox[0 0 612 792]/Parent 2 0 R/Resources<<>>>>endobj\nxref\n0 4\n0000000000 65535 f \n0000000009 00000 n \n0000000052 00000 n \n0000000101 00000 n \ntrailer<</Size 4/Root 1 0 R>>\nstartxref\n178\n%%EOF";
            file_put_contents($path, $dummyPdfContent);
        }

        return response()->download($path, 'Full-Stack-Developer-CV.pdf', [
            'Content-Type' => 'application/pdf',
        ]);
    }
}
