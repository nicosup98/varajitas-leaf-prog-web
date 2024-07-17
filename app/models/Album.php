<?php
namespace App\Models;
use App\Controllers\Controller;

class Album extends Model {
   protected $fillable = ["id_usuario", "id_varajita"];

   public $timestamps = true;
}