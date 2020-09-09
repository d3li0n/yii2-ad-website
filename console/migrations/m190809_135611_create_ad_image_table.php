<?php

use yii\base\NotSupportedException;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%ad_image}}`.
 */
class m190809_135611_create_ad_image_table extends Migration
{
    /**
     * {@inheritdoc}
     * @throws NotSupportedException
     */
    public function safeUp()
    {
        $this->createTable('{{%ad_image}}', [
            'id' => $this->getDb()->getSchema()->createColumnSchemaBuilder("uuid")->notNull(),
            'name' => $this->string()->notNull(),
            'ad_id' => $this->getDb()->getSchema()->createColumnSchemaBuilder("uuid")->notNull(),
            'created_time' => $this->bigInteger()->notNull(),
        ]);

        $this->addPrimaryKey('pk_ad_image_id', '{{%ad_image}}','id');

        $this->addForeignKey('fk_ad_ad_image', 'ad_image', 'ad_id', 'ad', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_ad_ad_image', 'ad_image');

        $this->dropTable('{{%ad_image}}');
    }
}
