<?php namespace Tai\Products\Models;

use Model;

/**
 * Model
 */
class Orders extends Model
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
    public $table = 'tai_products_orders';

    public $belongsToMany = [
        'products' => [
            'Tai\Products\Models\Products',
            'table' => 'tai_products_products_orders',
            'key' => 'order_id',
            'otherKey' => 'product_id',
        ]
    ];
}