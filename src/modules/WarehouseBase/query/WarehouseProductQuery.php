<?php

namespace thienhungho\WarehouseManagement\modules\WarehouseBase\query;

/**
 * This is the ActiveQuery class for [[\thienhungho\WarehouseManagement\modules\WarehouseBase\query\WarehouseProduct]].
 *
 * @see \thienhungho\WarehouseManagement\modules\WarehouseBase\query\WarehouseProduct
 */
class WarehouseProductQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \thienhungho\WarehouseManagement\modules\WarehouseBase\query\WarehouseProduct[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \thienhungho\WarehouseManagement\modules\WarehouseBase\query\WarehouseProduct|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
