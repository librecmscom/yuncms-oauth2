<?php

namespace yuncms\oauth2\migrations;

use yii\db\Migration;

class M171114120629Create_oauth2_refresh_token_table extends Migration
{

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%oauth2_refresh_token}}', [
            'refresh_token' => $this->string(40)->notNull()->comment('Refresh Token'),
            'client_id' => $this->integer()->unsigned()->notNull()->comment('Client Id'),
            'user_id' => $this->integer()->unsigned()->comment('User Id'),
            'expires' => $this->integer()->notNull()->comment('Expires'),
            'scope' => $this->text()->comment('Scope'),
        ],$tableOptions);

        $this->addPrimaryKey('pk', '{{%oauth2_refresh_token}}', 'refresh_token');
        $this->createIndex('ix_refresh_token_expires', '{{%oauth2_refresh_token}}', 'expires');
        $this->addforeignkey('fk_refresh_token_oauth2_client_id', '{{%oauth2_refresh_token}}', 'client_id', '{{%oauth2_client}}', 'client_id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%oauth2_refresh_token}}');
    }


    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M171114120629Create_oauth2_refresh_token_table cannot be reverted.\n";

        return false;
    }
    */
}
