<?php

/**
 * @OA\Get(path="/products", tags={"products"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return all products from the API. ",
 *         @OA\Response( response=200, description="List of orders.")
 * )
 */

Flight::route("GET /products", function(){
    Flight::json(Flight::product_service()->get_all());
});

/**
 * @OA\Get(path="/product_by_id", tags={"products"}, security={{"ApiKeyAuth": {}}},
 *         @OA\Parameter(in="query", name="id", example=1, description="Product ID"),
 *         @OA\Response( response=200, description="List of products by id.")
 * )
 */

Flight::route("GET /product_by_id", function(){
    Flight::json(Flight::product_service()->get_by_id(Flight::request()->query['id']));
});

/**
 * @OA\Get(path="/products/{id}", tags={"products"}, security={{"ApiKeyAuth": {}}},
 *         @OA\Parameter(in="path", name="id", example=1, description="Proucts ID"),
 *         @OA\Response( response=200, description="List of products by id.")
 * )
 */

Flight::route("GET /products/@id", function($id){
    Flight::json(Flight::product_service()->get_by_id($id));
});

/**
 * @OA\Delete(
 *     path="/products/{id}", security={{"ApiKeyAuth": {}}},
 *     description="Delete product",
 *     tags={"products"},
 *     @OA\Parameter(in="path", name="id", example=1, description="Product ID"),
 *     @OA\Response(
 *         response=200,
 *         description="Product deleted"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error"
 *     )
 * )
 */

Flight::route("DELETE /products/@id", function($id){
    Flight::product_service()->delete($id);
    Flight::json(['message' => "product deleted successfully"]);
});


/**
* @OA\Post(
*     path="/product", security={{"ApiKeyAuth": {}}},
*     description="Add product",
*     tags={"products"},
*     @OA\RequestBody(description="Add new product", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="product_name", type="string", example="Audi",description="Name of the car"),
*    				@OA\Property(property="product_image", type="string", example="images/car.jpg",	description="Image of the car" ),
*                   @OA\Property(property="product_description", type="string", example="Audi A3 2020",	description="Car description" ),
*                   @OA\Property(property="product_price", type="string", example="25000",	description="Car price" ),
*                   @OA\Property(property="product_hp", type="string", example="250",	description="Car horsepower" ),
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="Car has been added"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/


Flight::route("POST /product", function(){
    $request = Flight::request()->data->getData();
    Flight::json(['message' => "product added successfully",
        'data' => Flight::product_service()->add($request)
    ]);
});

/**
 * @OA\Put(
 *     path="/product/{id}", security={{"ApiKeyAuth": {}}},
 *     description="Edit car",
 *     tags={"products"},
 *     @OA\Parameter(in="path", name="id", example=1, description="Car ID"),
 *     @OA\RequestBody(description="Product info", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				@OA\Property(property="product_name", type="string", example="Audi",description="Name of the car"),
 *    				@OA\Property(property="product_image", type="string", example="images/car.jpg",	description="Image of the car" ),
 *                  @OA\Property(property="product_description", type="string", example="Audi A3 2020",	description="Car description" ),
 *                  @OA\Property(property="product_price", type="string", example="25000",	description="Car price" ),
 *                  @OA\Property(property="product_hp", type="string", example="250",	description="Car horsepower" ),          
 *        )
 *     )),
 *     @OA\Response(
 *         response=200,
 *         description="Color has been edited"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error"
 *     )
 * )
 */

Flight::route("PUT /product/@id", function($id){
    $product = Flight::request()->data->getData();
    Flight::json(['message' => "product edit successfully",
        'data' => Flight::product_service()->update($product, $id)
    ]);
});

?>