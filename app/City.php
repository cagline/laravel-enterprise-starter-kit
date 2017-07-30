<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','district_id','name_en'];
    
    /**
     * Get Lands that belong to city.
     */
    public function lands()
    {
        return $this->hasMany('App\Land');
    }
    
        /**
     * Get Lands that belong to city.
     */
    public function houses()
    {
        return $this->hasMany('App\Land');
    }
    
    /**
     * Scope a query to only include active users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeApi($query)
    {
        return $query->select('id','district_id','name_en');
    }
}
