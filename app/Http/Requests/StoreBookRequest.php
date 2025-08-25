<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'book_name' => [
                'required',
                'string',
                'max:150',
                Rule::unique('books')->where(function ($query) {
                    return $query->where('author', $this->author);
                })
            ],
            'description' => 'nullable|string',
            'author' => 'required|string|max:150',
            'published_date' => 'required|date_format:Y-m-d'
        ];
    }

    public function messages(): array
    {
        return [
            'book_name.unique' => 'A book with this name and author already exists.',
            'book_name.max' => 'Book name cannot exceed 150 characters.',
            'author.max' => 'Author name cannot exceed 150 characters.',
            'published_date.date_format' => 'Published date must be in Y-m-d format (e.g., 2024-01-15).'
        ];
    }
}