<?php

namespace thienhungho\WarehouseManagement\modules\WarehouseBase\query;

/**
 * This is the ActiveQuery class for [[\thienhungho\WarehouseManagement\modules\WarehouseBase\query\Warehouse]].
 *
 * @see \thienhungho\WarehouseManagement\modules\WarehouseBase\query\Warehouse
 */
class WarehouseQuery extends \thienhungho\ActiveQuery\models\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \thienhungho\WarehouseManagement\modules\WarehouseBase\query\Warehouse[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \thienhungho\WarehouseManagement\modules\WarehouseBase\query\Warehouse|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
