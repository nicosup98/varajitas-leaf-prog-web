<?php
namespace App\Models;
use App\Controllers\Controller;

class Album extends Controller {
   protected array $fillable = ["id_usuario", "id_varajita"];

   public $timestamps = true;
}