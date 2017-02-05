<?php
use yii\helpers\Html;
use yii\helpers\StringHelper;

?>
<div class="site-login">
    <h1>Вопросы</h1>
    <?php if(Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success">
            <?= Yii::$app->session->get('success'); ?>
        </div>
    <?php endif; ?>
    <p>
        <?= Html::a('Создать вопрос', ['/answers/create'], ['class'=>'btn btn-success']); ?>
    </p>

    
    <div class="container">

        <?php foreach ($model as $item): ?>

            <div class="row">
                <?= Html::a(StringHelper::truncate($item->body, 25), ['/answers/view', 'id' => $item->id]) ?>
                <br>
                <?= $item->created_at ?> - <?= $item->user->name ?>
            </div>
            <br><br>
        <?php endforeach; ?>
    </div>

</div>