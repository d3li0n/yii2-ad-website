<?php

use yii\base\NotSupportedException;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%like}}`.
 */
class m190809_143519_create_like_table extends Migration
{
    /**
     * {@inheritdoc}
     * @throws NotSupportedException
     */
    public function safeUp()
    {
        $this->createTable('{{%like}}', [
            'id' => $this->getDb()->getSchema()->createColumnSchemaBuilder("uuid")->notNull(),
            'user_id' => $this->getDb()->getSchema()->createColumnSchemaBuilder("uuid")->notNull(),
            'ad_id' => $this->getDb()->getSchema()->createColumnSchemaBuilder("uuid")->notNull(),
            'created_time' => $this->bigInteger()->notNull(),
        ]);

        $this->addPrimaryKey('pk_like_id', '{{%like}}','id');

        $this->addForeignKey('fk_user_like', 'like', 'user_id', 'user', 'id');
        $this->addForeignKey('fk_ad_like', 'like', 'ad_id', 'ad', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_ad_like', 'like');
        $this->dropForeignKey('fk_user_like', 'like');

        $this->dropTable('{{%like}}');
    }
}
