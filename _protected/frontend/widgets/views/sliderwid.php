<?php
   use yii\helpers\Url;
   ?>
				<?php if($position == 'header'){ ?>
							<ul class="bxslider">							<?php foreach($slides as $slide ){ ?>							 <?php if($slide->type == "image"){ ?>									 <li>									 <img class="imgs" src="<?= Yii::$app->params['baseurl']."/uploads/slides/large/".$slide->image_path ?>" alt="<?= $slide->alt_title ?>" title="<?= $slide->name ?>" />								  </li>							<?php  }else{ ?>									<li>									<video  loop="" autoplay="true" controls width="100%" alt="<?= $slide->alt_title ?>" title="<?= $slide->name ?>><source src="<?= Yii::$app->params['baseurl']."/uploads/slides/large/".$slide->image_path ?>" type="video/mp4">Your browser does not support the video tag.</video>								  </li>								  <div class="vid"></div>							<?php  }?>							<?php } ?>						   </ul>
				<?php	}  ?>
			 