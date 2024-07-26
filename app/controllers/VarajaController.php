<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Album;
use Leaf\Fetch;
use Ramsey\Uuid\Uuid;

class VarajaController extends Controller
{

   public function createVaraja(string $type)
   {
      db()->autoConnect();
      $data = match ($type) {
         "pokemon" => $this->getRandomPokemon(),
         "pato" => $this->getRandomPato(),
         "perro" => $this->getRandomPerro(),
         "anime" => $this->getRandomAnime()
      };

      $varaja = db()->select("varajas")->where("imagen", $data["imagen"])->first();



      $errors = db()->errors();

      if ($errors) {
         return response()->exit($errors);
      }

      if (!$varaja) {
         //app()->logger()->debug($data);
         db()->insert("varajas")->params($data)->execute();
         $varaja = db()->select("varajas")->where("id", db()->lastInsertId())->assoc();
      }

      $errors = db()->errors();

      if ($errors) {
         return response()->exit($errors);
      }

      $id_user = auth()->id();

      $album = new Album();

      $haveCard = db()->select("albums")->where(["id_usuario" => $id_user, "id_varaja" => $varaja["id"]])->first();

      if (!$haveCard) {
         $album->id_usuario = $id_user;
         $album->id_varaja = $varaja["id"];

         $album->save();
      }



      db()->close();

      response()->json($varaja);
   }

   private function getRandomPokemon()
   {
      $randomPokemon = rand(1, 1025);

      $res = Fetch::request(["url" => "https://pokeapi.co/api/v2/pokemon/$randomPokemon"]);

      $pokemon = $res->data;



      return ["nombre" => $pokemon->name, "imagen" => $pokemon->sprites->front_default, "tipo" => "pokemon"];
   }

   private function getRandomPato()
   {
      $randomNumber = rand(1, 10000);
      $res = Fetch::request(["url" => "https://random-d.uk/api/v2/quack"]);

      $pato = $res->data;
      return ["nombre" => "pato $randomNumber", "imagen" => $pato->url, "tipo" => "pato"];
   }

   private function getRandomPerro()
   {
      $randomId = Uuid::uuid4()->toString();
      $res = Fetch::request(["url" => "https://dog.ceo/api/breeds/image/random"]);

      $perro = $res->data;
      return ["nombre" => "perro $randomId", "imagen" => $perro->message, "tipo" => "perro"];
   }
   private function getRandomAnime()
   {
      $randomId = rand(1, 1000);

      $res = Fetch::get("https://api.jikan.moe/v4/anime/$randomId");
      $anime = $res->data;
      $name = $anime->data->titles[0]->title;
      $img = $anime->data->images->webp->image_url;
      return ["nombre" => $name, "imagen" => "$img", "tipo" => "anime"];
   }
}
