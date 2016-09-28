<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TasksSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tasks-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'tasks_type_id')
        ->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\TasksTypes::find()->all(),'id','title'),
            ['prompt' => 'Выберите тип', 'class' => 'form-control', 'onchange'=>'this.form.submit()', 'id' => 'task_type_list']) ?>

    <?php ActiveForm::end(); ?>

</div>
