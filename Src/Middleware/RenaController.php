<?php
namespace Rena\Lib\Middleware;

use Psr\Http\Message\UriInterface;
use Slim\App;

/**
 * Class RenaController
 * @package Rena\Lib\Middleware
 */
abstract class RenaController
{
    // Optional properties
    /**
     * @var App
     */
    protected $app;
    /**
     * @var \Psr\Http\Message\RequestInterface
     */
    protected $request;
    /**
     * @var \Psr\Http\Message\ResponseInterface
     */
    protected $response;

    /**
     * @var \Slim\Container
     */
    private $container;

    /**
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->container = $app->getContainer();
    }

    /**
     * This method allows use to return a callable that calls the action for
     * the route.
     * @param $actionName
     * @return \Closure
     * @internal param string $actionName Name of the action method to call
     */
    public function __invoke($actionName)
    {
        $app = $this->app;
        $controller = $this;

        $callable = function ($request, $response, $args) use ($app, $controller, $actionName) {
            if (method_exists($controller, 'setRequest')) {
                $controller->setRequest($request);
            }
            if (method_exists($controller, 'setResponse')) {
                $controller->setResponse($response);
            }
            if (method_exists($controller, 'init')) {
                $controller->init();
            }

            // store the name of the controller and action so we can assert during tests
            $controllerName = get_class($controller);
            $controllerName = strtolower($controllerName);
            $controllerNameParts = explode('\\', $controllerName);
            $controllerName = array_pop($controllerNameParts);
            preg_match('/(.*)controller$/', $controllerName, $result);
            $controllerName = $result[1];

            // these values will be useful when testing, but not included with the
            // Slim\Http\Response. Instead use SlimMvc\Http\Response
            if (method_exists($response, 'setControllerName')) {
                $response->setControllerName($controllerName);
            }
            if (method_exists($response, 'setActionName')) {
                $response->setActionName($actionName);
            }

            return call_user_func_array(array($controller, $actionName), $args);
        };

        return $callable;
    }

    /**
     * @param $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    /**
     * @param $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }


    /**
     * @param $file
     * @param array $args
     * @param int $status
     * @param string $contentType
     * @return mixed
     */
    protected function render(String $file, $args = array(), int $status = 200, String $contentType = "text/html; charset=UTF-8") {
        // Render the view using the render method
        return $this->container->render->render($file, $args, $status, $contentType, $this->response);
    }

    // @TODO add a fourth that is just called api, which figures out what the user has told you they want (xml / json) and use that as the header)
    // Remember to create a new response, with the new header that the user has requested in $this->requested
    // Something like: $response = $this->response->withHeader($this->requested->getHeader("Content-Type")); and then pass on $response
    /**
     * @param array $args
     * @param int $status
     * @return mixed
     */
    protected function json($args = array(), int $status = 200) {
        return $this->container->render->toJson($args, $status, $this->response);
    }

    /**
     * @param array $args
     * @param int $status
     * @return mixed
     */
    protected function xml($args = array(), int $status = 200) {
        return $this->container->render->toXML($args, $status, $this->response);
    }

    /**
     * Return true if XHR request
     */
    protected function isXhr()
    {
        return $this->request->isXhr();
    }

    /**
     * Get the POST params
     */
    protected function getPost()
    {
        $post = array_diff_key($this->request->getParams(), array_flip(array(
            '_METHOD',
        )));

        return $post;
    }

    /**
     * Get the POST params
     */
    protected function getQueryParams()
    {
        return $this->request->getQueryParams();
    }

    /**
     * Shorthand method to get dependency from container
     * @param $name
     * @return mixed
     */
    protected function get($name)
    {
        return $this->app->getContainer()->get($name);
    }

    /**
     * Redirect.
     *
     * Note: This method is not part of the PSR-7 standard.
     *
     * This method prepares the response object to return an HTTP Redirect
     * response to the client.
     *
     * @param  string|UriInterface $url    The redirect destination.
     * @param  int                 $status The redirect HTTP status code.
     * @return self
     */
    protected function redirect($url, $status = 302)
    {
        return $this->response->withRedirect($url, $status);
    }

    /**
     * Pass on the control to another action. Of the same class (for now)
     *
     * @param  string $actionName The redirect destination.
     * @param array $data
     * @return RenaController
     * @internal param string $status The redirect HTTP status code.
     */
    public function forward($actionName, $data=array())
    {
        // update the action name that was last used
        if (method_exists($this->response, 'setActionName')) {
            $this->response->setActionName($actionName);
        }

        return call_user_func_array(array($this, $actionName), $data);
    }
}
