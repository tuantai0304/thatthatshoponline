<?php
/**
 * Created by PhpStorm.
 * User: TuanTai
 * Date: 9/05/2017
 * Time: 1:20 PM
 */
namespace Tai\Products\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Tai\Products\Models\Categories;
use Tai\Products\Models\Orders;
use Tai\Products\Models\Products;

class CartComponent extends ComponentBase
{
    /* Define properties */
    public $maxItems;

    public $category;

    /**
     * Component details
    */

    public function componentDetails()
    {
        return [
            'name' => 'Products',
            'description' => 'Displays products on front page'
        ];
    }

    /* Define properties of the plugins*/

    public function defineProperties()
    {
        return [
            'maxItems' => [
                'title'             => 'Max items',
                'description'       => 'The most amount of todo items allowed',
                'default'           => 10,
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'The Max Items property can contain only numeric symbols'
            ],
            'categories' => [
                'title'             => 'Product category',
                'description'       => 'Select category to display',
                'default'           => 'all',
                'type'              => 'dropdown',
            ],
        ];
    }

    public function products() {
        $products = Session::get('products');
//        dd($products);

        $products_ids = array_keys($products);

//        dd($products_ids);

        $query = Products::whereIn('id', $products_ids)->get();

        $products_lists = array();
        foreach ($query as $item) {
            $products_lists[] = [
                'quantity' => $products[$item->id]['quantity'],
                'product' => $item
            ];
        }

        return $products_lists;
    }

    /*
     * onOrder handler
     *
     * **/

    public function onOrder() {
        $quanties = Input::get('quantity');
        $ids = Input::get('id');

        $name = "nametest";
        $phone = "012345678";
        $email = "tuantai0304@gmail.com";
        $address = "1347 Centre Road";

        $new_order = Orders::create([
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'address' => $address,

        ]);

        foreach ($ids as $key => $value) {
            $new_order->products()->attach($value, ['quantity'=>$quanties[$key]]);
        }
    }
}