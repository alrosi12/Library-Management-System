<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
       return [
            'id'           => $this->id,
            'title'        => $this->title,
            'isbn'         => $this->isbn,
            'status'       => $this->status,
            'total_copies' => $this->total_copies,
            'author'       => [
                'id'   => $this->author->id,
                'name' => $this->author->name,
            ],
        ];
    }
}
