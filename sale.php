<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->

<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Starter</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <!-- <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css"> -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
    integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" type="text/css" href="dist/css/coffee.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Waiting Number</h4>
        </div>
        <div class="modal-body">
          
       <?php        
		    include('dbconnect.php');        
			$sql = "SELECT waiting_num, isbusy FROM waiting_number";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
          if($row['isbusy'] == 1){
            echo '<label id ="lblWait" class="lbl" style="margin: 2px 2px; width:80px; height:80px; background:#222D32; text-align: center; padding-top:34px;"><font color="#FFFFFF">'.$row["waiting_num"].'</font></label>';
          }else{
            echo '<label id ="lblWait" class="lbl" style="margin: 2px 2px; width:80px; height:80px; background:#3C8DBC; text-align: center; padding-top:34px;"><font color="#FFFFFF">'.$row["waiting_num"].'</font></label>';
          }
				} 
            } else {
                echo "0 results";
            }
		?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

  <!-- Google Font -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="myVar.js"></script>

	<script>
		$(document).ready(function(){
			
      var servics = "<?php include('URL.php');  echo $sevices ?>";
      $(".lbl").click(function(){

        const mVar = new myVar("");

        var wait = $(this).text();
        var uid = mVar.getId();
        var sid = '1';
        var long= mVar.getsLong();
        var lat = mVar.getsLat();
        var isc = '1';
        var isp = '0';
          if($("#inputReceived").val() >= $("#inputTotal").val()){
            paid = '1';
          }
        var isy = '0';
        var isv = '1';
        var isd = '0';
        var tok= 'none';
        var rid= mVar.getsRecordID();
        var tot=$("#inputTotal").val();

        //insert data to record-Order
        $.ajax({
                    url: "setOrder.php",
                    type:"post",
                    data:{RID: rid.trim(),
                          UID: uid.trim(),
                          SID: sid.trim(),
                          LOG: long.trim(),
                          LAT: lat.trim(),
                          TOT: tot.trim(),
                          ISC: isc.trim(),
                          ISP: isp.trim(),
                          ISY: isy.trim(),
                          ISV: isv.trim(),
                          ISD: isd.trim(),
                          TOK: tok.trim(),
                          WAIT: wait.trim()
                    },
                    dataType: "json",
                    success: function(result){
                      alert("Insert Success");
                    }
                });
                     //update waiting number
                     if(isp == 0){
                        $.ajax({
                            url: "upDatewaitingNB.php",
                            type:"post",
                            data:{
                              WNB: wait.trim(),
                            },
                            dataType: "json",
                            success: function(result){
                              alert("Update Success");
                            }
                        });
                        $('#myModal').modal('hide');
						            $("#tblOrder").empty();
                     }
                     
var oTable = document.getElementById('tblOrder');
//gets rows of table
var rowLength = oTable.rows.length;
//loops through rows    
for (i = 0; i < rowLength; i++){
   //gets cells of current row
   var product = oTable.rows[i+1].cells[1].innerHTML;
   var siz = oTable.rows[i+1].cells[2].innerHTML;
   switch(size){
     case "S":
     size='1';
     break;
     case "M":
     size='2';
     break;
     case "L":
     size='3';
     break;
   }
   var price = oTable.rows[i+1].cells[3].innerHTML;
   var qty = oTable.rows[i+1].cells[4].innerHTML;
   var des = oTable.rows[i+1].cells[5].innerHTML;

  //  $.ajax({
  //                   url: "setOrderDetail.php",
  //                   type:"post",
  //                   data:{RID: rid.trim(),
  //                         PID: uid.trim(),
  //                         PRI: sid.trim(),
  //                         QTY: qty.trim(),
  //                         AMN: amn.trim(),
  //                         DIS: dis.trim(),
  //                         SIZ: siz.trim(),
  //                         DES: des.trim(),
  //                         ISD: isd.trim()
  //                   },
  //                   dataType: "json",
  //                   success: function(result){
  //                     alert("Insert Success");
  //                   }
  //               });
  
                }
            });

			$("button").click(function(){
				var name = $(this).text();
				if(name=="CANCEL"){
					
				}else if(name=="PAYMENT"){
					var rows = document.getElementById("tblOrder").getElementsByTagName("tbody").length;
					if(rows > 0){
						$('#myModal').modal();
					}else{
            alert("Table no Data");
          }
          
          $.getJSON(servics+'getRecordmaxID.php',function(data){
			      $.each(data.product,function(){
              const mVar = new myVar();
            
              if(this["record_id"] == null){
                mVar.setsRecordID('1');
             }else{
               var rid= parseInt(this["record_id"]);

              mVar.setsRecordID(""+(Number(rid) + 1));
             }
              //mVar.setsRecordID();
            });
          });
				}else if(name=="Search"){	
					 var textboxvalue = $('input[name=q]').val();
					 $("#product_card").empty();
					$.getJSON(servics+'getdatasearch.php?NAME='+textboxvalue+'',function(data){
						$.each(data.product,function(){
							//alert( this["product_name"]);
							$("#product_card").append($('<div class="card" style="float:left; margin-left:10px; margin-top:10px; border-radius: 5px; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2)">'
								+'<center>'
								+'<div class="img-container">'
									+'	<img id="imgProduct" class="card-img-top" style="height:120px; width:130px;border-radius: 5px 5px 0 0;" src="http://localhost:8181/POS-master/Product_PIC/'+this["product_name"]+'.jpg" >'
									+'</div>'
									+'<div class="card-body" style="width:100px; height=80px;">'
										+'<h6 id="hName" class="cardTitle" style="font-weight: bold" >'+this["product_name"]+'</h6>'
									+'</div>'
								+'</center>'
							+'</div>').attr({id:'asd'}));
							
						});
					});
				}else if(name=="ADD"){
					var tvQty = $("#qty").val();
          var des = $("#desc").val();
					var select = $("#selectSize").val();
					if(tvQty == "" || tvQty == 0 || des =="" || select == ""){
					alert("Please fill all info !!!");
					}else {
						$("#tblOrder").append("<tbody><tr><th scope=row>1</th><td>"+$("#lblName").text()+"</td><td>"+$("#selectSize option:selected").val()+"</td><td>"+$("#pri").text()+"</td><td>"+$("#qty").val()+"</td><td>"+$("#desc").val()+"</td><td>Hello</td></tr></tbody>");
						document.getElementById("myForm").style.display = "none";
            $("#pri").html('');
            $("#qty").val('');
            $("#desc").val('');
					  $("#selectSize").val('');
					}
          var rows = document.getElementById("tblOrder").getElementsByTagName("tbody").length;
          var oTable = document.getElementById('tblOrder');
          var total=0;
          for(var i=0;i<=rows;i++){
            var pr = oTable.rows[i+1].cells[3].innerHTML.trim();
            var qty = oTable.rows[i+1].cells[4].innerHTML.trim()
            var amount = Number(pr) * Number(qty);
            total = Number(total) + Number(amount);
            $("#inputTotal").val(""+ total);
          }
				}else if(name=="BACK"){
					document.getElementById("myForm").style.display = "none";
				}else if(name=="Close"){

				}else{
					/*$.post("getProduct.php",{
						PRO:name
					},function(data,status){
					$("#proDiv").html(data);
					});*/
					$("#product_card").empty();
					$.getJSON(servics+'getProduct.php?CATE='+name+'',function(data){
						$.each(data.product,function(){
							//alert( this["product_name"]);
							
							$("#product_card").append($('<div class="card" style="float:left; margin-left:10px; margin-top:10px; border-radius: 5px; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2)">'
								+'<center>'
								+'<div class="img-container">'
									+'	<img id="imgProduct" class="card-img-top" style="height:120px; width:130px;border-radius: 5px 5px 0 0;" src="http://localhost:8181/POS-master/Product_PIC/'+this["product_name"]+'.jpg" >'
									+'</div>'
									+'<div class="card-body" style="width:100px; height=80px;">'
										+'<h6 id="hName" class="cardTitle" style="font-weight: bold" >'+this["product_name"]+'</h6>'
									+'</div>'
								+'</center>'
							+'</div>').attr({id:'asd'}));
							
						});
					});
				}
			});
			$('#product_card').on("click",".card",function(){
				var name = $(this).text();
				
				document.getElementById("lblName").innerHTML = name;
				document.getElementById("myForm").style.display = "block";
				
			});
			$('#selectSize').on('change',function(event){
                event.preventDefault();
                var name =$("#lblName").text();
                var size =$("#selectSize").val();
				if(size == ''){
					$('#pri').text('0.00');	
				}
                $.ajax({
                    url: "getProductPrice.php",
                    type:"post",
                    data:{PRO: name.trim(), SIZE: size.trim()},
                    dataType: "json",
                    success: function(result){
                      $('#pri').text(result.toFixed(2));
                    }
                });
            });
            //display form login
			$( ".login" ).load("loginForm.php");
    });

  $(document).keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
      var total = $('#inputTotal').val();
      var recieve = $('#inputReceived').val();
      var change = recieve - total;
      $("#inputChange").val(""+ change + " " + "$");
    }
});
	</script>
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->

<body class="hold-transition skin-blue sidebar-mini">
<!-- display form login -->
	<div style="height:100%;width:100%" class="login" ></div>
	<div style="display:none" id="main" class="wrapper">
    <!-- Main Header -->
    <header class="main-header">
      <!-- Logo -->
      <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin</b>LTE</span>
      </a>

      <!-- Header Navbar -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->
            <li class="dropdown messages-menu">
              <!-- Menu toggle button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-envelope-o"></i>
                <span class="label label-success">4</span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">You have 4 messages</li>
                <li>
                  <!-- inner menu: contains the messages -->
                  <ul class="menu">
                    <li>
                      <!-- start message -->
                      <a href="#">
                        <div class="pull-left">
                          <!-- User Image -->
                          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                        </div>
                        <!-- Message title and timestamp -->
                        <h4>
                          Support Team
                          <small><i class="fa fa-clock-o"></i> 5 mins</small>
                        </h4>
                        <!-- The message -->
                        <p>Why not buy a new awesome theme?</p>
                      </a>
                    </li>
                    <!-- end message -->
                  </ul>
                  <!-- /.menu -->
                </li>
                <li class="footer"><a href="#">See All Messages</a></li>
              </ul>
            </li>
            <!-- /.messages-menu -->

            <!-- Notifications Menu -->
            <li class="dropdown notifications-menu">
              <!-- Menu toggle button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-bell-o"></i>
                <span class="label label-warning">5</span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">You have 10 notifications</li>
                <li>
                  <!-- Inner Menu: contains the notifications -->
                  <ul class="menu">
                    <li>
                      <!-- start notification -->
                      <a href="#">
                        <i class="fa fa-users text-aqua"></i> 5 new members joined today
                      </a>
                    </li>
                    <!-- end notification -->
                  </ul>
                </li>
                <li class="footer"><a href="#">View all</a></li>
              </ul>
            </li>
            <!-- Tasks Menu -->
            <li class="dropdown tasks-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-flag-o"></i>
                <span class="label label-danger">9</span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">You have 9 tasks</li>
                <li>
                  <!-- Inner menu: contains the tasks -->
                  <ul class="menu">
                    <li>
                      <!-- Task item -->
                      <a href="#">
                        <!-- Task title and progress text -->
                        <h3>
                          Design some buttons
                          <small class="pull-right">20%</small>
                        </h3>
                        <!-- The progress bar -->
                        <div class="progress xs">
                          <!-- Change the css width attribute to simulate progress -->
                          <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                            <span class="sr-only">20% Complete</span>
                          </div>
                        </div>
                      </a>
                    </li>
                    <!-- end task item -->
                  </ul>
                </li>
                <li class="footer">
                  <a href="#">View all tasks</a>
                </li>
              </ul>
            </li>
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs">Alexander Pierce</span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                  <p>
                    Alexander Pierce - Web Developer
                    <small>Member since Nov. 2012</small>
                  </p>
                </li>
                <!-- Menu Body -->
                <li class="user-body">
                  <div class="row">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </div>
                  <!-- /.row -->
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="#" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
            <li>
              <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
            </li>
          </ul>
        </div>
      </nav>
    </header>
	  
 
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>Alexander Pierce</p>
            <!-- Status -->
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>

        <!-- search form (Optional) -->
        
        <!-- /.search form -->


        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">HEADER</li>
          <!-- Optionally, you can add icons to the links -->
          <li class="active"><a href="#"><i class="fas fa-cart-arrow-down"></i> <span>POS</span></a></li>
          <li><a href="#"><i class="far fa-list-alt"></i> <span>List Detail</span></a></li>
          <li class="treeview">
            <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="#">Link in level 2</a></li>
              <li><a href="#">Link in level 2</a></li>
            </ul>
          </li>
        </ul>
        <!-- /.sidebar-menu -->
      </section>
      <!-- /.sidebar -->
    </aside>
	
	



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <?php        
		include('dbconnect.php');        
        $sql = "SELECT category FROM category";
        $result = $conn->query($sql);
        ?>
      <section class="content-header">
      <div class="container-fluid col-md-12">
          <div>
            <h2 style="text-align: center">POINT OF SALE</h2>
          </div>
          </div>

            <div class="btn">
            <?php
               if ($result->num_rows > 0) {
                // output data of each row
             while($row = $result->fetch_assoc()) {
              echo '<button type="button" class="btn btn-secondary" style="margin: 2px 2px;">'.$row["category"].'</button>';
               } 
            } else {
                echo "0 results";
              }
            ?>

            </div>
      </section>
      <!-- Main content -->
      <section class="content container-fluid">

        <!--------------------------
        | Your Page Content Here |
        -------------------------->
        <!-- Modal -->
        <div class="input-group col-md-6">
            <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat">Search</button>
            </span>
        </div>

        <?php
       

      ?>
      
      <div id="proDiv" class="container-fluid col-md-6" style="overflow-y: auto; height:450px; margin-top:5px;">
		<div class="form-popup" id="myForm">
			<form action="/action_page.php" class="form-container">
				<h1 id = "lblName"></h1>
				<select id = "selectSize" class="size">
					<option value="">Size</option>
					<option value="S">Small</option>
					<option value="M">Meduim</option>
					<option value="L">Large</option>
				</select>
				<h4  style=" margin-left:5px;float:left">Price:</h4>
				<h4 text="1.5" style="margin-left:10px;float:left" id = "pri"></h4>
				<h4 > $</h4>
				<input type="text" onkeypress="return isNumber(event)" placeholder="Quantity" id="qty">
				<input type="text" placeholder="Description" id="desc">
				<br></br>
				<button type="button" class="btn">ADD</button>
				<button type="button" class="btn cancel">BACK</button>
			</form>
		</div>
		<div id="product_card">
		
		</div>
      </div>
<div class="container-fluid col-md-6" style="overflow-y: scroll;height:260px;">
    <div class="box box-primary">
        <form>
        <table id = "tblOrder" class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Product</th>
	    <th scope="col">Size</th>
      <th scope="col">Price</th>
      <th scope="col">Quantity</th>
      <th scope="col">Description</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
 
</table>
          </form>
    </div>
</div>
<div class="container-fluid col-md-6" style="margin-top: 3px;">
    <div class="box box-primary">
    <form>
          <div class="form-group row">
            <label for="inputTotal" class="col-sm-6 col-form-label">Subtotal</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="inputTotal" placeholder="0"  disabled="disabled">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputReceived" class="col-sm-6 col-form-label">Received</label>
            <div class="col-sm-6">
              <input type="text" onkeypress="return isDecimal(event,this)" class="form-control" id="inputReceived" placeholder="0">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputChange" class="col-sm-6 col-form-label">Change</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="inputChange" placeholder="0" disabled="disabled">
            </div>
          </div>
        </form>
            <button id="can" type="submit" class="btn col-sm-6">CANCEL</button>
            <button type="button" class="btn btn-primary col-sm-6" id="payment">PAYMENT</button>
    </div>
</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <!-- <footer class="main-footer">
    
    <div class="pull-right hidden-xs">
      Anything you want
    </div>
   
    <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
  </footer> -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="pull-right-container">
                  <span class="label label-danger pull-right">70%</span>
                </span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED JS SCRIPTS -->

  <!-- jQuery 3 -->
  <script src="dist/js/evnt.js"></script>
  <script src="Numberic.js"></script>
  <script src="bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>

  <!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>

</html>