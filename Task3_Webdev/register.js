y = document.getElementsByClassName("error");
	inputs = document.getElementsByTagName("input");
	function checkCap(x,i)
	{
		
		if(x.value[0] != x.value[0].toUpperCase())
			y[i].innerHTML = "First letter should be capitalised";
		else
			y[i].innerHTML = "";
	}
	
	function username(x)
	{
		if (!x.value.match(/^[0-9a-zA-Z]+$/))
			y[2].innerHTML = "Requierd. Username must be a alphanumeric";
		else
			y[2].innerHTML = "";
	}
	
	function emailCheck(x)
	{
		var atpos = x.value.indexOf("@");
		var dotpos = x.value.lastIndexOf(".");
		if (atpos< 1 || dotpos<atpos+2 || dotpos+2>=x.length) 
			y[3].innerHTML = "Required. Email id not valid";
		else
			y[3].innerHTML = "";
    }
    
    function passlen(x)
    {
		len = x.value.length;
		if(len<6)
			y[6].innerHTML = "Password must be atleast 6 characters long";
		else
			y[6].innerHTML = "";
	}
	
	function recheck()
	{
		if(inputs[7].value != inputs[8].value)
			y[7].innerHTML = "Passwords do not match";
		else
			y[7].innerHTML = "";
	}	

	function ch()
	{
		x = document.getElementById("s");
		if(x.value == "")
			y[0].innerHTML = "Required";
		else
			y[0].innerHTML = "";
	}	

	function dat(x)
	{
		if(x.value == "")
			y[4].innerHTML = "Required";
	}
