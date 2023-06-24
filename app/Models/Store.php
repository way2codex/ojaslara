<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    public $table = 'store';

    
    public function store_links(){
        return $this->hasMany(StoreLinks::class, 'store_id', 'id');
    }
}
