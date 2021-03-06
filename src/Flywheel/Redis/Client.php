<?php
namespace Flywheel\Redis;


use Flywheel\Config\ConfigHandler;

class Client {
    /**
     * get Redis Connection instance
     *
     * @param string|array $config the connect name
     *
     * @throws \RedisException
     * @return \Flywheel\Redis\Connection
     */
    public static function getConnection($config = null) {
        if (null == $config || is_string($config)) {
            $c = ConfigHandler::get('redis');
            if (null == $config || !isset($c[$config])) {
                $config = '__default__';
            }

            if (!isset($c[$config])) {
                throw new \RedisException("Connection config not found with '{$config}'");
            }

            $config = $c[$config];
        }

        return Connection::getInstance($config['dsn'], ($config['option'])? $config['option'] : array());
    }
}