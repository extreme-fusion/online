$(document).ready(function() {
	$("input:checkbox, input:radio, input:file, select").uniform();
	$('a.SendButton, a.CancelButton').bind('click', function() {
		var FormSubmitID = (this.id).split('_');
		$('#'+FormSubmitID[1]).submit();
	});
	$(".valid, .error, .info, .status").each(function () {
		var GetStatus = $(this).attr("class");
		$(this).addClass("close-" +GetStatus);
		$(".close-" +GetStatus).click(function () {
			$(this).fadeOut("slow");
		});
	});

	$('#refresh').click(function() {
		window.location.reload();
	});
	
	$('.CancelButton').click(function() {
		window.location.href = window.location.protocol + '//' + window.location.host + '/' + window.location.pathname + '?abort=true';
	});

    $("select[name=localeset]").change(function () {
		$('input[type="hidden"]').attr('name', 'hidden');
		$('form').submit();
		
	});

	$('input:checkbox[name=AcceptCC]').click(function() {
		$('input[type="hidden"]').attr('name', 'step');
		if($('input:checkbox[name=AcceptCC]:checked').length > 0) {
			$("#SendForm_This").show();
		} else {
			$("#SendForm_This").hide();
		}
	});

	var bpos = "";
	var perc = 0 ;
	var minperc = 0 ;
	$('#password1, #admin_password1').css({backgroundPosition: "0 0"});
	$('#password1').keyup(function(){
		perc = passwordStrengthPercent($('#password1').val(),$('#username').val());
		bpos=" $('#colorbar').css( {backgroundPosition: \"0px -" ;
		bpos = bpos + perc + "px";
		bpos = bpos + "\" } );";
		bpos=bpos +" $('#colorbar').css( {width: \"" ;
		bpos = bpos + (perc * 3) + "px";
		bpos = bpos + "\" } );";
		eval(bpos);
	    	$('#percent').html(" " + perc  + "% ");
	});

	/** Team section **/
	$('.tab-click').click(function() {
		var id = this.id;
		$object = $('#tab-'+id);
		if ($object.is(':hidden')) {
			$object.fadeIn();
		} else {
			$object.fadeOut();
		}
	});

	$('#CustomRewrite, #CustomFurl').change(function() {
		var status = $(this).is(':checked');
		if (status) {
			$('#CustomStep3').fadeIn(1000);
		} else {
			$('#CustomStep3').fadeOut(500);
		}
	});
	/**/

});
