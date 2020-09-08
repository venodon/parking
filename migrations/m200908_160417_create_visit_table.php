<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%visit}}`.
 */
class m200908_160417_create_visit_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%visit}}', [
            'id'         => $this->bigPrimaryKey()->unsigned(),
            'number'     => $this->string(10),
            'status'     => $this->smallInteger(1),
            'entered_at' => $this->dateTime(),
            'left_at'    => $this->dateTime()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%visit}}');
    }
}
