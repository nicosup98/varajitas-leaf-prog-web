<?php
namespace App\Controllers;
use App\Controllers\Controller;

class AlbumController extends Controller {
   public function addVarajita() {
      $album = request()->get(["id_varaja", "id_usuario"]);
      db()->insert("albums")->params($album)->execute();

   }
}