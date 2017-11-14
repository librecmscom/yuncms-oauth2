<?php

namespace yuncms\oauth2\migrations;

use yii\db\Migration;

class M171114120251Create_oauth2_client_table extends Migration
{

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB  AUTO_INCREMENT=100000';
        }

        $this->createTable('{{%oauth2_client}}', [
            'client_id' => $this->primaryKey()->unsigned()->comment('Client ID'),
            'client_secret' => $this->string(64)->comment('Client Secret'),
            'user_id' => $this->integer()->unsigned()->comment('User ID'),
            'redirect_uri' => $this->text()->notNull()->comment('Redirect URL'),
            'grant_type' => $this->text()->comment('Grant Type'),
            'scope' => $this->text()->comment('Scope'),
            'name' => $this->string()->comment('Name'),
            'domain' => $this->string()->comment('Domain'),
            'provider' => $this->string()->comment('Provider'),
            'icp' => $this->string()->comment('Icp'),
            'registration_ip' => $this->string()->comment('Registration Ip'),
            'created_at' => $this->integer()->comment('Created At'),
            'updated_at' => $this->integer()->comment('Updated At'),
        ], $tableOptions);

        $this->createIndex('{{%oauth2_client_unique}}', '{{%oauth2_client}}', ['client_id', 'client_secret'], true);
        $this->addforeignkey('fk_oauth2_client_user_id', '{{%oauth2_client}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%oauth2_client}}');
    }


    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M171114120251Create_oauth2_client_table cannot be reverted.\n";

        return false;
    }
    */
}
