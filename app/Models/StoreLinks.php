<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreLinks extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    public $table = 'store_links';

  
}
