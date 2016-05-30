
<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
$user_id = \Yii::$app->user->identity->id;
?>

<?php if($model){ 
				$basic_data = $model->getBasicApplicationData($model->id);
				$education_data = $model->getEducationApplicationData($model->id);
				$address_data = $model->getAddressApplicationData($model->id);
				if($model->application_status == 0){
					$stat = "In Process";
				}elseif($model->application_status == 1){
					$stat = "Hold";
				}elseif($model->application_status == 2){
					$stat = "Waiting";
				}else{
					$stat = "Got Admission";
				}
				
				?>
<div id="application-info">
    
    <div class="row">
        <div class="col-lg-12">
            <h2>My Applications</h2>
            <h2>Payment Status <?php if($model->payment_status != 3){
				echo Html::a(Yii::t('app', 'Payment Now'), ['payment' , 'app_id' => $model->id], ['class' => 'btn btn-primary back']);
			}else{
				echo '<span class="btn btn-success">Payment Completed</span>';
			} ?></h2>
			
        </div><!--end col-lg-12-->
    </div><!--end row-->
      <div class="row">
        <div class="col-lg-12">
            <h3>Application Information</h3>
        </div><!--end col-lg-12-->
         <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
           
			<div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                    <span class="property">Application Status</span>
                </div><!--end col-lg-6-->           
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
                    <span><?= $stat ?></span>
                </div><!--end col-lg-6-->
            </div><!--end row-->

            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                    <span class="property">Transaction Id</span>
                </div><!--end col-lg-6-->           
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
                    <span><?= $model->transaction_id ?></span>
                </div><!--end col-lg-6-->
            </div><!--end row-->  
        </div><!--end col-lg-6-->
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                    <span class="property">Course</span>
                </div><!--end col-lg-6-->           
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
                    <span><?= $model->getcoursename($model->course_id); ?></span>
                </div><!--end col-lg-6-->
            </div><!--end row-->
            
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                    <span class="property">University</span>
                </div><!--end col-lg-6-->           
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
                    <span><?= $model->getuniversityname($model->university_id)?></span>
                </div><!--end col-lg-6-->
            </div><!--end row-->
		</div>
       
    </div><!--end row-->
	
    <div class="row">
        <div class="col-lg-12">
            <h3>Basic Information</h3>
        </div><!--end col-lg-12-->
        
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                    <span class="property">Application Id</span>
                </div><!--end col-lg-6-->           
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
                    <span><?= $basic_data->application_id ?></span>
                </div><!--end col-lg-6-->
            </div><!--end row-->
			<div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                    <span class="property">First Name</span>
                </div><!--end col-lg-6-->           
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
                    <span><?= $basic_data->fname ?></span>
                </div><!--end col-lg-6-->
            </div><!--end row-->

            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                    <span class="property">Last Name</span>
                </div><!--end col-lg-6-->           
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
                    <span><?= $basic_data->lname ?></span>
                </div><!--end col-lg-6-->
            </div><!--end row-->

            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                    <span class="property">DOB</span>
                </div><!--end col-lg-6-->           
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
                    <span><?= $basic_data->dob ?></span>
                </div><!--end col-lg-6-->
            </div><!--end row-->
            
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                    <span class="property">Father Name</span>
                </div><!--end col-lg-6-->           
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
                    <span><?= $basic_data->father_name ?></span>
                </div><!--end col-lg-6-->
            </div><!--end row-->
            
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                    <span class="property">Mother Name</span>
                </div><!--end col-lg-6-->           
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
                    <span><?= $basic_data->mother_name ?></span>
                </div><!--end col-lg-6-->
            </div><!--end row-->
           
           
        </div><!--end col-lg-6-->



         <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
               
             <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                    <span class="property">Gender</span>
                </div><!--end col-lg-6-->           
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
                    <span><?php if($basic_data->gender==1) echo"Male"; else echo"Female";?> </span>
                </div><!--end col-lg-6-->
            </div><!--end row-->
             <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                    <span class="property">Nationality</span>
                </div><!--end col-lg-6-->           
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
                    <span><?= $basic_data->nationality ?></span>
                </div><!--end col-lg-6-->
            </div><!--end row-->
            
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                    <span class="property">Mobile</span>
                </div><!--end col-lg-6-->           
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
                    <span><?= $basic_data->mobile ?></span>
                </div><!--end col-lg-6-->
            </div><!--end row-->
            
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                    <span class="property">Email</span>
                </div><!--end col-lg-6-->           
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
                    <span><?= $basic_data->email ?></span>
                </div><!--end col-lg-6-->
            </div><!--end row-->
            
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                    <span class="property">Apply Course</span>
                </div><!--end col-lg-6-->           
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
                    <span><?= $model->getCourseName($basic_data->apply_course); ?></span>
                </div><!--end col-lg-6-->
            </div><!--end row-->
            
             <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                    <span class="property">Passport Copy</span>
                </div><!--end col-lg-6-->           
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
                    <span><a href="/uploads/docs/passport/<?= $basic_data->passport_copy ?>" target="_blank">Click Here</a></span>
                </div><!--end col-lg-6-->
            </div><!--end row-->

        </div><!--end col-lg-6-->
    </div><!--end row-->
    
    
    <div class="row">
        <div class="col-lg-12">
            <h3>Address Information</h3>
        </div><!--end col-lg-12-->
        
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                    <span class="property">Address</span>
                </div><!--end col-lg-6-->           
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
                    <span><?= $address_data->address ?></span>
                </div><!--end col-lg-6-->
            </div><!--end row-->

            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                    <span class="property">Street</span>
                </div><!--end col-lg-6-->           
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
                    <span><?= $address_data->street ?></span>
                </div><!--end col-lg-6-->
            </div><!--end row-->
            
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                    <span class="property">City</span>
                </div><!--end col-lg-6-->           
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
                    <span><?= $address_data->city ?></span>
                </div><!--end col-lg-6-->
            </div><!--end row-->
            
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                    <span class="property">State</span>
                </div><!--end col-lg-6-->           
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
                    <span><?= $address_data->state ?></span>
                </div><!--end col-lg-6-->
            </div><!--end row-->
            
             <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                    <span class="property">Pin Code</span>
                </div><!--end col-lg-6-->           
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
                    <span><?= $address_data->pincode ?></span>
                </div><!--end col-lg-6-->
            </div><!--end row-->
            
             <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                    <span class="property">country</span>
                </div><!--end col-lg-6-->           
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
                    <span><?= $model->getCountryName($address_data->country); ?></span>
                </div><!--end col-lg-6-->
            </div><!--end row-->
           
        </div><!--end col-lg-6-->
        
    </div><!---end row-->
    
    
      
    <div class="row">
        <div class="col-lg-12">
            <h3>Education Information</h3>
        </div><!--end col-lg-12-->
        <?php 
		$name_exam = explode(",",$education_data->name_exam);
		$name_board = explode(",",$education_data->name_board);
		$pass_year = explode(",",$education_data->pass_year);
		$subject = explode(",",$education_data->subject);
		$aggregates = explode(",",$education_data->aggregates);
		$docs = explode(",",$education_data->docs);
		?>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                    <span class="property">Name Exam</span>
                </div><!--end col-lg-6-->           
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
                    <span><?= $name_exam[0] ?></span>
                </div><!--end col-lg-6-->
            </div><!--end row-->
			<div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                    <span class="property">Board</span>
                </div><!--end col-lg-6-->           
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
                    <span><?= $name_board[0] ?></span>
                </div><!--end col-lg-6-->
            </div><!--end row-->

            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                    <span class="property">Pass Year</span>
                </div><!--end col-lg-6-->           
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
                    <span><?= $pass_year[0] ?></span>
                </div><!--end col-lg-6-->
            </div><!--end row-->
            
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                    <span class="property">Subject</span>
                </div><!--end col-lg-6-->           
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
                    <span><?= $name_board[0] ?></span>
                </div><!--end col-lg-6-->
            </div><!--end row-->
            
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                    <span class="property">aggregates</span>
                </div><!--end col-lg-6-->           
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
                    <span><?= $name_board[0] ?></span>
                </div><!--end col-lg-6-->
            </div><!--end row-->
            
             <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                    <span class="property">Document</span>
                </div><!--end col-lg-6-->           
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
                    <span><a href="/uploads/docs/passport/<?= $docs[0] ?>" target="_blank">Click Here</a></span>
                </div><!--end col-lg-6-->
            </div><!--end row-->
            
        </div><!--end col-lg-6-->
     <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                    <span class="property">Name Exam</span>
                </div><!--end col-lg-6-->           
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
                    <span><?= $name_exam[1] ?></span>
                </div><!--end col-lg-6-->
            </div><!--end row-->
			<div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                    <span class="property">Board</span>
                </div><!--end col-lg-6-->           
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
                    <span><?= $name_board[1] ?></span>
                </div><!--end col-lg-6-->
            </div><!--end row-->

            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                    <span class="property">Pass Year</span>
                </div><!--end col-lg-6-->           
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
                    <span><?= $pass_year[1] ?></span>
                </div><!--end col-lg-6-->
            </div><!--end row-->
            
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                    <span class="property">Subject</span>
                </div><!--end col-lg-6-->           
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
                    <span><?= $name_board[1] ?></span>
                </div><!--end col-lg-6-->
            </div><!--end row-->
            
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                    <span class="property">aggregates</span>
                </div><!--end col-lg-6-->           
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
                    <span><?= $name_board[1] ?></span>
                </div><!--end col-lg-6-->
            </div><!--end row-->
            
             <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                    <span class="property">Document</span>
                </div><!--end col-lg-6-->           
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
                    <span><a href="/uploads/docs/passport/<?= $docs[1] ?>" target="_blank">Click Here</a></span>
                </div><!--end col-lg-6-->
            </div><!--end row-->
            
      </div><!--end col-lg-6-->
		 <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                    <span class="property">Name Exam</span>
                </div><!--end col-lg-6-->           
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
                    <span><?= $name_exam[2] ?></span>
                </div><!--end col-lg-6-->
            </div><!--end row-->
			<div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                    <span class="property">Board</span>
                </div><!--end col-lg-6-->           
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
                    <span><?= $name_board[2] ?></span>
                </div><!--end col-lg-6-->
            </div><!--end row-->

            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                    <span class="property">Pass Year</span>
                </div><!--end col-lg-6-->           
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
                    <span><?= $pass_year[2] ?></span>
                </div><!--end col-lg-6-->
            </div><!--end row-->
            
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                    <span class="property">Subject</span>
                </div><!--end col-lg-6-->           
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
                    <span><?= $name_board[2] ?></span>
                </div><!--end col-lg-6-->
            </div><!--end row-->
            
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                    <span class="property">aggregates</span>
                </div><!--end col-lg-6-->           
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
                    <span><?= $name_board[2] ?></span>
                </div><!--end col-lg-6-->
            </div><!--end row-->
            
             <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                    <span class="property">Document</span>
                </div><!--end col-lg-6-->           
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
                    <span><a href="/uploads/docs/passport/<?= $docs[2] ?>" target="_blank">Click Here</a></span>
                </div><!--end col-lg-6-->
            </div><!--end row-->
            
        </div><!--end col-lg-6-->
        
    </div><!---end row-->
	
    
    
</div><!--end application-info-->
<?php 
	}else{ ?>
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<h4> No applications submitted by you.</h4>
				</div>		
			</div>
		   <?php } ?>
           <style>	
		   .btn .btn-success{
			   float:right;
		   }
		   #application-info span.btn.btn-success,#application-info a.btn.btn-primary, #application-info span.btn.btn-success:hover,#application-info a.btn.btn-primary:hover {
				color: #fff;
			}
			.back{
				background-color: #F35151;
			}
			
           </style>	