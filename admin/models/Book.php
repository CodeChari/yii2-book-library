<?php

namespace admin\models;

use Isbn\Isbn;
use Yii;

/**
 * This is the model class for table "book".
 *
 * @property string $id
 * @property string $internal_id
 * @property string $name
 * @property integer $page_count
 * @property string $isbn
 * @property string $issn
 * @property integer $language_id
 * @property string $library_id
 * @property string $publisher_id
 * @property integer $type_id
 * @property integer $status_id
 * @property integer $category_id
 * @property integer $edition
 * @property string $description
 * @property string $last_update
 *
 * @property Category $category
 * @property Language $language
 * @property Library $library
 * @property Publisher $publisher
 * @property Status $status
 * @property Type $type
 * @property BookAuthor[] $bookAuthors
 * @property Author[] $authors
 * @property BookKeyWord[] $bookKeyWords
 * @property KeyWord[] $keyWords
 * @property LogCrud[] $logCruds
 * @property Rental[] $rentals
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'internal_id',
                    'name',
                    'language_id',
                    'library_id',
                    'publisher_id',
                    'type_id',
                    'status_id',
                    'category_id'
                ],
                'required'
            ],
            [
                [
                    'page_count',
                    'language_id',
                    'library_id',
                    'publisher_id',
                    'type_id',
                    'status_id',
                    'category_id',
                    'edition'
                ],
                'integer'
            ],
            [['description'], 'string'],
            [['description'], 'stripTags'],
            [['last_update'], 'safe'],
            [['internal_id'], 'string', 'max' => 11],
            [['name'], 'string', 'max' => 255],
            [['isbn', 'issn'], 'string', 'max' => 20],
            [['isbn', 'issn'], 'validateISBN'],
            [['internal_id'], 'unique']
        ];
    }

    /**
     * strip HTML and php tags
     * @return string
     */
    public function stripTags()
    {
        return strip_tags($this->description);
    }

    public function validateISBN()
    {
        $isbn = new Isbn();
        if (!empty($this->isbn)) {
            if ($isbn->validation->isbn($this->isbn) === false) {
                $this->addError('isbn', Yii::t('app', 'Not valid {isbn}', ['isbn' => 'isbn']));
            } else {
                $this->isbn = $isbn->hyphens->fixHyphens($this->isbn);
            }
        }
        if (!empty($this->issn)) {
            if ($isbn->validation->isbn($this->issn) === false) {
                $this->addError('issn', Yii::t('app', 'Not valid {isbn}', ['isbn' => 'issn']));
            } else {
                $this->issn = $isbn->hyphens->fixHyphens($this->issn);
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'internal_id' => Yii::t('app', 'Internal ID'),
            'name' => Yii::t('app', 'Book name'),
            'page_count' => Yii::t('app', 'Page Count'),
            'isbn' => Yii::t('app', 'Isbn'),
            'issn' => Yii::t('app', 'Issn'),
            'language_id' => Yii::t('app', 'Language ID'),
            'library_id' => Yii::t('app', 'Library ID'),
            'publisher_id' => Yii::t('app', 'Publisher ID'),
            'type_id' => Yii::t('app', 'Type ID'),
            'status_id' => Yii::t('app', 'Status ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'edition' => Yii::t('app', 'Edition'),
            'description' => Yii::t('app', 'Description'),
            'last_update' => Yii::t('app', 'Last Update'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::className(), ['id' => 'language_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLibrary()
    {
        return $this->hasOne(Library::className(), ['id' => 'library_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublisher()
    {
        return $this->hasOne(Publisher::className(), ['id' => 'publisher_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Type::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookAuthors()
    {
        return $this->hasMany(BookAuthor::className(), ['book_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthors()
    {
        return $this->hasMany(Author::className(), ['id' => 'author_id'])->viaTable('book_author', ['book_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookCategories()
    {
        return $this->hasMany(BookCategory::className(), ['book_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable('book_category',
            ['book_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookKeyWords()
    {
        return $this->hasMany(BookKeyWord::className(), ['book_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKeyWords()
    {
        return $this->hasMany(KeyWord::className(), ['id' => 'key_word_id'])->viaTable('book_key_word',
            ['book_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogCruds()
    {
        return $this->hasMany(LogCrud::className(), ['book_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentals()
    {
        return $this->hasMany(Rental::className(), ['book_id' => 'id']);
    }
}