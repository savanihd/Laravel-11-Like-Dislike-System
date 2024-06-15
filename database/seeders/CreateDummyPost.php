<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class CreateDummyPost extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Laravel Product CRUD Tutorial',
                'body' => 'Step by Step Laravel Product CRUD Tutorial'
            ],
            [
                'title' => 'Laravel Image Upload Example',
                'body' => 'Step by Step Laravel Image Upload Example'
            ],
            [
                'title' => 'Laravel File Upload Example',
                'body' => 'Step by Step Laravel File Upload Example'
            ],
            [
                'title' => 'Laravel Cron Job Example',
                'body' => 'Step by Step Laravel Cron Job Example'
            ],
            [
                'title' => 'Laravel Send Email Example',
                'body' => 'Step by Step Laravel Send Email Example'
            ],
            [
                'title' => 'Laravel CRUD with Image Upload',
                'body' => 'Step by Step Laravel CRUD with Image Upload'
            ],
            [
                'title' => 'Laravel Ajax CRUD with Image Upload',
                'body' => 'Step by Step Laravel Ajax CRUD with Image Upload'
            ],
            [
                'title' => 'Laravel Ajax CRUD with Image Upload',
                'body' => 'Step by Step Laravel Ajax CRUD with Image Upload'
            ]
        ];

        foreach ($posts as $key => $value) {
            Post::create([
                'title' => $value['title'],
                'body' => $value['body'],
            ]);
        }
    }
}
