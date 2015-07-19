<?php

namespace admin\models;

use Yii;

/**
 * This is the model class for table "rental".
 *
 * @property string $id
 * @property string $requested_date
 * @property string $rental_date
 * @property string $returned_date
 * @property string $user_id
 * @property string $book_id
 * @property string $other_detail
 * @property string $staff_id
 *
 * @property Payment[] $payments
 * @property Book $book
 * @property User $staff
 * @property User $user
 */
class Rental extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rental';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['requested_date', 'rental_date', 'returned_date'], 'safe'],
            [['user_id', 'book_id', 'staff_id'], 'required'],
            [['user_id', 'book_id', 'staff_id'], 'integer'],
            [['other_detail'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'requested_date' => Yii::t('app', 'Requested Date'),
            'rental_date' => Yii::t('app', 'Rental Date'),
            'returned_date' => Yii::t('app', 'Returned Date'),
            'user_id' => Yii::t('app', 'User ID'),
            'book_id' => Yii::t('app', 'Book ID'),
            'other_detail' => Yii::t('app', 'Other Detail'),
            'staff_id' => Yii::t('app', 'Staff ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payment::className(), ['rental_id' => 'id']);
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
    public function getStaff()
    {
        return $this->hasOne(User::className(), ['id' => 'staff_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
