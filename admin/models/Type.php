<?php

namespace admin\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "type".
 *
 * @property integer $id
 * @property string $type
 * @property string $last_update
 *
 * @property Book[] $books
 */
class Type extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['last_update'], 'safe'],
            [['type'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'last_update' => Yii::t('app', 'Last Update'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['type_id' => 'id']);
    }

    public function getTypeNameArray()
    {
        $allTypes = Type::find()->select(['id', 'type'])->asArray()->all();
        $map = ArrayHelper::map($allTypes, 'id', 'type');
        foreach ($map as &$m) {
            $m = Yii::t('app', $m);
        }
        return $map;
    }
}
