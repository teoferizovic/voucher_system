<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;

class AuthController extends Controller
{
    private $userService;

    function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    /**
     * Display a login view.
     *
     * @return Response
     */
    public function index(){
        return view('auth.login');
    }  
      
    /**
     * Display a registration view.
     *
     * @return Response
     */
    public function registration() {
        return view('auth.registration');
    }

    /**
     * Function used for login.
     *
     * @return Redirect
     */
    public function postLogin(UserLoginRequest $request) {
        
        $credentials = $request->only('email', 'password');

        if ($this->userService->loginUser($credentials)) {
            return redirect('dashboard')->with('success','Login successfully!');;
        }
  		
        return redirect("login")->with(['error' => 'Wrong credentials']);
    }

    /**
     * Function used for registration.
     *
     * @return Redirect
     */
    public function postRegistration(UserRegisterRequest $request) {  

        $data = $request->all();
        
        $user = $this->userService->createUser($data);
       
        return redirect("login")->with(['success' => 'Registration successfully!']);
    }

   /**
     * Function used for logout.
     *
     * @return Redirect
     */
    public function logout() {
        
        $this->userService->logoutUser();
        
        return redirect('login');
    }
}
