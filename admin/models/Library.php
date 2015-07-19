<?php

namespace admin\models;

use Yii;

/**
 * This is the model class for table "library".
 *
 * @property string $id
 * @property string $name
 * @property string $details
 * @property string $address_id
 * @property string $last_update
 *
 * @property Address $address
 * @property LibraryBook[] $libraryBooks
 * @property Book[] $books
 */
class Library extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'library';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['address_id'], 'required'],
            [['address_id'], 'integer'],
            [['last_update'], 'safe'],
            [['name', 'details'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'details' => Yii::t('app', 'Details'),
            'address_id' => Yii::t('app', 'Address ID'),
            'last_update' => Yii::t('app', 'Last Update'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddress()
    {
        return $this->hasOne(Address::className(), ['id' => 'address_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLibraryBooks()
    {
        return $this->hasMany(LibraryBook::className(), ['library_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['id' => 'book_id'])->viaTable('library_book', ['library_id' => 'id']);
    }
}
