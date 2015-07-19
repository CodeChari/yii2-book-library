<?php

use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model admin\models\Book */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="book-form">

        <?php $form = ActiveForm::begin(['id' => 'book-dynamic-form']); ?>

        <?= $form->field($modelBook, 'name')->textInput(['maxlength' => 255]) ?>

        <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
            'widgetBody' => '.container-items', // required: css class selector
            'widgetItem' => '.item', // required: css class
            'limit' => 10, // the maximum times, an element can be added (default 999)
            'min' => 1, // 0 or 1 (default 1)
            'insertButton' => '.add-item', // css class
            'deleteButton' => '.remove-item', // css class
            'model' => $modelsAuthor[0],
            'formId' => 'book-dynamic-form',
            'formFields' => [
                'first_name',
                'last_name',
            ],
        ]); ?>

        <div class="panel-body">
            <div class="container-items"><!-- widgetBody -->
                <?php foreach ($modelsAuthor as $i => $modelAuthor): ?>
                    <div class="item panel panel-default"><!-- widgetItem -->
                        <div class="panel-heading">
                            <h3 class="panel-title pull-left"><?= Yii::t('app', 'Author') ?></h3>

                            <div class="pull-right">
                                <button type="button" class="add-item btn btn-success btn-xs"><i
                                        class="glyphicon glyphicon-plus"></i></button>
                                <button type="button" class="remove-item btn btn-danger btn-xs"><i
                                        class="glyphicon glyphicon-minus"></i></button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <?php
                            // necessary for update action.
                            if (!$modelAuthor->isNewRecord) {
                                echo Html::activeHiddenInput($modelAuthor, "[{$i}]id");
                            }
                            ?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <?= $form->field($modelAuthor, "[{$i}]first_name")->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-sm-6">
                                    <?= $form->field($modelAuthor, "[{$i}]last_name")->textInput(['maxlength' => true]) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php DynamicFormWidget::end(); ?>


        <?= $form->field($modelBook, 'isbn')->textInput(['maxlength' => 20, 'placeholder' => '8881837188']) ?>

        <?= $form->field($modelBook, 'issn')->textInput(['maxlength' => 20, 'placeholder' => '8881837188']) ?>

        <?= $form->field($modelBook, 'page_count')->textInput() ?>

        <div class="form-group required">
            <label class="control-label" for="book-language"><?= Yii::t('app', 'Language') ?></label>
            <?= Html::dropDownList('Book[language_id]', null, $languageDropDownList, ['id' => 'book-language', 'class' => 'form-control']) ?>
        </div>

        <div class="form-group required">
            <label class="control-label" for="book-publisher"><?= Yii::t('app', 'Publisher') ?></label>
            <?= Html::dropDownList('Book[publisher_id]', null, $publisherDropDownList, ['id' => 'book-publisher', 'class' => 'form-control']) ?>
        </div>

        <div class="form-group required">
            <label class="control-label" for="book-type"><?= Yii::t('app', 'Type') ?></label>
            <?= Html::dropDownList('Book[type_id]', null, $typeDropDownList, ['id' => 'book-type', 'class' => 'form-control']) ?>
        </div>

        <div class="form-group required">
            <label class="control-label" for="book-type"><?= Yii::t('app', 'Status') ?></label>
            <?= Html::dropDownList('Book[status_id]', null, $statusDropDownList, ['id' => 'book-status', 'class' => 'form-control']) ?>
        </div>

        <div class="form-group required">
            <label class="control-label" for="book-type"><?= Yii::t('app', 'Category') ?></label>
            <?= Html::dropDownList('Book[category_id]', null, $categoryDropDownList, ['id' => 'book-category', 'class' => 'form-control']) ?>
        </div>

        <div class="form-group required">
            <label class="control-label" for="book-type"><?= Yii::t('app', 'Library') ?></label>
            <?= Html::dropDownList('Book[library_id]', null, $libraryDropDownList, ['id' => 'book-status', 'class' => 'form-control']) ?>
        </div>

        <?= $form->field($modelBook, 'edition')->textInput() ?>

        <div class="form-group">
            <label class="control-label" for="book-key-words"><?= Yii::t('app', 'Key Words') .' (' . Yii::t('app', 'Comma separated') .')' ?></label>
            <?= Html::textInput('KeyWord[words]', isset($keyWords) ? $keyWords : null, ['id' => 'book-key-words', 'class' => 'form-control']) ?>
        </div>

        <?= $form->field($modelBook, 'description')->textarea(['rows' => 6]) ?>


        <div class="form-group">
            <?= Html::submitButton($modelBook->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $modelBook->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
<?php

$JS = '
$(".dynamicform_wrapper").on("beforeInsert", function(e, item) {
    console.log("beforeInsert");
});

$(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    console.log("afterInsert");
});

$(".dynamicform_wrapper").on("beforeDelete", function(e, item) {
    if (! confirm("' . Yii::t('app', 'Are you sure you want to delete this item?') . '")) {
        return false;
    }
    return true;
});

$(".dynamicform_wrapper").on("afterDelete", function(e) {
    console.log("' . Yii::t('app', 'Deleted item!') . '");
});

$(".dynamicform_wrapper").on("limitReached", function(e, item) {
    alert("' . Yii::t('app', 'Limit reached') . '");
});

';

$this->registerJs($JS);