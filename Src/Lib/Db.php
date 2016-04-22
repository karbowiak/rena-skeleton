<?php

namespace Rena\Lib;


use Monolog\Logger;
use PDO;

class Db
{
    protected $queryCount = 0;
    protected $queryTime = 0;
    private $pdo;
    private $cache;
    private $logger;
    private $timer;
    private $config;
    public $persistence = true;

    function __construct(Cache $cache, Logger $logger, Timer $timer, Config $config) {
        $this->cache = $cache;
        $this->logger = $logger;
        $this->timer = $timer;
        $this->config = $config;

        if($this->persistence === false)
            $this->cache->persistence = false;

        $host = $config->get("unixSocket", "database") ? ";unix_socket=" . $config->get("unixSocket", "database", "/var/run/mysqld/mysqld.sock") : ";host=" . $config->get("host", "database", "127.0.0.1");
        $dsn = "mysql:dbname=" . $config->get("name", "database") . "{$host};charset=utf8";

        try {
            $this->pdo = new PDO($dsn, $config->get("username", "database"), $config->get("password", "database"), array(
                PDO::ATTR_PERSISTENT => $this->persistence,
                PDO::ATTR_EMULATE_PREPARES => $config->get('emulatePrepares', 'database'),
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => $config->get('useBufferedQuery', 'database', true),
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET time_zone = '+00:00',NAMES utf8;",
            ));
        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}