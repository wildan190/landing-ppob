<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $settings = \App\Models\WebSetting::first();

        return response()->json([
            'settings' => $settings,
        ]);
    }
}
