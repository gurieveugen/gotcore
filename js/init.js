var $ = jQuery.noConflict();

$().ready(function() {
	$('.jqmWindow#privacy-policy').jqm({trigger: 'a#modal-privacy', overlay:60});
	$('.jqmWindow#privacy-policy').jqmAddClose('a.close'); 
});

function SelectAll(id)
{
    document.getElementById(id).focus();
    document.getElementById(id).select();
}

$(window).load(function(){
	$('h1, h2, label, p').css('visibility','visible');
});

$(document).ready(function(){
	
	var containerHeight = $('#container').height();
	$('#container').css('height',containerHeight);
	
	$('.modal-trigger').click(function(){
		var modalPos = $(window).scrollTop() + 70;
		$('.jqmWindow').css('top', modalPos + 'px');
	});

});

$(function(){

    $("#form").submit(function(e){
 
      	e.preventDefault();

        dataString = $("#form").serialize();
        
        $.ajax({
        type: "POST",
        url: "wp-content/themes/launcheffect/post.php",
        data: dataString,
        dataType: "json",
        success: 
        	function(data) {
        		
	            if(data.email_check == "invalid"){
	                
	                $('#error').html('Invalid Email.');
	                
	            } else {
	            	
	            	if(data.reuser == "true") {
	            	
		            	$('#form, #error, #presignup-content').hide();
		                $('#returning').fadeIn();
		                
		                var returningCode = $('span.dirname').text() + '/' + data.returncode;
		                var returningtweetCode = 'http://twitter.com/share?url=' + returningCode;
		                
		                $('#returning span.user').text(data.email);
		                $('#returning span.clicks').text(data.clicks);
		                $('#returning span.conversions').text(data.conversions);
		                $('#returning input#returningcode').attr('value',returningCode);
		                
	            		$('#tweetblock-return').html('<a href="' + returningtweetCode + '" class="twitter-share-button" data-count="none">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>');	

						$('#fblikeblock-return').html('<fb:like id="fbLike" href="'+returningCode+'" send="true" layout="button_count" width="120" show_faces="false" font="arial"></fb:like>');
						FB.XFBML.parse(document.getElementById('fblikeblock-return'));
						
						function renderPlusoneReturning() {
        					gapi.plusone.render('plusoneblock-return', {'href':returningCode, 'size':'tall', 'annotation':'none'});
      					}
      					renderPlusoneReturning();
      					
						var tumblr_link_url_return = returningCode;
					
					    var tumblr_button = document.createElement("a");
					    tumblr_button.setAttribute("href", "http://www.tumblr.com/share/link?url=" + encodeURIComponent(tumblr_link_url_return) + "&name=" + encodeURIComponent(tumblr_link_name) + "&description=" + encodeURIComponent(tumblr_link_description));
					    tumblr_button.setAttribute("title", "Share on Tumblr");
					    tumblr_button.setAttribute("style", "display:inline-block; text-indent:-9999px; overflow:hidden; width:81px; height:20px; background:url('http://platform.tumblr.com/v1/share_1.png') top left no-repeat transparent;");
					    tumblr_button.innerHTML = "Share on Tumblr";
					    document.getElementById("tumblrblock-return").appendChild(tumblr_button);
					    
					    $('#linkinblock-return').html('<script src="http://platform.linkedin.com/in.js" type="text/javascript"></script><script type="IN/Share" data-url="'+returningCode+'"></script>');
						
	            	
	            	} else {
	            	
		            	$('#form, #error, #presignup-content').hide();
		                $('#success, #success-content').fadeIn();
		                
		                var refermiCode = $('span.dirname').text() + '/' + data.code;
		                var tweetCode = 'http://twitter.com/share?url=' + refermiCode;
		                
		                $('#success input#successcode').attr('value',refermiCode);
	            		
	            		$('#tweetblock').html('<a href="' + tweetCode + '" class="twitter-share-button" data-count="none">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>');	

						$("#fblikeblock").html('<fb:like id="fbLike" href="'+refermiCode+'" send="true" layout="button_count" width="120" show_faces="false" font="arial"></fb:like>');
						FB.XFBML.parse(document.getElementById('fblikeblock'));
						
						function renderPlusone() {
        					gapi.plusone.render('plusoneblock', {'href':refermiCode, 'size':'tall', 'annotation':'none'});
      					}
      					renderPlusone();
      					
						var tumblr_link_url = refermiCode;
					
					    var tumblr_button = document.createElement("a");
					    tumblr_button.setAttribute("href", "http://www.tumblr.com/share/link?url=" + encodeURIComponent(tumblr_link_url) + "&name=" + encodeURIComponent(tumblr_link_name) + "&description=" + encodeURIComponent(tumblr_link_description));
					    tumblr_button.setAttribute("title", "Share on Tumblr");
					    tumblr_button.setAttribute("style", "display:inline-block; text-indent:-9999px; overflow:hidden; width:81px; height:20px; background:url('http://platform.tumblr.com/v1/share_1.png') top left no-repeat transparent;");
					    tumblr_button.innerHTML = "Share on Tumblr";
					    document.getElementById("tumblrblock").appendChild(tumblr_button);
					    
					    $('#linkinblock').html('<script src="http://platform.linkedin.com/in.js" type="text/javascript"></script><script type="IN/Share" data-url="'+refermiCode+'"></script>');
	          				            		
	            	}
	                    
	            }	
	        }

        });          

    });
});
