<?php

use App\Tag;
use App\Post;
use App\Category;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Category::class, 5)->create();
        $tags = factory(Tag::class, 5)->create();
        $posts = factory(Post::class, 10)->create();
        

        $posts->each(function (Post $post) use ($tags) {
            $post->tags()->attach(
                $tags->random(rand(1, 5))->pluck('id')->toArray()
            );
            $post->category_id = rand(1, 5);
            $post->image = 'posts/' . $post->id . '.jpg';
            $post->save();
        });
    }
}
