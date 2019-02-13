<?php
define ('K_TCPDF_EXTERNAL_CONFIG', true);

 // Default images directory
define ('K_PATH_IMAGES', dirname(__FILE__).'/../images/');
define ('PDF_HEADER_LOGO', 'nita.png');
define ('PDF_HEADER_LOGO_WIDTH', 15);

// Cache directory for temporary files (full path)
define ('K_PATH_CACHE', sys_get_temp_dir().'/');

// Generic name for a blank image
define ('K_BLANK_IMAGE', '_blank.png');
define ('PDF_PAGE_FORMAT', 'A4');
define ('PDF_PAGE_ORIENTATION', 'L');
define ('PDF_CREATOR', 'NIT Agartala');
define ('PDF_AUTHOR', 'Pankajsree Das');
define ('PDF_HEADER_TITLE', "राष्ट्रीय प्रौद्योगिकी संस्थान अगरतला\nNational Institute of Technology Agartala");
define ('PDF_HEADER_STRING', "Jirania, Tripura(W) - 799046\nurl:http://www.nita.ac.in");

define ('PDF_UNIT', 'mm');
define ('PDF_MARGIN_HEADER', 5);
define ('PDF_MARGIN_FOOTER', 10);
define ('PDF_MARGIN_TOP', 30);
define ('PDF_MARGIN_BOTTOM', 25);
define ('PDF_MARGIN_LEFT', 15);
define ('PDF_MARGIN_RIGHT', 15);

define ('PDF_FONT_NAME_MAIN', 'freesans');
define ('PDF_FONT_SIZE_MAIN', 10);
define ('PDF_FONT_NAME_DATA', 'glacialindifference');
define ('PDF_FONT_SIZE_DATA', 8);
define ('PDF_FONT_MONOSPACED', 'glacialindifference');
define ('PDF_IMAGE_SCALE_RATIO', 1.25);

define('HEAD_MAGNIFICATION', 1.1);
// Height of cell respect font height
define('K_CELL_HEIGHT_RATIO', 1.25);

define('K_TITLE_MAGNIFICATION', 1.3);

/**
 * Reduction factor for small font.
 */
define('K_SMALL_RATIO', 2/3);

/**
 * Set to true to enable the special procedure used to avoid the overlappind of symbols on Thai language.
 */
define('K_THAI_TOPCHARS', true);

/**
 * If true allows to call TCPDF methods using HTML syntax
 * IMPORTANT: For security reason, disable this feature if you are printing user HTML content.
 */
define('K_TCPDF_CALLS_IN_HTML', true);

/**
 * If true and PHP version is greater than 5, then the Error() method throw new exception instead of terminating the execution.
 */
define('K_TCPDF_THROW_EXCEPTION_ERROR', true);


//============================================================+
// END OF FILE
//============================================================+
