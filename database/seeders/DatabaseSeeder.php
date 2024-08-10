<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Book;
use App\Models\Category;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create(
            [
                'user_id' => '2e340dda-d7a7-4f00-a4a6-753031d86c14',
                'user_name' => 'Tridiktya Hardani Putra', //mengirimkan data ke view about
                'username' => 'tridik123',
                'email' => 'tridiktya@gmail.com',
                'password' => bcrypt('password'),
                'user_role' => 'user',
            ]
        );

        User::create(
            [
                'user_id' => '883d5801-cc55-4a3b-af96-54c18d34a6f4',
                'user_name' => 'Putra Tridiktya', //mengirimkan data ke view about
                'username' => 'putra123',
                'email' => 'putra@gmail.com',
                'password' => bcrypt('password'),
                'user_role' => 'user',
            ]
        );

        User::create(
            [
                'user_id' => '4c8d2495-e735-42a4-a274-85a2479b6f2b',
                'user_name' => 'Admin', //mengirimkan data ke view about
                'username' => 'admin123',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('password'),
                'user_role' => 'admin',
            ]
        );

        Category::create(
            [
                'category_id' => '8ebbd1ab-0330-45cd-bb95-ea40704e00bf',
                'category_name' => 'Teknologi',
                // 'category_slug' => 'teknologi',
            ]
        );

        Category::create(
            [
                'category_id' => 'e5ad7bfb-c028-4a86-8aa6-d8dc91da8789',
                'category_name' => 'Lifestyle',
                // 'category_slug' => 'lifestyle',
            ]
        );

        Book::create(
            [
                'book_id' => Str::uuid(),
                'category_id' => '8ebbd1ab-0330-45cd-bb95-ea40704e00bf',
                'user_id' => '2e340dda-d7a7-4f00-a4a6-753031d86c14',
                'book_title' => 'How To Code In PHP',
                // 'book_slug' => 'how-to-code-in-php',
                'book_description' => 'Buku ini akan mengajarkan anda untuk belajar PHP dari nol.',
                'book_total' => 4,
            ]
        );

        Book::create(
            [
                'book_id' => Str::uuid(),
                'category_id' => 'e5ad7bfb-c028-4a86-8aa6-d8dc91da8789',
                'user_id' => '883d5801-cc55-4a3b-af96-54c18d34a6f4',
                'book_title' => 'Calisthenics For Beginner',
                // 'book_slug' => 'calisthenics-for-beginner',
                'book_description' => 'Buku ini akan memandu anda dalam olahraga kalistenik dengan mudah.',
                'book_total' => 6,
            ]
        );
    }
}
