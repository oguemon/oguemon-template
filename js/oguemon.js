jQuery(document).ready(function($) { 
    'use strict';

	//起動時
	$(window).load(function(){
		$('#sp-right-menu-area').css('display','none');
		$('#transparent').css('display','none');
	});
	//ボタンを押すとスライド
	$(function(){
		var $btn = $('#sp-menu-right-btn');
		var $sp = $('#sp-right-menu-area');
		var $tr = $('#transparent');
		var $container = $('#container');
		$btn.on('click', function(){
			$container.toggleClass('side-open');
			if($container.hasClass('side-open')){ //横に開いていたら
				$sp.css('display','block');
				$tr.css('display','block');
				$btn.css('transform','rotate(180deg)');
			}else{
				$tr.css('display','none');
				$btn.css('transform','rotate(0)');
	   			setTimeout(function(){
				$sp.css('display','none');
	  			},300);
			}
		});
		$tr.on('click', function(){
			$btn.css('transform','rotate(0)');
			$container.toggleClass('side-open');
	   		setTimeout(function(){
				$sp.css('display','none');
	  		},300);
			$tr.css('display','none');
		});
	});
});
