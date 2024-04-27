<?php

Flight::route("GET /orders", function(){
    Flight::json(Flight::order_service()->get_all());
});


Flight::route("GET /orders/@id", function($id){
    Flight::json(Flight::order_service()->get_by_id($id));
});

Flight::route("DELETE /orders/@id", function($id){
    Flight::order_service()->delete($id);
    Flight::json(['message' => "order deleted successfully"]);
});

Flight::route("POST /order", function(){
    $request = Flight::request()->data->getData();
    Flight::json(['message' => "order added successfully",
        'data' => Flight::order_service()->add($request)
    ]);
});
?>