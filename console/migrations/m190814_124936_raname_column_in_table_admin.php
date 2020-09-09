<?php

use yii\db\Migration;

/**
 * Class m190814_124936_raname_column_in_table_admin
 */
class m190814_124936_raname_column_in_table_admin extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('{{%admin}}', 'passwork_hash', 'password_hash');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('{{%admin}}', 'password_hash', 'passwork_hash');
    }
}
