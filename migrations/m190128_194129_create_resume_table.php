<?php

use yii\db\Migration;

/**
 * Handles the creation of table `resume`.
 */
class m190128_194129_create_resume_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('resume', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'surname' => $this->string(),
            'patronymic' => $this->string(),
            'text' => $this->text(),
            'email' => $this->string()->defaultValue(null),
            'phone' => $this->string(),
            'file' => $this->string(),
            'visitor_id' => $this->integer(),
            'category_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('resume');
    }
}
