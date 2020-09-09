<?php

use yii\db\Migration;

/**
 * Class m190809_111111_add_filds_to_user_table
 */
class m190809_111111_add_filds_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'mobile', $this->bigInteger());
        $this->addColumn('{{%user}}', 'first_name', $this->string());
        $this->addColumn('{{%user}}', 'last_name', $this->string());
        $this->addColumn('{{%user}}', 'is_active', $this->boolean()->defaultValue(false));
        $this->addColumn('{{%user}}', 'last_login', $this->bigInteger());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'last_login');
        $this->dropColumn('{{%user}}', 'is_active');
        $this->dropColumn('{{%user}}', 'last_name');
        $this->dropColumn('{{%user}}', 'first_name');
        $this->dropColumn('{{%user}}', 'mobile');
    }
}
