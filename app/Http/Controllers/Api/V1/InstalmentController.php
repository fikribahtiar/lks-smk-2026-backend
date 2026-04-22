<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InstalmentController extends Controller
{
    public function index(Request $request)
    {
        $society = $request->user();

        // ❌ belum validasi / belum accepted
        if (!$society->validation || $society->validation->status !== 'accepted') {
            return response()->json([
                'message' => 'Your data validation must be accepted first'
            ], 403);
        }

        $income = $society->validation->income;

        $cars = Car::get()->map(function ($car) use ($income) {

            $monthly = $car->price / $car->tenor;

            return [
                'id' => $car->id,
                'brand' => $car->brand,
                'model' => $car->model,
                'price' => $car->price,
                'tenor' => $car->tenor,
                'monthly_installment' => (int) $monthly,
                'eligible' => $monthly <= ($income * 0.3) // max 30% income
            ];
        });

        return response()->json([
            'cars' => $cars
        ], 200);
    }

    public function show($id)
    {
        $car = \App\Models\Car::find($id);

        if (!$car) {
            return response()->json([
                'message' => 'Car not found'
            ], 404);
        }

        $months = [12, 24, 36, 48, 60];

        return response()->json([
            'instalment' => [
                'id' => $car->id,
                'car' => $car->model,
                'brand' => $car->brand,
                'price' => $car->price,
                'description' => $car->description,
                'available_month' => collect($months)->map(function ($m) {
                    return [
                        'month' => $m,
                        'description' => $m . ' Months'
                    ];
                })
            ]
        ], 200);
    }
}
