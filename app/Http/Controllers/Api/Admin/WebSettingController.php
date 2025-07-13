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

    public function store(WebSettingRequest $request): JsonResponse
    {
        $existing = WebSetting::first();

        if ($existing) {
            return response()->json(['message' => 'WebSetting already exists.'], 400);
        }

        $setting = WebSetting::create($request->validated());
        return response()->json($setting, 201);
    }

    public function update(WebSettingRequest $request, $id): JsonResponse
    {
        $setting = WebSetting::findOrFail($id);
        $setting->update($request->validated());
        return response()->json($setting);
    }
}
