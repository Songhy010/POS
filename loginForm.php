<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->

<html>
<style>
@import url(https://fonts.googleapis.com/css?family=Roboto:300);
.login-page {
  width: 360px;
  padding: 8% 0 0;
  margin: auto;
}
.form {
  position: relative;
  z-index: 1;
  background: #FFFFFF;
  max-width: 360px;
  margin: 0 auto 100px;
  padding: 45px;
  text-align: center;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}
.form input {
  font-family: "Roboto", sans-serif;
  outline: 0;
  background: #f2f2f2;
  width: 100%;
  border: 0;
  margin: 0 0 15px;
  padding: 15px;
  box-sizing: border-box;
  font-size: 14px;
}
.form button {
  font-family: "Roboto", sans-serif;
  text-transform: uppercase;
  outline: 0;
  background: #4CAF50;
  width: 100%;
  border: 0;
  padding: 15px;
  color: #FFFFFF;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
}
.form button:hover,.form button:active,.form button:focus {
  background: #43A047;
}
.form .message {
  margin: 15px 0 0;
  color: #b3b3b3;
  font-size: 12px;
}
.form .message a {
  color: #4CAF50;
  text-decoration: none;
}
.form .register-form {
  display: none;
}
.container {
  position: relative;
  z-index: 1;
  max-width: 300px;
  margin: 0 auto;
}
.container:before, .container:after {
  content: "";
  display: block;
  clear: both;
}
.container .info {
  margin: 50px auto;
  text-align: center;
}
.container .info h1 {
  margin: 0 0 15px;
  padding: 0;
  font-size: 36px;
  font-weight: 300;
  color: #1a1a1a;
}
.container .info span {
  color: #4d4d4d;
  font-size: 12px;
}
.container .info span a {
  color: #000000;
  text-decoration: none;
}
.container .info span .fa {
  color: #EF3B3A;
}
body {
  background: #76b852; /* fallback for old browsers */
  background: -webkit-linear-gradient(right, #76b852, #8DC26F);
  background: -moz-linear-gradient(right, #76b852, #8DC26F);
  background: -o-linear-gradient(right, #76b852, #8DC26F);
  background: linear-gradient(to left, #76b852, #8DC26F);
  font-family: "Roboto", sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;      
}
</style>
  <script src="myVar.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	var servics = "<?php include('URL.php');  echo $sevices ?>";
	var userName = "";
	$( "#tvUser" ).keyup(function(event) {
		var User = $("#tvUser").val();
		var Pass = $("#tvPass").val();
		$.getJSON(servics+'getUser.php',function(data){
			$.each(data.product,function(){
				if(this["user_password"].trim()==Pass.trim() && this["user_name"].trim()==User.trim()){
					userName = "true";
				}
				else{
					userName = "false";
				}
			});
		});
	});
	$( "#tvPass" ).keyup(function() {
		var User = $("#tvUser").val();
		var Pass = $("#tvPass").val();
		$.getJSON(servics+'getUser.php',function(data){
			$.each(data.product,function(){
				if(this["user_password"].trim()==Pass.trim() && this["user_name"].trim()==User.trim()){
					userName = "true";
				}
				else{
					userName = "false";
				}
			});
		});
	});
	
	$("#btnLog").mousedown(function(){
		var User = $("#tvUser").val();
		var Pass = $("#tvPass").val();
		$.getJSON(servics+'getUser.php',function(data){
			$.each(data.product,function(){
				if(this["user_password"].trim()==Pass.trim() && this["user_name"].trim()==User.trim()){
					userName = "true";
				}
			});
		});
	});
	$('#btnLog').click(function(){
    var User = $("#tvUser").val();
		var Pass = $("#tvPass").val();
		if(userName=="true"){

      $.getJSON(servics+'getUserID.php?USER='+User+'&PASS='+Pass+'',function(data){
			$.each(data.product,function(){
        const mVar = new myVar();
        mVar.setId(this["user_id"]);
        //alert(this["user_id"]);
				// if(this["user_password"].trim()==Pass.trim() && this["user_name"].trim()==User.trim()){
				// 	userName = "true";
				// }
				// else{
				// 	userName = "false";
				// }
      });
    });
    $.getJSON(servics+'getStore.php?SID=1',function(data){
			$.each(data.product,function(){

        const mVar = new myVar();
        mVar.setsName(this["store_name"]);
        mVar.setsLong(this["store_long"]);
        mVar.setsLat(this["store_lat"]);
        mVar.setsPhone(this["store_phone"]);
        mVar.setsClose(this["store_close"]);
        mVar.setsDis(this["store_discount"]);
        mVar.setsState(this["store_status"]);
			});
    });
			$(".login").remove(); 
			document.getElementById("main").style.display = "block";
		}else{
			alert("!!Incorrect User Name or Password!!");
		}	
	});
});

</script>

<head>
</head>
<body>
<div id = "FRM" class="login-page">
  <div class="form">
    <form class="login-form">
      <input id="tvUser" type="text" placeholder="username"/>
      <input id="tvPass" type="password" placeholder="password"/>
      <button id="btnLog">login</button>
    </form>
  </div>
</div>
</body>
</html>
