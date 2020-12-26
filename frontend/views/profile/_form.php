<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use dosamigos\datepicker\DatePicker;
$this->title = 'Profile';
$path = Yii::getAlias('@webroot');
$today = date('Y-m-d');
$start_date = date('d-M-Y', strtotime($today.'-30years'));
$end_date = date('d-M-Y', strtotime($today.'-10years'));
$district = [ '1' => 'Bishnupur', '2' => 'Chandel', '3' => 'Churachandpur', '4' => 'Imphal East','5' => 'Imphal West', '6' => 'Jiribam', '7' => 'Kakching', '8' => 'Kamjong', '9' => 'Kangpokpi', '10' => 'Noney', '11' => 'Pherzawl','12' => 'Senapati', '13' => 'Tamenglong', '14' => 'Tengnoupal', '15' => 'Thoubal', '16' => 'Ukhrul'];
?>

<div class="site-index card ">
    <div class="card-body hasloader">
        <div id="full-loader"></div>
        <div class="loader">
            <div class="loader-cover"></div>
            <div class="loader-text">
                <i class="fa fa-spinner fa-spin text-primary"></i>&nbsp;
                <span class="loader-subtext">Uploading...</span>
            </div>
        </div>

      <?php $form = ActiveForm::begin([
            'id' => 'profile-form',
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
                <p><b class="text-primary" style="font-size:25px;">Saller Profile</b></p>
                <div><small>Fields marked (<span class="text-danger">*</span>) are mandatory</small></div>
            </h4>
            <br>
            <?php
                $photo = empty($model->photo)?'':$model->photo;
                $signature = empty($model->signature)?'':$model->signature;
                $certificate = empty($model->certificate_awarded)?'':$model->certificate_awarded;
             ?>
             <?php if($is_update){?>
               <?= $form->field($model, 'photos', ['template' => '{label}<div class="col-sm-5">{input}{error}</div><div class="col-sm-3"><img src="'.$photo.'" id="photo" class="img-responsive img-thumbnail"></div>'])->fileInput()->label($model->getAttributeLabel('photo').' <span class="text-danger">*</span>') ?>
             <?php }else{ ?>
               <?= $form->field($model, 'photo', ['template' => '{label}<div class="col-sm-5">{input}{error}</div><div class="col-sm-3"><img src="'.$photo.'" id="photo" class="img-responsive img-thumbnail"></div>'])->fileInput()->label($model->getAttributeLabel('photo').' <span class="text-danger">*</span>') ?>
             <?php } ?>
             <?php if($is_update){?>
               <?= $form->field($model, 'signatures', ['template' => '{label}<div class="col-sm-5">{input}{error}</div><div class="col-sm-3"><img src="'.$signature.'" id="signature" class="img-responsive img-thumbnail"></div>'])->fileInput()->label($model->getAttributeLabel('signature').' <span class="text-danger">*</span>') ?>
             <?php }else{ ?>
               <?= $form->field($model, 'signature', ['template' => '{label}<div class="col-sm-5">{input}{error}</div><div class="col-sm-3"><img src="'.$signature.'" id="signature" class="img-responsive img-thumbnail"></div>'])->fileInput()->label($model->getAttributeLabel('signature').' <span class="text-danger">*</span>') ?>
             <?php } ?>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label($model->getAttributeLabel('name').' <span class="text-danger">*</span>') ?>
            <?= $form->field($model, 'email')->textInput(['maxlength' => true])->label($model->getAttributeLabel('email').' <span class="text-danger">*</span>') ?>
            <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'district')->dropDownList($district, ['prompt' => '--Select District--'])->label('District <span class="text-danger">*</span>') ?>
            <?= $form->field($model, 'name_of_concern')->textInput(['maxlength' => true])->label($model->getAttributeLabel('name_of_concern').' <span class="text-danger">*</span>') ?>
            <?= $form->field($model, 'qualification')->textInput(['maxlength' => true])->label($model->getAttributeLabel('qualification').' <span class="text-danger">*</span>') ?>
            <?= $form->field($model, 'training_course')->textInput(['maxlength' => true])->label($model->getAttributeLabel('training_course').' <span class="text-danger">*</span>') ?>
            <?= $form->field($model, 'training_course_duration')->dropDownList([ '1' => '1-Year', '2' => '2-Years', '3' => '3-Years', '4' => '4-Years', '5' => '5-Years'], ['prompt' => '--Select Duration--'])->label($model->getAttributeLabel('training_course_duration').' <span class="text-danger">*</span>') ?>
            <?= $form->field($model, 'certificate_awarded', ['template' => '{label}<div class="col-sm-5">{input}{error}</div><div class="col-sm-3"><img src="'.$certificate.'" id="certificate" class="img-responsive img-thumbnail"></div>'])->fileInput()->label($model->getAttributeLabel('certificate_awarded')) ?>
      <br>
      <div>
        <h5 style="color:red">Note:- Minimum qualification shall be a graduate with degree in Agriculture or Science with Chemistry/Zoology/Botany/Biotechnology/Life Sciences.</h5>
      </div>
      <div class="form-group text-center">
          <?= Html::submitButton('Proceed', ['class' => 'btn btn-primary btn-lg', 'id'=>'submit-btn']) ?>
      </div>
      <?php ActiveForm::end() ?>
  </div>
</div>
<?php
$this->registerJs(<<<JS
$('#profile-form').on('keyup keypress', function(e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) {
        e.preventDefault();
        return false;
    }

});

$("#profile-photo").change(function() {
    readURL(this, $("#photo"));
});

$("#profile-photos").change(function() {
    readURL(this, $("#photo"));
});

$("#profile-signature").change(function() {
    readURL(this, $("#signature"));
});

$("#profile-signatures").change(function() {
    readURL(this, $("#signature"));
});

$("#profile-certificate_awarded").change(function() {
    readURL(this, $("#certificate"));
});

$("#profile-form").on("beforeSubmit", function() {
    // not compulsory
	// let qual = $("input[name='Personal[educational_qualification]']:checked").val();
 //    if(qual == '1') {
 //        if(!$("#personal-examination_2").val().length || !$("#personal-year_of_passing_2").val().length || !$("#personal-subjects_taken_2").val().length || !$("#personal-percentage_2").val().length) {
 //            toast('Please enter Higher Examination Details', 'bg-red');
 //            $("#personal-examination_2").focus();
 //            return false;
 //        }
 //    }
    $(".loader").show();
	$("#submit-btn").prop("disabled", true);
});

JS
);
