<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\files;

/**
 * filesMange represents the model behind the search form about `app\models\files`.
 */
class filesMange extends files
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file_id', 'file_size'], 'integer'],
            [['file_name', 'file_url', 'file_type'], 'safe'],
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
        $query = files::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'file_id' => $this->file_id,
            'file_size' => $this->file_size,
        ]);

        $query->andFilterWhere(['like', 'file_name', $this->file_name])
            ->andFilterWhere(['like', 'file_url', $this->file_url])
            ->andFilterWhere(['like', 'file_type', $this->file_type]);

        return $dataProvider;
    }
}
