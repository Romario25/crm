<?php
/**
 * Created by PhpStorm.
 * User: ataman
 * Date: 05.02.17
 * Time: 13:34
 */

namespace app\controllers;




use app\models\Answer;
use app\models\Question;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\HttpException;

class AnswersController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', ],
                'rules' => [
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    
    
    public function actionIndex(){
        
        $model = Answer::find()->orderBy('id DESC')->all();
        
        return $this->render('index', ['model' => $model]);
    }
    
    public function actionCreate(){
        
        $model = new Answer();
        
        if($model->load(Yii::$app->request->post()) && $model->save()){
            Yii::$app->session->setFlash('success', 'Ваш вопрос добавлен');
            $this->redirect('/answers');
        }
        
        return $this->render('create', ['model' => $model]);
    }

    public function actionView($id){

        $answer = Answer::findOne($id);
        if(is_null($answer)) throw new HttpException(404);

        $questionForm = new Question();
        $questionForm->answer_id = $answer->id;
        if (!Yii::$app->user->isGuest && $questionForm->load(Yii::$app->request->post()) && $questionForm->save())
        {
            $questionForm = new Question();
            $questionForm->answer_id = $answer->id;
        }

        $questions = Question::find()->where('answer_id = :answer_id', [
            ':answer_id' => $answer->id
        ])->all();

        return $this->render('view', [
            'answer' => $answer,
            'questions' => $questions,
            'questionForm' => $questionForm
        ]);
    }
}