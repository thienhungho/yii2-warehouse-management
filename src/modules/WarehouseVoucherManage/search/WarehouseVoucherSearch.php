<?php

namespace \thienhungho\WarehouseManagement\modules\WarehouseVoucherManage\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use thienhungho\WarehouseManagement\modules\WarehouseBase\WarehouseVoucher;

/**
 * \thienhungho\WarehouseManagement\modules\WarehouseVoucherManage\search\WarehouseVoucherSearch represents the model behind the search form about `thienhungho\WarehouseManagement\modules\WarehouseBase\WarehouseVoucher`.
 */
 class WarehouseVoucherSearch extends WarehouseVoucher
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'warehouse_id', 'employee_id', 'supplier_id', 'created_by', 'updated_by'], 'integer'],
            [['supplier_total_price', 'total_price'], 'number'],
            [['name', 'note', 'date', 'is_locked', 'status', 'type', 'attachments', 'created_at', 'updated_at'], 'safe'],
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
        $query = WarehouseVoucher::find();

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
            'id' => $this->id,
            'warehouse_id' => $this->warehouse_id,
            'employee_id' => $this->employee_id,
            'supplier_id' => $this->supplier_id,
            'date' => $this->date,
            'supplier_total_price' => $this->supplier_total_price,
            'total_price' => $this->total_price,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'is_locked', $this->is_locked])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'attachments', $this->attachments]);

        return $dataProvider;
    }
}
