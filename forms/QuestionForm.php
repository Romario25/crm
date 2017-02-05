<?php
/**
 * Created by PhpStorm.
 * User: ataman
 * Date: 05.02.17
 * Time: 16:56
 */

namespace app\forms;


use yii\base\Model;

class QuestionForm extends Model
{   
    public $body;
    public $answer_id;
    
    public function rules(){
        return [
            [[ 'body'], 'required'],
            
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'body' => 'Ответ'    
        ];
    }
}