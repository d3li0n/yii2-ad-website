<?php

use yii\db\Migration;

/**
 * Class m190815_230827_add_fild_is_negotiable_in_table_ad
 */
class m190815_230827_add_fild_is_negotiable_in_table_ad extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%ad}}', 'is_negotiable', $this->boolean()->defaultValue(false));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%ad}}', 'is_negotiable');
    }
}
