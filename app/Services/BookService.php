<?php

namespace App\Services;

use App\Models\Book;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class BookService
{
    protected $model;

    public function __construct(Book $model)
    {
        $this->model = $model;
    }

    public function createBook(array $data): Book
    {
        return $this->model->create($data);
    }

    public function updateBook(Book $book, array $data): Book
    {
        $book->update($data);
        return $book->fresh();
    }

    public function deleteBook(Book $book): bool
    {
        return $book->delete();
    }

    public function getPaginatedBooks(int $perPage = 4): LengthAwarePaginator
    {
        return $this->model->paginate($perPage);
    }

    public function searchBooks(string $query, int $perPage = 4): LengthAwarePaginator
    {
        return $this->model
            ->where('book_name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->paginate($perPage);
    }

    public function findBook(int $id): ?Book
    {
        return $this->model->find($id);
    }
}