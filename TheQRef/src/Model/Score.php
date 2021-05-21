<?php


namespace Model;


class Score
{

    public function __construct() {

    }


    public function insert($quizId,$userId,$score,$comment) :void {
        $baza = new DBPool();
        $object = $baza->getInstance();

        $sql = <<<'SQL'
                INSERT INTO score (QuizId,UserId,Score,Comment)
                VALUES ((:quizId),(:userId),(:score),(:comment))
        SQL;
        $stmt = $object->prepare($sql);
        $stmt->execute([":quizId"=>$quizId,":userId"=>$userId, ":score"=>$score,":comment"=>$comment,]);
        return;
    }

    public function update($comment) :void {
        $baza = new DBPool();
        $object = $baza->getInstance();

        $sql = <<<'SQL'
                UPDATE score
                SET Comment = (:comm)
                WHERE UniqueQuizAttempt = (SELECT MAX(UniqueQuizAttempt)
                                            FROM score)
        SQL;
        $stmt = $object->prepare($sql);
        $stmt->execute([":comm"=>$comment]);
        return;
    }

    public function getComments($quizId):array {
        $baza = new DBPool();
        $object = $baza->getInstance();

        $sql = <<<'SQL'
                SELECT * FROM score
                WHERE QuizId = (:quizId)
        SQL;
        $stmt = $object->prepare($sql);
        $stmt->execute([":quizId"=>$quizId]);
        $rows = [];
        foreach ($stmt as $row) {
            array_push($rows,$row);
        }
        return $rows;
    }

    public function getDataForAccountView($userId):array {
        $baza = new DBPool();
        $object = $baza->getInstance();

        $sql = <<<'SQL'
                SELECT quiz.QuizName,COUNT(*) as Attempts, ROUND(AVG(Score),2) as Score
                FROM score join user
                    ON score.UserId = user.UserId 
                join quiz
                    ON score.QuizId = quiz.QuizId
                WHERE score.UserId = (:userId)
                GROUP BY score.QuizId
        SQL;
        $stmt = $object->prepare($sql);
        $stmt->execute([":userId"=>$userId]);
        $rows = [];
        foreach ($stmt as $row) {
            array_push($rows,$row);
        }
        return $rows;
    }




}