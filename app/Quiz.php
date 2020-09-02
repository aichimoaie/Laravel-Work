<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{

   protected $fillable = [
       'payLoad','config','name','description'
   ];


   protected $casts = [
    'payLoad' => 'array',
    'config' => 'array'
];
 
// public function author()
// {
//     return $this->belongsTo('user', 'created_by_user_id');
// }
}
