<?php
//============================================================+
// File name   : tcpdf_include.php

// always load alternative config file for examples
require_once('config/tcpdf_config_alt.php');

// Include the main TCPDF library (search the library on the following directories).
$tcpdf_include_path = realpath('../tcpdf.php');
if (@file_exists($tcpdf_include_path)) {
	require_once($tcpdf_include_path);
}

//============================================================+
// END OF FILE
//============================================================+
