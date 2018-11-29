<?php

namespace thienhungho\WarehouseManagement\modules\WarehouseBase\base;

use thienhungho\ProductManagement\models\ProductUnit;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "{{%warehouse_voucher_items}}".
 *
 * @property integer $id
 * @property integer $warehouse_voucher
 * @property integer $warehouse_product
 * @property integer $product_unit
 * @property double $product_unit_price
 * @property string $currency_unit
 * @property integer $quantity
 * @property double $supplier_total_price
 * @property double $total_price
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property \thienhungho\WarehouseManagement\modules\WarehouseBase\ProductUnit $productUnit
 * @property \thienhungho\WarehouseManagement\modules\WarehouseBase\WarehouseProduct $warehouseProduct
 * @property \thienhungho\WarehouseManagement\modules\WarehouseBase\WarehouseVoucher $warehouseVoucher
 */
class WarehouseVoucherItems extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * This function helps \mootensai\relation\RelationTrait runs faster
     * @return array relation names of this model
     */
    public function relationNames()
    {
        return [
            'productUnit',
            'warehouseProduct',
            'warehouseVoucher',
        ];
    }

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
            ]);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%warehouse_voucher_items}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'                   => Yii::t('app', 'ID'),
            'warehouse_voucher'    => Yii::t('app', 'Warehouse Voucher'),
            'warehouse_product'    => Yii::t('app', 'Warehouse Product'),
            'product_unit'         => Yii::t('app', 'Product Unit'),
            'product_unit_price'   => Yii::t('app', 'Product Unit Price'),
            'currency_unit'        => Yii::t('app', 'Currency Unit'),
            'supplier_quantity'    => Yii::t('app', 'Supplier Quantity'),
            'quantity'             => Yii::t('app', 'Quantity'),
            'supplier_total_price' => Yii::t('app', 'Supplier Total Price'),
            'total_price'          => Yii::t('app', 'Total Price'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductUnit()
    {
        return $this->hasOne(ProductUnit::className(), ['id' => 'product_unit']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouseProduct()
    {
        return $this->hasOne(\thienhungho\WarehouseManagement\modules\WarehouseBase\WarehouseProduct::className(), ['id' => 'warehouse_product']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouseVoucher()
    {
        return $this->hasOne(\thienhungho\WarehouseManagement\modules\WarehouseBase\WarehouseVoucher::className(), ['id' => 'warehouse_voucher']);
    }

    /**
     * @inheritdoc
     * @return array mixed
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class'              => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value'              => new \yii\db\Expression('NOW()'),
            ],
            'blameable' => [
                'class'              => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \thienhungho\WarehouseManagement\modules\WarehouseBase\query\WarehouseVoucherItemsQuery the active query used by this
     *     AR class.
     */
    public static function find()
    {
        return new \thienhungho\WarehouseManagement\modules\WarehouseBase\query\WarehouseVoucherItemsQuery(get_called_class());
    }
}
