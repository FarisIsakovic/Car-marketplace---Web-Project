<?php

Flight::route("GET /service", function(){
    Flight::json(Flight::service_service()->get_all());
});


Flight::route("GET /service_by_id", function(){
    Flight::json(Flight::service_service()->get_by_id(Flight::request()->query['id']));
});


Flight::route("GET /service/@id", function($id){
    Flight::json(Flight::service_service()->get_by_id($id));
});

Flight::route("DELETE /service/@id", function($id){
    Flight::service_service()->delete($id);
    Flight::json(['message' => "product deleted successfully"]);
});


Flight::route("POST /service", function(){
    $request = Flight::request()->data->getData();
    Flight::json(['message' => "product added successfully",
        'data' => Flight::service_service()->add($request)
    ]);
});


Flight::route("PUT /product/@id", function($id){
    $product = Flight::request()->data->getData();
    Flight::json(['message' => "product edit successfully",
        'data' => Flight::product_service()->update($product, $id)
    ]);
});

?>