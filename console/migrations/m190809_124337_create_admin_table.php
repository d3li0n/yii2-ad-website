<?php

use yii\base\NotSupportedException;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%admin}}`.
 */
class m190809_124337_create_admin_table extends Migration
{
    /**
     * {@inheritdoc}
     * @throws NotSupportedException
     */
    public function safeUp()
    {
        $this->createTable('{{%admin}}', [
            'id' => $this->getDb()->getSchema()->createColumnSchemaBuilder("uuid")->notNull(),
            'email' => $this->string()->notNull()->unique(),
            'passwork_hash' => $this->string(),
            'created_time' => $this->bigInteger()->notNull(),
            'updated_time' => $this->bigInteger(),
        ]);

        $this->addPrimaryKey('pk_admin_id', '{{%admin}}','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%admin}}');
    }
}
