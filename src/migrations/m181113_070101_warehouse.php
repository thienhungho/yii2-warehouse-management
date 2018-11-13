<?php

namespace thienhungho\WarehouseManagement\migrations;

use yii\db\Schema;

class m181113_070101_warehouse extends \yii\db\Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%warehouse}}', [
            'id'         => $this->primaryKey(),
            'name'       => $this->string(255)->notNull(),
            'longitude'  => $this->decimal(24, 20),
            'latitude'   => $this->decimal(24, 20),
            'address'    => $this->text(),
            'country'    => $this->string(255),
            'city'       => $this->string(255),
            'state'      => $this->string(255),
            'zip_code'   => $this->string(255),
            'status'     => $this->string(255)->defaultValue('active'),
            'created_at' => $this->timestamp()->notNull()->defaultValue(CURRENT_TIMESTAMP),
            'updated_at' => $this->timestamp()->notNull()->defaultValue('0000-00-00 00:00:00'),
            'created_by' => $this->integer(19),
            'updated_by' => $this->integer(19),
        ], $tableOptions);

    }

    public function safeDown()
    {
        $this->dropTable('{{%warehouse}}');
    }
}
