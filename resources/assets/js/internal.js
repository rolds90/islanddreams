$(document).ready(function(){
    "use strict"
	
	$('.fb').hide();
	$('.facebook').on('click', function(){
		$('.fb').show();
		$('.tw').hide();
		$('.go').hide();
		$('.inst').hide();
		$('.pint').hide();
	});
	$('.tw').hide();
	$('.twitter').on('click', function(){
		$('.tw').show();
		$('.go').hide();
		$('.fb').hide();
		$('.inst').hide();
		$('.pint').hide();
	});
	$('.go').hide();
	$('.google').on('click', function(){
		$('.go').show();
		$('.fb').hide();
		$('.tw').hide();
		$('.inst').hide();
		$('.pint').hide();
	});
	$('.inst').hide();
	$('.instagram').on('click', function(){
		$('.inst').show();
		$('.fb').hide();
		$('.tw').hide();
		$('.go').hide();
		$('.pint').hide();
	});
	$('.pint').hide();
	$('.pinterest').on('click', function(){
		$('.pint').show();
		$('.fb').hide();
		$('.tw').hide();
		$('.go').hide();
		$('.inst').hide();
	});
	$('.fb .fa-facebook').on('click', function(){
		$('.fb').hide();
		$('.tw').hide();
		$('.pint').hide();
		$('.go').hide();
		$('.inst').hide();
	});
	$('.tw .fa-twitter').on('click', function(){
		$('.fb').hide();
		$('.tw').hide();
		$('.pint').hide();
		$('.go').hide();
		$('.inst').hide();
	});
	$('.pint .fa-pinterest-p').on('click', function(){
		$('.fb').hide();
		$('.tw').hide();
		$('.pint').hide();
		$('.go').hide();
		$('.inst').hide();
	});
	$('.go .fa-google-plus').on('click', function(){
		$('.fb').hide();
		$('.tw').hide();
		$('.pint').hide();
		$('.go').hide();
		$('.inst').hide();
	});
	$('.inst .fa-instagram').on('click', function(){
		$('.fb').hide();
		$('.tw').hide();
		$('.pint').hide();
		$('.go').hide();
		$('.inst').hide();
	});

	// Product List
	$('#listview').on('click',function(e){
		e.preventDefault();
		$('.shoppage .row > .product-grid').attr('class', 'product-layout product-list col-xl-12');
		localStorage.setItem('display', 'list');
	});
	
	// Product Grid
	$('#gridview').on('click',function(e){
		e.preventDefault();
		$('.shoppage .row > .product-list').attr('class', 'product-layout product-grid col-lg-3 col-md-3 col-sm-4 col-xl-12');
		localStorage.setItem('display', 'grid');
	});
	
	// Product Grid
	$('#grid-view').on('click',function(){
		$(this).addClass('active').siblings().removeClass('active');
		$('.mainpage .row > .product-list').attr('class', 'product-layout product-grid col-lg-4 col-md-4 col-sm-6 col-xl-12');
		localStorage.setItem('display', 'grid');
	});
	$('#list-view').on('click',function(){
		$(this).addClass('active').siblings().removeClass('active');
		$('.mainpage .row > .product-grid').attr('class', 'product-layout product-list col-xl-12');
		localStorage.setItem('display', 'list');
	});
	
	// collapse
	$('.left-box .who .collapse').on('shown.bs.collapse', function(){
	$(this).parent().removeClass("active").addClass("active");
	$(this).parent().find(".fa-caret-right").removeClass("fa-caret-right").addClass("fa-caret-down");
	}).on('hidden.bs.collapse', function(){
	$(this).parent().find(".fa-caret-down").removeClass("fa-caret-down").addClass("fa-caret-right");
	$(this).parent().removeClass("active").addClass("");
	});
	
	//quantity code
	$(function () {
		$('.add').on('click',function(){
			var $qty=$(this).closest('p').find('.qty');
			var currentVal = parseInt($qty.val());
				$qty.val(currentVal + 1);
		});
		$('.minus').on('click',function(){
			var $qty=$(this).closest('p').find('.qty');
			var currentVal = parseInt($qty.val());
			$qty.val(currentVal - 1);					
		});
	});
	
	
	// collapse
	$('.collapse').on('shown.bs.collapse', function(){
		$(this).parent().find(".fa-plus").removeClass("fa-plus").addClass("fa-minus");
	}).on('hidden.bs.collapse', function(){
		$(this).parent().find(".fa-minus").removeClass("fa-minus").addClass("fa-plus");
	});	
	
	
	
});
