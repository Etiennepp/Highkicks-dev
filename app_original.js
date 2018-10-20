$(document).ready(function(){ 

	if ($(document).scrollTop() > 50) {
		$('#menu').addClass('shrink');
	}
	if ($(document).scrollTop() > 100) {
		$('.search').attr('id','search-shrink');
	}

	
	var is_twitter_openned=1;
	var is_insta_openned=0;
	var is_snap_openned=0;
	var is_panier_openned=0;
	var is_compte_openned=0;

	$(document).click(function(event) {  if(!$(event.target).closest('#panier-wrap').length) {  $('#panier-open').fadeOut();is_panier_openned=0;} 
		if(!$(event.target).closest('#compte-wrap').length) {
			$('#compte-open').fadeOut();
			is_compte_openned=0;
		}       
	});

	$('#twitter-img').click(function(){
		if (is_twitter_openned==0){
			if (is_insta_openned==1){
				$('#insta-open').fadeOut();
				is_insta_openned=0;
			}else if(is_snap_openned==1){
				$('#snap-open').fadeOut();
				is_snap_openned=0;
			}
			is_twitter_openned=1;
			$('#twitter-open').delay(370).fadeIn();
			
		}

	});

	$('#snap-img').click(function(){
		if (is_snap_openned==0){
			if (is_insta_openned==1){
				$('#insta-open').fadeOut();
				is_insta_openned=0;
			}else if(is_twitter_openned==1){
				$('#twitter-open').fadeOut();
				is_twitter_openned=0;
			}
			is_snap_openned=1;

			$('#snap-open').delay(370).fadeIn();
			
			

		}

	});
	$('#insta-img').click(function(){
		if (is_insta_openned==0){
			if (is_snap_openned==1){
				$('#snap-open').fadeOut();
				is_snap_openned=0;
			}else if(is_twitter_openned==1){
				$('#twitter-open').fadeOut();
				is_twitter_openned=0;
			}
			is_insta_openned=1;

			$('#insta-open').delay(370).fadeIn();
			
		}

	});
	$('#compte').click(function(){
		if (is_compte_openned==0){
			$('#compte-open').fadeIn(200);
			is_compte_openned=1;

		}else{
			$('#compte-open').fadeOut(200);
			is_compte_openned=0;

		}

	});

	

	$('#panier').click(function(){
		if (is_panier_openned==0){
			$('#panier-open').fadeIn();
			is_panier_openned=1;

		}else{
			$('#panier-open').fadeOut();
			is_panier_openned=0;

		}
	});

	

	$(window).scroll(function() {
		if ($(document).scrollTop() > 50) {
			$('#menu').addClass('shrink');




		} else {
			$('#menu').removeClass('shrink');
		}
	});

	$(window).scroll(function() {
		if ($(document).scrollTop() > 100) {
			$('.search').attr('id', 'search-shrink');


		} else {
			$('.search').attr('id', '');
		}
	});

	$('#connexion-form').on('submit', function (e) {

		e.preventDefault();

		$.ajax({
			type: 'post',
			url: 'https://highkicks.fr/connexion.php',
			data: $('form').serialize(),
			success: function (data) {

				if ($.trim(data)=='fail'){
					$('#connexion-fail').fadeOut();
					$('#connexion-fail').fadeIn();
				}
				else{
					$('#connexion-fail').fadeOut();
					location.href='https://highkicks.fr/';
				};


			}
		});

	});

	$('#article-wrap').on("mouseenter", "article", function() {
		var distance = parseInt($(this).find('.price').width()) + 5;
		var dist_style = 'translateX('+ distance +'px)';
		$(this).find('.article-name').css('transform',dist_style);
	});
	$('#article-wrap').on("mouseleave", "article", function() {
		$(this).find('.article-name').css('transform','translateX(0px)');
	});


	$('.article-overwatch-thb').click(function(){
		$('#image-principal').attr("src", $(this).attr("src"));
		$('.article-overwatch-thb').css('opacity',0.25);
		$(this).css('opacity',1);
	});	

	var width = $('#image-1').width();
	$('#image-1').css('height', width);
	$('#image-2').css('height', width);
	$('#image-3').css('height', width);





}) 