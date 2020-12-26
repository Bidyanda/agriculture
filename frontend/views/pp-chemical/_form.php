<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use dosamigos\datepicker\DatePicker;
use wbraganca\dynamicform\DynamicFormWidget;
$this->title = 'Form-VIII';

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
                <p>
                  <b class="text-primary" style="font-size:22px;"><u>FORM-VIII</u></b><br />
                  <b class="text-primary" style="font-size:22px;">APPLICATION FOR THE GRANT/RENEWAL OF LICENCE TO SELL, STOCK OR EXHIBIT FOR SALE OR DISTRIBUTE INSECTICIDES,</b><br />
                  <b class="text-primary" style="font-size:22px;">APPLICATION FOR GRANT/RENEWAL OF LICENCE TO STOCK AND USE OF INSECTICDES FOR COMMERCIAL PEST CONTROL OPERATION</b><br /><br />
                  <div><small>[See sub-rules(1) and (3A) of rule 10]</small></div>
                </p>
                <div><small>Fields marked (<span class="text-danger">*</span>) are mandatory</small></div>
            </h4>
            <div align='center'>
              <?= $form->field($model, 'is_renew')->radiolist(['1'=>'New','2'=>'Renewal'])->label('Application for Licence <span class="text-danger">*</span>') ?>
            </div>
            <?php if($model->is_renew == '2') {?>
              <?= $form->field($model, 'licence')->textInput()->label($model->getAttributeLabel('licence').' <span class="text-danger">*</span>') ?>
              <?= $form->field($model, 'if_renewal_date_of_grant')->widget(DatePicker::className(), [
                                                                                'options' => ['readonly' => true,'class'=>'form-control','autocomplete'=>'off','placeholder'=>'Date of licence grant'],
                                                                                'clientOptions' => [
                                                                                    'autoclose' => true,
                                                                                    'format' => 'dd-mm-yyyy'
                                                                                ]
                                                                        ])->label($model->getAttributeLabel('Date of grant').' <span class="text-danger">*</span>')  ?>
            <?php } ?>
            <?php if(!empty($model->is_renew)){ ?>
              <h4 class="text-center">
                  <div><b class="text-primary">In case of application for commercial pest control operations</b></div>
              </h4>
              <section>
                <?= $form->field($model, 'address_of_registered')->textarea(['rows' =>3])->label($model->getAttributeLabel('Address of registrered, zonal and branch offices').' <span class="text-danger">*</span>')  ?>

                <?= $form->field($model, 'address_of_premises')->textarea(['rows' =>3])->label($model->getAttributeLabel('Address of the premises for which the licence is applied for ').' <span class="text-danger">*</span>')  ?>

                <?= $form->field($model, 'approval_of_technical_expertise')->radiolist(['yes'=>'Yes','no'=>'No'])->label($model->getAttributeLabel('Whether approval of technical expertise obtained ').' <span class="text-danger">*</span>')  ?>
                <div class="approval">
                  <?= $form->field($model, 'if_yes_ref_no')->textInput()->label($model->getAttributeLabel('If yes, state reference number').' <span class="text-danger"></span>')  ?>

                  <?= $form->field($model, 'if_yes_approved_date')->widget(DatePicker::className(), [
                                                                                    'options' => ['readonly' => true,'class'=>'form-control','autocomplete'=>'off','placeholder'=>'Date of grant'],
                                                                                    'clientOptions' => [
                                                                                        'autoclose' => true,
                                                                                        'format' => 'dd-mm-yyyy'
                                                                                    ]
                                                                            ])->label($model->getAttributeLabel('If yes, approval date').' <span class="text-danger"></span>')  ?>

                  <?= $form->field($model, 'if_yes_validity')->widget(DatePicker::className(), [
                                                                                    'options' => ['readonly' => true,'class'=>'form-control','autocomplete'=>'off','placeholder'=>'Licence Validity'],
                                                                                    'clientOptions' => [
                                                                                        'autoclose' => true,
                                                                                        'format' => 'dd-mm-yyyy'
                                                                                    ]
                                                                            ])->label($model->getAttributeLabel('If yes, date of validity').' <span class="text-danger"></span>')  ?>

                </div>
                <?= $form->field($model, 'name_of_restricted_insecticides')->textInput(['maxlength' => true])->label($model->getAttributeLabel('Name of restricted insecticides for which approved').' <span class="text-danger">*</span>')  ?>

                <?= $form->field($model, 'name_of_resp_tech_persion')->textInput(['maxlength' => true])->label($model->getAttributeLabel('Name of the responsibile technical person').' <span class="text-danger">*</span>')  ?>

                <?= $form->field($model, 'restricted_insecticide_possession_date')->radioList(['yes'=>'Yes','no'=>'No'])->label($model->getAttributeLabel('Whether any quantity of restricted insecticide in possession as on date of application').' <span class="text-danger">*</span>')  ?>

                <?= $form->field($model, 'if_yes_particulars_respective_quantity_possession')->textInput(['maxlength' => true])->label($model->getAttributeLabel('If yes, particluars and respective quantity of each in possesion').' <span class="text-danger">*</span>')  ?>

                <?= $form->field($model, 'details_of_safety_equipment_antidotes', ['template' => '{label}<div class="col-sm-5">{input}{error}</div><div class="col-sm-3"><img src="" id="photo" class="img-responsive img-thumbnail"></div>'])->fileInput()->label($model->getAttributeLabel('Details of safety equipment, antidotes and all other essential facilities.(Enclose Document)').' <span class="text-danger">*</span>') ?>

              </section>
              <h4 class="text-center">
                  <div><b class="text-primary">Name of the insecticide(s) and ists/their manufacturer/importer which the applicant instends to desl in and status of the principals(s) certificate:</b></div>
              </h4>
              <section>
                <div class="task-form">
                  <div class="container-items"><!-- widgetContainer -->
                    <?php DynamicFormWidget::begin([
                        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                        'widgetBody' => '.container-items', // required: css class selector
                        'widgetItem' => '.item', // required: css class
                        'limit' => 8, // the maximum times, an element can be added (default 999)
                        'min' => 1, // QUESTION: , // 0 or 1 (default 1)
                        'insertButton' => '.add-item', // css class
                        'deleteButton' => '.remove-item', // css class
                        'model' => $modelsInsecticide[0],
                        'formId' => 'profile-form',
                        'formFields' => [
                            'sl_no',
                            'particular_of_insecticide',
                            'name_of_manufacturer',
                            'registration_no',
                            'principal_certificate_no',
                            'principal_certificate_date_of_issue',
                            'principal_certificate_validity',
                        ],
                    ]);
                    ?>
                    <div class="container-items"><!-- widgetContainer -->
                      <?php foreach ($modelsInsecticide as $i => $modelInsecticide): ?>
                          <div class="item panel panel-default"><!-- widgetBody -->
                              <div class="panel-heading">
                                  <div class="pull-right">
                                      <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                      <button type="button" class="remove-item btn btn-danger btn-xs "><i class="glyphicon glyphicon-minus"></i></button>
                                  </div>
                                  <!-- <div class="clearfix"></div> -->
                              </div>
                              <div class="panel-body">
                                  <?php
                                      // necessary for update action.
                                      if (! $modelInsecticide->isNewRecord) {
                                          echo Html::activeHiddenInput($modelInsecticide, "[{$i}]id");
                                      }
                                  ?>
                                    <?= $form->field($modelInsecticide, "[{$i}]sl_no",['template' => '<div class="col-md-1 top width">{input}{error}</div>'])->textInput(['placeholder'=>'SL.no','type'=>'number'])->label(false) ?>
                                    <?= $form->field($modelInsecticide, "[{$i}]particular_of_insecticide",['template' => '<div class="col-md-2 width">{input}{error}</div>'])->textInput(['placeholder'=>'Particular of insecticide'])->label(false) ?>
                                    <?= $form->field($modelInsecticide, "[{$i}]name_of_manufacturer",['template' => '<div class="col-md-2 width">{input}{error}</div>'])->textInput(['placeholder'=>'Name of manufacturer'])->label(false) ?>
                                    <?= $form->field($modelInsecticide, "[{$i}]registration_no",['template' => '<div class="col-md-2 width">{input}{error}</div>'])->textInput(['class'=>'form-control percentage','placeholder'=>'Registration No.','maxlength' => true,'class'=>'form-control edu'])->label(false) ?>
                                    <?= $form->field($modelInsecticide, "[{$i}]principal_certificate_no",['template' => '<div class="col-md-1 width">{input}{error}</div>'])->textInput(['maxlength' => true,'placeholder'=>'Cert. No.'])->label(false) ?>
                                    <?= $form->field($modelInsecticide, "[{$i}]principal_certificate_date_of_issue",['template' => '<div class="col-md-2 width">{input}{error}</div>'])->widget(DatePicker::className(), [
                                                                                                      'options' => ['readonly' => true,'class'=>'form-control issuedate','autocomplete'=>'off','placeholder'=>'Cert. Issue'],
                                                                                                      'clientOptions' => [
                                                                                                          'autoclose' => true,
                                                                                                          'format' => 'dd-mm-yyyy'
                                                                                                      ]
                                                                                              ])  ?>
                                    <?= $form->field($modelInsecticide, "[{$i}]principal_certificate_validity",['template' => '<div class="col-md-2 width ">{input}{error}</div>'])->widget(DatePicker::className(), [
                                                                                                      'options' => ['readonly' => true,'class'=>'form-control certvalidity','autocomplete'=>'off','placeholder'=>'cert. Validity'],
                                                                                                      'clientOptions' => [
                                                                                                          'autoclose' => true,
                                                                                                          'format' => 'dd-mm-yyyy'
                                                                                                      ]
                                                                                              ])?>
                              </div>
                          </div>
                      <?php endforeach; ?>
                    </div>
                    <?php DynamicFormWidget::end(); ?>
                  </div>
                </div>
              </section>
              <h4 class="text-center">
                  <div><b class="text-primary">Complete address (including name of the land, PIN Code, etc.) of the premises, where the insecticides(s) shall be </b></div>
              </h4>
              <section>
                <?= $form->field($model, 'insecticide_store_address')->textarea(['rows' => 3])->label($model->getAttributeLabel('insecticide_store_address').' <span class="text-danger">*</span>')  ?>

                <?= $form->field($model, 'insecticide_store_land')->textInput(['maxlength' => true])->label($model->getAttributeLabel('insecticide_store_land').' <span class="text-danger">*</span>')  ?>

                <?= $form->field($model, 'insecticide_store_pin_code')->textInput()->label($model->getAttributeLabel('insecticide_store_pin_code').' <span class="text-danger">*</span>')  ?>

                <?= $form->field($model, 'insecticide_store_disctrict')->dropDownList($district,['prompt' =>'--Select District--'])->label($model->getAttributeLabel('insecticide_store_disctrict').' <span class="text-danger">*</span>')  ?>

                <?= $form->field($model, 'insecticide_stored_or_stocked')->textInput(['maxlength' => true])->label($model->getAttributeLabel('insecticide_stored_or_stocked').' <span class="text-danger">*</span>')  ?>

                <?= $form->field($model, 'sold_exhibited_for_sale_issued')->textInput(['maxlength' => true])->label($model->getAttributeLabel('Sold or exhibited for sale or issued for use in case of commercial pest control operations').' <span class="text-danger">*</span>')  ?>

                <?= $form->field($model, 'above_premises_residential_area')->textInput(['maxlength' => true])->label($model->getAttributeLabel('Whether any of the aboce primeses is situated in residential area').' <span class="text-danger">*</span>')  ?>

                <?= $form->field($model, 'above_premises_food_articles_stored')->textInput(['maxlength' => true])->label($model->getAttributeLabel('whether food articles are also stored in any of the above premises').' <span class="text-danger">*</span>')  ?>
              </section>
              <h4 class="text-center">
                  <div><b class="text-primary">Other Information</b></div>
              </h4>
              <?= $form->field($model, 'if_issued_of_applicant_licence')->textInput(['maxlength' => true])->label($model->getAttributeLabel('Full particular of licence(s), if issued in the name of thwe applicant by any other state in the area of their jurisdiction').' <span class="text-danger"></span>')  ?>

              <!-- <?//= $form->field($model, 'particular_application_fee')->textInput(['maxlength' => true])->label($model->getAttributeLabel('particular_application_fee').' <span class="text-danger">*</span>')  ?>

              <?//= $form->field($model, 'application_challan_or_draft_pay_order')->textInput(['maxlength' => true])->label($model->getAttributeLabel('application_challan_or_draft_pay_order').' <span class="text-danger">*</span>')  ?>

              <?//= $form->field($model, 'application_fee_date')->textInput()->label($model->getAttributeLabel('application_fee_date').' <span class="text-danger">*</span>')  ?>

              <?//= $form->field($model, 'application_fee_amount')->textInput(['maxlength' => true])->label($model->getAttributeLabel('application_fee_amount').' <span class="text-danger">*</span>')  ?>

              <?//= $form->field($model, 'sub_treasury_in_treasury_challan')->textInput(['maxlength' => true])->label($model->getAttributeLabel('sub_treasury_in_treasury_challan').' <span class="text-danger">*</span>')  ?> -->

              <?= $form->field($model, 'any_other_info')->textarea(['rows' => 3])->label($model->getAttributeLabel('any_other_info').' <span class="text-danger"></span>')  ?>
              <br>
              <div class="form-group text-center">
                  <?= Html::submitButton('Proceed', ['class' => 'btn btn-primary btn-lg', 'id'=>'submit-btn']) ?>
              </div>
            <?php } ?>

      <?php ActiveForm::end() ?>
  </div>
</div>
<style>
.card-header, .card-body {
    padding-top: 5px;
}
.top{
  margin-top:15px;
}
.width{
  padding-left: 5px;
  padding-right: 5px;
}
section{
  padding-left:20px;
  padding-right:20px;

}
.container-items .form-group:before,.container-items .form-group:after {
  display:inline;
}

container-items .
[role="radiogroup"] {
	margin-top: 12px;
}
[role="radiogroup"] .radio {
	display: inline;
}
.form-horizontal .radio, .form-horizontal .radio-inline {
    padding-top: 2px;
}
.approval{
  display:none;
}
</style>
<?php

$this->registerJs(<<<JS
  $(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    $(".issuedate").datepicker({
      'autoclose' : true,
      'format' : 'dd-mm-yyyy'
    });
    $(".certvalidity").datepicker({
      'autoclose' : true,
      'format' : 'dd-mm-yyyy'
    });
  });


$('#profile-form').on('keyup keypress', function(e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) {
        e.preventDefault();
        return false;
    }
});
$("#ppchemical-details_of_safety_equipment_antidotes").change(function() {
    readURL(this, $("#photo"));
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

$("input[name='PpChemical[is_renew]']").change(function() {
        location.href = "insecticide?is_renew="+this.value;
});

$("input[name='PpChemical[approval_of_technical_expertise]']").change(function() {
    if(this.value == 'yes') {
        $(".approval").slideDown();
    } else if(this.value == 'no') {
        $(".approval").slideUp();
    }
});
JS
);
