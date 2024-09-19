<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_CONNECTION', 'pgsql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            'url' => env('DATABASE_URL'),
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
        ],

        /*'mysql' => [
            'driver' => 'mysql',
            'host' => '127.0.0.1',
            'port' => '3306',
            'database' => 'portal',
            'username' => 'root',
            'password' =>  '',
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],*/
/*
        'pgsql' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', 'http://10.98.32.42'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'portal_prod'),
            'username' => env('DB_USERNAME', 'postgres'),
            'password' => env('DB_PASSWORD', 'ps_PortalPlansul'),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],
*/

        'pgsql' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', 'http://10.98.32.42'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'portal_dev'),
            'username' => env('DB_USERNAME', 'usr_portal'),
            'password' => env('DB_PASSWORD', 'ps_PortalPlansul'),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'bd_rh_rs' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', 'http://172.10.20.47'),
            'port' => env('DB_PORT', '5432'),
            'database' => 'bd_rh_rs',
            'username' => env('DB_USERNAME', 'usr_portal'),
            'password' => env('DB_PASSWORD', 'ps_PortalPlansul'),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'bd_planejamento' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', 'http://10.98.32.42'),
            'port' => env('DB_PORT', '5432'),
            'database' => 'bd_planejamento',
            'username' => env('DB_USERNAME', 'usr_portal'),
            'password' => env('DB_PASSWORD', 'ps_PortalPlansul'),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],


        'bd_controle_pessoal' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', 'http://10.98.32.42'),
            'port' => env('DB_PORT', '5432'),
            'database' => 'bd_controle_pessoal',
            'username' => env('DB_USERNAME', 'usr_portal'),
            'password' => env('DB_PASSWORD', 'ps_PortalPlansul'),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'bd_qualidade' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', 'http://10.98.32.42'),
            'port' => env('DB_PORT', '5432'),
            'database' => 'bd_qualidade',
            'username' => env('DB_USERNAME', 'usr_dblink'),
            'password' => env('DB_PASSWORD', 'ps_PortalPlansul'),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],


        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'host'  => 'RJ7399SR014',
            'database' =>  'BD_PLANSUL',
            'username' => 'USR_PLANSUL',
            'password' =>  '<C@i*apl@n5ul>',
            'charset' => 'utf8',
            'prefix' => '',
        ],
	    'sqlSISTRAF' => [
            'driver' => 'sqlsrv',
            'host'  => 'RJ7399SR014',
            'database' =>  'BD_PLANSUL_SISTRAF',
			//'database' => 'TESTE',
            'username' => 'USR_PLANSUL',
            'password' =>  '<C@i*apl@n5ul>',
			//'password' => 'indefinido',
            'charset' => 'utf8',
            'prefix' => '',
        ],
	    'sqlatc' => [
            'driver' => 'sqlsrv',
            'host'  => 'RJ7399SR014',
            'database' =>  'DB_ATC_2019',
            'username' => 'USR_PLANSUL',
            'password' =>  '<C@i*apl@n5ul>',
            'charset' => 'utf8',
            'prefix' => '',
        ],

		'delgrande' => [
			'driver' => 'pgsql',
			'url' => env('DATABASE_URL'),
			'host' => env('DB_HOST', 'http://10.98.32.42'),
			'port' => env('DB_PORT', '5432'),
			'database' => 'delgrande',
			'username' => env('DB_USERNAME', 'usr_portal'),
			'password' => env('DB_PASSWORD', 'ps_PortalPlansul'),
			'charset' => 'utf8',
			'prefix' => '',
			'prefix_indexes' => true,
			'schema' => 'public',
			'sslmode' => 'prefer',
		],

		'trafego' => [
			'driver' => 'pgsql',
			'url' => env('DATABASE_URL'),
			'host' => env('DB_HOST', 'http://10.98.32.42'),
			'port' => env('DB_PORT', '5432'),
			'database' => 'bd_trafego',
			'username' => env('DB_USERNAME', 'usr_portal'),
			'password' => env('DB_PASSWORD', 'ps_PortalPlansul'),
			'charset' => 'utf8',
			'prefix' => '',
			'prefix_indexes' => true,
			'schema' => 'public',
			'sslmode' => 'prefer',
		],

        'srvdac' => [
            'driver' => 'sqlsrv',
            'host'  => 'DF7436SR496 ',
            'database' =>  'BD_CONTROLE_PESSOAL',
            'username' => 's517101',
            'password' =>  '517101',
            'charset' => 'utf8',
            'prefix' => '',
        ]

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer body of commands than a typical key-value system
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'client' => env('REDIS_CLIENT', 'phpredis'),

        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            'prefix' => env('REDIS_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_').'_database_'),
        ],

        'default' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => env('REDIS_DB', 0),
        ],

        'cache' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => env('REDIS_CACHE_DB', 1),
        ],

    ],

];
