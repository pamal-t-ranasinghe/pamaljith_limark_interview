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

    public function index(Request $request, Company $company)
    {
        abort_if($company->user_id !== $request->user()->id, 403);

        $query = $company->contacts();

        if ($request->filled('title')) {
            $query->where('title', $request->title);
        }

        if ($request->filled('seniority')) {
            $query->where('seniority', $request->seniority);
        }

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', "%{$request->q}%")
                    ->orWhere('last_name', 'like', "%{$request->q}%")
                    ->orWhere('email', 'like', "%{$request->q}%");
            });
        }

        return $query->paginate(
            $request->get('per_page', 10)
        );
    }
}

