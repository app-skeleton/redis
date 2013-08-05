<?php defined('SYSPATH') OR die('No direct access allowed.');

return array
(
    'default' => array
    (
        'connection' => array(
            /**
             * The following options are available:
             *
             * string   hostname    server hostname,
             * string   port        server port
             * string   password    server password
             * boolean  persistent  use persistent connections?
             *
             */
            'hostname'   => '127.0.0.1',
            'port'       => 6379,
            'password'   => FALSE,
            'persistent' => FALSE,
        )
    )
);
