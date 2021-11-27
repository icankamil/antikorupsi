<?php

namespace App\AuthPortal\Controller;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class AuthPortalController
{
    public $model;

    public function auth(Request $request)
    {
        if ($request->query->get('token') != null) {
            $token_payload = JWT::decode($request->query->get('payload'), new Key($_ENV['JWT_SECRET'], 'HS256'));

            if (empty($token_payload->roles)) {
                return new RedirectResponse($_ENV['PORTAL_URL']);
            }

            $session = [
                'idUser' => $token_payload->user->id,
                'namaUser' => $token_payload->user->name,
                'email' => $token_payload->user->email,
                'role' => $token_payload->roles
            ];

            foreach ($session as $key => $value) {
                $request->getSession()->set($key, $value);
            }

            return new RedirectResponse('/');
        }

        return new RedirectResponse($_ENV['APP_PORTAL_URL']);
    }

    public function logout(Request $request)
    {
        $request->getSession()->invalidate();

        return new RedirectResponse($_ENV['PORTAL_URL'] . '/app/logout');
    }
}
