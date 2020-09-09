<?php

use yii\base\NotSupportedException;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%category_param}}`.
 */
class m190825_204050_create_category_param_table extends Migration
{
    /**
     * {@inheritdoc}
     * @throws NotSupportedException
     */
    public function safeUp()
    {
        $this->createTable('{{%category_param}}', [
            'category_id' => $this->getDb()->getSchema()->createColumnSchemaBuilder("uuid")->notNull(),
            'param_id' => $this->getDb()->getSchema()->createColumnSchemaBuilder("uuid")->notNull(),
            'created_time' => $this->bigInteger()->notNull(),
        ]);

        $this->addForeignKey('fk_category_category_param', 'category_param', 'category_id', 'category', 'id');
        $this->addForeignKey('fk_category_param_param', 'category_param', 'param_id', 'param', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_category_param_param', 'category_param');
        $this->dropForeignKey('fk_category_category_param', 'category_param');

        $this->dropTable('{{%category_param}}');
    }
}
