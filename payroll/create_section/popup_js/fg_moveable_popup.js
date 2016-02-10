var _FG_tracker=null;
var xmlHttp;
var xmlHttp1;
function fg_popup_form(formdiv_id,container_id,bg_div_id,str,URLS)
{
	/*ajax get value*/
	xmlHttp1=GetXmlHttpObject()
		if (xmlHttp1==null)
			{
			alert ("Browser does not support HTTP Request")
			return
			}
		var url= URLS;
		//alert(url);
		//"create_section/set_leave.php"
		url=url+"?ids="+str;
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
window.size = function(){
   var w = 0;
   var h = 0;
   //IE
   if(!window.innerWidth)  {
      //strict mode
      if(!(document.documentElement.clientWidth == 0))      {
         w = document.documentElement.clientWidth;
         h = document.documentElement.clientHeight;
      }
      //quirks mode
      else      {
         w = document.body.clientWidth;
         h = document.body.clientHeight;
      }
   }
   //w3c
   else   {
      w = window.innerWidth;
      h = window.innerHeight;
   }
   return {width:w,height:h};
}

window.center = function(){
   var hWnd = (arguments[0] != null) ? arguments[0] : {width:0,height:0};
   var _x = 0;
   var _y = 0;
   var offsetX = 0;
   var offsetY = 0;

   //IE
   if(!window.pageYOffset)   {
      //strict mode
      if(!(document.documentElement.scrollTop == 0))     {
         offsetY = document.documentElement.scrollTop;
         offsetX = document.documentElement.scrollLeft;
      }
      //quirks mode
      else     {
         offsetY = document.body.scrollTop;
         offsetX = document.body.scrollLeft;
      }
   }
   //w3c
   else   {
      offsetX = window.pageXOffset;
      offsetY = window.pageYOffset;
   }

   _x = ((this.size().width-hWnd.width)/2)+offsetX;
   _y = ((this.size().height-hWnd.height)/2)+offsetY;

   return{x:_x,y:_y};
}
function GetXmlHttpObject(){
	var xmlHttp=null;
	try	{
		// Firefox, Opera 8.0+, Safari
		xmlHttp=new XMLHttpRequest();
	}
	catch (e)
	{
		//Internet Explorer
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}catch (e){
			xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	return xmlHttp;
}

// set leave block

function set_leave(){    

    $(document).ready(function(){  		
		var serialno          = document.getElementById("serialno").value;
		var company_id        = document.getElementById("company_id").value;
		var section_id        = document.getElementById("section_id").value;
		var block_name        = document.getElementById("block_name").value;
		var bangla_block_name = document.getElementById("bangla_block_name").value;
		
		var dataStr = 'serialno='+serialno+'&company_id='+company_id+'&section_id='+section_id+'&block_name='+block_name+'&bangla_block_name='+bangla_block_name;	
		$.ajax({
		   type:'post',
		   url:'create_section/block_editing.php' ,
		   data:dataStr,
		   cache:false ,
		   success:function(st) {
			 $('#section_info_display').load('create_section/section_search.php',{'secid':section_id},function(){});  
		   }
		});	
	});	
	//alert(dataStr);
	// alert(serialno+company_id+section_id+block_name+bangla_block_name);
	/*document.getElementById("serialno").value=document.getElementById("serialno").value;
	document.getElementById("company_id").value=document.getElementById("company_id").value;
	document.getElementById("section_id").value=document.getElementById("section_id").value;
	document.getElementById("block_name_").value=document.getElementById("block_name").value;
    document.getElementById("bangla_block_name").value=
	document.getElementById("bangla_block_name").value;*/
}
function add_block()
{
	 $(document).ready(function(){
		var section_id        = document.getElementById("section_id").value;
		var block_name        = document.getElementById("block_name").value;
		var bangla_block_name = document.getElementById("bangla_block_name").value;
		
		var dataStr ='section_id='+section_id+'&block_name='+block_name+'&bangla_block_name='+bangla_block_name;	
		$.ajax({
		   type:'post',
		   url:'create_section/block_add.php' ,
		   data:dataStr,
		   cache:false ,
		   success:function(st) {
			 $('#section_info_display').load('create_section/section_search.php',{'secid':section_id},function(){});  
		   }
		});	
		
		
	});	
}

// edit alowence block
function edit_alowence(){

    $(document).ready(function(){
        var serialno         = document.getElementById("serialno").value;	
		var section_id		 = document.getElementById("section_id").value;
		var company_id		 = document.getElementById("company_id").value;
		var alowence_head_id = document.getElementById("alowence_head_id").value;			
		var alowence_name    = document.getElementById("alowence_name").value;
		var alowence_amount  = document.getElementById("alowence_amount").value;
		var alowence_type    = document.getElementById("alowence_type").value;
		var dataStr = 'serialno='+serialno+'&section_id='+section_id+'&company_id='+company_id+'&alowence_head_id=' + alowence_head_id+'&alowence_name='+alowence_name+'&alowence_amount='+alowence_amount
		+'&alowence_type='+alowence_type;

		//alert(dataStr);
		$.ajax({
		   type:'post' ,
		   url: 'create_section/alowence_edit_by_ajax.php',
		   data:dataStr, 
		   cache:false ,
		   success:function(st) {
		      //alert(st);
			  $('#section_info_display').load('create_section/section_search.php',{'secid':section_id},function(){});  			  
		   }
		});
	});	
}


// edit salary block
function edit_salary(){
    $(document).ready(function(){
        var serialno     = document.getElementById("serialno").value;	
		var section_id	 = document.getElementById("section_id").value;
		var company_id	 = document.getElementById("company_id").value;
		var salary_from  = document.getElementById("salary_from").value;			
		var salary_to    = document.getElementById("salary_to").value;
		var designation  = document.getElementById("designation").value;
		var salary_type  = document.getElementById("salary_type").value;
		var dataStr = 'serialno='+serialno+'&section_id='+section_id+'&company_id='+company_id+'&salary_from=' + salary_from+'&salary_to='+salary_to+'&designation='+designation
		+'&salary_type='+salary_type;

		//alert(dataStr);
		$.ajax({
		   type:'post' ,
		   url: 'create_section/salary_edit_by_ajax.php',
		   data:dataStr, 
		   cache:false ,
		   success:function(st) {		      
			  $('#section_info_display').load('create_section/section_search.php',{'secid':section_id},function(){});  			  
		   }
		});
	});	
}


function add_block() {

 $(document).ready(function(){  
		var section_id        = document.getElementById("section_id").value;
		var company_id        = document.getElementById("company_id").value;
		var block_name        = document.getElementById("block_name").value;
		var bangla_block_name = document.getElementById("bangla_block_name").value;
		
		var dataStr = 'section_id='+section_id+'&company_id='+company_id+'&block_name='+block_name+'&bangla_block_name='+bangla_block_name;
		//alert(dataStr);
		
		$.ajax({
		   type:'post' ,
		   url:'create_section/new_block_add_by_ajax.php',
		   data:dataStr,
		   cache:false ,
		   success:function(st) {
		      //alert(st);
			  $('#section_info_display').load('create_section/section_search.php',{'secid':section_id},function(){});  
		   }
		});
   });	
} 