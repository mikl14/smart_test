$(document).ready(function(){
	
	var answers = {};
	function resetValue() {
		$("input:radio").each(function(){
		  var id = $(this).attr("id");
		  $(this).attr('value',$("label[for='"+id+"']").text());
		});
		$.each(answers,function(key,value){
			if (value) {
				$("input[type=radio][name='"+key+"'][value='"+value+"']").prop('checked',true);
				$("input[type=number][name='"+key+"']").attr('value',value);
				$("textarea[name='"+key+"']").val(value);
			}
		});
		$(".opros").scrollTop(0);
	}

	function request_next(arg=1){
		var all_answered = true;
		$("input:radio").each(function(){
		  var name = $(this).attr("name");
		  if($("input:radio[name="+name+"]:checked").length == 0)
		  {
		    all_answered = false;
		  }
		});
		if(all_answered)
		{
			$.each($("input,textarea").serializeArray(),function(){
				answers[this.name]=this.value;
			})
			//console.log(answers);
			$("#navig").attr('value',arg);
			answers['navig']=arg;
			$.ajax({
				type: "POST",
				url: 'ajax_opros.php',
				data: answers,
				success: function(response)
				{
					//console.log(response);  //удалить
					$('.opros').html(response);
					resetValue();
				}
			});
		}
		else
		{
			alert("Не все поля заполнены");
		}
	}
	function request_back(){
		
		$("#navig").attr('value','-1');
		answers['navig']=-1;
		$.ajax({
			type: "POST",
			url: 'ajax_opros.php',
			data: answers,
			success: function(response)
			{
				//console.log(response);  //удалить
				$('.opros').html(response);
				resetValue();
			}
		});
	}

	$(".opros").on('click','#next',function(){
		request_next();
	});

	$(".opros").on('click','#back',function(){
		request_back();
	});	

	$(".opros").on('click','#end',function() {
		location.href="../";
	});

	$(".opros").on('click','#541',function() {
		$('input[name="55"]').prop('checked',false);
		$('input[name="56"]').prop('checked',false);
		$("input[value='NaN']").prop('checked',true);
		$('#gostinic').fadeIn();
		$('#specsred').hide();
		$('#sanatorno').hide();
		$('#orgotd').hide();
	});

	$(".opros").on('click','#542',function() {
		$('input[name="55"]').prop('checked',false);
		$('input[name="56"]').prop('checked',false);
		$('#specsred').fadeIn();
		$('#gostinic').hide();
		$('#sanatorno').hide();
		$('#orgotd').hide();
	});
	$(".opros").on('click','#555',function() {
		$('input[name="56"]').prop('checked',false);
		$('#sanatorno').fadeIn();
		$('#orgotd').hide();
	});
	$(".opros").on('click','#556',function() {
		$('input[name="56"]').prop('checked',false);
		$('#orgotd').fadeIn();
		$('#sanatorno').hide();
	});

	$("#begin > button").click(request_next(2));
});