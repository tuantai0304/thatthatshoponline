<?php namespace Tai\Products\Models;

use Model;

/**
 * Model
 */
class Products extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];

    /*
     * Validation
     */
    public $rules = [
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'tai_products_product';

    /*
     * Relation
     * */
    public $attachOne = [
      'product_image' => 'System\Models\File'
    ];

    public $attachMany = [
      'product_gallery' => 'System\Models\File'
    ];
}