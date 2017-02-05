<?php
/**
 * Created by PhpStorm.
 * User: ataman
 * Date: 05.02.17
 * Time: 17:11
 */

namespace app\services;


use app\models\Question;
use app\repositories\QuestionRepositoryInterface;
use Yii;


class QuestionService
{
    private $questionRepository;
    
    public function __construct(QuestionRepositoryInterface $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    /**
     * Сервис сохраняет ответ
     * 
     * @param integer $answer_id
     * @param integer $user_id
     * @param string $body
     * 
     * @throws \Exception
     */
    public function addQuestion($answer_id, $user_id, $body){

        try{
            $question = new Question();
            $question->answer_id = $answer_id;
            $question->user_id = $user_id;
            $question->body = $body;

            if($this->questionRepository->add($question)){
                Yii::$app->session->setFlash('success', "Ответ удачно добавлен");
            } else {
                Yii::$app->session->setFlash('error', "Произошла внутреняя ошибка");
                Yii::error("Произошла внутреняя ошибка");
            }    
        } catch (\Exception $e){
            Yii::$app->session->setFlash('error', "Произошла внутреняя ошибка");
            Yii::error("Произошла внутреняя ошибка : ".$e->getMessage());
        }
        
        
    }

    /**
     * Выдача ответов определенного вопроса
     * 
     * @param integer $answer_id
     * @return object
     */
    public function findIsAnswer($answer_id){
        return $this->questionRepository->findIsAnswer($answer_id);
    }
}