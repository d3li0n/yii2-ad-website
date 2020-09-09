<?php

use yii\base\NotSupportedException;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%category}}`.
 */
class m190809_122520_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     * @throws NotSupportedException
     */
    public function safeUp()
    {
        $this->createTable('{{%category}}', [
            'id' => $this->getDb()->getSchema()->createColumnSchemaBuilder("uuid")->notNull(),
            'parent_id' => $this->getDb()->getSchema()->createColumnSchemaBuilder("uuid"),
            'name' => $this->string()->unique()->notNull(),
            'depth' => $this->integer(),
            'is_active' => $this->boolean()->defaultValue(false),
            'created_time' => $this->bigInteger()->notNull(),
        ]);

        $this->addPrimaryKey('pk_category_id', '{{%category}}','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropPrimaryKey('pk_category_id', 'category');

        $this->dropTable('{{%category}}');
    }
}
