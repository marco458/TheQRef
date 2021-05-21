<?php

namespace Model;

class User {

    public function __construct() {
    }

    public function insert($name,$surname,$date,$email,$password) :void{
        $baza = new DBPool();
        $object = $baza->getInstance();

        $sql = <<<'SQL'
                INSERT INTO user (Name,Surname,DateOfBirth,Email,Password)
                VALUES ((:name),(:surname),(:date),(:email),(:password))
        SQL;
        $stmt = $object->prepare($sql);
        $stmt->execute([":name"=>$name,":surname"=>$surname,
            ":date"=>$date,":email"=>$email,":password"=>$password]);
    }

    public function userExists($email) :bool {
        $baza = new DBPool();
        $object = $baza->getInstance();
        $sql = <<<'SQL'
                SELECT *
                FROM user
                WHERE Email = (:email)
        SQL;
        $stmt = $object->prepare($sql);
        $stmt->execute([":email"=>$email]);

        foreach ($stmt as $row) {
            if($row != null) {
                return true;
            }
        }
        return false;
    }

    public function getPassword($userId): string {
        $baza = new DBPool();
        $object = $baza->getInstance();
        $sql = <<<'SQL'
                SELECT *
                FROM user
                WHERE UserId = (:userId)
        SQL;
        $stmt = $object->prepare($sql);
        $stmt->execute([":userId"=>$userId]);

        foreach ($stmt as $row) {
            if($row != null) {
                return $row["Password"];
            }
        }
        return "";
    }

    public function deleteUser($userId):void {
        $baza = new DBPool();
        $object = $baza->getInstance();
        $sql = <<<'SQL'
                DELETE FROM user
                WHERE UserId = (:userId)
        SQL;
        $stmt = $object->prepare($sql);
        $stmt->execute([":userId"=>$userId]);
    }

    public function getInfo($userId): array {
        $baza = new DBPool();
        $object = $baza->getInstance();
        $sql = <<<'SQL'
                SELECT *
                FROM user
                WHERE UserId = (:userId)
        SQL;
        $stmt = $object->prepare($sql);
        $stmt->execute([":userId"=>$userId]);
        $return = [];
        foreach ($stmt as $row) {
            array_push($return,$row["Name"]);
            array_push($return,$row["Surname"]);
            array_push($return,$row["DateOfBirth"]);
            array_push($return,$row["Email"]);
            array_push($return,$row["Password"]);
            return $return;
        }
    }

    public function getInfoWithId($userId): array {
        $baza = new DBPool();
        $object = $baza->getInstance();
        $sql = <<<'SQL'
                SELECT *
                FROM user
                WHERE UserId = (:userId)
        SQL;
        $stmt = $object->prepare($sql);
        $stmt->execute([":userId"=>$userId]);
        $return = [];
        foreach ($stmt as $row) {
            array_push($return,$row["UserId"]);
            array_push($return,$row["Name"]);
            array_push($return,$row["Surname"]);
            array_push($return,$row["DateOfBirth"]);
            array_push($return,$row["Email"]);
            array_push($return,$row["Password"]);
            return $return;
        }
    }

    public function changePassword($userId,$newPassword):void {
        $baza = new DBPool();
        $object = $baza->getInstance();
        $sql = <<<'SQL'
                UPDATE user 
                SET Password = (:newPassword)
                WHERE UserId = (:userId)
        SQL;
        $stmt = $object->prepare($sql);
        $stmt->execute([":userId"=>$userId,":newPassword"=>$newPassword]);
    }

    public function getIdFromEmail($email): int {
        $baza = new DBPool();
        $object = $baza->getInstance();
        $sql = <<<'SQL'
                SELECT *
                FROM user
                WHERE Email = (:email)
        SQL;
        $stmt = $object->prepare($sql);
        $stmt->execute([":email"=>$email]);

        foreach ($stmt as $row) {
            if($row != null) {
                return $row["UserId"];
            }
        }
        return -1;
    }

}