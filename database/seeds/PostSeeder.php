<?php
use App\Models\Post;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 10; $i++) {
            $post = new Post();
            $post->title = $faker->sentence(3);
            $post->content = $faker->text(400);
            $post->img = $faker->imageUrl(600, 450, null, true);
            $post->slug = Str::slug($post->title, '-');
            $post->save();
        }
    }
}
