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
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'isbn' => $this->isbn,
            'description' => $this->description,
            'publish_date' => $this->publish_date,
            'page_count' => $this->page_count,
            'language' => $this->language,
            'edition' => $this->edition,
            'total_copies' => $this->total_copies,
            'author_id' => $this->author_id,
            'publisher_id' => $this->publisher_id,
            'status' => $this->status,
            'categories' => $this->categories->pluck('name')->toArray(),

        ];
    }
}
