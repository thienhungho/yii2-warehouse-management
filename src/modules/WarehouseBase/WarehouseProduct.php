<?php

namespace thienhungho\WarehouseManagement\modules\WarehouseBase;

use Yii;
use \thienhungho\WarehouseManagement\modules\WarehouseBase\base\WarehouseProduct as BaseWarehouseProduct;

/**
 * This is the model class for table "warehouse_product".
 */
class WarehouseProduct extends BaseWarehouseProduct
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['sku'], 'required'],
            [['created_by', 'updated_by'], 'integer'],
            [['name', 'description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'feature_img', 'sku'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['feature_img'], 'default', 'value' => DEFAULT_FEATURE_IMG]
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
            $feature_img = upload_img('WarehouseProduct[feature_img]');
            if (!empty($feature_img)) {
                $this->feature_img = $feature_img;
            } elseif(empty($feature_img) && !$this->isNewRecord) {
                $model = static::findOne(['id' => $this->id]);
                if ($model) {
                    $this->feature_img = $model->feature_img;
                }
            }

            return true;
        }

        return false;
    }

}
