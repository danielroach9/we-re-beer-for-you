$( document ).ready(function(){
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
