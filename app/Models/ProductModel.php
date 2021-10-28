<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model {
    protected $table = 'products';
    protected $primaryKey = 'ProductCode';

    protected $allowedFields = ['productCode', 'productName', 'quantityInStock', 'buyPrice'];
}