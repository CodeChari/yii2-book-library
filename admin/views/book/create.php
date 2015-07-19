<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model admin\models\Book */

$this->title = Yii::t('app', 'Create Book');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Books'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-create">

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

    ]) ?>

</div>
