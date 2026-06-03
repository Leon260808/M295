<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'title'  => 'The Hitchhiker\'s Guide to the Galaxy',
                'author' => 'Douglas Adams',
                'slug'   => 'the-hitchhikers-guide-to-the-galaxy',
                'year'   => 1979,
                'pages'  => 208,
            ],
            [
                'title'  => 'The Lord of the Rings',
                'author' => 'J. R. R. Tolkien',
                'slug'   => 'the-lord-of-the-rings',
                'year'   => 1954,
                'pages'  => 1178,
            ],
            [
                'title'  => '1984',
                'author' => 'George Orwell',
                'slug'   => '1984',
                'year'   => 1949,
                'pages'  => 328,
            ],
            [
                'title'  => 'The Name of the Wind',
                'author' => 'Patrick Rothfuss',
                'slug'   => 'the-name-of-the-wind',
                'year'   => 2007,
                'pages'  => 662,
            ],
            [
                'title'  => 'Dune',
                'author' => 'Frank Herbert',
                'slug'   => 'dune',
                'year'   => 1965,
                'pages'  => 412,
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
