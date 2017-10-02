<?php

namespace Utnianos\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Response;
use Socialite;
use Tymon\JWTAuth\Exceptions\JWTException;
use Utnianos\Core\Usuario;

class AuthenticateController extends Controller
{

    private static $providers = ['github', 'facebook', 'google'];

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            // verify the credentials and create a token for the user
            if (!$token = \JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // if no errors are encountered we can return a JWT
        return response()->json(['token' => $token]);
    }

    public function index(Request $request)
    {
        return \JWTAuth::parseToken()->authenticate();
    }

    /**
     * registra un usuario nuevo.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function registrar(Request $request)
    {
        $this->validate($request, [
                'usuario' => 'required|unique:usuarios|max:255',
                'email' => 'required|unique:usuarios|email',
                'password' => 'required|max:1024'
            ]);

        $usuario = new Usuario($request->only(['usuario','email', 'password']));
        $usuario->save();

        $token = \JWTAuth::fromUser($usuario);

        return response()->json(['token' => $token]);
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->stateless()->redirect();
    }

    /**
     * realiza el login de un usuario a partir de un token
     * @param Request $request
     * @param $provider
     * @return \Illuminate\Http\JsonResponse
     * @internal param $token
     */
    public function loginWithProvider(Request $request, $provider)
    {
        $this->validate($request,
            ['provider' => Rule::in(self::$providers),
                'token' => 'required']);
        $providerUser = Socialite::driver($provider)
            ->stateless()
            ->userFromToken($request->get('token'));

        $user = Usuario::where('provider', $provider)
            ->where('provider_id', $providerUser->getId())->first();
        if ($user === null) {
            return response()->json([
                'id' => $providerUser->getId(),
                'nickname' => $providerUser->getNickname(),
                'name' => $providerUser->getName(),
                'email' => $providerUser->getEmail(),
                'avatar' => $providerUser->getAvatar()
            ], 401);
        } else {
            $token = \JWTAuth::fromUser($user);
            return response()->json(['token' => $token]);
        }
    }


    /**
     * Obtain the user information from provider.
     *
     * @param Request $request
     * @param $provider
     * @return \Illuminate\Http\JsonResponse|Response
     */
    public function handleProviderCallback(Request $request, $provider)
    {
        $this->validate($request, ['provider' => Rule::in(self::$providers)]);
        $githubUser = Socialite::driver($provider)->stateless()->user();
        $user = Usuario::where('provider', $provider)
            ->where('provider_id', $githubUser->getId())->first();
        if ($user === null) {
            return response('usuario inexistente', 401);
        } else {
            $token = \JWTAuth::fromUser($user);
            return response()->json(['token' => $token]);
        }
    }

    /**
     *
     * @return \Illuminate\Http\JsonResponse|Response
     */
    public function getProviders()
    {

        $google = Socialite::driver('google')->stateless();
        $googleConfig = config('services.google');
        return response()->json([
            [
                'name' => 'google',
                'url' => 'https://accounts.google.com/o/oauth2/v2/auth',
                'client' => $googleConfig['client_id'],
                'redirect' => $googleConfig['redirect'],
                'scope' => $google->getScopes()
            ]
        ]);
    }
}
