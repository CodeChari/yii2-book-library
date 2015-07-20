<?php

namespace admin\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "status".
 *
 * @property integer $id
 * @property string $status
 * @property string $last_update
 *
 * @property Book[] $books
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'required'],
            [['last_update'], 'safe'],
            [['status'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'status' => Yii::t('app', 'Status'),
            'last_update' => Yii::t('app', 'Last Update'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['status_id' => 'id']);
    }

    public function getStatusNameArray()
    {
        $allStats = Status::find()->select(['id', 'status'])->asArray()->all();
        $map = ArrayHelper::map($allStats, 'id', 'status');
        foreach ($map as &$m) {
            $m = Yii::t('app', $m);
        }
        return $map;
    }
}