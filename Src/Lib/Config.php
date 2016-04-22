<?php

namespace Rena\Lib;


/**
 * Class Config
 * @package Rena\Lib
 */
class Config
{
    /**
     * @var array|mixed
     */
    private $settings = array();

    /**
     * Config constructor.
     */
    function __construct() {
        $this->settings = require(BASEDIR . "/Config/Config.php");
    }

    /**
     * @param $key
     * @param null $type
     * @param null $default
     * @return null
     */
    public function get($key, $type = null, $default = null) {
        if(!empty($this->settings[$type][$key]))
            return $this->settings[$type][$key];
        return $default;
    }

    /**
     * @param null $type
     * @return array|mixed
     */
    public function getAll($type = null) {
        if(!empty($this->settings[$type]))
            return $this->settings[$type];
        return array();
    }
}