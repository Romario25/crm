<?php

use yii\db\Migration;

class m170205_123643_add_foreign_key extends Migration
{
    public function up()
    {
        $this->addForeignKey('f_answer_user', 'answer', 'user_id', 'user', 'id', 'CASCADE');

        $this->addForeignKey('f_question_user', 'question', 'user_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('f_question_answer', 'question', 'answer_id', 'answer', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropColumn('answer', 'f_answer_user');
        $this->dropColumn('question', 'f_question_user');
        $this->dropColumn('question', 'f_question_answer');
    }


}
