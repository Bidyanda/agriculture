<?php
use app\models\Trade;
use yii\helpers\ArrayHelper;
use app\models\State;
use app\models\Courses;
$course = ArrayHelper::map(Courses::find()->all(),'id','name');
$state = ArrayHelper::map(State::find()->all(),'id','name');
$trades = ArrayHelper::map(Trade::find()->where(['status'=>'ACTIVE'])->orderBy('duration DESC, name ASC')->all(), 'id', function($model) {
    return $model->name . ' ('.$model->duration.' Year Course)';
});
$division = ['1'=>'1st Division', '2'=>'2nd Division', '3'=>'3rd Division'];
$approval = ['1'=>'ACCEPTED', '2'=>'INCOMPLETE APPLICATION', '3'=>'NOT ACCEPTED'];
$qualification = ['1'=>'Class X / XII Passed', '2'=>'Class VIII Passed'];
$yes_no = ['NO'=>'NO', 'YES'=>'YES'];
$category = ['GEN'=>'General', 'SC'=>'SC', 'ST'=>'ST', 'PWD'=>'PWD'];
$division = ['1'=>'1st Division', '2'=>'2nd Division', '3'=>'3rd Division'];
$i = $t = 1;
?>

<table>
	<tr>
		<td class="text-center" rowspan="2" style="width: 18%; vertical-align: top;">
			<table class="table-bordered">
				<tr><td>FORM NO</td></tr>
				<tr><td><span class="bold-big"><?= $model['reg_id'] ?></span></td></tr>
			</table>
		</td>
		<td colspan="2" class="text-center">
			<img src="images/cultural-logo.png" class="center_pic">
		</td>
		<td rowspan="2" style="width: 18%; vertical-align: top;">
			<img src="<?= $model['photo'] ?>" class="stu-photo">
		</td>
	</tr>
	<tr>
		<td colspan="2" class="text-center">
			<br>
			<h3>APPLICATION FOR ADMISSION TO</h3>
			<h4>BA Dance/BA Music/BA Visual Arts/Thang-Ta/BA Umang Lai Haraoba/BA Tribal Studies/BA Sankirtana (2020-21)</h4>
		</td>
	</tr>
</table>
<hr>
<table class="student-info">
	<tr>
		<td class="light-text" style="width: 4%;"><?= $i++ ?>.</td>
		<td style="width: 32%;" class="light-text">Candidate Name:</td>
		<td>
			<div><?= $model['student_name'] ?></div>
			<div><span class="light-text">Phone: </span><?= $model['phone'] ?>&nbsp;&nbsp;&nbsp;&nbsp;<span class="light-text">Email: </span><?= $model['email'] ?></div>
			<div><span class="light-text">Date of Birth: </span><?= date('d/m/Y', strtotime($model['dob'])) ?>&nbsp;&nbsp;&nbsp;&nbsp;<span class="light-text">Gender: </span><?= $model['gender'] ?></div>
		</td>
	</tr>
	<tr>
		<td class="light-text"><?= $i++ ?>.</td>
		<td class="light-text"><div>(i) Father's/Guardian's Name:</div><div>(ii) Mother's Name :</div></td>
		<td><div><?= $model['father_name'] ?></div><div><?= $model['mother_name'] ?></div></td>
	</tr>
  <tr>
		<td class="light-text"><?= $i++ ?>.</td>
		<td class="light-text">Category(UR/SC/ST/OBC):</td>
		<td><?= $model['category'] ?></td>
	</tr>
  <tr>
		<td class="light-text"><?= $i++ ?>.</td>
		<td class="light-text"><div>(i) Nature of Physical Disability:</div><div>(ii)Extend of Disability :</div></td>
		<td><div><?= $model['nature_of_physical_disablity'] ?></div><div><?= $model['extend_of_disability'] ?></div></td>
	</tr>
	<tr>
		<td class="light-text"><?= $i++ ?>.</td>
		<td class="light-text">Permanent Address.:</td>
		<td><?= $model['permanent_address'] ?>, <?= $state[$model['permanent_state_id']] ?>, <?= $model['permanent_district'] ?>, <?= $model['permanent_pin'] ?></td>
	</tr>
	<tr>
		<td class="light-text"><?= $i++ ?>.</td>
		<td class="light-text">Present Address:</td>
		<td><?= $model['present_address'] ?>, <?= $state[$model['present_state_id']] ?>, <?= $model['present_district'] ?>, <?= $model['present_pin'] ?></td>
	</tr>
	<tr>
		<td class="light-text"><?= $i++ ?>.</td>
		<td class="light-text">Nationality:</td>
		<td><?= $model['nationality'] ?></td>
	</tr>
	<tr>
		<td class="light-text"><?= $i++ ?>.</td>
		<td class="light-text">Country:</td>
		<td><?= $model['country'] ?></td>
	</tr>
	<tr>
		<td class="light-text"><?= $i++ ?>.</td>
		<td class="light-text">State of Domicile:</td>
		<td><?= $model['state_of_domicile'] ?></td>
	</tr>
	<tr>
		<td class="light-text"><?= $i++ ?>.</td>
		<td class="light-text">
      <div>(i) Course of Study :</div>
      <div>(ii) Subject :</div>
    </td>
		<td>
      <div><?= $course[$model['course_id']]?></div>
      <div><?= $model['subject'] ?></div>
    </td>
	</tr>
  <tr>
		<td class="light-text"><?= $i++ ?>.</td>
		<td class="light-text">Identification:</td>
		<td><?= $model['identification_mark'] ?></td>
	</tr>
  <tr>
  </tr>
</table>
<br>
<div style="font-weight:bold;"><?= $i++;?>.  Academic Record</div>
<table class="student-info table-bordered">
	<tr>
		<th>Examination Name</th>
    <th>Year of Passing</th>
    <th>Division</th>
    <th>% of Marks</th>
    <th>Aggregate</th>
    <th>University/Board</th>
    <th>Subjects Taken</th>
	</tr>
	<tr>
		<td><?= $model['examination_1'] ?></td>
		<td><?= $model['year_of_passing_1'] ?></td>
		<td><?= $division[$model['division_1']] ?></td>
    <td><?= $model['percentage_2'] ?>%</td>
		<td><?= $model['aggregate_mark_1'] ?></td>
    <td><?= $model['examination_board_1'] ?></td>
    <td><?= $model['subjects_taken_1'] ?></td>
	</tr>
  <tr>
		<td><?= $model['examination_2'] ?></td>
		<td><?= $model['year_of_passing_2'] ?></td>
		<td><?= $division[$model['division_2']] ?></td>
    <td><?= $model['percentage_2'] ?>%</td>
		<td><?= $model['aggregate_mark_2'] ?></td>
    <td><?= $model['examination_board_2'] ?></td>
    <td><?= $model['subjects_taken_2'] ?></td>
	</tr>
  <?php if($model['is_other_course']){ ?>
    <tr>
  		<td><?= $model['other_course']?></td>
  		<td><?= $model['year_other_course'] ?></td>
  		<td></td>
      <td></td>
  		<td></td>
      <td><?= $model['institution_name'] ?></td>
      <td></td>
  	</tr>
  <?php } ?>
</table>
<br />
<table>
  <tr>
		<td class="light-text" style="font-weight:bold;"><?= $i++ ?>.</td>
		<td class="light-text" style="font-weight:bold;">Annual Income of the Parent/Guardian:</td>
		<td style="font-weight:bold;"><?= $model['anual_income_parent'] ?></td>
	</tr>
</table>
<br>

<hr />
<div class="pagebreak"> </div>
<table>
	<tr>
		<td style="width: 4%;" class="text-center"><b>DECLARATION BY THE APPLICANT</b></td>
	</tr>
</table>
<p class="text-justify">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I declare that entries made by me in this form an the documents submitted in support of the information furnished by me in the application form are true in all respects and
  in case any entry or information or documents are found false, this shall entail automatic cancellation of my admission besides rendering me liable to such an action as
  the University may deem proper. <br />&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;I declare that i shall submit myself to the disciplinary jurisdiction of the Vice-Chancellor and other authorities of the University.
  <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I further note that my admission to the University and my continuance on its rolls are subject to the provision of the University Status, Ordinances and other Rules and Instructions which may be issued from time to time.<br />
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I shall abide by the rules of discipline and proper conduct which my be framed in this regard.
</p>
<br />
<table>
  <tr>
    <td style="width:60%"><div style="text-align:left">Place .........................</div><div style="text-align:left">Date ..........................</div></td>
    <td><div style="text-align:right;font-style:Italic">Signature of the Applicant</div></td>
  </tr>
</table>
<hr />
<table>
	<tr>
		<td style="width: 4%;" class="text-center"><b>DECLARATION BY THE PARENT / GUARDIAN</b></td>
	</tr>
</table>
<br />
<p class="text-justify">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I Certify that the statements under items 1,3,16 and 17 made by my son/daughtr/ward and whose photograph apears on this form are correct, i shall be reponsible for any act commited by my ward against the University Rules.
</p>
<br />
<table style="width:100%">
  <tr>
    <td style="width:60%"><div style="text-align:left;">Place .........................</div><div style="text-align:left">Date ..........................</div></td>
    <td><div style="text-align:right;font-style:Italic">Signature of the Parents/Guardian</div></td>
  </tr>
</table>
<br />
<hr />
<table style="width:100%">
	<tr>
		<td style="width: 4%;" class="text-center"><b>FOR OFFICE USE ONLY</b></td>
	</tr>
</table>
<hr />
<br />
<p class="text-center">
  Original Documents have been verified and <br />recommended / not recommeded for admission.
</p>
<br />
<table style="width:100%">
  <tr>
    <td><div style="text-align:left">Date ..........................</div></td>
    <td><div style="text-align:right">Head of the Department ...............................</div><div>Seal</div></td>
  </tr>
</table>
<!-- <table>
	<tr>
		<td style="width: 70%;">
			Date: <b><?//= date('d/m/Y') ?></b>
		</td>
		<td>
			<img src="<?//= $model['student_signature']?>" class="sign">
		</td>
	</tr>
</table> -->

<!-- <h5>Registration Fee: <?//= $model['registration_fee_paid']=='1' ? '<b>PAID</b>' : '<b>NOT PAID</b>' ?></h5>-->
<?php if(!Yii::$app->user->can('admin')){ ?>
<hr>
<h3 class="text-center">Application Status</h3>
<table>
	<tr>
		<td style="width: 20%;"></td>
		<td>
			<div>1. Date of Application: <b><?= $model['apply_date'] ? date('d/m/Y', strtotime($model['apply_date'])) : '' ?></b></div><br>
			<div>2. Result of the selection: <?= $model['result']=='UNDER REVIEW' ? '' : $model['result'] ?></div><br>
			<div>3. Admission Fee Paid: <b><?= isset($model['admission_fee_paid']) ? 'PENDING' : 'PAID'; ?></b></div><br>
		</td>
		<td style="width: 20%;"></td>
	</tr>
</table>

<?php }else{?>
  <div class="pagebreak"> </div>
  <p class="text-center">
    <h3>Document List</h3>
  </p>
  <h4>Class X Marksheet</h4>
  <img src="<?= $model['marksheet_1']?>" height="1500px">
  <!-- <div class="pagebreak"> </div> -->
  <h4>Class X Certificate</h4>
  <img src="<?= $model['certificate_1']?>" height="1500px">
  <!-- <div class="pagebreak"> </div> -->
  <h4>Class XII Marksheet</h4>
  <img src="<?= $model['marksheet_2']?>" height="1500px">
  <!-- <div class="pagebreak"> </div> -->
  <h4>Class XII Certificate</h4>
  <img src="<?= $model['certificate_2']?>" height="1500px">
  <!-- <div class="pagebreak"> </div> -->
  <h4>Class XII Migration/Transfer Certificate</h4>
  <img src="<?= $model['migration_transfer']?>" height="1500px">
  <!-- <div class="pagebreak"> </div> -->
  <h4><?=$model['other_course']?> Certificate</h4>
  <img src="<?= $model['other_course_certificate']?>" height="1500px">
  <!-- <div class="pagebreak"> </div> -->
  <h4>Category(OBC/SC/ST) Certificate</h4>
  <?php if($model['category'] != 'General'){ ?>
  <img src="<?= $model['obc_sc_st_file']?>" height="1500px">
  <!-- <div class="pagebreak"> </div> -->
<?php }else{?>
  <div>Data not found.</div>
<?php } ?>
  <h4>Affidavit</h4>
    <?php if(!empty($model['affidavit'])){ ?>
    <img src="<?= $model['migration_transfer']?>" height="1500px">
    <!-- <div class="pagebreak"> </div> -->
    <?php }else{?>
     <div>Data not found.</div>
    <?php } ?>

<?php } ?>
<style>
@media print {
    .pagebreak { page-break-before: always; } /* page-break-after works, as well */
}
</style>
