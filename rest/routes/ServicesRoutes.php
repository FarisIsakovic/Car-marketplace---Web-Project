<?php

/**
 * @OA\Get(path="/service", tags={"services"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return all services from the API. ",
 *         @OA\Response( response=200, description="List of orders.")
 * )
 */

Flight::route("GET /service", function(){
    Flight::json(Flight::service_service()->get_all());
});

/**
 * @OA\Get(path="/service_by_id", tags={"services"}, security={{"ApiKeyAuth": {}}},
 *         @OA\Parameter(in="query", name="id", example=1, description="Service ID"),
 *         @OA\Response( response=200, description="List of services by id.")
 * )
 */

Flight::route("GET /service_by_id", function(){
    Flight::json(Flight::service_service()->get_by_id(Flight::request()->query['id']));
});

/**
 * @OA\Get(path="/service/{id}", tags={"services"}, security={{"ApiKeyAuth": {}}},
 *         @OA\Parameter(in="path", name="id", example=1, description="Proucts ID"),
 *         @OA\Response( response=200, description="List of products by id.")
 * )
 */

Flight::route("GET /service/@id", function($id){
    Flight::json(Flight::service_service()->get_by_id($id));
});

/**
 * @OA\Delete(
 *     path="/service/{id}", security={{"ApiKeyAuth": {}}},
 *     description="Delete service",
 *     tags={"services"},
 *     @OA\Parameter(in="path", name="id", example=1, description="Service ID"),
 *     @OA\Response(
 *         response=200,
 *         description="Service deleted"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error"
 *     )
 * )
 */

Flight::route("DELETE /service/@id", function($id){
    Flight::service_service()->delete($id);
    Flight::json(['message' => "product deleted successfully"]);
});

/**
* @OA\Post(
*     path="/service", security={{"ApiKeyAuth": {}}},
*     description="Add service",
*     tags={"services"},
*     @OA\RequestBody(description="Add new product", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="sname", type="string", example="Detailing of the car",description="Name of the service"),
*    				@OA\Property(property="sdesc", type="string", example="Top 5 in BiH",	description="Description of the service" ),
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="Service has been added"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/

Flight::route("POST /service", function(){
    $request = Flight::request()->data->getData();
    Flight::json(['message' => "product added successfully",
        'data' => Flight::service_service()->add($request)
    ]);
});

?>