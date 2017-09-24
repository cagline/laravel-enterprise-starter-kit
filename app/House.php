<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\SoftDeletes;

class House extends Model
{
    use SoftDeletes;
    const DEFAULT_IMAGE = 'default-image.png';
    const API_TYPE_CLIENT = 'client';    
    const API_TYPE_ROW = 'row';
    const DEFULT_TYPE = 'house';

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
    protected $fillable = ['title','description', 'city_id', 'address', 'house_size', 'land_size', 'map', 'type', 'sold','bed_rooms', 'bath_rooms','other_rooms', 'price', 'image1', 'image2', 'image3', 'image4','image5','image6','image7','image8','image9','image10'];
    protected $casts = [ 'sold' => 'boolean' ];
    protected $dates = ['deleted_at'];

    /**
    * Define the type column to every Item object instance
    * 
    * @return string
    */
    public function getTypeAttribute()
    {
        return self::DEFULT_TYPE;
    } 

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
        return $query->select('id','title','description', 'city_id', 'address', 'house_size', 'land_size', 'map', 'type', 'sold','bed_rooms', 'bath_rooms','other_rooms','price','image1', 'image2', 'image3', 'image4','image5','image6','image7','image8','image9','image10')->where('sold',0);
    }
    
    public function isSold(){
        return ($this->sold == 1) ? true : false;
    }
    
    public function getImage($i){
        return Storage::get(object_get($this, "image{$i}"));
    }

}
