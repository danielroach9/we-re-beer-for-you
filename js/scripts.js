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

    	$("#registerForm").submit(function(e){
			e.preventDefault();
	        var $first_name = $('#registerForm').find('#first_name').val();
			var $last_name = $('#registerForm').find('#last_name').val();
			var $email = $('#registerForm').find('#email').val();
			var $password = $('#registerForm').find('#password').val();

			var $data = {
				firstName: $first_name,
				lastName: $last_name,
				email: $email,
				password: $password,
				action: 'performRegister'
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

    	$('#selectedCategory').change(function(e){
				e.preventDefault();
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
							data = JSON.parse(data);
							$("#stylesDropdown").html(data.reduce((prev,curr)=>{
								return `${prev}<option value=${curr.id}>${curr.style_name}</option>`
							},"")
						  );
							$('#stylesDropdown').material_select();//this re initializes the select because materialize hides the real thing

						}else{
							alert("something broke");
							//nothing..
						}
					});
	    });
			$("#preferenceForm").submit(function(e){
				e.preventDefault();
		    var $cat_id = $('#preferenceForm').find('#selectedCategory').val();
				var $style = $('#preferenceForm').find('#stylesDropdown').val();
				var $abv = $('#preferenceForm').find('#abvRange').val();
				var $country_name = $('#preferenceForm').find('#countryDropdown option:selected').text();//need to get string, int value is meaningless

				var $data = {
					category: $cat_id,
					style: $style,
					abv: $abv,
					country: $country_name,
					action: 'insertNewPreference'
				};
				$.ajax({
					  type: "POST",
					  url: '../model/DB.class.php',
					  data: $data
				}).done(function(msg) {
		              console.log(msg);
					  if(msg){
							alert("success: you submitted preferences successfully");
							var $data2 = {
								category: $cat_id,
								style: $style,
								abv: $abv,
								country: $country_name,
								action: 'getPreferredBeer'
							};
							$.ajax({
								  type: "POST",
								  url: '../model/DB.class.php',
									data: $data2
							}).done(function(msg) {
								//console.log(msg);
								alert(msg);
								msg = JSON.parse(msg);
								$("#preferredBeers").html(msg.reduce((prev,curr)=>{
									return `${prev}<p> ${curr.id} ${curr.name}</p>`
								},"")
							  );
							});

					  	// window.location.href = 'views/inbox.php';
					  }
					  else{
					  	alert("Something broke");
					  }
				});
	    	});

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
