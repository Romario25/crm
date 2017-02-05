<?php

use yii\db\Migration;

class m170205_112758_create_table_answer extends Migration
{
    public function up()
    {
        $this->createTable('answer', [
            'id' => $this->primaryKey(11),
            'user_id' => $this->string(255)->notNull(),
            'body' => $this->text()->notNull(),
            'created_at' => $this->date(),
            'updated_at' => $this->date()
        ]);
    }

    public function down()
    {
        $this->dropTable('answer');
    }

    
}
