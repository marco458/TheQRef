<?php

namespace Model;

class DBPool {

    private static $pdo;

    public static function getInstance() {
        if(self::$pdo === null) {
            try {
                $dsn = 'mysql:dbname=theqref;'
                    . 'host=localhost;charset=utf8';

                self::$pdo = new \PDO(
                    $dsn,
                    'root',
                    '',
                    [
                        \PDO::ATTR_DEFAULT_FETCH_MODE =>
                            \PDO::FETCH_ASSOC,
                        \PDO::ATTR_ERRMODE =>
                            \PDO::ERRMODE_EXCEPTION
                    ]
                );

            } catch (\PDOException $e) {
                throw $e;
            }
        }
        return self::$pdo;
    }

}


