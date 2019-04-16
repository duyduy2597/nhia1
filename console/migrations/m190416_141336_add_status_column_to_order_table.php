<?php

use yii\db\Migration;

/**
 * Handles adding status to table `{{%order}}`.
 */
class m190416_141336_add_status_column_to_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%order}}', 'status', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%order}}', 'status');
    }
}
