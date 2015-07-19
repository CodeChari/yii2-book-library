<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $modelBook admin\models\Book */

$this->title = $modelBook->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Books'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $modelBook->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $modelBook->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('app', 'Delete permanently'), ['harddelete', 'id' => $modelBook->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?') . ' ' .
                    Yii::t('app', 'This action can not be undone'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= ''/*DetailView::widget([
        'model' => $modelBook,
        'attributes' => [
            //'id',
            'name',
            'page_count',
            'isbn',
            'issn',
            'language_id',
            'publisher_id',
            'type_id',
            'status_id',
            'edition',
            'description:ntext',
            'last_update',
        ],
    ]) */?>

    <table class="table table-striped table-bordered detail-view" >
        <tr>
            <th><?= Yii::t('app', 'Book name') ?></th>
            <td><?= $modelBook->name ?></td>
        </tr>
        <tr>
            <th><?= Yii::t('app', 'Author') ?></th>
            <td><?= $authors ?></td>
        </tr>
        <tr>
            <th><?= Yii::t('app', 'Internal ID') ?></th>
            <td><?= $modelBook->internal_id ?></td>
        </tr>
        <tr>
            <th><?= Yii::t('app', 'ISBN') ?></th>
            <td><?= $modelBook->isbn ?></td>
        </tr>
        <tr>
            <th><?= Yii::t('app', 'ISSN') ?></th>
            <td><?= $modelBook->issn ?></td>
        </tr>
        <tr>
            <th><?= Yii::t('app', 'Pages') ?></th>
            <td><?= $modelBook->page_count ?></td>
        </tr>
        <tr>
            <th><?= Yii::t('app', 'Language') ?></th>
            <td><?= $language['name'] ?></td>
        </tr>
        <tr>
            <th><?= Yii::t('app', 'Publisher') ?></th>
            <td><?= $publisher['name'] ?></td>
        </tr>
        <tr>
            <th><?= Yii::t('app', 'Type') ?></th>
            <td><?= $type['type'] ?></td>
        </tr>
        <tr>
            <th><?= Yii::t('app', 'Status') ?></th>
            <td><?= $status['status'] ?></td>
        </tr>
        <tr>
            <th><?= Yii::t('app', 'Edition') ?></th>
            <td><?= $modelBook->edition ?></td>
        </tr>
        <tr>
            <th><?= Yii::t('app', 'Key Words') ?></th>
            <td><?= $keyWords ?></td>
        </tr>
        <tr>
            <th><?= Yii::t('app', 'Description') ?></th>
            <td><?= $modelBook->description ?></td>
        </tr>
        <tr>
            <th><?= Yii::t('app', 'Last update') ?></th>
            <td><?= Yii::$app->formatter->asDatetime($modelBook->last_update) ?></td>
        </tr>
    </table>
</div>
