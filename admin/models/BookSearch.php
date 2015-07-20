<?php

namespace admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use admin\models\Book;

/**
 * BookSearch represents the model behind the search form about `admin\models\Book`.
 */
class BookSearch extends Book
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'page_count', 'language_id', 'library_id', 'publisher_id', 'type_id', 'status_id', 'edition'], 'integer'],
            [['internal_id', 'name', 'isbn', 'issn', 'description', 'created_at', 'updated_at'], 'safe'],
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
        $query = Book::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        //show all books where status != deleted
        if($this->status_id === null){
            //if(($status = Status::findOne(['status' => 'deleted'])) !== null){
                $this->status_id = Yii::$app->params['status']['deleted'];
                $query->andFilterWhere(['!=', 'status_id', $this->status_id]);
           //}
        }else{
            $query->andFilterWhere(['status_id' => $this->status_id]);
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            //'id' => $this->id,
            'page_count' => $this->page_count,
            'language_id' => $this->language_id,
            'library_id' => $this->library_id,
            'publisher_id' => $this->publisher_id,
            'type_id' => $this->type_id,
            //'status_id' => $this->status_id,
            'edition' => $this->edition,
            //'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'internal_id', $this->internal_id])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'isbn', $this->isbn])
            ->andFilterWhere(['like', 'issn', $this->issn])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
