$( document ).ready(function(){

		$('tabs').tabs();
		
		// $("#filters").hide();
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
		/* $("#filterText").click(function () {
			var af = "Apply Filters";
			var rf = "Remove Filters";
			var text = $(this).text();
			if(text == af){
				$(this).text(rf);
				$("#filters").show();
			}
			else if(text == rf){
				$(this).text(af);
				$("#filters").hide();
			}
		}); */

		$("#signOut").click(function(){
			var $data = { action: 'performRegister'};

			$.ajax({
				  type: "POST",
				  url: '../model/DB.class.php',
				  data: $data
			}).done(function(msg) {
				window.location.href = "http://serenity.ist.rit.edu/~ajp8707/we-re-beer-for-you/index.php?signout=true";
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
				  	window.location.href = 'http://serenity.ist.rit.edu/~ajp8707/we-re-beer-for-you/index.php?register=true';
				  }else{
				  	alert("An error occured trying to register a new user.");
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
					action: 'getPreferredBeer'
				};
				console.log($data);
				$.ajax({
					  type: "POST",
					  url: '../model/DB.class.php',
					  data: $data
				}).done(function(data) {
		               //console.log(data);
				 	  if(data){
				 	  	var $beers = jQuery.parseJSON(data);
				 	  	console.log($beers);
					  		$.each($beers,function(key,value){
					  			$("#results").append("<p>"+key+" - "+value+"</p>");
					  		});
				// 			// alert("success: you submitted preferences successfully");
				// 			// var $data2 = {
				// 			// 	category: $cat_id,
				// 			// 	style: $style,
				// 			// 	abv: $abv,
				// 			// 	country: $country_name,
				// 			// 	action: 'getPreferredBeer'
				// 			// };
				// 			// $.ajax({
				// 			// 	  type: "POST",
				// 			// 	  url: '../model/DB.class.php',
				// 			// 		data: $data2
				// 			// }).done(function(msg) {
				// 			// 	//console.log(msg);
				// 			// 	alert(msg);
				// 			// 	msg = JSON.parse(msg);
				// 			// 	$("#preferredBeers").html(msg.reduce((prev,curr)=>{
				// 			// 		return `${prev}<p> ${curr.id} ${curr.name}</p>`
				// 			// 	},"")
				// 			//   );
				// 			// });
							

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

		$('#beerRatingForm').submit(function(e){
			e.preventDefault();
			var $beerID = $('#beerRatingForm').find('#beer').val();
			var $comment = $('#beerRatingForm').find('#comment').val();
			var $rating = $("input[name='star']:checked").val();
			//if(!($("input[name='star']:checked"])){alert("Please select a rating");}
			var $location = $('#beerRatingForm').find('#location').val();
			var $uuid = $('#beerRatingForm').find('#uuid').val();

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
				  if(data){
				  	window.location.href = "http://serenity.ist.rit.edu/~ajp8707/we-re-beer-for-you/views/beer-rating.php";
				  	alert("Review was submitted!");
				  }
				  else{
				  	alert("Something went wrong submitting review..");
				  }
			});
		});

		$('#searchLink').click(function(e){
			window.location.href = 'views/search.php';
		});

		
});


function showRegister(){
	$("#register").show();
	$('#register').addClass('animated flipInY');
	$("#login").hide();
  }

function showLogin(){
	$("#register").hide();
	$('#login').addClass('animated flipInY');
	$("#login").show();
}
