<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['image_url'];

    protected $hidden = ['image'];


    // Accessors:
    // get{AttrName}Attribute
    // $product->image_url
    public function getImageUrlAttribute()
    {
        if ($this->image) {

            return asset('uploads/' . $this->image);
        }

        return 'https://ui-avatars.com/api/?name=' . $this->name;
    }
}
