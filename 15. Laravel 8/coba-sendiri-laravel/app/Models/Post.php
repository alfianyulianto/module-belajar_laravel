<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{

    use HasFactory, Sluggable;
    // public static $blog_post = [
    //     [
    //         "title" => "Judul Post Pertama",
    //         "slug" => "judul-post-pertama",
    //         "excerpt" => "Lorem ipsum pertama",
    //         "author" => "Alfian Yulianto",
    //         "body" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit et doloribus consequuntur quibusdam cum repellendus unde impedit iste voluptates cumque? Officia, natus? Blanditiis eos odio iure non. Numquam ratione voluptatem laudantium velit at sapiente eius. Fuga adipisci molestias deserunt inventore reprehenderit magnam. Voluptatum, maxime! Eius iure delectus quaerat quo vero esse modi dolorem repudiandae error, cupiditate ad et tempora repellendus at? Quam consectetur corporis provident voluptates excepturi voluptatum commodi recusandae reiciendis dolorem! Iure rerum, eaque nesciunt est dicta itaque natus rem voluptatem voluptate, voluptas labore non dolores? Voluptatum perferendis odio excepturi sequi omnis beatae quasi ipsum temporibus laudantium, minima dolore?"
    //     ],
    //     [
    //         "title" => "Judul Post Ke Dua",
    //         "slug" => "judul-post-ke-dua",
    //         "excerpt" => "Lorem ipsum ke dua",
    //         "author" => "Indah Larasati",
    //         "body" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit et doloribus consequuntur quibusdam cum repellendus unde impedit iste voluptates cumque? Officia, natus? Blanditiis eos odio iure non. Numquam ratione voluptatem laudantium velit at sapiente eius. Fuga adipisci molestias deserunt inventore reprehenderit magnam. Voluptatum, maxime! Eius iure delectus quaerat quo vero esse modi dolorem repudiandae error, cupiditate ad et tempora repellendus at? Quam consectetur corporis provident voluptates excepturi voluptatum commodi recusandae reiciendis dolorem! Iure rerum, eaque nesciunt est dicta itaque natus rem voluptatem voluptate, voluptas labore non dolores? Voluptatum perferendis odio excepturi sequi omnis beatae quasi ipsum temporibus laudantium, minima dolore?"
    //     ]
    // ];

    // public static function all()
    // {
    //     return collect(self::$blog_post);
    // }

    // public static function find($slug)
    // {
    //     $posts = static::all();

    //     // $new_post = [];
    //     // foreach ($posts as $post) {
    //     //     if ($post['slug'] === $slug) {
    //     //         $new_post = $post;
    //     //     }
    //     // }
    //     // return $new_post;
    //     return $posts->firstWhere('slug', $slug);
    // }


    protected $guarded = ['id'];

    protected $with = ['category', 'author'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->BelongsTo(User::class, 'user_id');
    }

    // Search
    public function scopeSearch($query, array $filters)
    {
        // Karena request() yang menangani harusnya controller maka buat controller mengirimka requestnya
        // Biarkan model menangandi query ke database
        // if (request('search')) {
        //     $query->where('title', 'like', '%' . request('search') . '%')->orWhere('body', 'like', '%' . request('search') . '%');
        // }

        // if (isset($filters['search']) ? $filters['search'] : false) {
        //     return $query->where('title', 'like', '%' . $filters['search'] . '%')
        //         ->orWhere('body', 'like', '%' . $filters['search'] . '%');
        // }

        $query->when(
            $filters['search'] ?? false,
            fn ($query, $search) =>
            $query->where(
                fn ($query) =>
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('body', 'like', '%' . $search . '%')
            )
        );

        // Agar search bisa menangani jika tampil post berdasarkan category dan author
        // whereHas untuk join ke tabel lain berdasarkan relationship
        $query->when(
            $filters['category'] ?? false,
            fn ($query, $category) =>
            $query->whereHas(
                'category',
                fn ($query) => $query->where('slug', $category)
            )
        );

        $query->when(
            $filters['author'] ?? false,
            fn ($query, $author) =>
            $query->whereHas(
                'author',
                fn ($query) => $query->where('username', $author)
            )
        );
    }


    // agar yang dikirmikan slug bukan id
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // membuat slug dengan eloqount sluggable
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
