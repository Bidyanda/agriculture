<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dosamigos\datepicker\DatePicker;
use yii\helpers\ArrayHelper;

$this->title = 'New Registration';
?>
<div class="site-index card">
    <?= $this->render('header') ?>
    <div class="card-body hasloader">
        <div id="full-loader"></div>
        <div class="loader">
            <div class="loader-cover"></div>
            <div class="loader-text">
                <i class="fa fa-spinner fa-spin text-primary"></i>&nbsp;
                <span class="loader-subtext">Uploading...</span>
            </div>
        </div>

        <?= $this->render('steps', ['step'=>3, 'active'=>3]) ?>

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

       <section>
          <h4 class="text-center">
              <div><b class="text-primary">Physical Disability :</b></div>
              <div><small><small>Fields marked (<span class="text-danger">*</span>) are mandatory</small></small></div>
          </h4>
          <br>
          <?= $form->field($model, 'nature_of_physical_disablity')->radioList([ 'YES' => 'YES', 'NO' => 'NO', ], ['prompt' => ''])->label($model->getAttributeLabel('nature_of_physical_disablity').' <span class="text-danger">*</span>') ?>

          <?= $form->field($model, 'extend_of_disability')->radioList([ 'YES' => 'YES', 'NO' => 'NO', ], ['prompt' => ''])->label($model->getAttributeLabel('extend_of_disability').' <span class="text-danger">*</span>') ?>
        </section>

        <section>
            <h4 class="text-center">
                <div><b class="text-primary">Create User Account</b></div>
            </h4>

            <div class="row">
                <div class="col-sm-offset-4 col-sm-5">
                    <h4><small>Note: Online Transaction Receipts will be sent to this address</small></h4>
                </div>
            </div>
            <?= $form->field($model, 'email', ['enableAjaxValidation'=>true])->textInput(['maxlength'=>true])->label($model->getAttributeLabel('email').' <span class="text-danger">*</span>') ?>

            <?= $form->field($model, 'username', ['enableAjaxValidation'=>true])->textInput(['maxlength'=>true])->label($model->getAttributeLabel('username').' <span class="text-danger">*</span>') ?>

            <?= $form->field($model, 'password')->passwordInput()->label($model->getAttributeLabel('password').' <span class="text-danger">*</span>') ?>

            <?= $form->field($model, 'confirmPassword')->passwordInput()->label($model->getAttributeLabel('confirmPassword').' <span class="text-danger">*</span>') ?>

            <br>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-8">
                    <label for="declaration" style="text-align: justify;">
                        <input type="checkbox" id="declaration">
                        I certify that the information I have provided is correct to the best of my knowledge and belief. If selected for training, I am prepared to undergo training in the institute.
                    </label>
                </div>
            </div>
         </section>

    	<br>
        <div class="form-group text-center">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary btn-lg', 'id'=>'submit-btn', 'disabled'=>true]) ?>
        </div>

        <?php ActiveForm::end() ?>
    </div>

</div>
<style type="text/css">
input, textarea {
	text-transform: uppercase;
}
[role="radiogroup"] {
    margin-top: 12px;
}
[role="radiogroup"] .radio {
    display: inline;
}
.form-horizontal .radio, .form-horizontal .radio-inline {
    padding-top: 2px;
}
[role="radiogroup"] .radio {
	display: inline;
}
#academic-email, #academic-username {
    text-transform: none;
}
</style>

<?php
$this->registerJs(<<<JS
$("#academic-ex_service_file").change(function() {
    readURL(this, $("#exservice_photo"));
});
$("#academic-sc_st_file").change(function() {
    readURL(this, $("#cat_photo"));
});
$("#academic-previous_trade_experience_file").change(function() {
    readURL(this, $("#exp_photo"));
});

$("input[name='Academic[sc_st]']").change(function() {
    if(this.value == 'GEN') {
        $("#categorycert").slideUp();
    } else {
        $("#categorycert").slideDown();
        if(this.value == 'PWD') {
            $("#degree").slideDown();
        } else {
            $("#degree").slideUp();
        }
    }
});
$("input[name='Academic[ex_service]']").change(function() {
    if(this.value == 'NO') {
        $("#exservice").slideUp();
    } else {
        $("#exservice").slideDown();
    }
});
$("#academic-previous_trade_experience").keyup(function() {
    if(this.value.length) {
        $("#experience").slideDown();
    } else {
        $("#experience").slideUp();
    }
});

$("#declaration").change(function() {
    if($(this).is(":checked")) {
        $("#submit-btn").prop("disabled", false);
    } else {
        $("#submit-btn").prop("disabled", true);
    }
});

$('#academic-form').on('keyup keypress', function(e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) {
        e.preventDefault();
        return false;
    }
});

$("#academic-form").on("beforeSubmit", function() {
    // let cat = $("input[name='Academic[sc_st]']:checked").val();
    // if(cat != 'GEN') {
    //     if(!$("#academic-sc_st_certificate_no").val().length || !$("#academic-date_of_issue").val().length) {
    //         toast('Please enter complete details of the Category Certificate', 'bg-red');
    //         return false;
    //     }
    //     if(cat == 'PWD' && !$("#academic-percentage_of_disability").val().length) {
    //         toast('Please enter Degree of Disability', 'bg-red');
    //         $("#academic-percentage_of_disability").focus();
    //         return false;
    //     }
    // }
    $(".loader").show();
	$("#submit-btn").prop("disabled", true);
});
JS
);
