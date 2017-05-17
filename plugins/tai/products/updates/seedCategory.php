<?php
/**
 * Created by PhpStorm.
 * User: TuanTai
 * Date: 7/05/2017
 * Time: 9:30 PM
 */

use Illuminate\Support\Facades\DB;
use Tai\Products\Models\Categories;
use Tai\Products\Models\Products;
use October\Rain\Database\Updates\Seeder;
use October\Rain\Database;
use System\Models\File;

class SeedCategories extends Seeder {

    public function run()
    {
        $faker = Faker\Factory::create();

        for($j=0; $j<10; $j++) {
            $this->generateACategory($faker);
        }
    }

    /**
     * @param $faker
     * @param $image
     * @param $file
     */
    public function generateACategory($faker)
    {
        $name = $faker->sentence($nbWords = 3, $variableNbWords = true);
        $slug = $faker->slug($name);

        $product = Categories::create([
            'name' => $name,
            'slug' => $slug,
            'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        ]);

    }
}