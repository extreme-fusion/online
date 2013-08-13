/** FUNKCJE OD WYSZUKIWANIA UŻYTKOWNIKA WSPÓLNE DLA PANELU ADMINA I RESZTY STRONY **/

(function($){
    $.fn.extend({
        searchEngine: function(options) {
			var methods = {
				searchIt : function(options) {
					$.ajax({
						url: addr_site+o.php_file,
						type: 'POST',
						dataType: 'json',
						data: {to: value, from_admin: defaults.is_here_admin_panel, self_search: defaults.self_search, only_active: defaults.only_active},
						success: function(oJsonObject, sTextstatus, oXMLHttpRequest){
							$(this).css({'borderRadius':'5px 5px 0 0','border-bottom-width':'0'});
							if (parseInt(oJsonObject.status) == 0) {
								var users = '<ul style="width:'+o.width+'px">';
								for (i = 0; i < oJsonObject.users.length; i++)
								{
									var users = users + '<li id="def-'+ oJsonObject.users[i].id +'">' + oJsonObject.users[i].username + '</li>';
								}
								var users = users + '</ul>';
								$('#'+defaults.tip_id).html(users);
							} else if (parseInt(oJsonObject.status) == 2) {
								return methods['hideTip'].apply( this, Array.prototype.slice.call( o, 1 ))
							} else {
								$('#'+defaults.tip_id).html('<div class="'+defaults.tip_id+'_error">'+oJsonObject.error_msg+'</div>');
							}
						},
						error: function(oXMLHttpRequest, sTextstatus, oErrorThrown) {
							alert(sTextstatus);
						}
					});
				},
				hideTip : function(options) {
					$('#'+defaults.tip_id).html('');
					last_value = '';
				}
			};

            var defaults = {
                php_file: 'ajax/search_users.php',
                is_here_admin_panel: 0,
                self_search: 1,
				only_active: 0,
				tip_id: 'defenders'
            };

			var value = '';
			var last_value = '';

            $.extend(defaults, options);

            return this.each(function() {
                var obj = $(this);
				var width = obj.width()-100;

				o = $.extend(defaults, {'offset': obj.offset(), 'width_orig': obj.width(), 'width': width});

				var marg = (o.width_orig-o.width)/2;

				var pos_top = o.offset.top + 26;
				var pos_left = o.offset.left + marg;

				$(this).after('<div id="'+defaults.tip_id+'" style="position:absolute; top:'+pos_top+'px; left:'+pos_left+'px; width:'+width+'px !important"></div>');

				$(this).keyup(function() {
					value = $(this).val();
					if (last_value != value) {
						last_value = value;
						return methods['searchIt'].apply( this, Array.prototype.slice.call( o, 1 ))
					}
				}).click(function() {
					value = $(this).val();
					if (last_value != value) {
						last_value =  value;
						return methods['searchIt'].apply( this, Array.prototype.slice.call( o, 1 ))
					}
				}).blur(function() {
					$('html').click(function(e){
						if(e.target.id != 'defenders' && e.target.id != 'search_user') {
							return methods['hideTip'].apply( this, Array.prototype.slice.call( o, 1 ))
						}
					});
				}).focus(function() {
					value = $(this).val();
					if (last_value != value && value) {
						last_value =  value;
						return methods['searchIt'].apply( this, Array.prototype.slice.call( o, 1 ))
					}
				});
            });
        }
    });
})(jQuery);

$(function() {

	// ============================
	// Wysyłanie formularzy przez link
	// ============================
	$('.Buttons .save').bind('click', function() {
		$('#preview').remove();
		var FormSubmitID = (this.id).split('_');
		$('#' +FormSubmitID[1]).submit();
	});

	$('.Buttons .preview').bind('click', function() {
		$('#save').remove();
		var FormSubmitID = (this.id).split('_');
		$('#' +FormSubmitID[1]).submit();
	})

	$('.Buttons .delete').bind('click', function() {
		$('#preview').remove();
		$('#save').remove();
		var FormSubmitID = (this.id).split('_');
		$('#' +FormSubmitID[1]).submit();
	})

	// Ajax loaded news
	/*$('.buttone').click(function(e) {
		e.preventDefault();
		$.ajax({
			url: addr_site+'ajax/index.php?file=news',
			type: 'GET',
			data: {'current': 2}
		});
	});*/

	// Manipulowanie domyślną zawartością pola

	$('.valueSystem').each(function() {
		var val = $(this).val();
		$(this).focus(
			function() {
				if (this.value == val) {
					this.value = '';
				}
			}
		).blur(function() {
			if (this.value == '') {
				this.value = val;
			}
		});
	});
	
	// Wracanie do poprzedniej strony
	$('.back').click(function(e){
		history.back();
	});
});

function addText(f,i,a,e){if(e==undefined){e="inputform"}if(f==undefined){f="message"}element=document.forms[e].elements[f];element.focus();if(document.selection){var c=document.selection.createRange();var h=c.text.length;c.text=i+c.text+a;return false}else{if(element.setSelectionRange){var b=element.selectionStart,g=element.selectionEnd;var d=element.scrollTop;element.value=element.value.substring(0,b)+i+element.value.substring(b,g)+a+element.value.substring(g);element.setSelectionRange(b+i.length,g+i.length);element.scrollTop=d;element.focus()}else{var d=element.scrollTop;element.value+=i+a;element.scrollTop=d;element.focus()}}}
function insertText(f,h,e){if(e==undefined){e="inputform"}if(document.forms[e].elements[f].createTextRange){document.forms[e].elements[f].focus();document.selection.createRange().duplicate().text=h}else{if((typeof document.forms[e].elements[f].selectionStart)!="undefined"){var a=document.forms[e].elements[f];var g=a.selectionEnd;var d=a.value.length;var c=a.value.substring(0,g);var i=a.value.substring(g,d);var b=a.scrollTop;a.value=c+h+i;a.selectionStart=c.length+h.length;a.selectionEnd=c.length+h.length;a.scrollTop=b;a.focus()}else{document.forms[e].elements[f].value+=h;document.forms[e].elements[f].focus()}}}
