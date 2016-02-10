<?php
			$str = "select * from tbl_pay_emp_production_issue";
			$stm = oci_parse($conn,$str);
			oci_execute($stm);
			$ncol = oci_num_fields($stm);
			echo "<table><tr>";
			for($i=1;$i<=$ncol;$i++) {
			    $f = oci_field_name($stm,$i);
				echo "<td>".$f."</td>";
			}
			echo "</tr>";
			while($res= oci_fetch_array($stm,OCI_BOTH)) {
			  echo "<tr>";
			  for($i=1;$i<=$ncol;$i++) {
			    $f = oci_field_name($stm,$i);
				echo  '<td>'.$res[$f].'</td>'; 
			  }
			  echo '</tr>';
			}
			echo "</table>";
?>