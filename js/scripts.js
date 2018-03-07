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
				  }
				  else{
				  	alert("User/password incorrect!");
				  }
			});
    	});

    	$('#selectedCategory').change(function(e){
				e.preventDefault();
	        var $cat_id = $(this).val();
					alert($cat_id);

	        var $data = {
	        	category: $cat_id,
	        	action: 'getStylesByCategory'
	        };

	        $.ajax({
				  type: "POST",
				  url: '../model/DB.class.php',
				  data: $data
			}).done(function(data) {
				alert(data);
				if(data){
					console.log(data);
					$("#stylesDropdown").html("");
					//set $styles to data

				}else{
					console.log("error");
					//nothing..
				}
			});

	        // $.post('../model/DB.class.php', { dropdownValue: cat_id }, function(data){
	        //   alert('ajax completed. Response:  '+data);
	        //   //do after submission operation in DOM
	        // });
	    });
			// $("#preferenceForm").submit(function(e){
			// 	e.preventDefault();
		  //   var $cat_id = $('#preferenceForm').find('#selectedCategory').val();
			// 	var $style = $('#preferenceForm').find('#stylesDropdown').val();
			// 	var $abv = 0;
			// 	var $country_name = $('#preferenceForm').find('#countryDropdown').text();//need to get string, int value is meaningless
			//
			// 	var $data = {
			// 		user: $userName,
			// 		pass: $password,
			// 		action: 'performLogin'
			// 	};
			//
			// 	$.ajax({
			// 		  type: "POST",
			// 		  url: 'model/DB.class.php',
			// 		  data: $data
			// 	}).done(function(msg) {
		  //             console.log(msg);
			// 		  if(msg){
			// 		  	window.location.href = 'views/inbox.php';
			// 		  }
			// 		  else{
			// 		  	alert("User/password incorrect!");
			// 		  }
			// 	});
	    // 	});

		$('#msg_send').click(function(){
			var $subject = $('#subject-input').val();
			var $recipientID = $('#send-to-input').val();
			var $recipientName = $('#send-to-input :selected').text();
			var $content = $('#message-area').val();

			console.log("subject: "+$subject);
			console.log("recipient ID: "+$recipientID);
			console.log("recipient Name: "+$recipientName);
			console.log("content: "+$content);

			// $.ajax({

			// }).done(function(data){

			// })
		});
});

function showRegister(){
  $("#register").show();
  $('#register').addClass('animated flipInY');
  $("#login").hide();
}
