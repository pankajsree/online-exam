<?php
    session_start();
    require_once("../../check-session.php");
    require("../../../common/common.php");
    require_once("../../../config/db-config.php");

    $query = "SELECT `sec_id`, `sec_name`, `positive`, `negative` FROM `sec_details`";
    $result = mysqli_query($conn, $query);
    if(!$result) {
        die("Query Failed !!!");
    }
    $row = mysqli_fetch_assoc($result);
    $sec_id = $row['sec_id'];
    $sec_name = $row['sec_name'];
    $positive = $row['positive'];
    $negative = $row['negative'];
    $table_result = $sec_id . "_result";

    $query = "SELECT `candidate_id`, `candidate_name`, `attempted`, `correct`, `incorrect`, `score` FROM `$table_result`";
    $result = mysqli_query($conn, $query);
    if(!$result) {
        die("Query Failed !!!");
    }

    // Include the main TCPDF library (search for installation path).
    require_once('tcpdf_include.php');

    class MYPDF extends TCPDF {

        //Page header
        public function Header() {
            // Logo
            $image_file = K_PATH_IMAGES.'nita.jpg';
            $this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
            // Set font
            $this->SetFont('helvetica', 'B', 20);
            // Title
            $this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        }

        // Page footer
        public function Footer() {
            // Position at 15 mm from bottom
            $this->SetY(-15);
            // Set font
            $this->SetFont('helvetica', 'I', 8);
            // Page number
            $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        }
    }



// create new PDF document
// $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
//
// set document information
// $pdf->SetCreator(PDF_CREATOR);
// $pdf->SetAuthor('Nicola Asuni');
// $pdf->SetTitle('TCPDF Example 003');
// $pdf->SetSubject('TCPDF Tutorial');
// $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// -------------------------------------------------------------------------------------------------

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Pankajsree Das');
$pdf->SetTitle('Candidate Scorecard');
$pdf->SetSubject('Candidate Scorecard');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('theano', '', 10);

// add a page
$pdf->AddPage('P');

/* NOTE:
 * *********************************************************
 * You can load external XHTML using :
 *
 * $html = file_get_contents('/path/to/your/file.html');
 *
 * External CSS files will be automatically loaded.
 * Sometimes you need to fix the path of the external CSS.
 * *********************************************************
 */

// define some HTML content with style
$html = <<<EOF
<!DOCTYPE html>
<html>
    <head>
        <style>
            h1 {
                font-size: 20px;
                text-align: center;
                text-decoration: underline;
            }
            table {
                width: 100%;
                font-size: 10px;
            }
            th {
                background-color: #ccc;
                border: 1px solid #000;
                text-align: center;
            }
            td {
                border: 1px solid #000;
                text-align: center;
            }
        </style>
    </head>
    <body>

        <h1>Candidate Result Sheet - $sec_name</h1>
        <table>
            <tbody>
                <tr>
                    <th>Candidate ID</th>
                    <th>Candidate Name</th>
                    <th>Attempted</th>
                    <th>Correct</th>
                    <th>Incorrect</th>
                    <th>Final Score</th>
                </tr>
EOF;
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $candidate_id = $row['candidate_id'];
            $candidate_name = $row['candidate_name'];
            $attempted = $row['attempted'];
            $correct = $row['correct'];
            $incorrect = $row['incorrect'];
            $score = $row['score'];
            $html .= "
                <tr>
                    <td>$candidate_id</td>
                    <td>$candidate_name</td>
                    <td>$attempted</td>
                    <td>$correct</td>
                    <td>$incorrect</td>
                    <td>$score</td>
                </tr>
            ";
        }

        $html .= <<<EOF
            </tbody>
        </table>
    </body>
</html>

EOF;
// output the HTML content
$pdf->writeHTML($html, true, true, true, false, 'L');

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------
$pdf_output = 'candidate_result_'.$sec_id.'.pdf';
//Close and output PDF document
$pdf->Output($pdf_output, 'I');

//============================================================+
// END OF FILE
//============================================================+
