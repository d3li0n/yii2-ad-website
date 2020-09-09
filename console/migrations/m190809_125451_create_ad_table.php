<?php

use yii\base\NotSupportedException;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%ad}}`.
 */
class m190809_125451_create_ad_table extends Migration
{
    /**
     * {@inheritdoc}
     * @throws NotSupportedException
     */
    public function safeUp()
    {
        $this->createTable('{{%ad}}', [
            'id' => $this->getDb()->getSchema()->createColumnSchemaBuilder("uuid")->notNull(),
            'title' => $this->string()->notNull(),
            'description' => $this->text(),
            'user_id' => $this->getDb()->getSchema()->createColumnSchemaBuilder("uuid")->notNull(),
            'category_id' => $this->getDb()->getSchema()->createColumnSchemaBuilder("uuid")->notNull(),
            'status_id' => $this->integer()->notNull(),
            'country' => $this->string(),
            'city_id' => $this->getDb()->getSchema()->createColumnSchemaBuilder("uuid")->notNull(),
            'price' => $this->integer(),
            'main_images' => $this->integer(),
            'reason_id' => $this->integer(),
            'created_time' => $this->bigInteger()->notNull(),
            'updated_time' => $this->bigInteger(),
            'is_deleted' => $this->boolean()->defaultValue(false),
        ]);

        $this->addPrimaryKey('pk_ad_id', '{{%ad}}','id');

        $this->addForeignKey('fk_user_ad', 'ad', 'user_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('fk_category_ad', 'ad', 'category_id', 'category', 'id', 'CASCADE');
        $this->addForeignKey('fk_city_ad', 'ad', 'city_id', 'city', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_city_ad', 'ad');
        $this->dropForeignKey('fk_category_ad', 'ad');
        $this->dropForeignKey('fk_user_ad', 'ad');

        $this->dropTable('{{%ad}}');
    }
}
