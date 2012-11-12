function mainmenu(){
	$(".child-menu").hide();
	//$(" .navbar li").hover(function(){
	//	$(this).find('ul:first').css({visibility: "visible",display: "none"}).show(400);
	//	},function(){
	//	$(this).find('ul:first').css({visibility: "hidden"});
	//	});
	$(".navbar").children().click(function() {
		//event.preventDefault();
		$(this).children(".child-menu").slideToggle("slow"); 
	});
}

 $(document).ready(function(){
	mainmenu();
});	
