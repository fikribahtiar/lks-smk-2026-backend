<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Validation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ValidationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'job' => 'required',
            'job_description' => 'required|min:6',
            'income' => 'required|numeric',
            'reason_accepted' => 'required',
        ]);

        $society = $request->user();

        $validation = $society->validations;

        if ($validation) {
            $validation->update([
                'job' => $request->job,
                'job_description' => $request->job_description,
                'income' => $request->income,
                'reason_accepted' => $request->reason_accepted,
            ]);
        } else {
            Validation::create([
                'society_id' => $society->id,
                'job' => $request->job,
                'job_description' => $request->job_description,
                'income' => $request->income,
                'reason_accepted' => $request->reason_accepted,
            ]);
        }

        Validation::create([
            'society_id' => $society->id,
            'job' => $request->job,
            'job_description' => $request->job_description,
            'income' => $request->income,
            'reason_accepted' => $request->reason_accepted,
        ]);

        return response()->json([
            'message' => 'Request data validation sent successful'
        ], 200);
    }
    public function index(Request $request)
    {
        $society = $request->user();

        if (!$society) {
            return response()->json([
                'message' => 'Unauthorized user'
            ], 401);
        }

        $validation = $society->validation()->with('validator')->first();

        return response()->json([
            'validation' => $validation ? [
                'id' => $validation->id,
                'status' => $validation->status,
                'job' => $validation->job,
                'job_description' => $validation->job_description,
                'income' => $validation->income,
                'reason_accepted' => $validation->reason_accepted,
                'validator' => $validation->validator ? [
                    'id' => $validation->validator->id,
                    'name' => $validation->validator->name,
                ] : null
            ] : null
        ], 200);
    }
}