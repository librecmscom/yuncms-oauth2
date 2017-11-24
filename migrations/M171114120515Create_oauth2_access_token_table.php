<?php

namespace yuncms\oauth2\migrations;

use yii\db\Migration;

class M171114120515Create_oauth2_access_token_table extends Migration
{

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%oauth2_access_token}}', [
            'access_token' => $this->string(40)->notNull()->comment('Access Token'),
            'client_id' => $this->integer()->unsigned()->notNull()->comment('Client Id'),
            'user_id' => $this->integer()->unsigned()->comment('User Id'),
            'expires' => $this->integer()->notNull()->comment('Expires'),
            'scope' => $this->text()->comment('Scope'),
        ], $tableOptions);
        $this->addPrimaryKey('pk', '{{%oauth2_access_token}}', 'access_token');
        $this->createIndex('ix_access_token_expires', '{{%oauth2_access_token}}', 'expires');
        $this->addforeignkey('fk_access_token_oauth2_client_id', '{{%oauth2_access_token}}', 'client_id', '{{%oauth2_client}}', 'client_id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%oauth2_access_token}}');
    }


    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M171114120515Create_oauth2_access_token_table cannot be reverted.\n";

        return false;
    }
    */
}
