<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;

$this->title = 'Задать вопрос';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1>Ответы на вопрос : <?= $answer->id ?></h1>

    <p>
        <?= Html::encode($answer->body); ?>
    </p>


    <?php Pjax::begin(['id' => 'questions']) ?>
        <?php foreach($questions as $question): ?>
            <div>
                <?= Html::encode($question->body) ?>    
            </div>
            <div>
                <?= $question->created_at ?> | <?= $question->user->name ?>
            </div>
            <br><br>
        <?php endforeach; ?>
    <?php Pjax::end() ?>


   <?php if(!Yii::$app->user->isGuest): ?>

        <?php
        $this->registerJs(
            '$("document").ready(function(){
                $("#new_question").on("pjax:end", function() {
                    $.pjax.reload({container:"#questions"}); 
                });
            });'
        );
        ?>

        <div class="notes-form">
            <?php yii\widgets\Pjax::begin(['id' => 'new_question']) ?>
            <?php if(Yii::$app->session->hasFlash('error')): ?>
                <div class="alert alert-danger">
                    <?= Yii::$app->session->get('error') ?>
                </div>
            <?php endif; ?>
            <?php if(Yii::$app->session->hasFlash('success')): ?>
                <div class="alert alert-success">
                    <?= Yii::$app->session->get('success') ?>
                </div>
            <?php endif; ?>
            <?php $form = ActiveForm::begin([ 'options' => ['data-pjax' => true]]); ?>

            <?= $form->field($questionForm, 'body')->textarea(['rows' => 6]) ?>

            <div class="form-group">
                <?= Html::submitButton("Ответ", ['class' =>  'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
            <?php Pjax::end(); ?>

        </div>
    <?php else: ?>
       <div>
           Для того, чтобы ответить на вопрос <?= Html::a('авторизируйтесь', ['/site/login']); ?>
       </div>
    <?php endif; ?>

</div>
