<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class House extends Model
{
    const DEFAULT_IMAGE = 'default-image.png';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'houses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'city_id', 'address', 'house_size', 'land_size', 'map', 'type', 'sold','bed_rooms', 'bath_rooms','other_rooms', 'image1', 'image2', 'image3', 'image4','image5','image6','image7','image8','image9','image10'];
    protected $casts = [ 'sold' => 'boolean' ];

    /**
     * Get the City that owns the House.
     */
    public function city()
    {
        return $this->belongsTo('App\City');
    }
    
 
    /**
     * Scope a query to only include active users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeApi($query)
    {
//        return $query->where('type', 'house');
        return $query->select('id','title', 'city_id', 'address', 'house_size', 'land_size', 'map', 'type', 'sold');
    }
    
    public function isSold(){
        return ($this->sold == 1) ? true : false;
    }
    
    public function getImage($i){
        return Storage::get(object_get($this, "image{$i}"));
    }

}
