<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
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

