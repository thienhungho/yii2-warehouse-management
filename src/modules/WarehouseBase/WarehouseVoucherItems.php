<?php

namespace thienhungho\WarehouseManagement\modules\WarehouseBase;

use thienhungho\WarehouseManagement\modules\WarehouseBase\base\WarehouseVoucherItems as BaseWarehouseVoucherItems;

/**
 * This is the model class for table "warehouse_voucher_items".
 */
class WarehouseVoucherItems extends BaseWarehouseVoucherItems
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
                [
                    [
                        'warehouse_voucher',
                        'product_unit_price',
                        'quantity',
                    ],
                    'required',
                ],
                [
                    [
                        'warehouse_voucher',
                        'warehouse_product',
                        'product_unit',
                        'created_by',
                        'updated_by',
                    ],
                    'integer',
                ],
                [
                    [
                        'product_unit_price',
                        'supplier_total_price',
                        'total_price',
                        'quantity',
                        'supplier_quantity',
                    ],
                    'number',
                ],
                [
                    [
                        'created_at',
                        'updated_at',
                    ],
                    'safe',
                ],
                [
                    ['currency_unit'],
                    'string',
                    'max' => 255,
                ],
                [
                    ['currency_unit'],
                    'default',
                    'value' => 'VND',
                ],
            ]);
    }

    /**
     * @param bool $insert
     *
     * @return bool
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (empty($this->supplier_quantity)) {
                $this->supplier_quantity = $this->quantity;
            }

            $this->total_price = $this->quantity * $this->product_unit_price;

            if (empty($this->supplier_total_price)) {
                $this->supplier_total_price = $this->total_price;
            }

            return true;
        }

        return false;
    }

}
