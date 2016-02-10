
    <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <!-- END: load jquery -->
    <!--jQuery Date Picker-->
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.datepicker.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.progressbar.min.js" type="text/javascript"></script>
    <!-- jQuery dialog related-->
    <script src="js/jquery-ui/external/jquery.bgiframe-2.1.2.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.draggable.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.position.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.resizable.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.dialog.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.blind.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.explode.min.js" type="text/javascript"></script>
    <!-- jQuery dialog end here-->
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <!--Fancy Button-->
    <script src="js/fancy-button/fancy-button.js" type="text/javascript"></script>
    <script src="js/setup.js" type="text/javascript"></script>
    <!-- Load TinyMCE -->
    <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setupProgressbar('progress-bar');
            setDatePicker('date-picker');
            setupDialogBox('dialog', 'opener');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });
    </script>
    <!-- /TinyMCE -->
    <style type="text/css">
        #progress-bar
        {
            width: 400px;
        }
    </style>


       
        <div class="grid_10">
            <div class="box round first fullpage">
                <h2>
                    Form Controls</h2>
                <div class="block ">
                    <table width="557" class="form">
          <tr>
                            <td width="128" class="col1">
<label>
                                    Section</label>
                            </td>
<td width="157" class="col2">
<select id="select2" name="select2">
                              <option value="1">Value 1</option>
                              <option value="2">Value 2</option>
                              <option value="3">Value 3</option>
                            </select>
                            <input type="checkbox" />Check
            </td>
			<td width="108">
<label>
                                    Date Comdition</label>
            </td>
<td>
                                <input type="text"  />
                            </td>
                      </tr>
                        <tr>
                            <td>
                                <label>
                                    Block</label>
                            </td>
                            <td>
                                <select id="select2" name="select2">
                              <option value="1">Value 1</option>
                              <option value="2">Value 2</option>
                              <option value="3">Value 3</option>
                            </select>
                            </td>
                            <td>
<label>
                          Date</label>                            </td>
                      <td width="144">
                        <input type="text" id="date-picker" />                            </td>
                      </tr>
                        </table>
                        
      				<table class="form">
                        
                        
                        <tr>
                            <td width="141">
<label>
                                    Card No</label>
                            </td>
                      <td width="144">
<input type="text"  />
                              
                            </td>
                      <td width="116">
<label>
                Style</label>
                            </td>
                      <td width="144">
                <input type="text"  />
                              
                            </td>
                      </tr>
                        <tr>
                            <td>
                                <label>
                                    Name</label>
                            </td>
                            <td>
                                <input type="text"  />
                            </td>
                            <td>
                                <label>
                                    Size</label>
                            </td>
                            <td>
                                <input type="text"  />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td>
                                <label>
                                    Quantity</label>
                            </td>
                            <td>
                                <input type="text"  />
                            </td>
                        </tr>
                        <tr>
                        	<td colspan="4" align="center"><input type="button" name="btn_save" id="btn_save" value=" &nbsp;&nbsp;Save&nbsp;&nbsp;" class="btn btn-navy" /></td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
    <div class="clear">
    </div>
    