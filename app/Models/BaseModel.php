<?php

namespace App\Models;

use Base;
use Prefab;
use DB\SQL;
use DB\SQL\Mapper;

class BaseModel extends Prefab {

    /**
     * @var Base; 
     */
    protected $f3;

    /**
     * @var \DB\SQL
     */
    protected $sql;

    public function __construct()
    {
        // Load FatFree instance
        $this->f3 = Base::instance();

        // Load credentials form database
        $host = $this->f3->get("DB.HOSTNAME");
        $port = $this->f3->get("DB.PORT");
        $name = $this->f3->get("DB.NAME");
        $user = $this->f3->get("DB.USERNAME");
        $pass = $this->f3->get("DB.PASSWORD");

        // Initiate the SQL connection
        $this->sql = new SQL(
            "mysql:host=$host;dbname=$name;port=$port",
            $user, $pass
        );
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

}