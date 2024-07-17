<?php

namespace App\Controllers;

use Leaf\Helpers\Password;

class UserController extends Controller
{
   public function login()
   {
      auth()->autoConnect();
      list($username, $password) = array_values(app()->request()->get(["username", "password"]));

      $user = auth()->login([
         "username" => $username,
         "password" => $password
      ]);

      if (!$user) {
         return response()->exit(auth()->errors());
      }

      response()->json($user);
   }


   public function singup()
   {
      db()->autoConnect();
      list($fullname, $username, $email, $password, $confirmPassword) = array_values(request()->get(["fullname", "username", "email", "password", "confirmPassword"]));

      if ($password !== $confirmPassword) {
         return response()->exit(["password" => "not match"]);
      }

      // el que hizo los timestamp de la libreria de auth de leaf deberia ir preso
      $req = [
         "fullname" => $fullname,
         "username" => $username,
         "email" => $email,
         "password" => Password::bcrypt($password)
      ];
      $timestmaps = [
         "created_at" => tick()->format("YYYY-MM-DD HH:mm:ss.SSS"),
         "updated_at" => tick()->format("YYYY-MM-DD HH:mm:ss.SSS")
      ];
      db()->insert("users")->params([...$req, ...$timestmaps, "verified" => 0])->unique("username", "email")->execute();
      $errors = db()->errors();
      if ($errors) {
         return response()->exit($errors);
      }
      $data = auth()->login(["username" => $username, "password" => $password]);

      if (!$data) {
         return response()->exit(auth()->errors());
      }

      response()->json($data);
   }
}
