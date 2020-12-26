<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use dosamigos\datepicker\DatePicker;

$this->title = 'Sign Up';
$today = date('Y-m-d');
$start_date = date('d-M-Y', strtotime($today.'-55years'));
$end_date = date('d-M-Y', strtotime($today.'-10years'));
$send_otp_url = Url::to(['/site/send-otp', 'phone'=>'']);
$verify_otp_url = Url::to(['/site/verify-otp', 'otp'=>'']);
$qualification = ['COHSEM'=>'COHSEM', 'Other'=>'Other'];
$enddate = date('Y-m-d',strtotime('2020-12-30'));
$todays = strtotime($today);
$end = strtotime($enddate);
?>
<div class="row">
  <div class="col-md-1"></div>
  <div class="col-md-10" align='center'>
    <div class="site-index card" align='center'>
        <div class="card-body hasloader">
            <div id="full-loader"></div>
            <div class="loader">
                <div class="loader-cover"></div>
                <div class="loader-text">
                    <i class="fa fa-spinner fa-spin text-primary"></i>&nbsp;
                    <span class="loader-subtext">Uploading...</span>
                </div>
            </div>

            <!-- <?//= $this->render('steps', ['step'=>1, 'active'=>1]) ?> -->

          <?php if($end > $todays) {?>
        	<?php $form = ActiveForm::begin([
                'id' => 'verification-form',
                'layout' => 'horizontal',
                'fieldConfig' => [
                    'horizontalCssClasses' => [
                        'label' => 'col-sm-4',
                        'offset' => 'col-sm-offset-2',
                        'wrapper' => 'col-sm-4',
                    ],
                ],
            ]); ?>
            <section>
                <h3 class="text-center">
                    <p><b class="text-primary" style="font-size:25px;">Registration</b></p>
                </h3>
                <br>
                <?= $form->field($model, 'phone', ['template' => '{label}<div class="col-sm-4">{input}{error}</div><div class="col-sm-2">'.Html::button('Send OTP', ['class'=>'btn btn-primary btn-sm btn-block', 'id'=>'resend', 'disabled'=>true]).'</div>'])->textInput(['placeholder'=>'Enter Your Phone Number', 'autocomplete'=>'off', 'type'=>'number', 'class'=>'form-control numberonly', 'maxlength'=>true])->label($model->getAttributeLabel('phone')) ?>
                <?= $form->field($model, 'code', ['template' => '{label}<div class="col-sm-4">{input}{error}</div><div class="col-sm-2">'.Html::button('Verify OTP', ['class'=>'btn btn-primary btn-sm btn-block', 'id'=>'verifyotp-btn', 'disabled'=>true]).'</div>'])->textInput(['placeholder'=>'Enter OTP here', 'maxlength'=>true, 'autocomplete'=>'off', 'class'=>'form-control numberonly', 'readonly'=>true])->label('Enter 6-digit OTP') ?>

                <div class="row">
                    <div class="col-sm-offset-4 col-sm-4">
                        <b class="text-primary" id="verified"><i class="fa fa-check"></i> Phone Number Verified</b>
                    </div>
                </div>
            </section>
            <br>

            <div class="form-group text-center">
                <?= Html::submitButton('Proceed', ['class' => 'btn btn-primary btn-lg', 'id'=>'submit-btn', 'disabled'=>true]) ?>
            </div>

            <?php ActiveForm::end() ?>
          <?php }else{ ?>
            <div align='center'>
              <h3 style="color:red">New Registration was Closed.</h3>
            </div>
          <?php } ?>
    	</div>
    </div>
  </div>
</div>


<style type="text/css">
label.control-label.col-sm-4{
    color: black;
}
label {
    color: black;
}
#board{
  display: none;
}
input,textarea {
	text-transform: uppercase;
}
#verified {
    visibility: hidden;
}
.card{
  width:90%;
}
</style>

<?php
$this->registerJs(<<<JS


// $("#instructions-modal").modal("show");

$('#verification-form').on('keyup keypress', function(e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) {
        e.preventDefault();
        return false;
    }
    // var board = $("#verify-examination_board_2").val();
    // if(board != 'COHSEM'){
    //   var exam = $(".text").val();
    //   if(exam.length == 0){
    //     $(".texts").show();
    //     return false;
    //   }
    // }
});

$("#verification-form").on("beforeSubmit", function() {
    $(".loader").show();
    //end
	$("#submit-btn").prop("disabled", true);
});

var counter = 0;
$("#otp-phone").keyup(function() {
    var phone = $("#otp-phone").val();
    if(isPhone(phone)) {
        if(counter == 0) {
            $("#resend").prop("disabled", false);
        }
    } else {
        $("#resend").prop("disabled", true);
    }
});

// $("#verify-email").keyup(function(){
//   var mail = $(this).val();
//   if(IsEmail(mail)){
//     console.log('yes');
//   }else {
//     console.log('no');
//   }
// });
function IsEmail(email) {
  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if(!regex.test(email)) {
    return false;
  }else{
    return true;
  }
}

$("#resend").click(function() {
    var btn = $(this);
    var phone = $("#otp-phone").val();
    var otpdata = phone;
    if(isPhone(phone)) {
        $("#resend").prop("disabled", true);
        $("#resend").text("Sending OTP...");
        $.post("$send_otp_url"+otpdata)
        .done(function(data) {
            data = JSON.parse(data);
            if(data.status == "1") {
                $("#otp-code").prop("readonly", false);
                $("#verifyotp-btn").prop("disabled", false);
                countDown();
                toast(data.msg, 'bg-blue');
            } else {
                $("#resend").prop("disabled", false);
                $("#resend").text("Send OTP");
                toast(data.msg, 'bg-red');
            }
        });
    } else {
        $("#resend").prop("disabled", false);
        $("#resend").text("Send OTP");
        toast('Please enter a valid phone number', 'bg-red');
    }
});

$("#verifyotp-btn").click(function() {
    var btn = $(this);
    var otp = $("#otp-code").val();
    if(isOtp(otp)) {
        btn.prop("disabled", true);
        $("#otp-code").attr("readonly", true);
        $.post("$verify_otp_url"+otp, function(data) {
            data = JSON.parse(data);
            if(data.status=="1") {
                $("#otp-phone").prop("readonly", true);
                toast(data.msg, "bg-blue");
                clearInterval(timer);
                btn.text("Verified");
                $("#resend").fadeOut();
                btn.fadeOut();
                $("#verified").css('visibility', 'visible');
                $("#submit-btn").prop("disabled", false);
                $("#verification-form").submit();
            } else {
                $("#otp-code").attr("readonly", false);
                toast(data.msg, "bg-red");
                btn.prop("disabled", false);
                btn.text("Verify OTP");
            }
        });
    } else {
        btn.prop("disabled", false);
        btn.text("Verify OTP");
        toast('OTP should be a 6-digit number', 'bg-red');
    }
});
var timer;
function countDown() {
    var btn = $("#resend");
    var t = 10;
    var timer = setInterval(function() {
        btn.text("Resend OTP ("+t+")");
        t--;
        counter = t;
        if(t<0) {
            clearInterval(timer);
            btn.prop("disabled", false);
            btn.text("Resend OTP");
        }
    }, 1000);
}

function isPhone(phone) {
    var regex = /^[6-9]\d{9}$/;
    return regex.test(phone);
}
function isOtp(otp) {
    var regex = /^\d{6}$/;
    return regex.test(otp);
}
// $("#verify-aadhaar_file").change(function() {
//     readURL(this, $("#photo"));
// });

JS
);
