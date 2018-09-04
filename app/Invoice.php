<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Invoice extends Model
{
    use SoftDeletes;
    use SoftCascadeTrait;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The array of your relation names to cascade
     *
     * @var array
     */
    protected $softCascade = ['orders'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function orders()
    {
        return $this->hasMany("App\Order");
    }
}
