<?php

namespace thienhungho\WarehouseManagement\modules\WarehouseBase;

use thienhungho\WarehouseManagement\modules\WarehouseBase\base\WarehouseVoucher as BaseWarehouseVoucher;

/**
 * This is the model class for table "warehouse_voucher".
 */
class WarehouseVoucher extends BaseWarehouseVoucher
{
    const TYPE_IN_PUT = 'input';
    const TYPE_OUT_PUT = 'output';
    const STATUS_UNPAID = 'unpaid';
    const STATUS_PAID = 'paid';

    public $is_total_price_correct = true;

    /**
     * WarehouseVoucher constructor.
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        parent::__construct($config);
        if ($this->supplier_total_price != $this->total_price) {
            $this->is_total_price_correct = false;
        }
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
                        'name',
                        'warehouse_id',
                        'employee_id',
                        'supplier_id',
                        'supplier_total_price',
                        'is_locked'
                    ],
                    'required',
                ],
                [
                    [
                        'warehouse_id',
                        'employee_id',
                        'supplier_id',
                        'created_by',
                        'updated_by',
                    ],
                    'integer',
                ],
                [
                    [
                        'supplier_total_price',
                        'total_price',
                    ],
                    'number',
                ],
                [
                    [
                        'note',
                    ],
                    'string',
                ],
                [
                    [
                        'is_locked',
                        'date',
                        'created_at',
                        'updated_at',
                    ],
                    'safe',
                ],
                [
                    [
                        'name',
                        'status',
                        'type',
                    ],
                    'string',
                    'max' => 255,
                ],
                [
                    ['name'],
                    'unique',
                ],
                [
                    ['total_price'],
                    'default',
                    'value' => 0,
                    'on'    => 'insert',
                ],
            ]);
    }

    /**
     * @param bool $insert
     *
     * @return bool
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $attachments = upload_img('WarehouseVoucher[attachments]', true);
            if (!empty($attachments)) {
                $this->attachments = json_encode($attachments);
            } elseif (empty($attachments) && !$this->isNewRecord) {
                $model = static::findOne(['id' => $this->id]);
                if ($model) {
                    $this->attachments = $model->attachments;
                }
            }

            return true;
        }

        return false;
    }

    public function afterSave($insert, $changedAttributes)
    {
        if (parent::afterSave($insert, $changedAttributes)) {
            $this->total_price = WarehouseVoucherItems::find()->where(['warehouse_voucher' => $this->id])->sum('total_price');
            $this->save();

            return true;
        }

        return false;
    }

}
