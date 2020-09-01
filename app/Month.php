<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Month extends Model
{

    use SoftDeletes;
    protected $dates = ['deleted_at', 'date'];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'date', 'income'
    ];

    protected $casts = [
        'date' => 'datetime:d/m/Y'
    ];

    public function setDateAttribute($date) 
    {
        $dt = Carbon::parse($date);

        $this->attributes['date'] = $dt->year.'-'.$dt->month.'-'.$dt->day;
    }

}
