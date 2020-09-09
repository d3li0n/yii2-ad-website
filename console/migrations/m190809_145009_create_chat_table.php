<?php

use yii\base\NotSupportedException;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%chat}}`.
 */
class m190809_145009_create_chat_table extends Migration
{
    /**
     * {@inheritdoc}
     * @throws NotSupportedException
     */
    public function safeUp()
    {
        $this->createTable('{{%chat}}', [
            'id' => $this->getDb()->getSchema()->createColumnSchemaBuilder("uuid")->notNull(),
            'ad_id' => $this->getDb()->getSchema()->createColumnSchemaBuilder("uuid")->notNull(),
            'user_from' => $this->getDb()->getSchema()->createColumnSchemaBuilder("uuid")->notNull(),
            'user_to' => $this->getDb()->getSchema()->createColumnSchemaBuilder("uuid")->notNull(),
            'created_time' => $this->bigInteger()->notNull(),
        ]);

        $this->addPrimaryKey('pk_chat_id', '{{%chat}}','id');

        $this->addForeignKey('fk_ad_chat', 'chat', 'ad_id', 'ad', 'id');
        $this->addForeignKey('fk_user_from_chat', 'chat', 'user_from', 'user', 'id');
        $this->addForeignKey('fk_user_to_chat', 'chat', 'user_to', 'user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_user_to_chat', 'chat');
        $this->dropForeignKey('fk_user_from_chat', 'chat');
        $this->dropForeignKey('fk_ad_chat', 'chat');

        $this->dropTable('{{%chat}}');
    }
}
