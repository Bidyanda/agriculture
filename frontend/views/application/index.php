<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Application Status';

$status = ['0'=>'Pending', '1'=>'Verify', '2'=>'Reject'];
$payment = ['0'=>'Pending', '1'=>'Ready for payemnt','2'=>'Paid'];
$payfee = Url::to(['/application/admission-fee']);

?>

<div class="card">
	<div class="card-body">
		<div class="loader">
      <div class="loader-cover"></div>
      <div class="loader-text">
          <i class="fa fa-spinner fa-spin text-primary"></i>&nbsp;
          <span class="loader-subtext">Please wait...</span>
      </div>
    </div>
		<div class="row">
					<div class="col-md-12">
						<div class="panel panel-primary">
							<div class="panel-heading" align='center'>
								<h3 class="panel-title">Application Status</h3>
							</div>
							<br />
							<table class="table table-hover table-striped" id="dev-table">
								<thead>
									<tr>
										<th>Slno.</th>
										<th>Application Type</th>
										<th>Form Type</th>
										<th>Application No.</th>
										<th>Application Date</th>
										<th>Application Status</th>
										<th>District Agri. Officer Verified</th>
										<th>Directorate Agri. Officer Verified</th>
										<th>Application Fee Amount</th>
										<th>Payment Status</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($models as $id=>$model) ?>
									<tr>
										<td><?= ++$id?></td>
										<td>Insecticide</td>
										<td><?= $model->is_renew == 1 ? 'New' : 'Renewed';?></td>
										<td><?= $model->id ?></td>
										<td><?= date('Y-m-d',strtotime($model->application_date));?></td>
										<td><?= $status[$model->status]?></td>
										<td><?= $status[$model->district_officer_verified]?></td>
										<td><?= $status[$model->directorate_officer_verified]?></td>
										<td><?= $model->application_fee_amount?></td>
										<td><?= $payment[$model->payment_status]?></td>
										<td><?= Html::a('<i class="fa fa-pencil" style="color:blue"></i>', ['update']) ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
		</div>
	</div>
</div>


<?php
$this->registerJs(<<<JS
$("#submit-btn").click(function() {
	$(".loader").show();
	$("#payfee").load('$payfee', function() {
		$(".loader").hide();
	});
});
JS
);
