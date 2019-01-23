<?php

use Illuminate\Database\Seeder;

use App\Models\Food;

class FoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $new_food = new Food();
        $new_food->rest_id   = 1;
        $new_food->food_name = 'Rendang Sapi';
        $new_food->food_desc = 'Makanan khas Minangkabau.';
        $new_food->price     = 50000;
        $new_food->save();

        $new_food = new Food();
        $new_food->rest_id   = 1;
        $new_food->food_name = 'Soto Ayam';
        $new_food->food_desc = 'Soto ayam dengan Nasi';
        $new_food->price     = 20000;
        $new_food->save();

        $new_food = new Food();
        $new_food->rest_id   = 2;
        $new_food->food_name = 'Paket 1';
        $new_food->food_desc = '1 Nasi + 2 Ayam Goreng';
        $new_food->price     = 50000;
        $new_food->save();

        $new_food = new Food();
        $new_food->rest_id   = 2;
        $new_food->food_name = 'Paket 2';
        $new_food->food_desc = '1 French Fries + 1 Chicken Burger';
        $new_food->price     = 20000;
        $new_food->save();
    }
}
