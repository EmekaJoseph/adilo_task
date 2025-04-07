<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{

    protected $guarded = ['id'];
    public $primaryKey = 'id';
    public $timestamps  = true;

    public function category()
    {
        return $this->belongsTo(Category::class,);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
