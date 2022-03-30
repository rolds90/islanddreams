$(document).ready(function(){
    "use strict"
	
	/*calender script code start here*/
	 $(function () {
        $('.date').datetimepicker({
			pickTime: false
		});
     });
	/*calender script code end here*/
	
	
	
	/*slideshow script code start here*/
	$('.slideshow').owlCarousel({
		loop: true,
		margin: 0,
		autoplay: true,
		smartSpeed: 1500,
		dots: true,
		nav:false,
		responsiveClass: true,
		responsive: {
			0: {
				items: 1
			},
			991: {
				items: 1
			},
			1180: {
				items: 1
			}
		}
	});
	/*slideshow script code end here*/
	
	/*testimonails script code start here*/
	
	$('.testimonails').owlCarousel({
		loop: true,
		margin: 0,
		items: 2,
		autoplay: true,
		smartSpeed: 2500,
		dots: true,
		nav:false,
		responsiveClass: true,
		responsive: {
			0: {
				items: 1
			},
			768: {
				items: 1
			},
			991: {
				items: 2
			},
			1180: {
				items: 2
			}
		}
	});
		
	/*testimonails script code end here*/
	
	/*testimonail1 script code start here*/
	$('.testimonail1').owlCarousel({
		loop: true,
		margin: 0,
		items: 1,
		autoplay: true,
		smartSpeed: 2500,
		dots: true,
		nav:false,
		responsiveClass: true,
		responsive: {
			0: {
				items: 1
			},
			768: {
				items: 1
			},
			991: {
				items: 1
			},
			1180: {
				items: 1
			}
		}
	});
	/*testimonail1 script code end here*/
	
	/*tweet script code start here*/
	$('#tweet').owlCarousel({
		loop: true,
		margin: 0,
		autoplay: true,
		smartSpeed: 1500,
		dots: true,
		nav:true,
		navText:['<i class="fa fa-angle-left fa1"></i>', '<i class="fa fa-angle-right fa2"></i>'],
		responsiveClass: true,
		responsive: {
			0: {
				items: 1
			},
			991: {
				items: 1
			},
			1180: {
				items: 1
			}
		}
	});
	/*tweet script code end here*/
	
	/*deal script code start here*/
	$('.deal').owlCarousel({
		loop: true,
		margin: 0,
		autoplay: true,
		smartSpeed: 1500,
		dots: true,
		nav:true,
		navText:['<i class="fa fa-angle-left fa1"></i>', '<i class="fa fa-angle-right fa2"></i>'],
		responsiveClass: true,
		responsive: {
			0: {
				items: 1
			},
			768: {
				items: 2
			},
			991: {
				items: 3
			},
			1180: {
				items: 4
			}
		}
	});
	/*deal script code end here*/
	
	/*test script code start here*/
	$('.test').owlCarousel({
		loop: true,
		margin: 0,
		autoplay: true,
		smartSpeed: 1500,
		dots: true,
		nav:false,
		responsiveClass: true,
		responsive: {
			0: {
				items: 1
			},
			768: {
				items: 2
			},
			991: {
				items: 3
			},
			1180: {
				items: 3
			}
		}
	});
	/*text script code end here*/
	
	
	/*blogs script code start here*/
	$('.blogs').owlCarousel({
		loop: true,
		margin: 0,
		autoplay: true,
		smartSpeed: 1500,
		dots: true,
		nav:true,
		navText:['Prev', 'Next'],
		responsiveClass: true,
		responsive: {
			0: {
				items: 1
			},
			991: {
				items: 1
			},
			1180: {
				items: 1
			}
		}
	});
	/*blogs script code end here*/
	
	/*relate script code start here*/
	$('#related-pro').owlCarousel({
		loop: true,
		margin: 0,
		items: 3,
		autoplay: true,
		smartSpeed: false,
		dots: true,
		nav:true,
		navText:['Prev', 'Next'],
		responsiveClass: true,
		responsive: {
			0: {
				items: 1
			},
			991: {
				items: 3
			},
			1180: {
				items: 3
			}
		}
	});
	/*relate script code end here*/
	
	/*additional script code start here*/
	$('#additional').owlCarousel({
		loop: true,
		margin: 0,
		items: 9,
		autoplay: true,
		smartSpeed: 1500,
		dots: true,
		nav:true,
		navText:['<i class="fa fa-angle-left fa1"></i>', '<i class="fa fa-angle-right fa2"></i>'],
		responsiveClass: true,
		responsive: {
			0: {
				items: 1
			},
			991: {
				items: 4
			},
			1180: {
				items: 6
			},
			1280: {
				items: 9
			}
		}
	});
	/*additional script code end here*/
	
});