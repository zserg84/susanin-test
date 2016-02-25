<?php

use yii\db\Migration;

class m160223_085323_block extends Migration
{
    public function up()
    {
        $this->createTable('image', [
            'id' => $this->primaryKey(),
            'ext' => $this->string(4),
            'comment' => $this->string(),
            'create_time' => $this->integer(),
            'sort' => $this->integer(10),
        ]);

        $this->createTable('directory', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);

        $this->createTable('block', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'alias' => $this->string()->notNull(),
            'active' => $this->boolean()->defaultValue(1),
            'category_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'text' => $this->text(),
            'image_id' => $this->integer(),
            'directory_id' => $this->integer(),
            'text_active' => $this->boolean()->defaultValue(0),
            'image_active' => $this->boolean()->defaultValue(0),
            'directory_active' => $this->boolean()->defaultValue(0),
        ]);
        $this->addForeignKey('fk_block_category_id__category_id', 'block', 'category_id', 'category', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_block_image_id__image_id', 'block', 'image_id', 'image', 'id', 'SET NULL', 'CASCADE');
        $this->addForeignKey('fk_block_directory_id__directory_id', 'block', 'directory_id', 'directory', 'id', 'SET NULL', 'CASCADE');

        $this->createTable('block_category', [
            'block_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
        ]);
        $this->addPrimaryKey('pk_block_category', 'block_category', 'block_id, category_id');
        $this->addForeignKey('fk_block_category_block_id__block_id', 'block_category', 'block_id', 'block', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_block_category_category_id__category_id', 'block_category', 'category_id', 'category', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('block_category');
        $this->dropTable('block');
        $this->dropTable('directory');
        $this->dropTable('image');
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
