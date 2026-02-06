<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContactResource;
use App\Models\Company;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function storeContact(Request $request, Company $company): \Illuminate\Http\JsonResponse
    {
        try{
            abort_if($company->user_id !== $request->user()->id, 403);

            $data = $request->validate([
                'first_name' => ['required','string','max:255'],
                'last_name'  => ['required','string','max:255'],
                'email'      => ['required','email','max:255'],
                'title'      => ['required','string','max:255'],
                'seniority'  => ['required','in:junior,mid,senior'],
            ]);

            $contact = $company->contacts()->create($data);

            return response()->json(new ContactResource($contact), 201);
        } catch (\Exception $e) {
           return response()->json(['error' => 'Failed to create contact', 'message' => $e->getMessage()], 500);
        }
    }

    public function index(Request $request, Company $company): \Illuminate\Contracts\Pagination\LengthAwarePaginator | \Illuminate\Http\JsonResponse
    {
        try {
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
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create contact', 'message' => $e->getMessage()], 500);
        }

    }
}

