<?php                                                                           // '<?' or '<?php' tells PHP to start parsing
/*********************************************************************
 * The comments herein are designed to be helpful to someone with    *
 * little or no programming experience.  To that end, many of the    *
 * comments may address things will appear obvious to many coders.   *
 * For the most part I'll place my comments at the end of each line. *
 * Feel free to e-mail any comments or questions to FX@iviking.org.  *
 * Please remember that this code is being released as open source   *
 * under The Artistic License of PERL fame...                        *
 * http://www.opensource.org/licenses/artistic-license.html          *
 *...and is also covered by the FX.php license addendum...           *
 * http://www.iviking.org/downloads/ADDENDUM.txt                     *
 *********************************************************************/

include_once($_SERVER['DOCUMENT_ROOT'] . "/FX/FX.php");                         // FX.php contains the class for pulling data
                                                                                // from FileMaker into PHP -- 'include_once()'
                                                                                // makes sure the class is only declared once.
include_once($_SERVER['DOCUMENT_ROOT'] . "/FX/server_data.php");                // To make sure that these examples work for you, be sure
                                                                                // to set the IP address of your server in server_data.php
                                                                                // IMPORTANT: The leading '$' denotes a variable in PHP

$DatasetQuery = new FX($serverIP, $webCompanionPort, $dataSourceType);          // This line creates an instance of the FX class
$DatasetQuery->SetDBData('Book_List.fp5');
$LayoutData = $DatasetQuery->FMLayoutNames();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <title>iViking FX -- Layout List Dataset Example Page</title>
    </head>

    <body bgcolor="#FFFFFF">
        <pre>
<?php
print_r($LayoutData);                                                           // pint_r() is a PHP function used to diplay variables
                                                                                // in human readable form.  This is especially useful
                                                                                // for arrays.
?>
        </pre>
    </body>
</html>