<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->insert('user', [
            'username' => 'admin',
            'password_hash' => '$2y$13$gtJtfUz/cMF/MdxP2.VhFOwGs6N3317OJAcDjnFGSoYILHoP3oGMi',
            'auth_key' => 'btWr6CYA8aOISFayEntZcV1ZT8PaSMLm',
            'password_reset_token' => 'def1gsdO5HR_3esflDLLv1_4GMwjIB-E_1456313310',
            'email' => 'admin@gmail.com',
            'status' => 10,
            'created_at' => '1456297483',
            'updated_at' => '1456297483'
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
