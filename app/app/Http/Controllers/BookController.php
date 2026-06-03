<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Book::all());
    }

    public function show(int $id): JsonResponse
    {
        return response()->json(Book::findOrFail($id));
    }

    public function findBySlug(string $slug): JsonResponse
    {
        return response()->json(Book::where('slug', '=', $slug)->firstOrFail());
    }

    public function findByYear(int $year): JsonResponse
    {
        return response()->json(Book::where('year', '=', $year)->get());
    }

    public function findByMaxPages(int $pages): JsonResponse
    {
        return response()->json(Book::where('pages', '<', $pages)->get());
    }

    public function search(string $search): JsonResponse
    {
        return response()->json(
            Book::where('title', 'LIKE', '%' . $search . '%')
                ->orWhere('author', 'LIKE', '%' . $search . '%')
                ->get()
        );
    }

    public function count(): JsonResponse
    {
        return response()->json(['count' => Book::count()]);
    }

    public function avgPages(): JsonResponse
    {
        return response()->json(['avg-pages' => round(Book::avg('pages'))]);
    }

    public function dashboard(): JsonResponse
    {
        return response()->json([
            'books'  => Book::count(),
            'pages'  => Book::sum('pages'),
            'oldest' => Book::min('year'),
            'newest' => Book::max('year'),
        ]);
    }
}
