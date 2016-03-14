<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Computer;

/**
 * ComputerSearch represents the model behind the search form about `common\models\Computer`.
 */
class ComputerSearch extends Computer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['serial_id', 'computer_status', 'model', 'computer_name', 'cpu', 'ram', 'storage_capacity', 'shelf_placement', 'purchase_date', 'warranty_date', 'end_dato'], 'safe'],
            [['type_id'], 'integer'],
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
        $query = Computer::find();

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
            'type_id' => $this->type_id,
            'purchase_date' => $this->purchase_date,
            'warranty_date' => $this->warranty_date,
            'end_dato' => $this->end_dato,
        ]);

        $query->andFilterWhere(['like', 'serial_id', $this->serial_id])
            ->andFilterWhere(['like', 'computer_status', $this->computer_status])
            ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'computer_name', $this->computer_name])
            ->andFilterWhere(['like', 'cpu', $this->cpu])
            ->andFilterWhere(['like', 'ram', $this->ram])
            ->andFilterWhere(['like', 'storage_capacity', $this->storage_capacity])
            ->andFilterWhere(['like', 'shelf_placement', $this->shelf_placement]);

        return $dataProvider;
    }
}
