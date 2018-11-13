<?php

namespace thienhungho\WarehouseManagement\migrations;

use yii\db\Schema;

class m181113_070101_warehouse_voucher extends \yii\db\Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%warehouse_voucher}}', [
            'id'                   => $this->primaryKey(),
            'name'                 => $this->string(255)->notNull(),
            'warehouse_id'         => $this->integer(19)->notNull(),
            'employee_id'          => $this->integer(19)->notNull(),
            'supplier_id'          => $this->integer(19)->notNull(),
            'note'                 => $this->text(),
            'date'                 => $this->datetime(),
            'supplier_total_price' => $this->float()->notNull()->defaultValue(0),
            'total_price'          => $this->float()->notNull()->defaultValue(0),
            'is_locked'            => $this->tinyint(1),
            'status'               => $this->string(255)->defaultValue('active'),
            'type'                 => $this->string(255)->defaultValue('input'),
            'attachments'          => $this->text(),
            'created_at'           => $this->timestamp()->notNull()->defaultValue(CURRENT_TIMESTAMP),
            'updated_at'           => $this->timestamp()->notNull()->defaultValue('0000-00-00 00:00:00'),
            'created_by'           => $this->integer(19),
            'updated_by'           => $this->integer(19),
            'FOREIGN KEY ([[employee_id]]) REFERENCES {{%employee}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
            'FOREIGN KEY ([[supplier_id]]) REFERENCES {{%supplier}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
            'FOREIGN KEY ([[warehouse_id]]) REFERENCES {{%warehouse}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);

    }

    public function safeDown()
    {
        $this->dropTable('{{%warehouse_voucher}}');
    }
}
