<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * store a new company for the authenticated user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string',
            'industry' => 'required|string',
            'location' => 'required|string',
        ]);

        $company = $request->user()
            ->companies()
            ->create($data);

        return response()->json($company, 201);
    }
}
