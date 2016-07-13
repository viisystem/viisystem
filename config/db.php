<?php
$host = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '';
$ssh = gethostbyname(gethostname());
$mongodb = '';
if (in_array($host, ['demo.com'])) {
    $mongodb = 'mongodb://localhost:27017/demo';
} else {
    $mongodb = 'mongodb://localhost:27017/default';
}

return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=mydatabase', // MySQL, MariaDB
            //'dsn' => 'sqlite:/path/to/database/file', // SQLite
            //'dsn' => 'pgsql:host=localhost;port=5432;dbname=mydatabase', // PostgreSQL
            //'dsn' => 'cubrid:dbname=demodb;host=localhost;port=33000', // CUBRID
            //'dsn' => 'sqlsrv:Server=localhost;Database=mydatabase', // MS SQL Server, sqlsrv driver
            //'dsn' => 'dblib:host=localhost;dbname=mydatabase', // MS SQL Server, dblib driver
            //'dsn' => 'mssql:host=localhost;dbname=mydatabase', // MS SQL Server, mssql driver
            //'dsn' => 'oci:dbname=//localhost:1521/mydatabase', // Oracle
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'tablePrefix' => '',
            'enableSchemaCache' => true,
            'schemaCacheDuration' => 3600,
            'schemaCache' => 'cache',
        ],
        'mongodb' => [
            'class' => '\yii\mongodb\Connection',
            'dsn' => $mongodb,
        ],
    ],
];
