<?php
app()->registerMiddleware('auth', function () {
    auth()->autoConnect();
    $user = auth()->user();
  
    if (!$user) {
      // user is not logged in
      response()->exit([
        'error' => 'Unauthorized',
        'data' => auth()->errors(),
      ], 401);
    }
  });

app()->group("/varaja", ["middleware" => "auth",function(){
    app()->get("/gen/{type}", "VarajaController@createVaraja");
    app()->get("/user","AlbumController@getVarajasOfUser");
    app()->get("/user/{type}","AlbumController@getVarajasOfUserByType");
}]);
app()->get('/', function () {
    response()->json(['message' => 'Congrats!! You\'re on Leaf API']);
});




app()->post("/login","UserController@login");
app()->post("/singup","UserController@singup");