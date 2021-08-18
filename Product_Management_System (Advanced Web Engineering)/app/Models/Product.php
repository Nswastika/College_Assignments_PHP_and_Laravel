<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'type', 'firstname', 'surname', 'price', 'papl'];
    
    public function user(){
        return $this->belongsTo(User::class);
    }


}
