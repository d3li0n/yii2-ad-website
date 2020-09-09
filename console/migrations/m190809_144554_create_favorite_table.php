<?php

use yii\base\NotSupportedException;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%favorite}}`.
 */
class m190809_144554_create_favorite_table extends Migration
{
    /**
     * {@inheritdoc}
     * @throws NotSupportedException
     */
    public function safeUp()
    {
        $this->createTable('{{%favorite}}', [
            'id' => $this->getDb()->getSchema()->createColumnSchemaBuilder("uuid")->notNull(),
            'user_id' => $this->getDb()->getSchema()->createColumnSchemaBuilder("uuid")->notNull(),
            'ad_id' => $this->getDb()->getSchema()->createColumnSchemaBuilder("uuid")->notNull(),
            'created_time' => $this->bigInteger()->notNull(),
        ]);

        $this->addPrimaryKey('pk_favorite_id', '{{%favorite}}','id');

        $this->addForeignKey('fk_user_favorite', 'favorite', 'user_id', 'user', 'id');
        $this->addForeignKey('fk_ad_favorite', 'favorite', 'ad_id', 'ad', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_ad_favorite', 'favorite');
        $this->dropForeignKey('fk_user_favorite', 'favorite');

        $this->dropTable('{{%favorite}}');
    }
}
