<?php

namespace thienhungho\WarehouseManagement\modules\WarehouseBase;

use Yii;
use \thienhungho\WarehouseManagement\modules\WarehouseBase\base\Warehouse as BaseWarehouse;

/**
 * This is the model class for table "warehouse".
 */
class Warehouse extends BaseWarehouse
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['name'], 'required'],
            [['longitude', 'latitude'], 'number'],
            [['address'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['name', 'country', 'city', 'state', 'zip_code', 'status'], 'string', 'max' => 255],
            [['name'], 'unique']
        ]);
    }
	
}
