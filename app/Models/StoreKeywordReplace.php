<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreKeywordReplace extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    public $table = 'store_keyword_replace';

  
}
