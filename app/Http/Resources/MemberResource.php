<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'  =>$this->name,
            'eamil' =>$this->eamil,
            'phone' =>$this->phone,
            'membership_date'   =>$this->membership_date,
            'is_active' =>$this->is_active,
            
        ];
    }
}
