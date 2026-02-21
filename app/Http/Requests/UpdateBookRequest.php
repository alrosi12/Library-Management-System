<?php

namespace App\Http\Requests;

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
    public function rules($id): array
    {
        return [
            'title'        => ['required', 'string', 'max:255', 'unique:books,title,' . $id],
            'author_id'    => ['required', 'exists:authors,id'],
            'publisher_id' => ['nullable', 'exists:publishers,id'],
            'total_copies' => ['required', 'integer', 'min:1'],
            'status'       => ['required', 'in:available,borrowed,reserved,archived'],
            'isbn'         => ['required', 'string', 'size:13', 'unique:books,isbn,' . $id],
            'description'  => ['nullable', 'string', 'max:255'],
            'page_count'   => ['nullable', 'integer'],
            'edition'      => ['nullable', 'integer', 'min:1'],
            'category_ids' => ['required', 'array'],
            'category_ids.*' => ['exists:categories,id'],
            'publisher_date' => ['nullable', 'date']
        ];
    }
}
