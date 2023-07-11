$(document).ready(function(){
	$(".opros button").click(()=>{
		$(".black_screen").fadeIn(200);
	});
	$(".black_screen").mousedown(function(arg){
		if(arg.target==this)
			$(this).fadeOut(200);
	});

	$("button[type='submit']").click(function(e)
	{
		e.preventDefault();
		$.ajax({
			type: "POST",
			url: 'ajax.php',
			data: $("form").serialize(),
			success: function(response)
			{
				var jsonData = JSON.parse(response);
				if (jsonData.success == "1")
				{
					// console.log(jsonData.inn);
					// console.log(jsonData.okpo);
					//console.log(jsonData.naimobj);
					// console.log(jsonData.adresf);
					// console.log(jsonData.okato);
					// console.log(jsonData.oktmo);
					// console.log(jsonData.typep);
					// console.log(jsonData.typeofsn);
					// console.log(jsonData.typeermsp);
					// console.log(jsonData.type_msp);
					// console.log(jsonData.okved_osn);
					// console.log(jsonData.okved_neosn);
					// console.log(jsonData.fact_okved_osn);
					// console.log(jsonData.fact_okved_neosn);
					// console.log(jsonData.schr);
					// console.log(jsonData.viruchka);
					// console.log(jsonData.systemnalog);
					// console.log(jsonData.sposob_likvid);
					$("#page1").css('display','none');
					$("#page2").css('display','flex');
					$("#info").html('<span style="font-size:40px">Вы ввели</span>'+jsonData.naimobj);
				}
				else
				{
					alert('Не найдено');
				}
			}
		});
	});

	$("#back").click(function(e)
	{
		e.preventDefault();
		$("#page1").css('display','flex');
		$("#page2").css('display','none');
	});

	$("#next").click(function(e)
	{
		e.preventDefault();
		location.href="/html/answer_base.php";
	});

});