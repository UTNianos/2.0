<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Auth\LoginProxy;
use App\Auth\Requests\LoginRequest;

class ApiLoginController extends Controller
{
    private $loginProxy;

    public function __construct(LoginProxy $loginProxy)
    {
        $this->loginProxy = $loginProxy;
    }

    public function login(LoginRequest $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');

        return response($this->loginProxy->attemptLogin($email, $password));
    }

    public function refresh(Request $request)
    {
        return response($this->loginProxy->attemptRefresh());
    }

    public function logout()
    {
        $this->loginProxy->logout();

        return response(null, 204);
    }
}