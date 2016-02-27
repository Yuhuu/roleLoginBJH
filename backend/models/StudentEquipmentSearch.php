<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\StudentEquipment;

/**
 * StudentEquipmentSearch represents the model behind the search form about `backend\models\StudentEquipment`.
 */
class StudentEquipmentSearch extends StudentEquipment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'student_id', 'serial_id', 'borrow_status_id', 'require_by_teacher_id', 'start_at', 'end_at'], 'integer'],
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
        $query = StudentEquipment::find();

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
            'student_id' => $this->student_id,
            'serial_id' => $this->serial_id,
            'borrow_status_id' => $this->borrow_status_id,
            'require_by_teacher_id' => $this->require_by_teacher_id,
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
        ]);

        return $dataProvider;
    }
}
