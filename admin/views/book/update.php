<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model admin\models\Book */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Book',
]) . ' ' . $modelBook->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Books'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modelBook->name, 'url' => ['view', 'id' => $modelBook->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="book-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'modelBook' => $modelBook,
        'modelsAuthor' => $modelsAuthor,
        'languageDropDownList' => $languageDropDownList,
        'publisherDropDownList' => $publisherDropDownList,
        'typeDropDownList' => $typeDropDownList,
        'statusDropDownList' => $statusDropDownList,
        'categoryDropDownList' => $categoryDropDownList,
        'libraryDropDownList' => $libraryDropDownList,
        'keyWords' => $keyWords,
    ]) ?>

</div>
