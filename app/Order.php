<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
