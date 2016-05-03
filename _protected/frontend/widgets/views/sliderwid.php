<?php
   use yii\helpers\Url;
   if($imggallery1->alt_title!=''){ $alt = $imggallery1->alt_title; }else{ $alt = 'Drish';  }
   if($imggallery1->name!=''){  $name = $imggallery1->name; }else{ $name = 'Drish';  }
   ?>
        	<div class="responsive-slider" data-spy="responsive-slider" data-autoplay="true">
                <div class="slides" data-group="slides">
                    <ul>   
					<?php foreach($imggallery as $imggallery1){ ?>
							<li>
							  <div class="slide-body" data-group="slide">
							  <?php if($imggallery1->type == "image"){ ?>
								  <img src="<?= Yii::$app->params['baseurl']."large/slides/".$imggallery1->image_path ?>" alt="<?= $alt ?>" title="<?= $name ?>" />
							<?php  }else{ ?>
								  <div class="vid"><video  loop="" autoplay="true" controls width="100%"><source src="<?= Yii::$app->params['baseurl']."large/slides/".$imggallery1->image_path ?>" type="video/mp4">Your browser does not support the video tag.</video></div>
							<?php  }?>
								
								<?php if($position == 'header'){
									echo $imggallery1->Image_name;
								} ?>
								
							  </div>
							</li>                     
					<?php } ?>
					</ul>
                </div>
				<?php if($position == 'header'){ ?>
							<a class="slider-control left" href="#" data-jump="prev"><img src="images/scroll-left.png" alt="Previous" title="Previous" /></a>
							<a class="slider-control right" href="#" data-jump="next"><img src="images/scroll-right.png" alt="Next" title="Next" /></a>
				<?php	} ?>
               
                <div class="pages">
				<?php
				$count = 1;
				foreach($imggallery as $imggallery1){ ?>
						<a class="page" href="#" data-jump-to="<?= $count ?>"><?= $count ?></a>
				  <?php
				$count++;
				  } ?>
                </div>
			</div>   