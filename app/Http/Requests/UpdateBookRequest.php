<?php

namespace App\Http\Requests;

use App\Models\Book;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $book = request()->id;
        return [
            'title' => 'required|string|max:255|unique:books,title' . $book,
            'isbn' => 'required||size:13|unique:books,isbn,' . $book,
            'description' => 'nullable|string|max:255',
            'publish_date' => 'nullable|date',
            'page_count' => 'nullable|int|min:1',
            'language' => 'nullable|string',
            'edition' => 'nullable|int',
            'total_copies' => 'nullable|int',
            'author_id' => 'required|int|exists:authors,id',
            'publisher_id' => 'exists:publishers,id',
            'status' => 'nullable|in:available,borrowed,reserved,archived',
            'category_ids' => 'required|array',
            'category_ids.*' => 'exists:categories,id',
        ];
    }
}
