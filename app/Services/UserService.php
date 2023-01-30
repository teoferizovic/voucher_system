<?php

namespace App\Services;

use Hash;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserService {

	public function createUser(array $data) : User {
		
		$user = User::create([
        	'name' => $data['name'],
        	'email' => $data['email'],
        	'password' => Hash::make($data['password'])
      	]);

      	return $user;
	}

	public function loginUser(array $credentials) : bool {
		return Auth::attempt($credentials);
	}

	public function logoutUser() {
		return Auth::logout();
	}
}