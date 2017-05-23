<?php
/**
 * Created by PhpStorm.
 * User: TuanTai
 * Date: 7/05/2017
 * Time: 9:30 PM
 */

use Illuminate\Support\Facades\DB;
use Tai\Products\Models\Products;
use October\Rain\Database\Updates\Seeder;
use October\Rain\Database;
use System\Models\File;

class SeedAllTables extends Seeder {

    public function run()
    {
        $faker = Faker\Factory::create();

        $files = File::query()
//            ->where('field','=','product_image')
            ->where('attachment_type','=', 'Tai\Products\Models\Products')
            ->getModels();
        foreach ($files as $file) {
            $file->delete();
        }


        for($j=0; $j<5; $j++) {
            $this->generateAProduct($faker);
        }
    }

    /**
     * @param $faker
     * @param $image
     * @param $file
     */
    public function generateAProduct($faker)
    {
        $name = $faker->sentence($nbWords = 3, $variableNbWords = true);
        $slug = str_slug($name);
        $product = Products::create([
            'name' => $name,
            'slug' => $slug,
            'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        ]);

//        $new_image = $faker->image('storage/temp/public', $width = 200, $height = 200, 'food');
//        $file = new File();
//        $file->data = $new_image;
//        $file->attachment_type = 'Tai\Products\Models\Products';
//        $file->attachment_id = $product->id;
//        $file->field = 'product_image';
//        $file->save();

        for ($i = 0; $i < 5; $i++) {
            $image[$i] = $faker->image('storage/temp/public', $width = 200, $height = 200, 'food');

            $file[$i] = new File();
            $file[$i]->data = $image[$i];
            $file[$i]->is_public = true;
            $file[$i]->attachment_type = 'Tai\Products\Models\Products';
            $file[$i]->attachment_id = $product->id;
            $file[$i]->field = 'product_gallery';
            if ($i === 0)
                $file[$i]->field = 'product_image';

            $file[$i]->save();
        }

        /* Remove temp files */
        array_map(function ($o) {
            unlink($o);
        }, $image);
    }
}