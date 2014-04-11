var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }

xmlhttp.open("POST","demo_post2.asp",true);
xmlhttp.setRequestHeader("Content-type","./php/test-analyze.php");
xmlhttp.send("//Variables being passed to server go here.
");
