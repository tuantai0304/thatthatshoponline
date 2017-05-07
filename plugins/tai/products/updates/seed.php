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
//            ->where('attachment_type','=', 'Tai\Products\Models\Products')
            ->getModels();
        foreach ($files as $file) {
            $file->delete();
        }


        for($j=0; $j<30; $j++) {
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
        $product = Products::create([
            'name' => $faker->sentence($nbWords = 3, $variableNbWords = true),
            'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        ]);


        for ($i = 0; $i < 5; $i++) {
            $image[$i] = $faker->image('storage/temp/public', $width = 100, $height = 100, 'food');

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