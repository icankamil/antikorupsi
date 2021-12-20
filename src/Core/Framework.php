<?php

namespace Core;

use Core\Classes\SessionData;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\HttpKernel;

class Framework extends HttpKernel implements HttpKernelInterface
{
    private $matcher;
    private $controllerResolver;
    private $argumentResolver;

    public function __construct(UrlMatcher $matcher, ControllerResolver $controllerResolver, ArgumentResolver $argumentResolver)
    {
        $this->matcher = $matcher;
        $this->controllerResolver = $controllerResolver;
        $this->argumentResolver = $argumentResolver;
    }

    public function handle(
        Request $request,
        $type = HttpKernelInterface::MASTER_REQUEST,
        $catch = true
    ) {
        $this->matcher->getContext()->fromRequest($request);
        $pathInfo = $request->getPathInfo();

        // Start the session
        SessionData::start();
        $request->setSession(SessionData::get());

        // !!!! Overriding Core Framework !!!!

        // $base_url = ($_SERVER['SERVER_PROTOCOL'] == 'HTTP/1.1' ? 'http' : 'https') . '://' . $_SERVER['HTTP_HOST'];

        // if (strpos($pathInfo, '/admin') !== false) {
        //     if (empty($request->getSession()->all()) && !($pathInfo == '/auth/check' && $request->query->get('token') != null)) {
        //         return new RedirectResponse($_ENV['PORTAL_URL'].'/app/find?url='.$base_url);
        //     }

        //     if (!empty($request->getSession()->all())) {
        //         $token = $request->getSession()->get('token');
        //         $request->getSession()->set('token', $token);
        //         $auth = callAPI('GET', $_ENV['PORTAL_URL'] . '/api/auth/profile', [], 'Authorization: Bearer ' . $token);
        //         if ($auth == null) {
        //             $request->getSession()->invalidate();
        //             return new RedirectResponse($_ENV['PORTAL_URL'].'/app/find?url='.$base_url);
        //         }
        //     }
        // }

        // -----------------------------------

        $GLOBALS['url'] = $pathInfo;

        try {
            $request->attributes->add($this->matcher->match($pathInfo));

            $controller = $this->controllerResolver->getController($request);
            $arguments = $this->argumentResolver->getArguments($request, $controller);

            return call_user_func_array($controller, $arguments);
        } catch (ResourceNotFoundException $exception) {
            return new Response('Not Found', 404);
        } catch (\Exception $exception) {
            return new Response('' . $exception, 500);
        }
    }
}
