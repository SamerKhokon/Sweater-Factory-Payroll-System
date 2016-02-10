<table border="1" bordercolor="#007" align="center">
        <tr>
            <td border="1">
                <table style="border: solid 1px #FF0000; background: #FFFFFF; width: 100%; text-align: center">
                    <tr>
                        <th>C1 € «</th>
                        <td>C2 € «</td>
                    </tr>
                    <tr>
                        <td >D1 &euro; &laquo;</td>
                        <th>D2 &euro; &laquo;</th>
                    </tr>
                </table>
            </td>
            <td border="1">A2</td>
            <td border="1">AAAAAAAA</td>
        </tr>
        <tr>
            <td border="1">B1</td>
            <td border="1" rowspan="2">
                <table class="test1">
                    <tr>
                        <td >E1</td>
                        <td>
                            <table>
                                <tr>
                                    <td>
                                        <img src="./res/logo.gif" alt="Logo" width=100 />
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="border: solid 2px #770000">F1</td>
                        <td style="border: solid 2px #007777">F2</td>
                    </tr>
                </table>
            </td>
            <td border="1"><barcode type="EAN13" value="45" style="width: 30mm; height: 6mm; font-size: 4mm"></barcode></td>
        </tr>
        <tr>
            <td border="1"><barcode type="C39" value="HTML2PDF" label="none" style="width: 35mm; height: 8mm"></barcode></td>
            <td border="1">A2</td>
        </tr>
        <?php
		for($i=0;$i<=200;$i++)
		{
		?>
        <tr>
        	<td>dddd</td><td>ddd</td><td>dddd</td>
        </tr>
        <?php
		}
		?>
    </table>
    <br>
    Exemple avec border et padding : <br>
    <table style="border: solid 5mm #770000; padding: 5mm;" cellspacing="0" >
        <tr>
            <td style="border: solid 3mm #007700; padding: 2mm;"><img src="./res/off.png" alt="" style="width: 20mm"></td>
        </tr>
    </table>
    <img src="./res/off.png" style="width: 10mm;"><img src="./res/off.png" style="width: 10mm;"><img src="./res/off.png" style="width: 10mm;"><img src="./res/off.png" style="width: 10mm;"><img src="./res/off.png" style="width: 10mm;"><br>
    <br>
    <table style="border: solid 1px #440000; width: 150px"  cellspacing="0"><tr><td style="width: 100%">Largeur : 150px</td></tr></table><br>
    <table style="border: solid 1px #440000; width: 150pt"  cellspacing="0"><tr><td style="width: 100%">Largeur : 150pt</td></tr></table><br>
    <table style="border: solid 1px #440000; width: 100mm"  cellspacing="0"><tr><td style="width: 100%">Largeur : 100mm</td></tr></table><br>
    <table style="border: solid 1px #440000; width: 5in"    cellspacing="0"><tr><td style="width: 100%">Largeur : 5in</td></tr></table><br>
    <table style="border: solid 1px #440000; width: 80%"    cellspacing="0"><tr><td style="width: 100%">Largeur : 80% </td></tr></table><br>
