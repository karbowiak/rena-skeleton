<?php

namespace Rena\Lib;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Views\Twig;
use XMLParser\XMLParser;

class Render {
    protected $contentType;
    private $response;
    private $request;
    private $view;

    public function __construct(Twig $twig, RequestInterface $request, ResponseInterface $response) {
        $this->view = $twig;
        $this->contentType = $request->getContentType();
        $this->response = $response;
        $this->request = $request;
        //$twig->render($response, $template, $data);
    }

    public function render(String $templateFile, $dataArray = array(), int $status = null, String $contentType = null) {
        if($contentType)
            $this->contentType = $contentType;

        // Run the scrapeCheck
        $this->scrapeChecker();

        if($this->contentType == "application/json")
            return $this->toJson($dataArray, $status);
        if($this->contentType == "application/xml")
            return $this->toXML($dataArray, $status);

        return $this->toTwig($templateFile, $dataArray);
    }

    public function toJson($dataArray = array(), int $status = 200) {
        return $this->response->withStatus($status)
            ->withHeader("Content-Type", "application/json")
            ->withAddedHeader("Access-Control-Allow-Origin", "*")
            ->withAddedHeader("Access-Control-Allow-Methods", "GET, POST")
            ->write(json_encode($dataArray));
    }

    public function toXML($dataArray = array(), int $status = 200) {
        return $this->response->withStatus($status)
            ->withHeader("Content-Type", "application/xml")
            ->withAddedHeader("Access-Control-Allow-Origin", "*")
            ->withAddedHeader("Access-Control-Allow-Methods", "GET, POST")
            ->write(XMLParser::encode($dataArray, "rena"));
    }

    public function toTwig(String $templateFile, $dataArray = array()) {
        // Get all the character information on the guy who is logged in

        // Create an array of extra data to pass along
        $extraData = array(
        );

        // Merge the arrays
        $dataArray = array_merge($extraData, $dataArray);

        // Render the view
        return $this->view->render($this->response, $templateFile, $dataArray);
    }

    private function scrapeChecker() {

    }
}