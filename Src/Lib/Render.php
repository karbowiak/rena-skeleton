<?php

namespace Rena\Lib;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Slim\Views\Twig;
use XMLParser\XMLParser;
use Zend\Diactoros\Response;

/**
 * Class Render
 * @package Rena\Lib
 */
class Render
{
    /**
     * @var Twig
     */
    private $view;

    /**
     * Render constructor.
     * @param Twig $twig
     */
    public function __construct(Twig $twig)
    {
        $this->view = $twig;
    }

    /**
     * @param String $templateFile
     * @param array $dataArray
     * @param int|null $status
     * @param String|null $contentType
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function render(String $templateFile, $dataArray = array(), int $status = null, String $contentType = null, ResponseInterface $response)
    {
        $contentType = $response->getHeader("Content-Type");
        if ($contentType)
            $contentType = $contentType;

        // Run the scrapeCheck
        $this->scrapeChecker();

        if ($contentType == "application/json")
            return $this->toJson($dataArray, $status, $response);
        if ($contentType == "application/xml")
            return $this->toXML($dataArray, $status, $response);

        return $this->toTwig($templateFile, $dataArray, $response);
    }

    /**
     *
     */
    private function scrapeChecker()
    {

    }

    /**
     * @param array $dataArray
     * @param int $status
     * @param ResponseInterface $response
     * @return mixed
     */
    public function toJson($dataArray = array(), int $status = 200, ResponseInterface $response)
    {
        return $response->withStatus($status)
            ->withHeader("Content-Type", "application/json")
            ->withAddedHeader("Access-Control-Allow-Origin", "*")
            ->withAddedHeader("Access-Control-Allow-Methods", "GET, POST")
            ->write(json_encode($dataArray));
    }

    /**
     * @param array $dataArray
     * @param int $status
     * @param ResponseInterface $response
     * @return mixed
     */
    public function toXML($dataArray = array(), int $status = 200, ResponseInterface $response)
    {
        return $response->withStatus($status)
            ->withHeader("Content-Type", "application/xml")
            ->withAddedHeader("Access-Control-Allow-Origin", "*")
            ->withAddedHeader("Access-Control-Allow-Methods", "GET, POST")
            ->write(XMLParser::encode($dataArray, "rena"));
    }

    /**
     * @param String $templateFile
     * @param array $dataArray
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function toTwig(String $templateFile, $dataArray = array(), ResponseInterface $response)
    {
        // Get all the character information on the guy who is logged in

        // Create an array of extra data to pass along
        $extraData = array();

        // Merge the arrays
        $dataArray = array_merge($extraData, $dataArray);

        // Render the view
        return $this->view->render($response, $templateFile, $dataArray);
    }
}