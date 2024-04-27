<?php
Flight::route('POST /login', function(){
    $login = Flight::request()->data->getData();
    $user = Flight::userDao()->get_user_by_email($login['email']);

    if (count($user) > 0) {
        $user = $user[0];
        if ($user['password'] == md5($login['password'])) {
            // Password matches, unset password field and return success message
            unset($user['password']);
            Flight::json(["message" => "Password is correct", "user" => $user]);
        } else {
            // Password does not match, return error message
            Flight::json(["message" => "Wrong password"], 401);
        }
    } else {
        // User with given email not found, return error message
        Flight::json(["message" => "User doesn't exist"], 404);
    }
});
