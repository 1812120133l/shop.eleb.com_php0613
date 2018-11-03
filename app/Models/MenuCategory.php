<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    //
    protected $fillable=[
        'name','type_accumulation','shop_id','description','is_selected'
    ];

    public function user(){
        return $this->belongsTo(User::class,'shop_id','id');
    }
}
