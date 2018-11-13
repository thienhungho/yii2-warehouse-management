<?php

namespace \thienhungho\WarehouseManagement\modules\WarehouseVoucherManage\search;

use thienhungho\WarehouseManagement\modules\WarehouseBase\WarehouseVoucherItems;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * \thienhungho\WarehouseManagement\modules\WarehouseVoucherManage\search\WarehouseVoucherItemsSearch represents the model behind the
 * search form about `thienhungho\WarehouseManagement\modules\WarehouseBase\WarehouseVoucherItems`.
 */
class WarehouseVoucherItemsSearch extends WarehouseVoucherItems
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'id',
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
                    'currency_unit',
                    'created_at',
                    'updated_at',
                ],
                'safe',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = WarehouseVoucherItems::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id'                   => $this->id,
            'warehouse_voucher'    => $this->warehouse_voucher,
            'warehouse_product'    => $this->warehouse_product,
            'product_unit'         => $this->product_unit,
            'product_unit_price'   => $this->product_unit_price,
            'quantity'             => $this->quantity,
            'supplier_quantity'    => $this->quantity,
            'supplier_total_price' => $this->supplier_total_price,
            'total_price'          => $this->total_price,
            'created_at'           => $this->created_at,
            'updated_at'           => $this->updated_at,
            'created_by'           => $this->created_by,
            'updated_by'           => $this->updated_by,
        ]);
        $query->andFilterWhere([
            'like',
            'currency_unit',
            $this->currency_unit,
        ]);

        return $dataProvider;
    }
}
