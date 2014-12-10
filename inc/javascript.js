//~~~~~~~~~~~~~~~~~~~~~~~~~~
// Javascript modul pre ACP aplikaciu
//                          BY 
//~~~~~~~~~~ Seky ~~~~~~~~~~~~~

//~~~~~~~~~~~~~~~~~~~~~~~~~~
//~~~~~ Zoznam v tabulke ~~~~~~~

function zoznam(id) {
	if(document.all) {
		 if(document.all[id].style.display == 'none') {
			document.all[id].style.display = 'block';
		 } else {
			document.all[id].style.display = 'none';
		 }
	} else {
		if(document.getElementById(id).style.display == 'none') {
			document.getElementById(id).style.display = 'table-row';
		 } else {
			document.getElementById(id).style.display = 'none';
		}
	}
}

//~~~~~~~~~~~~~~~~~~~~~~~
//~~~~~ Menu efekt ~~~~~~~
var efekt = true;

$(document).ready(
function(){	

	//start
	$(".menu-system").children().each(
		function(){
			$(this).children().stop().fadeTo(1, 0.4);        
		}
	);
      
	
	//Menu click
	$(".menu-system-right").click(
		function () {
			if(efekt) {
				$(this).parent().children(".menu-system-right").children(".menu-popis").css({display: "none"});
				$(".menu-system").hide("slow");
				$(this).parent().children(".menu-system-left").children(".menu-reset").css({display: "block"},{height: "auto"});
				$(this).parent().children(".menu-system-right").children(".menu-obsah").css({display: "block"},{height: "auto"});
				$(this).parent().slideDown();
			} else {
				$(".menu-system").css({display: "none"});	
				$(this).parent().children(".menu-system-left").children(".menu-reset").css({display: "block"});
				$(this).parent().children(".menu-system-right").children(".menu-obsah").css({display: "block"});
				$(this).parent().children(".menu-system-right").children(".menu-popis").css({display: "none"});
				$(this).parent().css({display: "block"});	
			}		
		}
	);
	$(".menu-avatar").click(
		function () {
			if(efekt) {
				$(this).parent().parent().children(".menu-system-right").children(".menu-popis").css({display: "none"});
				$(".menu-system").hide("slow");
				$(this).parent().parent().children(".menu-system-left").children(".menu-reset").css({display: "block"},{height: "auto"});
				$(this).parent().parent().children(".menu-system-right").children(".menu-obsah").css({display: "block"},{height: "auto"});
				$(this).parent().parent().slideDown();
			} else {
				$(".menu-system").css({display: "none"});	
				$(this).parent().parent().children(".menu-system-left").children(".menu-reset").css({display: "block"});
				$(this).parent().parent().children(".menu-system-right").children(".menu-obsah").css({display: "block"});
				$(this).parent().parent().children(".menu-system-right").children(".menu-popis").css({display: "none"});
				$(this).parent().parent().css({display: "block"});	
			}		
		}
	);
	// Menu reset
	$(".menu-reset").click( 
		function(){
			if(efekt) {
				$(".menu-reset").css({display: "none"});
				$(".menu-obsah").css({display: "none"});
				$(".menu-popis").css({display: "block"},{height: "auto"});
				$(".menu-system").show("slow");
			} else {
				$(".menu-reset").css({display: "none"});
				$(".menu-obsah").css({display: "none"});
				$(".menu-system").css({display: "block"});
				$(".menu-popis").css({display: "block"});
			}
		}
	);

	// Menu efekt
	$(".menu-system").hover(
		function(){
			if(efekt){
				$(this).children(".menu-system-left").stop().animate({left: "7px"}, "normal");
				$(this).children(".menu-system-right").stop().animate({left: "-7px"}, "normal");
			} else {
				$(this).children(".menu-system-left").css({left: "7px"});
				$(this).children(".menu-system-right").css({left: "-7px"});	
			}
			$(this).children().each(
			function(){
				$(this).children().stop().fadeTo(efekt ? "normal" : 1, 1.0);		
			});
		}, 
		function(){
			if(efekt){
				$(this).children(".menu-system-left").stop().animate({left: "0px"}, "normal");
				$(this).children(".menu-system-right").stop().animate({left: "0px"}, "normal");
			} else {
				$(this).children(".menu-system-left, .menu-system-right").css({left: "0px"});			
			}
			$(this).children().each(function(){
				$(this).children().stop().fadeTo(efekt ? "normal" : 1, 0.4);        
			});
		}
	);	
}
);