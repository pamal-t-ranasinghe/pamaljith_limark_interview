<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id,
            'company_id'=> $this->company_id,
            'first_name'=> $this->first_name,
            'last_name' => $this->last_name,
            'email'     => $this->email,
            'title'     => $this->title,
            'seniority' => $this->seniority,
            'created_at'=> $this->created_at,
        ];
    }
}
