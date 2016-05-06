

		$(document).ready(function(){

            $( ".updateprice" ).change(function() {
                color = $('#cart-color').val();
                width = $('#cart-width').val();
                size = $('#cart-size').val();
                changed = 0;
                $.each( varients, function( key, value ) {
                   if(value.color == color && value.size==size && value.width==width){
                       $('.red-color').html('<i class="fa fa-inr"></i>'+value.price);
                      //alert(value.price);
                       changed = 1;
                   }
                });
                if(changed == 0){
                    $('.red-color').html('<i class="fa fa-inr"></i>'+product_price);
                }
            });





			$('nav#menu').mmenu({
				extensions	: [ 'effect-slide-menu', 'pageshadow' ],
				searchfield	: true,
				counters	: true,
				navbar 		: {
					title		: 'Menu'
				},
				navbars		: [
					{
						position	: 'top',
						content		: [ 'searchfield' ]
					}, {
						position	: 'top',
						content		: [
							'prev',
							'title',
							'close'
						]
					}
				]
			});



			$("body").show();

			if($(".address li span").length){
				$(".address li span").click(function(event){
	
					  var target = $(event.target).next().is(':visible');
					  if(target)
					  {
					   $(this).next().slideUp();
					   $("i",this).removeClass("fa-minus").addClass("fa-plus");
					   
					   $(this).removeClass("active");
					   return;
					  }
					  else {
					   $(".address li span").next().slideUp();
					   $(".address li span i").removeClass("fa-minus").addClass("fa-plus");
					   $(this).next().slideDown();
					   $("i",this).addClass("fa-minus").removeClass("fa-plus");
					   $(".address li span").removeClass("active");
					   $(this).addClass("active");
					   
					   
					  }
					
				 });
			}


			
			var winwid = window.innerWidth;
			if($('.bxslider').length){
				$('.bxslider').bxSlider({
					auto: true,
					autoControls: true,
					pager:true,			
				});
			}
			if($('.bxslider-1').length){
				$('.bxslider-1').bxSlider({
				 minSlides: 2,
				  maxSlides: 6,
				  slideWidth: 270,
				  moveSlides:1
				}); 
			}
			if($( '#example3' ).length){
				$( '#example3' ).sliderPro({
					width: 960,
					height: 500,
					fade: true,
					arrows: true,
					buttons: false,
					fullScreen: true,
					shuffle: true,
					smallSize: 500,
					mediumSize: 1000,
					largeSize: 3000,
					thumbnailArrows: true,
					autoplay: false
				});
			}
			function myscrool(){
				if(topval>0)
				{
					winheight = $(".slider-area").height();

					$(".slider-area").css({
						"height":winheight,
						"position":"relative",
					});
					$(".rel-box").css({
						"height":"0",
					});
				}
				else{
					$(".slider-area").css({
						"height":"100%",
						"position":"fixed",
					});
					$(".rel-box").css({
						"height":winheight,
					});
				}
			};


			var topval = $(this).scrollTop();

			var winheight = $(".slider-area").height();

			
			
			function runcode(imgheight) {
					
					var imgheight;

				if($(".imgs").length){
				 imgheight = $(".imgs").height();
				}
				else{
				 imgheight = winheight;
				}
				var winw = window.innerWidth;



				if (winheight >= imgheight || winw < 768) {

					$(".slider-area").css({
						"height": imgheight,
						"position": "relative",
					});

				}
				else {

					$(window).resize(function () {
						if (screen.width > window.innerWidth) {
							var winheight = $(".slider-area").height();
						} else {
							var winheight = $(".slider-area").height();
						}
					});
					if (!$( ".rel-box" ).length ) {

						$("<div class='rel-box'></div>").insertBefore(".slider-area").css("height", winheight);

					}
					if($(".main-slider>.bx-wrapper").length)
					{
						$(".main-slider>.bx-wrapper").css("height", winheight);
					}

					if($(".portfolio-slider").length)
					{
						$(".portfolio-slider").css("height", winheight);
					}


					myscrool();

					$(window).scroll(function () {
						topval = $(this).scrollTop();
						myscrool();
						stopnav();

					});
				}
			}

			var high = $('.free-shipping').outerHeight();
           $("<div>").insertAfter('.free-shipping').css("height",high);
			
            function stopnav(){
				
			
				var imgheight1;

				if($(".imgs").length){
				 imgheight1 = $(".imgs").height();
				}
				else{
				 imgheight1 = 0;
				}
				
				 if ($(this).scrollTop() > imgheight1-high-high) {
                    $('.free-shipping').css({
                        position: "fixed",
                        top: "0",
                    });
                    
                } else {
                    $('.free-shipping').css({
                        position: "absolute",
                        top: "auto",
                    });
                }
			}
			

			/*if($(".imgs").length){
				var theImage = new Image();
				theImage.src = $(".imgs").attr("src");
				theImage.onload = function() {
					imgheight = $(".imgs").height();
					runcode(imgheight);
					stopnav();
				};
			}
			else{
				imgheight = winheight;
				runcode(imgheight);
				stopnav();
			}*/
			
			 $(".imgs").ready(function(){
				runcode();
				stopnav();
				setTimeout(function(){
					runcode();
					stopnav();
					
				}, 500);
			 });

		 
			 
            
            
        });   
		
		  $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });
        // scroll body to 0px on click
        $('#back-to-top').click(function () {
            $('#back-to-top').tooltip('hide');
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
        
		
		if($('#back-to-top').length){
			
        	$('#back-to-top').tooltip('show'); 
		}


		

		
		
		
		