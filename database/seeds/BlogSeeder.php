<?php

use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $blogCategories = factory(\App\Models\BlogCategory::class, 5)->create();

        foreach ($blogCategories as $category) {
            factory(\App\Models\Blog::class, 30)->create([
                'category_id' => $category->id
            ]);
        }
    }
}
