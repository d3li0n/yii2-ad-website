<?php

use yii\base\NotSupportedException;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%param}}`.
 */
class m190809_150001_create_param_table extends Migration
{
    /**
     * {@inheritdoc}
     * @throws NotSupportedException
     */
    public function safeUp()
    {
        $this->createTable('{{%param}}', [
            'id' => $this->getDb()->getSchema()->createColumnSchemaBuilder("uuid")->notNull(),
            'ad_id' => $this->getDb()->getSchema()->createColumnSchemaBuilder("uuid")->notNull(),
            'name' => $this->string()->notNull(),
            'type' => $this->string()->notNull(),
            'value' => $this->string()->notNull(),
            'created_time' => $this->bigInteger()->notNull(),
        ]);

        $this->addPrimaryKey('pk_param_id', '{{%param}}','id');

        $this->addForeignKey('fk_ad_param', 'param', 'ad_id', 'ad', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_ad_param', 'param');

        $this->dropTable('{{%param}}');
    }
}
