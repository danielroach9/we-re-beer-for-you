$( document ).ready(function(){
		$('select').material_select();
        $(".button-collapse").sideNav();
		$('.modal').modal();

		$("#loginForm").submit(function(e){
			e.preventDefault();
	        var $userName = $('#loginForm').find('#login_email').val();
			var $password = $('#loginForm').find('#login_password').val();

			var $data = {
				user: $userName,
				pass: $password,
				action: 'performLogin'
			};

			$.ajax({
				  type: "POST",
				  url: 'model/DB.class.php',
				  data: $data
			}).done(function(msg) {
	              console.log(msg);
				  if(msg){
				  	window.location.href = 'views/inbox.php';
				  }else{
				  	alert("User/password incorrect!");
				  }
			});
    	});

    	$('#selectedCategory').change(function(){
	        var $cat_id = $(this).val();

	        var $data = {
	        	category: $cat_id,
	        	action: 'getStylesByCategory'
	        };

	        $.ajax({
				  type: "POST",
				  url: '../model/DB.class.php',
				  data: $data
			}).done(function(data) {
				if(data){
					console.log(data);
				}else{
					//nothing..
				}
			});

	        $.post('../model/DB.class.php', { dropdownValue: cat_id }, function(data){
	          alert('ajax completed. Response:  '+data);
	          //do after submission operation in DOM
	        });
	    });

		$('#msg_send').click(function(){
			var $subject = $('#subject-input').val();
			var $recipient = $('#send-to-input').val();
			var $content = $('#message-area').val();

			var $data{
				subject: $subject,
				recipient: $recipient,
				content: $content,
				action: 'insertNewMessage'
			};

			$.ajax({
				type: "POST",
			  	url: '../model/DB.class.php',
				data: $data
			}).done(function(data){
				if(data){
					console.log(data);
				}else{
					console.log("did not go through");
				}
			})
		});
});

function showRegister(){
  $("#register").show();
  $('#register').addClass('animated flipInY');
  $("#login").hide();
}
