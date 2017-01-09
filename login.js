
			
/*=============================== Sign in ===========================*/
			$(document).ready(function() {
				$("#login_form").submit(function() {
			
				var UN = $("#LoginUname").val();
				var PW = $("#LoginPsw").val();
				

				if (UN == "") {
					$("#signin_status").html('<div class="alert alert-danger"><i class="fa fa-times-circle-o"></i>Please enter username to proceed.</div>');
					$("#LoginUname").focus();
					setTimeout('$("#signin_status").html("")', 8000);
				} else if (PW == "") {
					$("#signin_status").html('<div class="alert alert-danger"><i class="fa fa-times-circle-o"></i>Please enter password to proceed.</div>');
					$("#LoginPsw").focus();
					setTimeout('$("#signin_status").html("")', 8000);
				
				} else {
					var SignindataString = 'Uname=' + UN + '&PassW=' + PW +'&Signbtn=signin';
					$.ajax({
						type : "POST",
						url : "cart/signin.php",
						data : SignindataString,
						cache : false,
						beforeSend : function() {
							$("#signin_status").html('<br clear="all"><div><font style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:black;">Please wait</font> <img src="pics/loadings.gif" alt="Loading...." align="absmiddle" title="Loading...."/></div><br clear="all">');
						},
						success : function(response) {
							
							if(response=='SP'){
								$("#signin_status").hide().fadeIn('slow').html('<div class="alert alert-info"><i class="fa fa-times-circle-o"></i>Your account has been suspended.Please contact admin.</div>');
								$("#LoginUname").val('');
								$("#LoginPsw").val('');
								$("#LoginUname").focus();
								setTimeout('$("#signin_status").html("")', 12000);
							}else{
								
								if (response == 'Pass') {
								
								document.location = 'homex.php';
								//$("#LoginUname").val('');
								} else {
								$("#signin_status").hide().fadeIn('slow').html('<div class="alert alert-danger"><i class="fa fa-times-circle-o"></i>Please enter your correct username or password</div>');
								
								$("#LoginUname").val('');
								$("#LoginPsw").val('');
								$("#LoginUname").focus();
								setTimeout('$("#signin_status").html("")', 5000);
								}
							}
							
						}
					});
				}
				return false;
				});
			});
/*===============================/Sign in ===========================*/

/*===============================Add to Cart Map===========================*/

			function AddtoCartMAPCSV(){
			var xmlhttp;
			if (window.XMLHttpRequest)
			  {// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp=new XMLHttpRequest();
			  }
			else
			  {// code for IE6, IE5
			  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			xmlhttp.onreadystatechange=function()
			  {
			  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			    {
			    document.getElementById("mapout").innerHTML=xmlhttp.responseText;
			    }
			  }
			
			var MAPBTN=document.getElementById('mapdata');
			
			queryString_1 = "?Btnmap="+MAPBTN;
			
			
			xmlhttp.open("GET","sesschk.php" + queryString_1,true);
			xmlhttp.send();
			}			
/*===============================/Add to Cart Map===========================*/
			
/*===============================Add to Cart Time===========================*/

			function AddtoCartTIMECSV(){
			var httpTime;
			if (window.XMLHttpRequest)
			  {// code for IE7+, Firefox, Chrome, Opera, Safari
				httpTime=new XMLHttpRequest();
			  }
			else
			  {// code for IE6, IE5
				httpTime=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			httpTime.onreadystatechange=function()
			  {
			  if (httpTime.readyState==4 && httpTime.status==200)
			    {
			    document.getElementById("timeout").innerHTML=httpTime.responseText;
			    }
			  }
			
			var TIMEBTN=document.getElementById('timeseries');
			
			queryString_2 = "?Btntime="+TIMEBTN;
				
			httpTime.open("GET","sesschk.php" + queryString_2,true);
			httpTime.send();
			}			
/*===============================/Add to Cart Time===========================*/
			
/*===============================Load data visible ===========================*/			
			function loadDataAvailable()
			{
			var AjaxHttp;
			if (window.XMLHttpRequest)
			  {// code for IE7+, Firefox, Chrome, Opera, Safari
				AjaxHttp=new XMLHttpRequest();
			  }
			else
			  {// code for IE6, IE5
				AjaxHttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			AjaxHttp.onreadystatechange=function()
			  {
			  if (AjaxHttp.readyState==4 && AjaxHttp.status==200)
			    {
			    document.getElementById("view_data_avail").innerHTML=AjaxHttp.responseText;
			    }
			  }
			AjaxHttp.open("GET","dataavailable.php",true);
			AjaxHttp.send();
			}	
			
/*===============================/Load data visible ===========================*/
