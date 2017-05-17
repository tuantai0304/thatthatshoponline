<?php
/**
 * Created by PhpStorm.
 * User: TuanTai
 * Date: 9/05/2017
 * Time: 1:20 PM
 */
namespace Tai\Products\Components;

class Category extends \Cms\Classes\ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Category list',
            'description' => 'Displays a collection of categories'
        ];
    }

    // This array becomes available on the page as {{ component.posts }}
    public function categories()
    {
        return ['First Cat', 'Second Category', 'Third Category'];
    }
}