<?php

use yii\db\Migration;

/**
 * Class m190814_161603_rename_type_main_images_in_table_ad
 */
class m190814_161603_rename_type_main_images_in_table_ad extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('{{%ad}}', 'main_images', 'main_image');
        $this->alterColumn('ad', 'main_image', $this->string()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('{{%ad}}', 'main_image', 'main_images');
    }
}
