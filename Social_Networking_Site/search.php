<html>
<head>
<title>Search Users</title>
<style>
input[type="button"]{
      margin: 0;
      width: 15%;
      padding: 7px 10px;
      border: 1px solid #CCCCCC;
      border-top: none;
      cursor: pointer;
    }
input[type="button"]{
        background: #f2f2f2;
    }
input[type="submit"]{     
	width: 10%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer; }
input[type="submit"]:hover {
    background-color: #45a049;
}

input[type=text], select {
    width: 15%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

</style>
<script>
	
function search_ajax(str){
	if(str == ''){
		document.getElementById('suggestions').innerHTML="";
		document.getElementById('suggestions').style.border="0px";
		return;
	}
	else{
		var req = new XMLHttpRequest(); 
		req.onreadystatechange = function() { 
			if(req.readyState == 4 && req.status == 200){ 
				document.getElementById('suggestions').innerHTML = req.responseText;
				}
			}
		req.open('GET', 'live_search.php?search='+str, true); 
		req.send();
	}
	
} 

function moveValue(str){
	document.getElementById("nearsearch").elements[0].value=str;
	return;
}

</script>
</head>

<body>

<form id ="nearsearch" action="profile.php" method="post">
<input type="text" name="search" placeholder="Search" onkeyup="search_ajax(this.value)" onkeydown="search_ajax(this.value)"/>
<input type="submit" value="submit"/>
<div id="suggestions"></div>
</form>
<br>

</body>

</html>
