<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use dosamigos\datepicker\DatePicker;
use app\models\State;
use app\models\Courses;
$state = ArrayHelper::map(State::find()->all(),'id','name');
$course = ArrayHelper::map(Courses::find()->all(),'id','name');
$this->title = 'New Registration';

$today = date('Y-m-d');
$start_date = date('d-M-Y', strtotime($today.'-30years'));
$end_date = date('d-M-Y', strtotime($today.'-10years'));

$division = ['1'=>'1st Division', '2'=>'2nd Division', '3'=>'3rd Division'];
$years = [];
for($y = 2020; $y > 2010; $y--) {
    $years[$y] = $y;
}
$model->dob = $model->dob ? date('d-M-Y', strtotime($model->dob)) : null;

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

        <?= $this->render('steps', ['step'=>2, 'active'=>2]) ?>

    	<?php $form = ActiveForm::begin([
            'id' => 'personal-form',
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
                <p><b class="text-primary">Personal Details</b></p>
                <div><small><small>Fields marked (<span class="text-danger">*</span>) are mandatory</small></small></div>
            </h4>
            <br>

            <?= $form->field($model, 'photo', ['template' => '{label}<div class="col-sm-5">{input}{error}</div><div class="col-sm-3"><img src="" id="photo" class="img-responsive img-thumbnail"></div>'])->fileInput()->label($model->getAttributeLabel('photo').' <span class="text-danger">*</span>') ?>

            <!-- <?//= $form->field($model, 'student_signature', ['template' => '{label}<div class="col-sm-5">{input}{error}</div><div class="col-sm-3"><img src="" id="sign" class="img-responsive img-thumbnail"></div>'])->fileInput()->label($model->getAttributeLabel('student_signature').' <span class="text-danger">*</span>') ?> -->

            <?= $form->field($model, 'student_name')->textInput(['maxlength' => true])->label($model->getAttributeLabel('student_name').' <span class="text-danger">*</span>') ?>
            <?= $form->field($model, 'father_name')->textInput(['maxlength' => true])->label($model->getAttributeLabel('father_name').' <span class="text-danger">*</span>') ?>
            <?= $form->field($model, 'mother_name')->textInput(['maxlength' => true])->label($model->getAttributeLabel('mother_name').' <span class="text-danger">*</span>') ?>
            <?= $form->field($model, 'dob')->label($model->getAttributeLabel('dob').' <span class="text-danger">*</span>')->widget(
                DatePicker::className(), [
                    'options' => ['readonly' => true, 'autocomplete'=>'off'],
                    'clientOptions' => [
                        'startDate' => $start_date,
                        'endDate' => $end_date,
                        'autoclose' => true,
                        'format' => 'dd-M-yyyy'
                    ]
            ]) ?>

            <?= $form->field($model, 'gender')->radioList([ 'MALE' => 'MALE', 'FEMALE' => 'FEMALE', 'TRANSGENDER' => 'TRANSGENDER'])->label($model->getAttributeLabel('gender').' <span class="text-danger">*</span>') ?>

            <?= $form->field($model, 'category')->dropDownList([ 'General' => 'General', 'OBC' => 'OBC', 'EBS' => 'EBS', 'ST' => 'ST', 'SC' => 'SC'], ['prompt' => '--Select Category--'])->label($model->getAttributeLabel('category').' <span class="text-danger">*</span>') ?>

            <div class="section2">
              <?= $form->field($model, 'obc_sc_st_file', ['template' => '{label}<div class="col-sm-5">{input}{error}</div><div class="col-sm-3"><img src="" id="obc_sc_st_file" class="img-responsive img-thumbnail"></div>'])->fileInput()->label($model->getAttributeLabel('obc_sc_st_file').' <span class="text-danger">*</span>') ?>
            </div>

            <?= $form->field($model, 'blood_group')->dropDownList([ 'A(+)' => 'A(+)', 'A(-)' => 'A(-)','B(+)' => 'B(+)', 'B(-)' => 'B(-)', 'O(+)' => 'O(+)', 'O(-)' => 'O(-)', 'AB(+)' => 'AB(+)','AB(-)' => 'AB(-)'], ['prompt' => '-Select Blood Group-'])->label($model->getAttributeLabel('blood_group').' <span class="text-danger">*</span>') ?>

            <?= $form->field($model, 'nationality')->textInput(['maxlength' => true,'value'=>'INDIAN'])->label($model->getAttributeLabel('nationality').' <span class="text-danger">*</span>') ?>

            <?= $form->field($model, 'country')->textInput(['maxlength' => true,'value'=>'INDIA'])->label($model->getAttributeLabel('country').' <span class="text-danger">*</span>') ?>

            <?= $form->field($model, 'state_of_domicile')->dropDownList($state, ['prompt' => '-Select State-'])->label($model->getAttributeLabel('state_of_domicile').' <span class="text-danger">*</span>') ?>

            <?= $form->field($model, 'course_id')->dropDownList($course, ['prompt' => '-Select Course-'])->label($model->getAttributeLabel('course_id').' <span class="text-danger">*</span>') ?>

            <?= $form->field($model, 'subject')->textInput(['maxlength' => true])->label($model->getAttributeLabel('subject').' <span class="text-danger">*</span>') ?>

            <?= $form->field($model, 'identification_mark')->textInput(['maxlength' => true])->label($model->getAttributeLabel('identification_mark').' <span class="text-danger">*</span>') ?>

            <?= $form->field($model, 'anual_income_parent')->textInput(['maxlength' => true, 'class'=>'form-control numberonly', 'type'=>'number'])->label($model->getAttributeLabel('anual_income_parent').' <span class="text-danger">*</span>') ?>

            <hr />
            <h4 class="labeling">
                <div><b class="text-secondary">Permanent Address :</b></div>
            </h4>

            <?= $form->field($model, 'permanent_address')->textarea(['rows' => 2])->label('Address <span class="text-danger">*</span>') ?>

            <?= $form->field($model, 'permanent_state_id')->dropDownList($state, ['prompt' => '-Select State-'])->label($model->getAttributeLabel('permanent_state_id').' <span class="text-danger">*</span>') ?>

            <?= $form->field($model, 'permanent_district')->dropDownList([ 'Bishnupur' => 'Bishnupur', 'Chandel' => 'Chandel', 'Churachandpur' => 'Churachandpur', 'Imphal East' => 'Imphal East',
             'Imphal West' => 'Imphal West', 'Jiribam' => 'Jiribam', 'Kakching' => 'Kakching', 'Kamjong' => 'Kamjong', 'Kangpokpi' => 'Kangpokpi', 'Noney' => 'Noney', 'Pherzawl' => 'Pherzawl',
              'Senapati' => 'Senapati', 'Tamenglong' => 'Tamenglong', 'Tengnoupal' => 'Tengnoupal', 'Thoubal' => 'Thoubal', 'Ukhrul' => 'Ukhrul'], ['prompt' => '--Select District--'])->label('District <span class="text-danger">*</span>') ?>

            <?= $form->field($model, 'permanent_pin')->textInput(['maxlength' => true, 'class'=>'form-control numberonly', 'type'=>'number'])->label($model->getAttributeLabel('permanent_pin').' <span class="text-danger">*</span>') ?>
            <hr />
            <h4 class="labeling">
                <div><b class="text-secondary">Present Address :</b></div>
            </h4>
            <label class="labelings"><input type="checkbox" id="address" name="address"> Same as Above</label>

            <?= $form->field($model, 'present_address')->textarea(['rows' => 2])->label('Address <span class="text-danger">*</span>') ?>

            <?= $form->field($model, 'present_state_id')->dropDownList($state, ['prompt' => '-Select State-'])->label($model->getAttributeLabel('present_state_id').' <span class="text-danger">*</span>') ?>

            <?= $form->field($model, 'present_district')->dropDownList([ 'Bishnupur' => 'Bishnupur', 'Chandel' => 'Chandel', 'Churachandpur' => 'Churachandpur', 'Imphal East' => 'Imphal East',
             'Imphal West' => 'Imphal West', 'Jiribam' => 'Jiribam', 'Kakching' => 'Kakching', 'Kamjong' => 'Kamjong', 'Kangpokpi' => 'Kangpokpi', 'Noney' => 'Noney', 'Pherzawl' => 'Pherzawl',
              'Senapati' => 'Senapati', 'Tamenglong' => 'Tamenglong', 'Tengnoupal' => 'Tengnoupal', 'Thoubal' => 'Thoubal', 'Ukhrul' => 'Ukhrul'], ['prompt' => '--Select District--'])->label('District <span class="text-danger">*</span>') ?>

            <?= $form->field($model, 'present_pin')->textInput(['maxlength' => true, 'class'=>'form-control numberonly', 'type'=>'number'])->label($model->getAttributeLabel('present_pin').' <span class="text-danger">*</span>') ?>

        </section>

        <section id="section1">
            <h4 id="qualification1" class="text-center">
                <div><b class="text-primary">Class X Details</b></div>
            </h4>
            <br>
            <?= $form->field($model, 'examination_board_1')->textInput(['maxlength' => true,'readonly'=>true])->label($model->getAttributeLabel('examination_board_1').' <span class="text-danger">*</span>') ?>

            <?= $form->field($model, 'examination_1')->textInput(['maxlength' => true])->label($model->getAttributeLabel('examination_1').' <span class="text-danger">*</span>') ?>

            <?= $form->field($model, 'year_of_passing_1')->dropDownList($years, ['prompt'=>'- Select Year -'])->label($model->getAttributeLabel('year_of_passing_1').' <span class="text-danger">*</span>') ?>

            <?= $form->field($model, 'division_1')->radioList($division)->label($model->getAttributeLabel('division_1').' <span class="text-danger">*</span>') ?>

            <?= $form->field($model, 'subjects_taken_1')->textArea(['rows' => 2])->label($model->getAttributeLabel('subjects_taken_1').' <span class="text-danger">*</span>') ?>

            <?= $form->field($model, 'percentage_1')->textInput(['class'=>'form-control percentage', 'type'=>'number', 'step'=>0.01])->label($model->getAttributeLabel('percentage_1').' <span class="text-danger">*</span>') ?>

            <?= $form->field($model, 'aggregate_mark_1')->textInput(['class'=>'form-control percentage', 'type'=>'number', 'step'=>0.01])->label($model->getAttributeLabel('aggregate_mark_1').' <span class="text-danger">*</span>') ?>

            <?= $form->field($model, 'certificate_1', ['template' => '{label}<div class="col-sm-5">{input}{error}</div><div class="col-sm-3"><img src="" id="certificate1" class="img-responsive img-thumbnail"></div>'])->fileInput()->label($model->getAttributeLabel('certificate_1').' <span class="text-danger">*</span>') ?>

            <?= $form->field($model, 'marksheet_1', ['template' => '{label}<div class="col-sm-5">{input}{error}</div><div class="col-sm-3"><img src="" id="marksheet1" class="img-responsive img-thumbnail"></div>'])->fileInput()->label($model->getAttributeLabel('marksheet_1').' <span class="text-danger">*</span>') ?>
        </section>

        <section id="section3">
            <h4 class="text-center">
                <div><b class="text-primary">Class XII Details</b></div>
            </h4>
            <br>

            <?php $model->examination_board_2 = empty($reg->examination_board_2)?'COHSEM':'OTHERS'; ?>
            <?= $form->field($model, 'examination_board_2')->radioList(['COHSEM'=>'COHSEM','OTHERS'=>'OTHERS'])->label($model->getAttributeLabel('examination_board_1').' <span class="text-danger">*</span>') ?>
            <div class="section4">
              <?= $form->field($model, 'examination_board_2')->textInput(['id'=>'board','placeholder'=>'Enter Your Board Name'])->label('') ?>
            </div>

            <?= $form->field($model, 'examination_2')->textInput(['maxlength' => true])->label($model->getAttributeLabel('examination_2').' <span class="text-danger">*</span>') ?>

            <?= $form->field($model, 'year_of_passing_2')->dropDownList($years, ['prompt'=>'- Select Year -'])->label($model->getAttributeLabel('year_of_passing_2').' <span class="text-danger">*</span>') ?>

            <?= $form->field($model, 'division_2')->radioList($division)->label($model->getAttributeLabel('division_2').' <span class="text-danger">*</span>') ?>

            <?= $form->field($model, 'subjects_taken_2')->textArea(['rows' => 2])->label($model->getAttributeLabel('subjects_taken_2').' <span class="text-danger">*</span>') ?>

            <?= $form->field($model, 'percentage_2')->textInput(['class'=>'form-control percentage', 'type'=>'number', 'step'=>0.01])->label($model->getAttributeLabel('percentage_2').' <span class="text-danger">*</span>') ?>

            <?= $form->field($model, 'aggregate_mark_2')->textInput(['class'=>'form-control percentage', 'type'=>'number', 'step'=>0.01])->label($model->getAttributeLabel('aggregate_mark_2').' <span class="text-danger">*</span>') ?>

            <?= $form->field($model, 'certificate_2', ['template' => '{label}<div class="col-sm-5">{input}{error}</div><div class="col-sm-3"><img src="" id="certificate2" class="img-responsive img-thumbnail"></div>'])->fileInput()->label($model->getAttributeLabel('certificate_2').' <span class="text-danger">*</span>') ?>

            <?= $form->field($model, 'marksheet_2', ['template' => '{label}<div class="col-sm-5">{input}{error}</div><div class="col-sm-3"><img src="" id="marksheet2" class="img-responsive img-thumbnail"></div>'])->fileInput()->label($model->getAttributeLabel('marksheet_2').' <span class="text-danger">*</span>') ?>

            <?= $form->field($model, 'migration_transfer', ['template' => '{label}<div class="col-sm-5">{input}{error}</div><div class="col-sm-3"><img src="" id="migration_transfer" class="img-responsive img-thumbnail"></div>'])->fileInput()->label($model->getAttributeLabel('migration_transfer').' <span class="text-danger">*</span>') ?>
            <hr />
            <h4 class="labeling">
                <div><b class="text-secondary">If required for affidavit(Optional):</b></div>
            </h4>
            <?= $form->field($model, 'affidavit', ['template' => '{label}<div class="col-sm-5">{input}{error}</div><div class="col-sm-3"><img src="" id="affidavit" class="img-responsive img-thumbnail"></div>'])->fileInput()->label($model->getAttributeLabel('affidavit')) ?>
            <hr>
            <label class="labelings"><input type="checkbox" id="course" name="Personals[is_other_course]" value='1'> Other Course(Optional) </label>
        </section>
        <section id="section5">
            <h4 class="text-center">
                <div><b class="text-primary">Other Certificate Course:</b></div>
            </h4>
            <br>
            <?= $form->field($model, 'institution_name')->textInput()->label('Institution Name') ?>

            <!-- <?//= $form->field($model, 'examination_board_2')->textInput(['maxlength' => true])->label($model->getAttributeLabel('examination_board_2').' <span class="text-danger">*</span>') ?> -->

            <?= $form->field($model, 'other_course')->textInput(['maxlength' => true])->label('Course Name') ?>

            <?= $form->field($model, 'year_other_course')->dropDownList($years, ['prompt'=>'- Select Year -'])->label($model->getAttributeLabel('year_other_course')) ?>

            <?= $form->field($model, 'other_course_certificate', ['template' => '{label}<div class="col-sm-5">{input}{error}</div><div class="col-sm-3"><img src="" id="certificate3" class="img-responsive img-thumbnail"></div>'])->fileInput()->label($model->getAttributeLabel('other_course_certificate')) ?>

        </section>

    	<br>
        <div class="form-group text-center">
            <?= Html::submitButton('Proceed', ['class' => 'btn btn-primary btn-lg', 'id'=>'submit-btn']) ?>
        </div>

        <?php ActiveForm::end() ?>
	</div>
</div>

<style type="text/css">
input, textarea {
	text-transform: uppercase;
}
.labeling{
    text-align: right;
    padding-right: 69%;
}
.labelings{
    text-align: left;
    padding-left: 34%;
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
.section2{
  display:none;
}
.section4{
  display:none;
}
#section5{
  display:none;
}
</style>

<?php
$this->registerJs(<<<JS
$('#personal-form').on('keyup keypress', function(e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) {
        e.preventDefault();
        return false;
    }

});
$("input[name='Personals[examination_board_2]']").change(function() {
    // console.log(this.value);
    if(this.value == 'OTHERS') {
        $(".section4").slideDown();
        $("#board").show();
        $("#board").val('');
        $(".field-personals-migration_transfer").find('.control-label').html('Upload Migration Certificate<span class="text-danger">*</span>');
    } else if(this.value == 'COHSEM') {
        $(".section4").slideUp();
        $("#board").hide();
        $(".field-personals-migration_transfer").find('.control-label').html('Upload Transfer Certificate<span class="text-danger">*</span>');
        $("#board").val('COHSEM');
    }
});

$("#personals-photo").change(function() {
    readURL(this, $("#photo"));
});
$("#personals-affidavit").change(function() {
    readURL(this, $("#affidavit"));
});

$("#personals-migration_transfer").change(function() {
    readURL(this, $("#migration_transfer"));
});

$("#personals-other_course_certificate").change(function() {
    readURL(this, $("#certificate3"));
});

$("#personals-obc_sc_st_file").change(function() {
    readURL(this, $("#obc_sc_st_file"));
});
$("#personals-certificate_1").change(function() {
    readURL(this, $("#certificate1"));
});
$("#personals-marksheet_2").change(function() {
    readURL(this, $("#marksheet2"));
});
$("#personals-marksheet_3").change(function() {
    readURL(this, $("#marksheet3"));
});
$("#personals-certificate_2").change(function() {
    readURL(this, $("#certificate2"));
});
$("#personals-certificate_3").change(function() {
    readURL(this, $("#certificate3"));
});

$("#personals-marksheet_1").change(function() {
    readURL(this, $("#marksheet1"));
});
$("#personals-marksheet_2").change(function() {
    readURL(this, $("#marksheet2"));
});

$("#personals-form").on("beforeSubmit", function() {
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


$("#address").click(function() {
  if($('#address').is(":checked"))
   {
       var add =  $("#personals-permanent_address").val();
       var district =  $("#personals-permanent_district").val();
       var pin =  $("#personals-permanent_pin").val();
       var state = $("#personals-permanent_state_id").val();
       $("#personals-present_address").val(add);
       $("#personals-present_district").val(district);
       $("#personals-present_pin").val(pin);
       $("#personals-present_state_id").val(state);
   }else {
      $("#personals-present_address").val('');
      $("#personals-present_district").val('');
      $("#personals-present_pin").val('');
      $("#personals-present_state_id").val('');
   }
});
$("#course").click(function() {
  if($('#course').is(":checked"))
   {
      $("#section5").slideDown();
   }else {
     $("#section5").slideUp();
      $("#personals-institution_name").val('');
      $("#personals-other_course").val('');
      $("#personals-year_other_course").val('');
   }
});
$("select[name='Personals[category]']").change(function() {

    if(this.value != 'General') {
        $(".section2").slideDown();
        $("#personals-obc_sc_st_file").show();
    } else {
        $(".section2").slideUp();
        $("#personals-obc_sc_st_file").hide();
    }
});
JS
);
