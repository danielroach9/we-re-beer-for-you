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
				var $uuid = 1;
				var $country_name = $('#preferenceForm').find('#countryDropdown option:selected').text();//need to get string, int value is meaningless

				var $data = {
					uuid: $uuid,
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
								uuid: $uuid,
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
			var $recipient = $('#send-to-input').val();
			var $content = $('#message-area').val();

			console.log($subject);
			console.log($recipient);
			console.log($content);

			var $data = {
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
					alert("Message was successfully sent.");
				}else{
					console.log(data);
					alert("An error occurred while trying to send the message. | "+data);
				}
			})
		});

		$('#beerRatingForm').submit(function(){
			var $beerID = $('#beerRatingForm').find('#beerID').val();
			var $comment = $('#beerRatingForm').find('#comment').val();
			var $rating = $("input[name='star']:checked").val();
			//if(!($("input[name='star']:checked"])){alert("Please select a rating");}
			var $location = $('#beerRatingForm').find('#location').val();
			var $uuid = 1; //HARDCODED
			
			var $data = {
					beerID: $beerID,
					comment: $comment,
					rating: $rating,
					location: $location,
					uuid: $uuid,
					action: 'insertNewRating'
			};

			$.ajax({
				  type: "POST",
				  url: '../model/DB.class.php',
				  data: $data
			}).done(function(data) {
	              		  console.log(data);
				  if(data){
				  	alert("Review was submitted!");
				  }
				  else{
				  	alert("Something went wrong submitting review..");
				  }
			});
		});
});

function showRegister(){
  $("#register").show();
  $('#register').addClass('animated flipInY');
  $("#login").hide();
}
