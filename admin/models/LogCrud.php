<?php

namespace admin\models;

use Yii;

/**
 * This is the model class for table "log_crud".
 *
 * @property string $id
 * @property string $user_id
 * @property integer $crud_action_id
 * @property string $book_id
 * @property string $last_update
 *
 * @property Book $book
 * @property CrudAction $crudAction
 * @property User $user
 */
class LogCrud extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'log_crud';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'crud_action_id', 'book_id'], 'required'],
            [['user_id', 'crud_action_id', 'book_id'], 'integer'],
            [['last_update'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'crud_action_id' => Yii::t('app', 'Crud Action ID'),
            'book_id' => Yii::t('app', 'Book ID'),
            'last_update' => Yii::t('app', 'Last Update'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Book::className(), ['id' => 'book_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrudAction()
    {
        return $this->hasOne(CrudAction::className(), ['id' => 'crud_action_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
