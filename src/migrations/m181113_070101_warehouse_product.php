<?php

namespace thienhungho\WarehouseManagement\migrations;

use yii\db\Schema;

class m181113_070101_warehouse_product extends \yii\db\Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%warehouse_product}}', [
            'id'          => $this->primaryKey(),
            'name'        => $this->string(255)->notNull(),
            'feature_img' => $this->string(255),
            'sku'         => $this->string(255),
            'description' => $this->text(),
            'created_at'  => $this->timestamp()->notNull()->defaultValue(CURRENT_TIMESTAMP),
            'updated_at'  => $this->timestamp()->notNull()->defaultValue('0000-00-00 00:00:00'),
            'created_by'  => $this->integer(19),
            'updated_by'  => $this->integer(19),
        ], $tableOptions);

    }

    public function safeDown()
    {
        $this->dropTable('{{%warehouse_product}}');
    }
}
