<?php

namespace admin\models;

use Yii;

/**
 * This is the model class for table "crud_action".
 *
 * @property integer $id
 * @property string $action
 *
 * @property LogCrud[] $logCruds
 */
class CrudAction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'crud_action';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['action'], 'required'],
            [['action'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'action' => Yii::t('app', 'Action'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogCruds()
    {
        return $this->hasMany(LogCrud::className(), ['crud_action_id' => 'id']);
    }
}
