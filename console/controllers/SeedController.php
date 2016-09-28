<?php
namespace console\controllers;

use common\models\Tasks;
use common\models\TasksTypes;
use Yii;
use common\models\User;
use yii\console\Controller;

class SeedController extends Controller
{
    public function actionIndex()
    {
        User::deleteAll();
        Tasks::deleteAll();
        TasksTypes::deleteAll();

        $faker = \Faker\Factory::create();

        $user = new User();
        $user->email = $faker->email;
        $user->username = 'admin';
        $user->setPassword('123456');
        $user->generateAuthKey();
        $user->save();

        $types1 = new TasksTypes();
        $types1->title = 'Ошибка';
        $types1->is_default = 0;
        $types1->position = 1;
        $types1->save();

        $types2 = new TasksTypes();
        $types2->title = 'Фича';
        $types2->is_default = true;
        $types2->position = 2;
        $types2->save();

        $types3 = new TasksTypes();
        $types3->title = 'Поддержка';
        $types3->is_default = 0;
        $types3->position = 3;
        $types3->save();
    }
}