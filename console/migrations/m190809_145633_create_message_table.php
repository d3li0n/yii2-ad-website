<?php

use yii\base\NotSupportedException;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%message}}`.
 */
class m190809_145633_create_message_table extends Migration
{
    /**
     * {@inheritdoc}
     * @throws NotSupportedException
     */
    public function safeUp()
    {
        $this->createTable('{{%message}}', [
            'id' => $this->getDb()->getSchema()->createColumnSchemaBuilder("uuid")->notNull(),
            'chat_id' => $this->getDb()->getSchema()->createColumnSchemaBuilder("uuid")->notNull(),
            'user_from' => $this->getDb()->getSchema()->createColumnSchemaBuilder("uuid")->notNull(),
            'user_to' => $this->getDb()->getSchema()->createColumnSchemaBuilder("uuid")->notNull(),
            'text' => $this->text()->notNull(),
            'created_time' => $this->bigInteger()->notNull(),
        ]);

        $this->addPrimaryKey('pk_message_id', '{{%message}}','id');

        $this->addForeignKey('fk_chat_message', 'message', 'chat_id', 'chat', 'id');
        $this->addForeignKey('fk_user_from_message', 'message', 'user_from', 'user', 'id');
        $this->addForeignKey('fk_user_to_message', 'message', 'user_to', 'user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_user_to_message', 'message');
        $this->dropForeignKey('fk_user_from_message', 'message');
        $this->dropForeignKey('fk_chat_message', 'message');

        $this->dropTable('{{%message}}');
    }
}
