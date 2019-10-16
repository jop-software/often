<?php

namespace App\Models;

use Base;
use Prefab;
use DB\SQL;
use DB\SQL\Mapper;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

class BaseModel extends Prefab {

    /**
     * @var Base; 
     */
    protected $f3;

    /**
     * @var \DB\SQL
     */
    protected $sql;

    /**
     * @var \Doctrine\DBAL\Connection
     */
    protected $connection;

    public function __construct()
    {
        // Load FatFree instance
        $this->f3 = Base::instance();

        // Initiate doctrine connection
        $this->connection = DriverManager::getConnection([
            "host" => $this->f3->get("DB.HOSTNAME"),
            "user" => $this->f3->get("DB.USERNAME"),
            "password" => $this->f3->get("DB.PASSWORD"),
            "dbname" => $this->f3->get("DB.NAME"),
            "driver" => $this->f3->get("DB.DRIVER"),
        ]);
    }

    /**
     * get a new \DB\SQL\Mapper instance with the given tablename
     * 
     * @param string $tablename
     * @return \DB\SQL\Mapper
     */
    public function getMapper(string $tableName) {
        $mapper = new Mapper($this->sql, $tableName);
        return $mapper;
    }

    /**
     * return fresh instance of the doctrine query builder
     * 
     * @return \Doctrine\DBAL\Query\QueryBuilder
     */
    public function getQueryBuilder() {
        return $this->connection->createQueryBuilder();
    }

}