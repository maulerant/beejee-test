<?php

namespace BeeJee\Components;

use PDO;

class DataSource
{
    /** @var PDO */
    protected static $ds = null;

    private function __construct()
    {
    }

    /**
     * @param $options
     * @return PDO
     * @throws \Exception
     */
    public static function init($options)
    {
        return self::getInstance($options);
    }

    /**
     * @param $options
     * @return string
     */
    public static function getDNS($options)
    {
        return $options['database']['driver'] . ':host=' . $options['database']['host'] . ((!empty($options['database']['port'])) ? (';port=' . $options['database']['port']) : '') . ';dbname=' . $options['database']['base'];
    }

    /**
     * @param array $options
     * @return PDO
     * @throws \Exception
     */
    public static function getInstance($options = [])
    {
        if (self::$ds === null) {
            if (empty($options['database']['base'] || empty($options['database']['user'] || $options['database']['password']))) {
                throw new \Exception('Database connection not configured');
            }
            self::$ds = new PDO(self::getDNS($options), $options['database']['user'], $options['database']['password']);
        }
        return self::$ds;
    }
}