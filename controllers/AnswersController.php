<?php
/**
 * Created by PhpStorm.
 * User: ataman
 * Date: 05.02.17
 * Time: 13:34
 */

namespace app\controllers;




use app\forms\QuestionForm;
use app\models\Answer;
use app\models\Question;
use app\services\QuestionService;
use Yii;
use yii\base\Module;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\HttpException;

class AnswersController extends Controller
{

    private $questionService;
    
    public function __construct($id, Module $module, QuestionService $questionService, array $config = [])
    {
        $this->questionService = $questionService;
        parent::__construct($id, $module, $config);
    }


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

        $questionForm = new QuestionForm();

        if (!Yii::$app->user->isGuest && $questionForm->load(Yii::$app->request->post()) && $questionForm->validate())
        {
            $this->questionService->addQuestion($answer->id, Yii::$app->user->getId(), $questionForm->body);
            $questionForm = new QuestionForm();
        }

        $questions = $this->questionService->findIsAnswer($answer->id);

        return $this->render('view', [
            'answer' => $answer,
            'questions' => $questions,
            'questionForm' => $questionForm
        ]);
    }
}