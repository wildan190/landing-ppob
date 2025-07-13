<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\WebSettingRequest;
use App\Models\WebSetting;
use Illuminate\Http\JsonResponse;

class WebSettingController extends Controller
{
    public function index(): JsonResponse
    {
        $setting = WebSetting::first();
        return response()->json($setting);
    }

    public function createOrUpdate(WebSettingRequest $request): JsonResponse
    {
        $data = $request->validated();

        $setting = WebSetting::first();

        if ($setting) {
            $setting->update($data);
        } else {
            $setting = WebSetting::create($data);
        }

        return response()->json([
            'message' => 'Web setting saved successfully.',
            'data' => $setting,
        ], 200);
    }
}
