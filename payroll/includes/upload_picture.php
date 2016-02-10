<fieldset>
<legend>Upload Employee Photo</legend>
<form action="picture_upload.php" method="post" enctype="multipart/form-data">
   <table>
      <tr>
	    <td>Upload photo: </td>
		<td><input type="file" name="myfile" id="myfile"/></td>
	  </tr>
	  <input type="hidden" name="id" value="<?php echo $_GET['id'];?>"/>
	  <tr>
	   <td>&nbsp;</td>
	   <td><input type="submit" value="upload"/></td>
	  </tr>
   </table>   
</form>
</fieldset>