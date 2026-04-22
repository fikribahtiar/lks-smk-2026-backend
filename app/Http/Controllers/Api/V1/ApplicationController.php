<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Application;
use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApplicationController extends Controller
{
    public function store(Request $request)
    {
        $society = $request->user();

        // ❌ belum accepted
        if (!$society->validation || $society->validation->status !== 'accepted') {
            return response()->json([
                "message" => "Your data validator must be accepted by validator before"
            ], 401);
        }

        // ❌ sudah pernah apply
        if (Application::where('society_id', $society->id)->exists()) {
            return response()->json([
                "message" => "Application for a instalment can only be once"
            ], 401);
        }

        // ❌ validasi input
        $validator = \Validator::make($request->all(), [
            'instalment_id' => 'required|exists:cars,id',
            'months' => 'required|integer',
            'notes' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => "Invalid field",
                "errors" => $validator->errors()
            ], 401);
        }

        Application::create([
            'society_id' => $society->id,
            'car_id' => $request->instalment_id,
            'months' => $request->months,
            'notes' => $request->notes
        ]);

        return response()->json([
            "message" => "Applying for Instalment successful"
        ], 200);
    }

    public function index(Request $request)
    {
        if (!$request->user()) {
            return response()->json([
                'message' => 'Unauthorized user'
            ], 401);
        }

        $society = $request->user();

        $cars = \App\Models\Car::with(['applications' => function ($query) use ($society) {
            $query->where('society_id', $society->id);
        }])->get();

        $result = [];

        foreach ($cars as $car) {
            $applications = [];

            foreach ($car->applications as $app) {
                $applications[] = [
                    'month' => (string) $app->months,
                    'nominal' => (string) ($car->price / $app->months),
                    'apply_status' => $app->status ?? 'pending',
                    'notes' => $app->notes
                ];
            }

            $result[] = [
                'id' => $car->id,
                'car' => $car->model,
                'brand' => $car->brand,
                'price' => (string) $car->price,
                'description' => $car->description ?? '-',
                'applications' => $applications
            ];
        }

        return response()->json([
            'instalments' => $result
        ], 200);
    }
}
