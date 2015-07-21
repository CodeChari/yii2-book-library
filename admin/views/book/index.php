<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel admin\models\BookSearch */
/* @var $model admin\models\Book */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Books');
$this->params['breadcrumbs'][] = $this->title;

$this->params['allTypes'] = $allTypes;
$this->params['allStatuses'] = $allStatuses;
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Book'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= \yii\widgets\LinkPager::widget([
        'pagination' => $dataProvider->pagination,
    ]);
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'name',
                'value' => function ($model, $id) {
                    return Html::a($model->name, Url::to(['book/view', 'id' => $model->id]));
                },
                'format' => 'html',
                //'search' => true,
            ],
            'isbn',
            'issn',
            [
                'attribute' => 'type_id',
                'value' => function($model){
                    return $this->params['allTypes'][$model->type_id];
                },
            ],
            [
                'attribute' => 'status_id',
                'value' => function($model){
                    return $this->params['allStatuses'][$model->status_id];
                },
            ],
            // 'edition',
            // 'description:ntext',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {harddelete}',
                'buttons' => [
                    'harddelete' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-remove"></span>', $url, [
                            'data-confirm' => Yii::t('app', 'Are you sure you want to delete this item?') . ' ' .
                                Yii::t('app', 'This action can not be undone'),
                            'data-method' => 'post',
                            'data-pjax' => 0,
                            'title' => Yii::t('app', 'Delete permanently')
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
