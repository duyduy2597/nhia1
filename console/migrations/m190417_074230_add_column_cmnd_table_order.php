<?php

use yii\db\Migration;

/**
 * Class m190417_074230_add_column_cmnd_table_order
 */
class m190417_074230_add_column_cmnd_table_order extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%order}}', 'cmnd', $this->string(12)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%order}}', 'cmnd');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190417_074230_add_column_cmnd_table_order cannot be reverted.\n";

        return false;
    }
    */
}
