<?php
use app\models\Image;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin() ?>

<?= Html::dropDownList('category',$selectedCategory,$categories,['class'=>'form-control']) ?>

<div class="form-group">
    <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end() ?>
