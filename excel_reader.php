<?php
// Test CVS

require_once 'Excel/reader.php';


// ExcelFile($filename, $encoding);
$data = new Spreadsheet_Excel_Reader();


// Set output Encoding.
$data->setOutputEncoding('CP1251');
/***
* if you want you can change 'iconv' to mb_convert_encoding:
* $data->setUTFEncoder('mb');
*
**/

/***
* By default rows & cols indeces start with 1
* For change initial index use:
* $data->setRowColOffset(0);
*
**/



/***
*  Some function for formatting output.
* $data->setDefaultFormat('%.2f');
* setDefaultFormat - set format for columns with unknown formatting
*
* $data->setColumnFormat(4, '%.3f');
* setColumnFormat - set format for column (apply only to number fields)
*
**/

$data->read('Book1.xls');

/*


 $data->sheets[0]['numRows'] - count rows
 $data->sheets[0]['numCols'] - count columns
 $data->sheets[0]['cells'][$i][$j] - data from $i-row $j-column

 $data->sheets[0]['cellsInfo'][$i][$j] - extended info about cell
    
    $data->sheets[0]['cellsInfo'][$i][$j]['type'] = "date" | "number" | "unknown"
        if 'type' == "unknown" - use 'raw' value, because  cell contain value with format '0.00';
    $data->sheets[0]['cellsInfo'][$i][$j]['raw'] = value if cell without format 
    $data->sheets[0]['cellsInfo'][$i][$j]['colspan'] 
    $data->sheets[0]['cellsInfo'][$i][$j]['rowspan'] 
*/

//error_reporting(E_ALL ^ E_NOTICE);
$letter = '';





for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
	if($letter != substr(strtoupper(str_replace("\"","",$data->sheets[0]['cells'][$i][1])),0,1)){
		$letter = substr(strtoupper(str_replace("\"","",$data->sheets[0]['cells'][$i][1])),0,1);
		if($i >= 2){
			echo "</dl>\n";
			echo "<p><a href='#'>Top</a></p>\n\n";
		}
		echo "<h2 id=\"".strtolower($letter)."list\">".strtoupper($letter)."</h2>\n";
		echo "<dl>\n";
		
	}

	for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {

		if($j == 1){
			echo "<dt>";
		}else{
			echo "<dd>";
		}
		
		echo $data->sheets[0]['cells'][$i][$j];

		if($j == 1){
			echo "</dt>\n";
		}else{
			echo "</dd>\n";
		}

		if($i == $data->sheets[0]['numRows']){
			echo "</dl>";
		}
	}

}


//print_r($data);
//print_r($data->formatRecords);
?>
