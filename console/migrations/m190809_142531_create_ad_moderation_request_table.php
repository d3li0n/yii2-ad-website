<?php

use yii\base\NotSupportedException;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%ad_moderation_request}}`.
 */
class m190809_142531_create_ad_moderation_request_table extends Migration
{
    /**
     * {@inheritdoc}
     * @throws NotSupportedException
     */
    public function safeUp()
    {
        $this->createTable('{{%ad_moderation_request}}', [
            'id' => $this->getDb()->getSchema()->createColumnSchemaBuilder("uuid")->notNull(),
            'ad_id' => $this->getDb()->getSchema()->createColumnSchemaBuilder("uuid")->notNull(),
            'moderator_id' => $this->getDb()->getSchema()->createColumnSchemaBuilder("uuid")->notNull(),
            'status_id' => $this->bigInteger()->notNull(),
            'reason_id' => $this->bigInteger(),
            'created_time' => $this->bigInteger()->notNull(),
            'updated_time' => $this->bigInteger(),
        ]);

        $this->addPrimaryKey('pk_ad_moderation_request_id', '{{%ad_moderation_request}}','id');

        $this->addForeignKey('fk_ad_ad_moderation_request', 'ad_moderation_request', 'ad_id', 'ad', 'id', 'CASCADE');
        $this->addForeignKey('fk_admin_ad_moderation_request', 'ad_moderation_request', 'moderator_id', 'admin', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_admin_ad_moderation_request', 'ad_moderation_request');
        $this->dropForeignKey('fk_ad_ad_moderation_request', 'ad_moderation_request');

        $this->dropTable('{{%ad_moderation_request}}');
    }
}
