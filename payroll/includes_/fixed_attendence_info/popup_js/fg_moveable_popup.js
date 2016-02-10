var _FG_tracker=null;
var xmlHttp;
var xmlHttp1;
function fg_popup_form(formdiv_id,container_id,bg_div_id,str,dateI,section_id)
{
	/*ajax get value*/
	xmlHttp1=GetXmlHttpObject()
		if (xmlHttp1==null)
			{
			alert ("Browser does not support HTTP Request")
			return
			}
		var url="includes/fixed_attendence_info/set_leave.php"
		url=url+"?ids="+str+"&dateI="+dateI+"&section_id="+section_id;
		//alert(url);
		url=url+"&sid="+Math.random();
		xmlHttp1.onreadystatechange=function()
		{
			
				if (xmlHttp1.readyState==4 || xmlHttp1.readyState=="complete")
				{ 
					document.getElementById("fg_formContainer").innerHTML=xmlHttp1.responseText;
					/*var options = {
					script:"./AutoComplete/get_initemtype.php?json=true&",
					varname:"itemType",
					json:true,
					shownoresults:false,
					callback: function (obj) 
						{
						//alert('ff');
						document.getElementById('itypeidpop').value = obj.id;
						}
					};
					var as_json = new bsn.AutoSuggest('it_item_type_namepop', options);*/
				} 
			}
		xmlHttp1.open("POST",url,true)
		xmlHttp1.send(null)
	
	/*end*/
    var bgdiv = document.getElementById(bg_div_id);
    bgdiv.style.display="block";

    var formdiv = document.getElementById(formdiv_id);
    formdiv.style.display="block";

    var pt = window.center({width:390,height:480});

    formdiv.style.top = pt.y + "px";
    formdiv.style.left = pt.x + "px";

    formdiv.handlerobj = new FG_MoveablePopup(formdiv);
    
    var containerdiv = document.getElementById(container_id);
    if(containerdiv && containerdiv.SavedInnerHTML)
    {
        containerdiv.innerHTML = containerdiv.SavedInnerHTML;
    }

}

function fg_hideform(formdiv_id,bg_div_id)
{
    var formdiv = document.getElementById(formdiv_id);
    formdiv.style.display="none";

    var bgdiv = document.getElementById(bg_div_id);
    bgdiv.style.display="none";
}


function FG_MoveablePopup(div_obj)
{
    var _div_obj = div_obj;
    //div_obj.handlerobj = this;

    var downposX = 0;
    var downposY = 0;
    var dragging = false;

    this.isIE    = false;
    this.isNS    = false;


    this.Init = function()
    {
        if (navigator.userAgent.indexOf("MSIE") >= 0 ||
            navigator.userAgent.indexOf("Opera") >= 0) 
        {
            this.isIE = true;
        }
        else
        {
            this.isNS = true;
        }
    }


    _div_obj.onmousedown = function(event)
    {
        var x=0;
        var y=0;

        _this = this.handlerobj;

        if (_this.isIE) 
        {
            x = window.event.clientX + 
                document.documentElement.scrollLeft + 
                document.body.scrollLeft;

            y = window.event.clientY + 
                document.documentElement.scrollTop + 
                document.body.scrollTop;
        }
        else
        {
            x = event.clientX + window.scrollX;
            y = event.clientY + window.scrollY;
        }

        var top = parseInt(this.style.top,  10);
        
        var client_y = y - top;
        if(!(client_y>0  && client_y<30))
        {
         return;
        }
        
        _this.cursorStartX = x;
        _this.cursorStartY = y;
        _this.divStartX   = parseInt(this.style.left, 10);
        _this.divStartY   = top;

        if (this.handlerobj.isIE) 
        {
            document.attachEvent("onmousemove", _this.onmousemove);
            document.attachEvent("onmouseup",   _this.onmouseup);
            window.event.cancelBubble = true;
            window.event.returnValue = false;
        }
        else
        {
            document.addEventListener("mousemove", _this.onmousemove,   true);
            document.addEventListener("mouseup",   _this.onmouseup, true);
            event.preventDefault();
        }

        _FG_tracker = _this;
        _this._div_obj = this;

    }

    this.onmousemove = function(event)
    {
        _this = _FG_tracker;

        var x = 0;
        var y = 0;


        if (_this.isIE) 
        {
            x = window.event.clientX + document.documentElement.scrollLeft
              + document.body.scrollLeft;
            y = window.event.clientY + document.documentElement.scrollTop
              + document.body.scrollTop;
        }
        else
        {
            x = event.clientX + window.scrollX;
            y = event.clientY + window.scrollY;
        }

        _this._div_obj.style.left = (_this.divStartX + x - _this.cursorStartX) + "px";
        _this._div_obj.style.top  = (_this.divStartY   + y - _this.cursorStartY) + "px";

        if (_this.isIE) 
        {
            window.event.cancelBubble = true;
            window.event.returnValue = false;
        }
        else
        {
            event.preventDefault();
        }
    }

    this.onmouseup = function()
    {
         _this = _FG_tracker;
        if (_this.isIE) 
        {
            document.detachEvent("onmousemove", _this.onmousemove);
            document.detachEvent("onmouseup",   _this.onmouseup);
        }
        else
        {
            document.removeEventListener("mousemove", _this.onmousemove,   true);
            document.removeEventListener("mouseup",   _this.onmouseup, true);
        }
        _FG_tracker = null;
        
    }

   this.Init();
}
// code from: http://www.geekdaily.net/2007/07/04/javascript-cross-browser-window-size-and-centering/
window.size = function()
{
   var w = 0;
   var h = 0;

   //IE
   if(!window.innerWidth)
   {
      //strict mode
      if(!(document.documentElement.clientWidth == 0))
      {
         w = document.documentElement.clientWidth;
         h = document.documentElement.clientHeight;
      }
      //quirks mode
      else
      {
         w = document.body.clientWidth;
         h = document.body.clientHeight;
      }
   }
   //w3c
   else
   {
      w = window.innerWidth;
      h = window.innerHeight;
   }
   return {width:w,height:h};
}

window.center = function()
{
   var hWnd = (arguments[0] != null) ? arguments[0] : {width:0,height:0};

   var _x = 0;
   var _y = 0;
   var offsetX = 0;
   var offsetY = 0;

   //IE
   if(!window.pageYOffset)
   {
      //strict mode
      if(!(document.documentElement.scrollTop == 0))
      {
         offsetY = document.documentElement.scrollTop;
         offsetX = document.documentElement.scrollLeft;
      }
      //quirks mode
      else
      {
         offsetY = document.body.scrollTop;
         offsetX = document.body.scrollLeft;
      }
   }
   //w3c
   else
   {
      offsetX = window.pageXOffset;
      offsetY = window.pageYOffset;
   }

   _x = ((this.size().width-hWnd.width)/2)+offsetX;
   _y = ((this.size().height-hWnd.height)/2)+offsetY;

   return{x:_x,y:_y};
}
function GetXmlHttpObject()
{
	var xmlHttp=null;
	try
	{
		// Firefox, Opera 8.0+, Safari
		xmlHttp=new XMLHttpRequest();
	}
	catch (e)
	{
	//Internet Explorer
	try
	{
		xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
	}
	catch (e)
	{
		xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	}
	return xmlHttp;
}
function set_leave()
{
	var leave1=document.getElementById("leave1").value;
	var leave2=document.getElementById("leave2").value;
	var leave3=document.getElementById("leave3").value;
	if(leave1=='')
		leave1	=0;
	if(leave2=='')
		leave2	=0;
	if(leave3=='')
		leave3	=0;
	
	var total_leave =parseFloat(leave1)+parseFloat(leave2)+parseFloat(leave3);
	
	document.getElementById("leave1val").value=parseFloat(leave1);
	document.getElementById("leave2val").value=parseFloat(leave2);
	document.getElementById("leave3val").value=parseFloat(leave3);
	document.getElementById("leave").value=total_leave;
	
}

var pkey = 0;
function ret_valid_digit( evt , type , cnt) {
pkey = (evt.which) ? evt.which : event.keyCode;
if( pkey == 8 || pkey == 127 )
return true;
if( type == 'int' ) {
if( pkey >= 48 && pkey <= 57 )
return true;
}
else if( type == 'double' ) {
if( pkey >= 48 && pkey <= 57)
{
	return true;
	/*
	var myval	=val;
	//alert(hid);
	if(myval < hid)
		return true;
	else
		return false;*/
}

if( pkey == 46 && cnt == -1 )
return true;
}
return false;
}




function check_sick()
{
	var myval = parseInt($('#leave1').val());
	var hid = parseInt($('#leave1h').val());
	var h = /[0-9]/;
	if(myval=="") {
	//alert('Enter value');
	$('#leave1').focus();
	return false;
	}else if(myval> hid){
	//alert('value must <= 20');
	$('#leave1').focus();
	return false;
	}else{
	//alert('ok');
	}

}