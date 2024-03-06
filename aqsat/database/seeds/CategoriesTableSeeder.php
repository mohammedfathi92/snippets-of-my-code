<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Category;

use App\Product;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        $category = Category::firstOrNew([
            'slug' => 'out_product',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name' => 'سلع خارجية',
            ])->save();
        }


        Product::create([
            'name' => 'سلعة خارجية',
            'category_id' => 1,
            'status' => 1,
        ]);


        $category = Category::firstOrNew([
            'slug' => 'category-2',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name' => 'Category 2',
            ])->save();
        }
    }
}
