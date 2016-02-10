<script type="text/javascript">
	$(document).ready(function() {
		$('#slider').rhinoslider({
			controlsPlayPause: false,
			showControls: 'always',
			showBullets: 'always',
			controlsMousewheel: false,
			prevText: 'Back',
			nextText:'Proceed',
	slidePrevDirection: 'toRight',
slideNextDirection: 'toLeft'
		});


		$(".rhino-prev").hide();
		$('.rhino-next').after('<a class="form-submit" href="javascript:void(0);" >Proceed</a>');
		$(".rhino-next").hide();




		var info = ["STEP 1","STEP 2","STEP 3"];
		var images = ["account-details.png","account-details.png","account-details.png"];
		$('.rhino-bullet').each(function(index){
			$(this).html('<p style="margin: 0pt; font-size: 13px; font-weight: bold;"><img src="./img/'+
				images[index]+'"></p><p class="bullet-desc">'+info[index]+'</p></a>');
		});





	});

	$('.form-submit').live("click",function(){

		$('.form-error').html("");

		var current_tab = $('#slider').find('.rhino-active').attr("id");

		switch(current_tab){
			case 'rhino-item0':
				var srep1 = step1_validation();
				if(srep1==0)
				{
				ajaxsmsresult();
				}
				else
					break;
			case 'rhino-item1':
				step2_validation();
				break;
			case 'rhino-item2':
				var step3 =step3_validation();
				if(step3==0)
					submit_from();
				else
					break;
		}
	});

	var step1_validation = function(){

		var err = 0;

		if($('#m_number').val() == ''){
			$('#m_number').parent().parent().find('.form-error').html("Mobile Number is Required");
			err++;
		}
		if(err == 0){
			$(".rhino-active-bullet").removeClass("step-error").addClass("step-success");
			$(".rhino-next").show();
			$('.form-submit').hide();
			$('.rhino-next').trigger('click');
		}else{
			$(".rhino-active-bullet").removeClass("step-success").addClass("step-error");
		}

		return err;
	};

	var step2_validation = function(){
		var err = 0;

		if($('#username').val() == ''){
			$('#username').parent().parent().find('.form-error').html("Username is Required");
			err++;
		}
		if($('#pass').val() == ''){
			$('#pass').parent().parent().find('.form-error').html("Password is Required");
			err++;
		}
		if($('#cpass').val() == ''){
			$('#cpass').parent().parent().find('.form-error').html("Confirm Password is Required");
			err++;
		}
		if(err == 0){
			$(".rhino-active-bullet").removeClass("step-error").addClass("step-success");
			$(".rhino-next").show();
			$('.form-submit').hide();
			$('.rhino-next').trigger('click');
		}else{
			$(".rhino-active-bullet").removeClass("step-success").addClass("step-error");
		}

	};

	var step3_validation = function(){
		var err = 0;

		if($('#email').val() == ''){
			$('#email').parent().parent().find('.form-error').html("Email is Required");
			err++;
		}
		if(err == 0){
			$(".rhino-active-bullet").removeClass("step-error").addClass("step-success");
			$(".rhino-next").show();
			$('.form-submit').hide();
			$('.rhino-next').trigger('click');
		}else{
			$(".rhino-active-bullet").removeClass("step-success").addClass("step-error");
		}
		
		return err;

	};
	
	
	function submit_from()
	{
		alert('success');
	}
	function ajaxsmsresult()
	{
		var m_number	=$('#m_number').val();
		m_number		=m_number.replace(/^,/,'');
		var m_num_total =(m_number.split(",").length);
		var m_message	=$('#m_message').val();
		var length 		=m_message.length;
		var divider		=160;
		var result		=(length/divider);
		result			=Math.ceil(result);
		if(result==0)
			result=1;
		var total_sms	=(m_num_total*result);
		$('#total_number').val(m_num_total);
		$('#stotal_number').text(m_num_total);
		
		$('#total_sms').val(total_sms);
		$('#stotal_sms').text(total_sms);
		
		$('#sms').val(result);
		$('#ssms').text(result);
	}
</script>
<style type="text/css">
	body { background-color:#fff; }
	#wrapper{
		border: 1px solid #DCDADA;
		border-radius: 5px 5px 5px 5px;
		box-shadow: 2px 2px 2px #E1E1E1;
		background: #fff;
		width:700px;
		height:480px;
		background:#f4f4f4;
	}
	#wrapper h3{
		font-size:16px;
		height:60px;
		background:url(img/title.png) no-repeat left top;
		margin:0;
		padding:16px 0 0 20px;
		text-shadow: 1px 1px 2px #000;
		filter: dropshadow(color=#000, offx=1, offy=1);
		color:#fff;
	}
	#slider {

		background: #fff;
		/*IE bugfix*/
		padding:0;
		margin:0;
		width:700px;
		height:400px;	

	}

	#slider li { list-style:none; }

	#page {
		width:600px;
		margin:50px auto;
	}

	#slider{
		color: #000;
		background:#f4f4f4;
		font-size:12px;
	}

	.form-step{

		padding:16% 3% !important;
	}

	.form-submit{
		cursor: pointer;
		display: block;
		position: absolute;
		right: 0;
		bottom: 0;
		-moz-user-select: none;
		background: none repeat scroll 0 0 #6F95DC;
		border-radius: 5px 5px 5px 5px;
		color: #FFFFFF;
		display: block;
		margin: 0 20px 20px;
		padding: 10px;
		text-align: center;
		width: 125px;
		z-index: 10;
		font-weight: bold;
		text-decoration: none;
		background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#94b9e9), to(#4870d2));
		background-image: -moz-linear-gradient(#94b9e9, #4870d2);
		background-image: -webkit-linear-gradient(#94b9e9, #4870d2);
		background-image: -o-linear-gradient(#94b9e9, #4870d2);
		filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#94b9e9, endColorstr=#4870d2)";
		-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#94b9e9, endColorstr=#4870d2)";
		font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif;

	}

	.errorDisplay{
		border:2px solid red;
	}

	.form-left{
		color: #717171;
		float: left;
		font-size: 13px;
		font-weight: bold;
		padding: 5px;
		width: 200px;
	}
	.form-right{
		float: left;
		width: 214px;
	}
	.row{
		float: left;
		margin: 5px 0;
		width: 100%;
	}
	.form-step input[type='text']{
		border: 1px solid #CFCFCF;
		border-radius: 4px 4px 4px 4px;
		height: 25px;
		padding: 3px;
		width: 200px;
	}
	select{
		border-radius: 4px;
		border: 1px solid #CFCFCF;
		-webkit-border-radius: 4px;
		-moz-border-radius: 4px;
		background: #FFF;
		padding: 2px;
		height: 30px;
		width:205px;
		font-size:12px;
		background:#f4f4f4;
	}

	select option{
		font-size:12px;
		background:#f4f4f4;
		color:#717171;
	}


	.form-error{
		color: red;
		font-size: 12px;
		padding: 8px;
	}

	.step-error{
		background:#f5715f !important;
		color:#FFF !important;
		-moz-box-shadow:1px 1px 4px #C6C4C4
			-webkit-box-shadow:1px 1px 4px #C6C4C4
			box-shadow:1px 1px 4px #C6C4C4
	}
	.step-success{
		background:#72e487 !important;
		color:#FFF !important;
		-moz-box-shadow:1px 1px 1px 4px #C6C4C4
			-webkit-box-shadow:1px 1px 1px 4px #C6C4C4
			box-shadow:1px 1px 1px 4px #C6C4C4
	}
	.bullet-desc{
		font-size: 14px;
		font-weight: bold;
	}
</style>
        
<div id="page">
    <div id="wrapper">
        <h3>SMS SEND PROCESS</h3>
        <form action="">
            <div id="slider">
                <div class="form-step">
                    <div class="row">
                        <div class="form-left">Mobile Number*</div>
                        <div class="form-right"><input type="text" id="m_number" name="m_number" class="form-input" /></div>
                        <div class="form-error"></div>
                    </div>
                    <div class="row">
                        <div class="form-left">Message</div>
                        <div class="form-right"><textarea name="m_message" id="m_message" rows="3" cols="23" class="form-input" ></textarea></div>
                        <div class="form-error"></div>
                    </div>
                </div>
                
                <div class="form-step">
                    <div class="row">
                        <div class="form-left">Total Number</div>
                        <div class="form-right" id="stotal_number"></div>
                        <div class="form-error"></div>
                        <input type="hidden" id="total_number" name="total_number" class="form-input" />
                    </div>
                    <div class="row">
                        <div class="form-left">Sms</div>
                        <div class="form-right" id="ssms"></div>
                        <div class="form-error"></div>
                        <input type="hidden" id="sms" name="sms" class="form-input" />
                    </div>
                    <div class="row">
                        <div class="form-left">Total Sms</div>
                        <div class="form-right" id="stotal_sms"></div>
                        <div class="form-error"></div>
                    </div>
                    <input type="hidden" id="total_sms" name="total_sms" class="form-input" />
                </div>
                <div class="form-step">
                    <div class="row">
                        <div class="form-left">Email *</div>
                        <div class="form-right"><input type="text" id="email" name="email" class="form-input" /></div>
                        <div class="form-error"></div>
                    </div>
                    <div class="row">
                        <div class="form-left">Mobile No</div>
                        <div class="form-right"><input type="text" id="mobile" name="mobile" class="form-input" /></div>
                        <div class="form-error"></div>
                    </div>
                </div>
              </form>
            </div>
    </div>