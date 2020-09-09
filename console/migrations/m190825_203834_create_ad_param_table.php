<?php

use yii\base\NotSupportedException;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%ad_param}}`.
 */
class m190825_203834_create_ad_param_table extends Migration
{
    /**
     * {@inheritdoc}
     * @throws NotSupportedException
     */
    public function safeUp()
    {
        $this->createTable('{{%ad_param}}', [
            'ad_id' => $this->getDb()->getSchema()->createColumnSchemaBuilder("uuid")->notNull(),
            'param_id' => $this->getDb()->getSchema()->createColumnSchemaBuilder("uuid")->notNull(),
            'param_value' => $this->string()->notNull(),
            'created_time' => $this->bigInteger()->notNull(),
        ]);

        $this->addForeignKey('fk_ad_ad_param', 'ad_param', 'ad_id', 'ad', 'id');
        $this->addForeignKey('fk_ad_param_param', 'ad_param', 'param_id', 'param', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_ad_param_param', 'ad_param');
        $this->dropForeignKey('fk_ad_ad_param', 'ad_param');

        $this->dropTable('{{%ad_param}}');
    }
}
