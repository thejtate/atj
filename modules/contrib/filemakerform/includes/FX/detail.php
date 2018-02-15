<?php                                                                            // '<?' or '<?php' tells PHP to start parsing

define("DEBUG", false);                                                         // by setting DEBUG to true, you can look at some of what FX.php is doing

/*********************************************************************
 * This file is part of the release of FX.php.  This PHP class is    *
 * freely available from http://www.iviking.org/                     *
 *                                                                   *
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

// MICROSOFT IIS TWEAKS

if (! isset($_SERVER['DOCUMENT_ROOT'])) {
    global $DOCUMENT_ROOT;
    global $HTTP_SERVER_VARS;

    $_SERVER['DOCUMENT_ROOT'] = str_replace(str_replace('\\\\', '/', $_SERVER['PHP_SELF']), '', str_replace('\\\\', '/', $_SERVER['PATH_TRANSLATED'])) . '/';
    $DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
    $HTTP_SERVER_VARS['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'];
}

// END MICROSOFT IIS TWEAKS

include_once($_SERVER['DOCUMENT_ROOT'] . "/FX/FX.php");                         // FX.php contains the class for pulling data
                                                                                // from FileMaker into PHP -- 'include_once()'
                                                                                // makes sure the class is only declared once.
include_once($_SERVER['DOCUMENT_ROOT'] . "/FX/server_data.php");                // To make sure that these examples work for you, be sure
                                                                                // to set the IP address of your server in server_data.php
                                                                                // IMPORTANT: The leading '$' denotes a variable in PHP
include_once($_SERVER['DOCUMENT_ROOT'] . "/FX/image_proxy.php");                // This file allows proxying of images from a FileMaker DB
                                                                                // allowing you to keep your DB behind the firewall.
$BookQuery = new FX($serverIP, $webCompanionPort, $dataSourceType);             // This line creates an instance of the FX class
$BookQuery->SetDBData($bookListFile, "Detail_View");                            // The '->' indicates that SetDBData is part of
                                                                                // the FX instance we just created.
$BookQuery->SetDBUserPass ($webUN, $webPW);                                     // Set the user name and password for the desired access.
$BookQuery->AddDBParam('-recid', $_GET['ID']);                                  // '-recid' is a reference to the unique ID that FileMaker
                                                                                // creates for each record.  You'll also note that PHP
                                                                                // recognizes the parameters passed from the last page ('ID').
$query = $_GET['query'];
$BookData = $BookQuery->FMFind();
$currentKey = key($BookData['data']);                                           // From the online PHP manual:
                                                                                // key() returns the index element of the current array position
                                                                                // This is ideal in our case since the outer array has one element.

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <title>iViking FX -- Book Detail Demo Page</title>
        <style type="text/css">
            <!--
                .whitetxt    {color: #FFFFFF}
            -->
        </style>
    </head>

    <body bgcolor="#FFFFFF">
        <h2 align="left">iViking FX -- Book List Detail Page</h2>
        <table cellspacing="0" cellpadding="2" border="0" bgcolor="#CCCCCC">
            <tr>
                <td colspan="6">&nbsp;</td>
            </tr>
            <tr>
                <td width="10" rowspan="5">&nbsp;</td>
                <td align="left" width="75" valign="top"><b>Author:&nbsp;</b></td>
                <td align="left" width="240" bgcolor="#FFFFFF">
                    <?php echo $BookData['data'][$currentKey]['author'][0]; ?>
                </td>
                <td width="5" rowspan="5">&nbsp;</td>
                <td align="center" valign="center" bgcolor="#FFFFFF" width="125" rowspan="4">
                    <img src="image_proxy.php?FXimage=<?php echo vignereEncryptURL($BookData['data'][$currentKey]['cover_art'][0]); ?>">
                </td>
                <td width="10" rowspan="5">&nbsp;</td>
            </tr>
            <tr>
                <td align="left" valign="top"><b>Title:&nbsp;</b></td>
                <td align="left" bgcolor="#FFFFFF">
                    <?php echo $BookData['data'][$currentKey]['title'][0]; ?>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><b>ISBN:&nbsp;</b></td>
                <td align="left" bgcolor="#FFFFFF">
                    <?php echo $BookData['data'][$currentKey]['ISBN'][0]; ?>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"><b>Description:&nbsp;</b></td>
                <td align="left" rowspan="2" bgcolor="#FFFFFF">
                    <?php echo str_replace("\n", '<br />', $BookData['data'][$currentKey]['description'][0]); ?>
                </td>
            </tr>
            <tr>
                <td align="center" valign="center">
                    <b>Pages:</b>&nbsp;<?php echo $BookData['data'][$currentKey]['number_of_pages'][0]; ?>
                </td>
            </tr>
            <tr>
                <td align="center" colspan="6">
                    <a href="index.php?<?php echo $query; ?>">Return to Book List</a>
                </td>
            </tr>
        </table>
    </body>
</html>