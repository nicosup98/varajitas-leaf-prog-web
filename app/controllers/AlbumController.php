<?php
namespace App\Controllers;
use App\Controllers\Controller;

class AlbumController extends Controller {
   public function getVarajasOfUser(){
      db()->autoConnect();

      $user_id = auth()->id();

      $varajas = db()->query("SELECT v.* from varajas v join albums a on a.id_varaja = v.id where a.id_usuario = ?")->bind($user_id)->all();

      $errors = db()->errors();

      if($errors){
         return response()->exit($errors);
      }
      db()->close();
      response()->json($varajas);
   }
}