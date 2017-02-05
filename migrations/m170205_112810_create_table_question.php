<?php

use yii\db\Migration;

class m170205_112810_create_table_question extends Migration
{
    public function up()
    {
        $this->createTable('question', [
            'id' => $this->primaryKey(11),
            'user_id' => $this->string(255)->notNull(),
            'answer_id' => $this->integer(11)->notNull(),
            'body' => $this->text()->notNull(),
            'created_at' => $this->date(),
            'updated_at' => $this->date(),
        ]);
    }

    public function down()
    {
        $this->dropTable('question');
    }

    
}
