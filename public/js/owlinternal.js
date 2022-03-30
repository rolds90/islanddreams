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
	
	/*additional script code start here
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
	additional script code end here*/
	

	var bigimage = $("#big");
	var thumbs = $("#additional");
	//var totalslides = 10;
	var syncedSecondary = true;

	bigimage
		.owlCarousel({
			items: 1,
			slideSpeed: 2000,
			nav: false,
			autoplay: true,
			dots: false,
			loop: true,
			responsiveRefreshRate: 200,
			// navText: [
			// 	'<i class="fa fa-arrow-left" aria-hidden="true"></i>',
			// 	'<i class="fa fa-arrow-right" aria-hidden="true"></i>'
			// ]
		})
		.on("changed.owl.carousel", syncPosition);

	thumbs
		.on("initialized.owl.carousel", function () {
			thumbs
				.find(".owl-item")
				.eq(0)
				.addClass("current");
		})
		.owlCarousel({
			items: 4,
			dots: true,
			nav: true,
			navText: [
				'<i class="fa fa-angle-left fa1" aria-hidden="true"></i>',
				'<i class="fa fa-angle-right fa2" aria-hidden="true"></i>'
			],
			smartSpeed: 200,
			slideSpeed: 500,
			slideBy: 4,
			responsiveRefreshRate: 100
		})
		.on("changed.owl.carousel", syncPosition2);

	function syncPosition(el) {
		//if loop is set to false, then you have to uncomment the next line
		//var current = el.item.index;

		//to disable loop, comment this block
		var count = el.item.count - 1;
		var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

		if (current < 0) {
			current = count;
		}
		if (current > count) {
			current = 0;
		}
		//to this
		thumbs
			.find(".owl-item")
			.removeClass("current")
			.eq(current)
			.addClass("current");
		var onscreen = thumbs.find(".owl-item.active").length - 1;
		var start = thumbs
			.find(".owl-item.active")
			.first()
			.index();
		var end = thumbs
			.find(".owl-item.active")
			.last()
			.index();

		if (current > end) {
			thumbs.data("owl.carousel").to(current, 100, true);
		}
		if (current < start) {
			thumbs.data("owl.carousel").to(current - onscreen, 100, true);
		}
	}

	function syncPosition2(el) {
		if (syncedSecondary) {
			var number = el.item.index;
			bigimage.data("owl.carousel").to(number, 100, true);
		}
	}

	thumbs.on("click", ".owl-item", function (e) {
		e.preventDefault();
		var number = $(this).index();
		bigimage.data("owl.carousel").to(number, 300, true);
	});
});