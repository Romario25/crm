<?php

use yii\db\Migration;
use yii\db\Schema;

class m170205_105940_create_table_user extends Migration
{
    public function up()
    {
        $this->createTable('user', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING.' NOT NULL',
            'login' => Schema::TYPE_STRING.' NOT NULL',
            'password_hash' => Schema::TYPE_STRING.' NOT NULL',
            'auth_key' => Schema::TYPE_STRING.'(32) NOT NULL',
            'created_at' => Schema::TYPE_INTEGER.' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER.' NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable('user');
    }

    
}
