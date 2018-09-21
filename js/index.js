function inverser(){

	if(document.getElementById('pid1').style.display == 'block'){
		document.getElementById('pid1').style.display = 'none';
		document.getElementById('pid2').style.display = 'block';
		return;
	}
	if(document.getElementById('pid1').style.display == 'none'){
		document.getElementById('pid1').style.display = 'block';
		document.getElementById('pid2').style.display = 'none';
	}
}

$('.message a').click(function(){
   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
	
});
