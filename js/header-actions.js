function mainmenu(){
	$(".navbar ul").css({display: "none"}); // Opera Fix
	$(" .navbar li").hover(function(){
		$(this).find('ul:first').css({visibility: "visible",display: "none"}).show(400);
		},function(){
		$(this).find('ul:first').css({visibility: "hidden"});
		});
}

 $(document).ready(function(){
	mainmenu();
});	
