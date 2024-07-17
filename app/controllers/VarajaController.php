<?php

namespace App\Controllers;

use App\Controllers\Controller;
use Leaf\Fetch;

class VarajaController extends Controller
{

   public function createVaraja(string $type)
   {
      $data = match ($type) {
         "pokemon" => $this->getRandomPokemon(),
         "pato" => $this->getRandomPato(),
      };

      response()->json($data);
   }

   private function getRandomPokemon()
   {
      $randomPokemon = rand(1, 1025);

      $res = Fetch::request(["url" => "https://pokeapi.co/api/v2/pokemon/$randomPokemon"]);

      $pokemon = $res->data;


      
      return ["nombre"=> $pokemon->name, "imagen" => $pokemon->sprites->front_default, "tipo"=>"pokemon"];
   }

   private function getRandomPato()
   {
      $randomNumber = rand(1,290 + 55); // jpg + gif
      $res = Fetch::request(["url" => "https://random-d.uk/api/v2/quack"]);
      
      $pato = $res->data;
      return ["nombre" => "pato $randomNumber", "imagen" => $pato->url, "tipo" => "pato"];
   }
}
