<?php

use yii\db\Migration;
use yii\db\Schema;
/**
 * Handles the creation for table `tasks_types`.
 */
class m160927_095147_create_tasks_types_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tasks_types', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'position' => $this->integer(),
            'is_default' => $this->boolean(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tasks_types');
    }
}
