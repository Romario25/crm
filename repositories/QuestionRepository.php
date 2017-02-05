<?php
/**
 * Created by PhpStorm.
 * User: ataman
 * Date: 05.02.17
 * Time: 17:01
 */

namespace app\repositories;


use app\models\Question;
use yii\base\Model;


class QuestionRepository  implements QuestionRepositoryInterface
{

    /**
     * Добавление записи в бд
     *
     * @param Model $question
     * @return boolean
     */
    public function add(Model $question)
    {
        // TODO: Implement add() method.
        if(!$question->isNewRecord){
            throw new \InvalidArgumentException();
        }
        return $question->insert(false);
    }


    /**
     * Вывод записи по id
     *
     * @param integer $id
     * @return object
     *
     * @throws \InvalidArgumentException
     */
    public function find($id)
    {
        $question = Question::findOne($id);
        if($question == null){
            throw new \InvalidArgumentException();
        }

        return $question;
    }


    /**
     * Вывод ответов конктретног вопроса
     *
     * @param integer $answer_id
     * @return object
     */
    public function findIsAnswer($answer_id)
    {
        $questions = Question::find()->where('answer_id = :answer_id', [
            ':answer_id' => $answer_id
        ])->all();

        return $questions;
    }


    public function save(Model $question)
    {
        if($question->isNewRecord){
            throw new \InvalidArgumentException();
        }
        $question->update(false);
    }
}