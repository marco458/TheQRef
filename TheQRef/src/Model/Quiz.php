<?php


namespace Model;


class Quiz
{
    public function __construct() {
    }

    public function insert($userId,$quizName,$quizDesc,$quizQ,$isPublic,$comments) :void{
        $baza = new DBPool();
        $object = $baza->getInstance();

        $sql = <<<'SQL'
                INSERT INTO quiz (UserId,QuizName,QuizDescription,QuizQuestions,isPublic,enableComments)
                VALUES ((:id),(:name),(:desc),(:ques),(:public),(:comm))
        SQL;
        $stmt = $object->prepare($sql);
        $stmt->execute([":id"=>$userId,":name"=>$quizName, ":desc"=>$quizDesc,":ques"=>$quizQ,
            ":public"=>$isPublic, ":comm"=>$comments]);
        return;
    }

    public function getQuiz($userId):array {
        $baza = new DBPool();
        $object = $baza->getInstance();

        $sql = <<<'SQL'
                SELECT *
                FROM quiz
                WHERE UserId = (:userId)
        SQL;
        $stmt = $object->prepare($sql);
        $stmt->execute([":userId"=>$userId,]);
        $map = [];
        foreach ($stmt as $row)  {
            array_push($map,$row);
        }
        return $map;
    }

    public function getAll($userId) :array {
        $baza = new DBPool();
        $object = $baza->getInstance();

        $sql = <<<'SQL'
                SELECT *
                FROM quiz
                WHERE UserId <> (:userId)
        SQL;
        $stmt = $object->prepare($sql);
        $stmt->execute([":userId"=>$userId]);
        $map = [];
        foreach ($stmt as $row)  {
            array_push($map,$row);
        }
        return $map;
    }

    public function getQuizWithID($quizId) :array {
        $baza = new DBPool();
        $object = $baza->getInstance();

        $sql = <<<'SQL'
                SELECT *
                FROM quiz
                WHERE QuizId = (:quizId)
        SQL;
        $stmt = $object->prepare($sql);
        $stmt->execute([":quizId"=>$quizId]);
        $map = [];
        foreach ($stmt as $row)  {
            array_push($map,$row);
        }
        return $map;
    }

    public function public($quizId) :bool {
        $baza = new DBPool();
        $object = $baza->getInstance();

        $sql = <<<'SQL'
                SELECT *
                FROM quiz
                WHERE QuizId = (:quizId)
        SQL;
        $stmt = $object->prepare($sql);
        $stmt->execute([":quizId"=>$quizId]);
        $map = [];
        foreach ($stmt as $row)  {
            if($row["isPublic"] == 1) {
                return true;
            }
        }
        return false;
    }

    public function update($quizId,$quizDesc,$quizQuestions,$isPublic,$enableComm) :void {
        $baza = new DBPool();
        $object = $baza->getInstance();

        $sql = <<<'SQL'
                UPDATE quiz
                SET QuizDescription = (:desc),
                    QuizQuestions = (:quizQuestions),
                isPublic = (:isPublic),
                enableComments = (:enableComm)
                WHERE QuizId = (:quizId)
        SQL;
        $stmt = $object->prepare($sql);
        $stmt->execute([":desc"=>$quizDesc,":quizId"=>$quizId,":quizQuestions"=>$quizQuestions,":isPublic"=>$isPublic,":enableComm"=>$enableComm]);
    }

    public function deleteQuiz($quizId) :void {
        $baza = new DBPool();
        $object = $baza->getInstance();

        $sql = <<<'SQL'
                DELETE
                FROM quiz
                WHERE QuizId = (:quizId)
        SQL;
        $stmt = $object->prepare($sql);
        $stmt->execute([":quizId"=>$quizId]);
    }


    public function getStatistics() {
        $baza = new DBPool();
        $object = $baza->getInstance();

        $sql = <<<'SQL'
                SELECT quiz.UserId as id,quiz.QuizName as name,MIN(Score) as min,
                MAX(Score) as max,
                AVG(Score) as avg,
                STDDEV(Score) as std
                FROM score join quiz
                    on score.QuizId = quiz.QuizId
                GROUP BY score.QuizId
        SQL;
        $stmt = $object->prepare($sql);
        $stmt->execute([]);
        $map = [];
        foreach ($stmt as $row)  {
           array_push($map,$row);
        }
        return $map;
    }

}