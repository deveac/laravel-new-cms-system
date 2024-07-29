<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function setPostImageAttribute($value) { // image mutator
        $this->attributes['post_image'] =  $value;
    }

    public function getPostImageAttribute($value) { // image accessor
        if(strpos($value, 'https://') !== false || strpos($value, 'http://')) {
            return $value;
        }

        return asset('storage/' . $value);
    }
}
