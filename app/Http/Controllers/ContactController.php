<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request, Company $company): \Illuminate\Http\JsonResponse
    {
        abort_if($company->user_id !== $request->user()->id, 403);

        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'title' => 'required',
            'seniority' => 'required|in:junior,mid,senior',
        ]);

        $contact = $company->contacts()->create($data);

        return response()->json($contact, 201);
    }
}

