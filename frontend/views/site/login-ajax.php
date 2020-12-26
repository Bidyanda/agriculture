<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>
<div class="site-login">

    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

    <div class="text-center">
        <img class="logo" src="/images/cultural-logo.png">
    </div>
    <br>
    <div class="row">
        <div class="col-sm-offset-2 col-sm-8">
            <?= $form->field($model, 'username')->textInput(['placeholder'=>'Username'])->label(false) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-offset-2 col-sm-8">
            <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Password'])->label(false) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="form-group">
                <?= Html::submitButton('Login', ['class' => 'btn btn-block btn-lg btn-primary', 'id' => 'login-button', 'style'=>'border-radius: 0;']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<br>

<style type="text/css">
.site-login .help-block, .header-text {
    color: #fff !important;
}
.header-text {
    color: #3d5890 !important;
}
#loginform-username, #loginform-password {
    text-transform: none;
}
</style>

<?php
$this->registerJs(<<<JS
setTimeout(function() {
    $("#loginform-username").focus();
}, 800);

$("#login-form").on("beforeSubmit", function() {
    $("#login-button").text("Logging in...");
    $("#login-button").prop("disabled", true);
});
JS
);
