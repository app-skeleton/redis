<?php defined('SYSPATH') or die('No direct script access.');
/*
 * @package		Redis Module
 * @author      Pap Tamas
 * @copyright   (c) 2011-2013 Pap Tamas
 * @website		https://bitbucket.org/paptamas/kohana-redis
 * @license		http://www.opensource.org/licenses/isc-license.txt
 *
 */

class Kohana_Redis_Client {

    /**
     * @var Redis_Client    A singleton instance
     */
    protected static $_instance;

    /**
     * @var Redis           A Redis instance
     */
    protected $_redis;

    /**
     * Construct
     *
     * @param   string  $redis_group
     * @throws  Redis_Exception
     */
    protected function __construct($redis_group = 'default')
    {
        // Get the config array
        $config = Kohana::$config->load('redis')->get($redis_group);

        // Init the redis client
        $this->_redis = new Redis();

        try
        {
            $connected = $config['connection']['persistent']
                ? $this->_redis->connect($config['connection']['hostname'], $config['connection']['port'])
                : $this->_redis->pconnect($config['connection']['hostname'], $config['connection']['port']);
        }
        catch (RedisException $e)
        {
            $connected = FALSE;
        }


        if ( ! $connected)
        {
            throw new Redis_Exception('Can not connect to redis server.');
        }

        if ($config['connection']['password'] && ! $this->_redis->auth($config['connection']['password']))
        {
            throw new Redis_Exception('Can not authenticate the connection to redis server.');
        }
    }

    /**
     * Returns a singleton instance of the class
     *
     * @return  Redis_Client
     */
    public static function instance()
    {
        if ( ! Redis_Client::$_instance instanceof Redis_Client)
        {
            Redis_Client::$_instance = new Redis_Client();
        }

        return Redis_Client::$_instance->_redis;
    }
}

// END Kohana_Redis_Client
