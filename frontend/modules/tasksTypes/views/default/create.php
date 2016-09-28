<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TasksTypes */

$this->title = 'Новый тип';
$this->params['breadcrumbs'][] = ['label' => 'Список типов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-types-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
