<?php

use yii\db\Migration;

/**
 * Handles adding secretkey to table `{{%order}}`.
 */
class m190421_114936_add_secretkey_column_to_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%order}}', 'secretkey', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%order}}', 'secretkey');
    }
}
