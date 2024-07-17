<?php

namespace App\Database\Seeds;

use Illuminate\Database\Seeder;
use Leaf\Fetch;
use App\Models\Varaja;
use Ramsey\Uuid\Uuid;

class VarajasSeeder extends Seeder
{

   public function run()
   {
      // $this->generatePatos();
      // $this->generatePokemons();
      $this->generatePerros();
   }


   private function generatePerros()
   {
      for ($i = 1; $i <= 20; $i++) {
         $randomId = Uuid::uuid4()->toString();
         $resp = Fetch::request(["url" => "https://dog.ceo/api/breeds/image/random"]);

         $data = $resp->data;
         $varaja = new Varaja();

         $varaja->nombre = "perro $randomId";
         $varaja->imagen = $data->message;
         $varaja->tipo = "perro";

         $varaja->save();
      }
   }


   private function generatePatos()
   {
      for ($i = 1; $i <= 20; $i++) {
         $randomPato = rand(1, 10000);
         $resp = Fetch::get("https://random-d.uk/api/v2/quack");

         $data = $resp->data;
         $varaja = new Varaja();

         $varaja->nombre = "pato $randomPato";
         $varaja->imagen = $data->url;
         $varaja->tipo = "pato";

         $varaja->save();
      }
   }


   private function generatePokemons()
   {
      for ($i = 1; $i <= 100; $i++) {
         $randomPokemon = rand(1, 1025);
         $resp = Fetch::get("https://pokeapi.co/api/v2/pokemon/$randomPokemon");

         $data = $resp->data;
         $varaja = new Varaja();

         $varaja->nombre = $data->name;
         $varaja->imagen = $data->sprites->front_default;
         $varaja->tipo = "pokemon";

         $varaja->save();
      }
   }
}
