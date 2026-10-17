<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FileUploadRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    /**
     * Upload an image or document (SRS 5.2 - POST /api/v1/admin/upload)
     */
    public function upload(FileUploadRequest $request): JsonResponse
    {
        $file = $request->file('file');
        $folder = $request->input('folder', 'general');

        $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs("uploads/{$folder}", $filename, 'public');

        $url = Storage::url($path);

        return response()->json([
            'status' => 'success',
            'message' => 'ፋይሉ በተሳካ ሁኔታ ተጭኗል (File uploaded successfully)',
            'data' => [
                'url' => $url,
                'path' => $path,
                'original_name' => $file->getClientOriginalName(),
                'size' => $file->getSize(),
                'mime_type' => $file->getMimeType(),
            ],
        ], 201);
    }
}
