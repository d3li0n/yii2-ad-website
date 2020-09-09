<?php

use yii\base\NotSupportedException;
use yii\db\Migration;

/**
 * Class m190825_203544_delete_field_ad_id_in_table_param
 */
class m190825_203544_delete_field_ad_id_in_table_param extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('fk_ad_param', 'param');
        $this->dropColumn('{{%param}}', 'ad_id');
    }

    /**
     * {@inheritdoc}
     * @throws NotSupportedException
     */
    public function safeDown()
    {
        $this->addColumn('{{%param}}', 'ad_id', $this->getDb()->getSchema()->createColumnSchemaBuilder("uuid"));
        $this->addForeignKey('fk_ad_param', 'param', 'ad_id', 'ad', 'id');
    }
}
