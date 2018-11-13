<?php

namespace thienhungho\WarehouseManagement\migrations;

use yii\db\Schema;

class m181113_070101_warehouse_voucher_items extends \yii\db\Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%warehouse_voucher_items}}', [
            'id'                   => $this->primaryKey(),
            'warehouse_voucher'    => $this->integer(19)->notNull(),
            'warehouse_product'    => $this->integer(19),
            'product_unit'         => $this->integer(19),
            'product_unit_price'   => $this->float()->notNull(),
            'currency_unit'        => $this->string(255)->defaultValue('USD'),
            'supplier_quantity'    => $this->float()->notNull(),
            'quantity'             => $this->float()->notNull(),
            'supplier_total_price' => $this->float(),
            'total_price'          => $this->float(),
            'created_at'           => $this->timestamp()->notNull()->defaultValue(CURRENT_TIMESTAMP),
            'updated_at'           => $this->timestamp()->notNull()->defaultValue('0000-00-00 00:00:00'),
            'created_by'           => $this->integer(19),
            'updated_by'           => $this->integer(19),
            'FOREIGN KEY ([[product_unit]]) REFERENCES {{%product_unit}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
            'FOREIGN KEY ([[warehouse_product]]) REFERENCES {{%warehouse_product}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
            'FOREIGN KEY ([[warehouse_voucher]]) REFERENCES {{%warehouse_voucher}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);

    }

    public function safeDown()
    {
        $this->dropTable('{{%warehouse_voucher_items}}');
    }
}
