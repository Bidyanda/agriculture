<?php
use yii\helpers\Html;

$width = '91%';
?>

<div class="row">
    <div class="col-md-offset-2 col-md-8">
		<div class="steps">
			<div class="progressbar-back"></div>
			<div class="progressbar-front"></div>
			<div class="stepscover">
				<?= Html::a('<div>Verfication</div>', '#!', ['class'=>'step completed', 'data-toggle'=>'tooltip', 'title'=>'Phone Number Verification']) ?>
			</div>
			<div class="stepscover">
				<?= Html::a('<div>Personal Details</div>', '#!', ['class'=>'step completed', 'data-toggle'=>'tooltip', 'title'=>'Personal Details']) ?>
			</div>
			<div class="stepscover">
				<?= Html::a('<div>Other Details</div>', '#!', ['class'=>'step completed', 'data-toggle'=>'tooltip', 'title'=>'Social Details & Trade Selection']) ?>
			</div>
			<div class="stepscover">
				<?= Html::a('<div>Payment</div>', '#!', ['class'=>'step incomplete', 'data-toggle'=>'tooltip', 'title'=>'Payment']) ?>
			</div>
		</div>
	</div>
</div>

<style type="text/css">
.steps {
	display: flex;
	width: 100%;
	position: relative;
	margin-bottom: 20px;
}
.progressbar-back, .progressbar-front {
	position: absolute;
	top: 18%;
}
.progressbar-back {
	border-bottom: 4px solid #aaa;
	width: 100%;
}
.progressbar-front {
	width: <?= $width ?>;
	text-align:center;
	padding-bottom:5px;
	background: linear-gradient(90deg, rgba(0,124,198,1) 93%, rgba(255,255,255,1) 100%);
	background-size: 100% 5px;
}
.stepscover {
	width: 33%;				/*Adjust this value depending on no. of steps - Sushil*/
	text-align: center;
}
.step {
	text-align: center;
	background-color: #fff;
}
.step div {
	margin-top: 14%;
	color: #607d8b;
	font-size: 12px;
	font-weight: bold;
}
.step.completed div {
	color: #007cc6;
}
.step:hover {
	color: #333;
	text-decoration: none;
}
.step:before {
	color: #fff;
	font-family: FontAwesome;
	position: absolute;
	padding: 0 4px;
	-webkit-box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14),0 3px 1px -2px rgba(0,0,0,0.12),0 1px 5px 0 rgba(0,0,0,0.2);
	box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14),0 3px 1px -2px rgba(0,0,0,0.12),0 1px 5px 0 rgba(0,0,0,0.2);
	border-radius: 50%;
}
.step.active:before {
	content: "\f10c";
	background-color: #64b5f6;
}
.step.incomplete:before {
	content: "\f10c";
	background-color: #ccc;
}
.step.completed:before {
	content: "\f058";
	background-color: #007cc7;
}
@media only screen and (max-width: 667px) {
	.step div {
		margin-top: 25%;
		font-size: 11px;
	}
}
@media only screen and (max-width: 480px) {
	.step div {
		margin-top: 40%;
		font-size: 8px;
	}
}
</style>

<script type="text/javascript">
function progress(step) {
	let w;
	switch(step) {			/*Adjust this value depending on no. of steps - Sushil*/
		case 1: w = 15;
				break;
		case 2: w = 40;
				break;
		case 3: w = 65;
				break;
		case 4: w = 100;
				break;
	}
	$(".progressbar-front").animate({width: w+"%"}, 2000, "swing", function() {
		let elem = $(".step:eq("+(step-1)+")");
		elem.removeClass("active");
		elem.addClass("completed");
		let next_elem = $(".step:eq("+(step)+")");
		if(next_elem.length) {
			next_elem.addClass("active");
			next_elem.removeClass("incomplete");
		}
	});
}
</script>
