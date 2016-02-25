<?php

use yii\db\Migration;

class m160223_083325_category extends Migration
{
    public function up()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'name' => $this->string()->notNull(),
            'active' => $this->boolean()->defaultValue(1)
        ]);
        $this->addForeignKey('fk_category_parent_id__category_id', 'category', 'parent_id', 'category', 'id', 'SET NULL', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('category');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
