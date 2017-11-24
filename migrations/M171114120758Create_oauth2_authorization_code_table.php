<?php

namespace yuncms\oauth2\migrations;

use yii\db\Migration;

class M171114120758Create_oauth2_authorization_code_table extends Migration
{

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%oauth2_authorization_code}}', [
            'authorization_code' => $this->string(40)->notNull()->comment('Authorization Code'),
            'client_id' => $this->integer()->unsigned()->notNull()->comment('Client Id'),
            'user_id' => $this->integer()->unsigned()->comment('User Id'),
            'redirect_uri' => $this->text()->notNull()->comment('Redirect Uri'),
            'expires' => $this->integer()->notNull()->comment('Expires'),
            'scope' => $this->text()->comment('Scope'),
        ],$tableOptions);

        $this->addPrimaryKey('pk', '{{%oauth2_authorization_code}}', 'authorization_code');
        $this->createIndex('ix_authorization_code_expires', '{{%oauth2_authorization_code}}', 'expires');
        $this->addforeignkey('fk_authorization_code_oauth2_client_id', '{{%oauth2_authorization_code}}', 'client_id', '{{%oauth2_client}}', 'client_id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%oauth2_authorization_code}}');
    }


    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M171114120758Create_oauth2_authorization_code_table cannot be reverted.\n";

        return false;
    }
    */
}
