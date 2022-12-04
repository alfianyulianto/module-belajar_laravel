<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            "name" => "Alfian Yulianto",
            "username" => "alfianyulianto",
            "email" => "alfianyulianto36@gmail.com",
            "password" => bcrypt('password')
        ]);

        User::factory(3)->create();

        Category::create([
            "name" => "Web Programming",
            "slug" => "web-prigramming"
        ]);
        Category::create([
            "name" => "Web Design",
            "slug" => "web-design"
        ]);
        Category::create([
            "name" => "Personal",
            "slug" => "personal"
        ]);

        Post::factory(30)->create();

        // Post::create([
        //     "title" => "Judul Post Pertama",
        //     "category_id" => 1,
        //     "user_id" => 1,
        //     "slug" => "judul-post-pertama",
        //     "excerpt" => "Lorem ipsum pertama",
        //     "body" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Est eius non ipsa veritatis illum in nulla incidunt reprehenderit quaerat consequuntur cumque, molestiae officiis adipisci et facere atque? Dolor, itaque accusantium sed in eius sint laudantium ea accusamus maiores blanditiis delectus aliquam sequi quas tenetur necessitatibus excepturi veniam repudiandae dolores ipsam? Autem eum ipsa consectetur id quae iste, fugit, eaque itaque ipsum nostrum quod cum nemo repellat suscipit dignissimos assumenda iusto minus odit, sit omnis in! Quod nemo, beatae, sapiente blanditiis rerum, iste vitae aut eaque aliquid assumenda tempora eveniet natus animi reiciendis distinctio. Similique quam alias fuga asperiores nobis perferendis, culpa maxime tempora? Modi dolorem maxime a quam ea officiis sit tempora molestiae quia minus necessitatibus placeat nam doloribus, iste, tempore vel nemo rem perferendis voluptate. Rem expedita qui culpa nihil nulla quis laudantium adipisci. Mollitia, ad ducimus quis veritatis nisi voluptatibus facilis repellat? Unde quo nesciunt deserunt quis nostrum!"
        // ]);


        // Post::create([
        //     "title" => "Judul Post Ke Dua",
        //     "category_id" => 1,
        //     "user_id" => 1,
        //     "slug" => "judul-post-ke-dua",
        //     "excerpt" => "Lorem ipsum ke dua",
        //     "body" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Est eius non ipsa veritatis illum in nulla incidunt reprehenderit quaerat consequuntur cumque, molestiae officiis adipisci et facere atque? Dolor, itaque accusantium sed in eius sint laudantium ea accusamus maiores blanditiis delectus aliquam sequi quas tenetur necessitatibus excepturi veniam repudiandae dolores ipsam? Autem eum ipsa consectetur id quae iste, fugit, eaque itaque ipsum nostrum quod cum nemo repellat suscipit dignissimos assumenda iusto minus odit, sit omnis in! Quod nemo, beatae, sapiente blanditiis rerum, iste vitae aut eaque aliquid assumenda tempora eveniet natus animi reiciendis distinctio. Similique quam alias fuga asperiores nobis perferendis, culpa maxime tempora? Modi dolorem maxime a quam ea officiis sit tempora molestiae quia minus necessitatibus placeat nam doloribus, iste, tempore vel nemo rem perferendis voluptate. Rem expedita qui culpa nihil nulla quis laudantium adipisci. Mollitia, ad ducimus quis veritatis nisi voluptatibus facilis repellat? Unde quo nesciunt deserunt quis nostrum!"
        // ]);

        // Post::create([
        //     "title" => "Judul Post Ke Tiga",
        //     "category_id" => 2,
        //     "user_id" => 1,
        //     "slug" => "judul-post-ke-tiga",
        //     "excerpt" => "Lorem ipsum ke tiga",
        //     "body" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Est eius non ipsa veritatis illum in nulla incidunt reprehenderit quaerat consequuntur cumque, molestiae officiis adipisci et facere atque? Dolor, itaque accusantium sed in eius sint laudantium ea accusamus maiores blanditiis delectus aliquam sequi quas tenetur necessitatibus excepturi veniam repudiandae dolores ipsam? Autem eum ipsa consectetur id quae iste, fugit, eaque itaque ipsum nostrum quod cum nemo repellat suscipit dignissimos assumenda iusto minus odit, sit omnis in! Quod nemo, beatae, sapiente blanditiis rerum, iste vitae aut eaque aliquid assumenda tempora eveniet natus animi reiciendis distinctio. Similique quam alias fuga asperiores nobis perferendis, culpa maxime tempora? Modi dolorem maxime a quam ea officiis sit tempora molestiae quia minus necessitatibus placeat nam doloribus, iste, tempore vel nemo rem perferendis voluptate. Rem expedita qui culpa nihil nulla quis laudantium adipisci. Mollitia, ad ducimus quis veritatis nisi voluptatibus facilis repellat? Unde quonesciunt deserunt quis nostrum!"
        // ]);
    }
}
