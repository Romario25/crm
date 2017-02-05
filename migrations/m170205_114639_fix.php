<?php

use yii\db\Migration;

class m170205_114639_fix extends Migration
{
    public function up()
    {
        $this->dropColumn('answer', 'user_id');
        $this->addColumn('answer', 'user_id', $this->integer(11));
        $this->dropColumn('question', 'user_id');
        $this->addColumn('question', 'user_id', $this->integer(11));
    }

    public function down()
    {
        echo "m170205_114639_fix cannot be reverted.\n";

        return false;
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
