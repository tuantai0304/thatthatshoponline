<?php
/**
 * Created by PhpStorm.
 * User: TuanTai
 * Date: 9/05/2017
 * Time: 1:20 PM
 */
namespace Tai\Products\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Session;
use October\Rain\Support\Facades\Flash;
use phpDocumentor\Reflection\Types\Integer;
use Tai\Products\Models\Categories;
use Tai\Products\Models\Products;

class ProductsComponent extends ComponentBase
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

    public function allProducts() {
        return Products::paginate($this->property('maxItems'));
    }

    public function categorizedProducts() {
        $category = Categories::where('id', '=', $this->param('id'))->first();
        $products = $category->products()->paginate($this->property('maxItems'));

//        $this->page['category'] = $category;
        return ['products'=>$products, 'category' => $category];
    }

    public function similarProducts() {
        $slug = $this->param('slug');

        $product = Products::where('slug', '=', $slug)->first();

        $categories = $product->categories()->get()->toArray();
        $str_cat = array_map(function($o){return $o['id']; }, $categories);

//        dd($str_cat);
        $similar_products = Products::whereHas('categories', function ($query) use ($str_cat){
            $query->whereIn('tai_products_categories.id', $str_cat);
        })->get()->take(5);
//        $this->page['category'] = $category;
//        dd($similar_products);

        return $similar_products;

    }

    /* Get product detail */
    public function product() {
        $slug = $this->param('slug');

        return Products::where('slug', '=', $slug)->first();
    }

    public function onRun()
    {
        $this->prepareVars();
    }


    protected function prepareVars()
    {
        $this->maxItems = $this->page['maxItems'];
//        $this->maxItems = $this->page['maxItems'];
    }

    /* Get categories */
    public function getCategoriesOptions() {
        return Categories::all();
    }

    /***
     * Ajax handler
     *
     */
    public function onAddToCart() {
        $id = input('product_id');

        $product = Products::find($id);

        $products = Session::get('products');
        if ($products == null)
            $products = array();


        if (array_key_exists($id, $products))
            $products[$id]['quantity'] = $products[$id]['quantity'] + 1;
        else {
            $products[$id]['quantity'] = 1;
//            $products[$id]['product'] = Products::where('id','=', $id)->first();
        }

//        var_dump($products);
        $sum = array_sum(array_map(function($o){return $o['quantity'];}, $products));

//        var_dump($sum);
        Session::put('products', $products);

//        $this['cart_products'];
        Flash::success('Added "' . $product->name . '"');

        return [
            'cart_products' => $sum
        ];
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