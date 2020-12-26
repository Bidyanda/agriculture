<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dosamigos\datepicker\DatePicker;
use yii\helpers\ArrayHelper;
use app\models\Courses;

$course = ArrayHelper::map(Courses::find()->all(),'id','name');
$this->title = 'User List';
?>
    <!-- <?//= $this->render('header') ?> -->
        <!-- <div id="full-loader"></div>
        <div class="loader">
            <div class="loader-cover"></div>
            <div class="loader-text">
                <i class="fa fa-spinner fa-spin text-primary"></i>&nbsp;
                <span class="loader-subtext">Uploading...</span>
            </div>
        </div> -->
    	<?php $form = ActiveForm::begin([
            'id' => 'academic-form',
            'layout' => 'horizontal',
            'fieldConfig' => [
                'horizontalCssClasses' => [
                    'label' => 'col-sm-4',
                    'offset' => 'col-sm-offset-2',
                    'wrapper' => 'col-sm-5',
                ],
            ],
        ]); ?>
            <h4 class="text-center">
                <div><b class="text-primary">Create User Account</b></div>
            </h4>
            <?= $form->field($model, 'email', ['enableAjaxValidation'=>true])->textInput(['maxlength'=>true])->label($model->getAttributeLabel('email').' <span class="text-danger">*</span>') ?>

            <?= $form->field($model, 'username', ['enableAjaxValidation'=>true])->textInput(['maxlength'=>true])->label($model->getAttributeLabel('username').' <span class="text-danger">*</span>') ?>
            <?= $form->field($model, 'course_id')->dropdownlist($course,['prompt'=>'--Select Course--','required'=>true])->label('Course <span class="text-danger">*</span>') ?>
            <?= $form->field($model, 'password')->passwordInput()->label($model->getAttributeLabel('password').' <span class="text-danger">*</span>') ?>

            <?= $form->field($model, 'confirmPassword')->passwordInput()->label($model->getAttributeLabel('confirmPassword').' <span class="text-danger">*</span>') ?>

            <br>

    	<br>
        <div class="form-group text-center">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary btn-lg', 'id'=>'submit-btn']) ?>
        </div>

        <?php ActiveForm::end() ?>

<style type="text/css">
input, textarea {
	text-transform: uppercase;
}

.form-horizontal .radio, .form-horizontal .radio-inline {
    padding-top: 2px;
}

#academic-email, #academic-username {
    text-transform: none;
}
</style>

<?php
$this->registerJs(<<<JS

$('#academic-form').on('keyup keypress', function(e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) {
        e.preventDefault();
        return false;
    }
});

$("#academic-form").on("beforeSubmit", function() {
	$("#submit-btn").prop("disabled", true);
});
JS
);
