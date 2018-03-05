$( document ).ready(function(){
        $(".button-collapse").sideNav();
		$('.modal').modal();

		$("#loginForm").submit(function(e){
		e.preventDefault();
        var $userName = $('#loginForm').find('#first_name').val();
		var $password = $('#loginForm').find('#password').val();

		var $data = {
			user: $userName,
			pass: $password,
			action: 'performLogin'
		};

		$.ajax({
			  type: "POST",
			  url: 'DB.class.php',
			  data: $data
		}).done(function(msg) {
              console.log(msg);
			  if(msg == true){
			  	window.location.href = 'home.php';
			  }
			  else{
			  	alert("User/password incorrect!");
			  }
		});
    }) 
});

function showRegister(){
  $("#register").show();
  $("#login").hide();
}
