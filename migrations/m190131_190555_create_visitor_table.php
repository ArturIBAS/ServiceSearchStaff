<?php

use yii\db\Migration;

/**
 * Handles the creation of table `visitor`.
 */
class m190131_190555_create_visitor_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('visitor', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'email'=>$this->string()->defaultValue(null),
            'password'=>$this->string(),
            'isAdmin'=>$this->integer()->defaultValue(0)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('visitor');
    }
}
