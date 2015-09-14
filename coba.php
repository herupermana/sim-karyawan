<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.hurup {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 24px;
	font-weight: bold;
	color: #333333;
	text-decoration: none;
	background-color: #CCCCCC;
	margin: 5px;
	padding: 5px;
	border: 1px solid #333333;
	text-align: justify;
	display: block;
}
-->
</style>
</head>

<body>
<script language="JavaScript">

<!--
// please keep these lines on when you copy the source
// made by: Nicolas - http://www.javascript-page.com

var clockID = 0;

function UpdateClock() {
   if(clockID) {
      clearTimeout(clockID);
      clockID  = 0;
   }

   var tDate = new Date();

   document.theClock.theTime.value = "" 
                                   + tDate.getHours() + ":" 
                                   + tDate.getMinutes() + ":" 
                                   + tDate.getSeconds();
   
   clockID = setTimeout("UpdateClock()", 1000);
}
function StartClock() {
   clockID = setTimeout("UpdateClock()", 500);
}

function KillClock() {
   if(clockID) {
      clearTimeout(clockID);
      clockID  = 0;
   }
}

//-->

</script>
<body onload="StartClock()" onunload="KillClock()">
<center><form name="theClock">
<input type=text name="theTime" size=8 class="hurup">
</form></center>

</body>
</html>
