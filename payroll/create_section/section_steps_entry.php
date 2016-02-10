<?php
		session_start();
		require '../../includes/db.php';
		
		$last_section_id      = $_POST['last_section_id'];
		$section_name_english = trim(strtoupper($_POST['section_name_english']));
		$section_name_bangla  = $_POST['section_name_bangla'];
		$section_type         = $_POST['section_type'];
		$company_id           = $_SESSION['company_id'];
		$alowences            = $_POST['alowences'];
		$list		          = $_POST['list'];			
		$txtbox				  = $_POST['textbox'];
		$sels                 = $_POST['selecbox'];	 						
		
		
		$duplicate_count_str = "SELECT COUNT(*) FROM TBL_PAY_SECTION_INFO WHERE upper(SEC_NAME)='$section_name_english' and COMPANY_ID=$company_id";
		$duplicate_count_stm = mysqli_query($conn,$duplicate_count_str);
		
		
		while($rss = mysqli_fetch_array($duplicate_count_stm)) {
		    $counter = $rss['COUNT(*)'];
		}
		if($counter==0) {
			// section_info table adding
			$section_info_str = "INSERT INTO TBL_PAY_SECTION_INFO(SEC_NAME,COMPANY_ID,SEC_TYPE_ID,BNG_SEC_NAME) VALUES('$section_name_english',$company_id,$section_type,'$section_name_bangla')";
			
			$section_info_stm = mysqli_query( $conn,$section_info_str);
			
			if($section_info_stm)
			{
				$section_str = "select MAX(ID) from TBL_PAY_SECTION_INFO";
				$section_stm = mysqli_query($conn,$section_str);	
				
				if($last_row = mysqli_fetch_array($section_stm)){	
					$last_section_id2 = $last_row[0];
				}
			}	
			
			
			//my list values

			$block_parse = explode(",",$list);
			for($i=0;$i<count($block_parse);$i++) {
				$block_name = $block_parse[$i];
				if($block_name!="") {
					$block_entry_str = "INSERT INTO TBL_PAY_SECTION_BLOCK(SECTION_ID,COMPANY_ID,BLOCK_NAME,BNG_BLOCK_NAME) VALUES($last_section_id2,$company_id,'$block_name','$section_name_bangla')";
								
					$block_entry_stm = mysqli_query($conn,$block_entry_str);
					
				}
			}
				   
			$textboxes_value_parse 	= explode(",",$txtbox);
			$combo_value_parse 		= explode(",",$sels);
			$alowences_id_parse 	= explode(",",$alowences);
			
			
			for($j=0;$j<count($textboxes_value_parse);$j++) {
			   $amount       =  $textboxes_value_parse[$j];//.'%'
			   $type         = $combo_value_parse[$j];
			   $alowence_id  = $alowences_id_parse[$j];
			
			   if($type!="" && $alowence_id!="")		 {
			   		if($amount=='')
						$amount	=0;
					$alowence_entr_str = "INSERT INTO TBL_PAY_SECTION_ALLOWENCE_INFO
					(COMPANY_ID,SECTION_ID,ALLOWENCE_HEAD_ID,ALLOWENCE_AMOUNT,
					ALLOWENCE_AFFECT) VALUES($company_id,$last_section_id2,$alowence_id,'$amount','$type')";
					
					$alowence_entr_stm = mysqli_query($conn,$alowence_entr_str);
				
			   }
			}

           echo 'Data saved successfully!';			
		}else{
		    echo $section_name_english." is already exist!";
		}	
?>