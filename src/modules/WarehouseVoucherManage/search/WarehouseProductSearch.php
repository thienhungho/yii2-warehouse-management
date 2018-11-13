<?php

namespace \thienhungho\WarehouseManagement\modules\WarehouseVoucherManage\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use thienhungho\WarehouseManagement\modules\WarehouseBase\WarehouseProduct;

/**
 * \thienhungho\WarehouseManagement\modules\WarehouseVoucherManage\search\WarehouseProductSearch represents the model behind the search form about `thienhungho\WarehouseManagement\modules\WarehouseBase\WarehouseProduct`.
 */
 class WarehouseProductSearch extends WarehouseProduct
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name', 'created_by', 'updated_by'], 'integer'],
            [['feature_img', 'sku', 'description', 'created_at', 'updated_at'], 'safe'],
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
        $query = WarehouseProduct::find();

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
            'name' => $this->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'feature_img', $this->feature_img])
            ->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
