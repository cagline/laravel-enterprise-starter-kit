<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'districts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','province_id','name_en'];
    
    /**
     * Get the cities for the blog post.
     */
    public function cities()
    {
        return $this->hasMany('App\City');
    }
    
    /**
     * Get the houses for the districts.
     */
    public function houses()
    {
        return $this->hasManyThrough('App\House', 'App\City');
    }
    
        /**
     * Get the houses for the districts.
     */
    public function lands()
    {
        return $this->hasManyThrough('App\Land', 'App\City');
    }
    
    /**
     * Scope a query to only include active users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeApi($query)
    {
        return $query->select('id','province_id','name_en');
    }
}
