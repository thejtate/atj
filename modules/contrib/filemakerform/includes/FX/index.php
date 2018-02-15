<?php                                                                           // '<?' or '<?php' tells PHP to start parsing

define("DEBUG", true);                                                         // by setting DEBUG to true, you can look at some of what FX.php is doing

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
$BookQuery = new FX($serverIP, $webCompanionPort, $dataSourceType);             // This line creates an instance of the FX class
$BookQuery->SetDBData($bookListFile, "Book_List");                              // The '->' indicates that SetDBData is part of
                                                                                // the FX instance we just created.
$BookQuery->SetDBUserPass ($webUN, $webPW);                                     // Set the user name and password for the desired access.
$arrayName = '_' . $_SERVER["REQUEST_METHOD"];                                  // Note the '$$' a couple of lines down.  I'm using a variable
                                                                                // whose name is the contents of another variable.  VERY handy.
if (isset(${$arrayName}['currentSort']) && ${$arrayName}['currentSort'] != '') { // If sorting has been requested, this adds it to the query.
    $BookQuery->AddSortParam($_GET['currentSort']);
}
if (isset(${$arrayName}['currentQuery']) && ${$arrayName}['currentQuery'] == 'Search Book List!') { // Check if this page is being accessed by a search
    $currentSearch = '';                                                        // initialize the $currentSearch variable
    foreach ($$arrayName as $key => $value) {                                   // 'foreach()' is a VERY handy function.  It steps
                                                                                // through an array and stores the data in temporary
                                                                                // variables as directed ($key and $value in this case)
        if ($key != 'currentSort' && $key != 'currentQuery') {
            $BookQuery->AddDBParam($key, $value);                               // '$key' contains the name of the field to search in,
        }                                                                       // '$value' contains the value we hope to find.
        $currentSearch .= '&' . "$key=" . urlencode($value);                    // The '.' and '.=' operators concatenate expressions
    }
    $BookData = $BookQuery->FMFind();                                           // This performs a find based on the specified parameters.
} else {
    $currentSearch = '';
    $BookData = $BookQuery->FMFindAll();                                        // Shows all records in the database
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <title>iViking FX -- Book List Demo Page</title>
        <style type="text/css">
            <!--
                .whitetxt    {color: #FFFFFF}
            -->
        </style>
    </head>

    <body bgcolor="#FFFFFF">
        <h2 align="left">iViking FX -- Book List Demo Page</h2>
        <table cellspacing="0" cellpadding="0" border="0">
            <tr bgcolor="#333333">
                <th align="left" width="150">
                    <a href="index.php?currentSort=author<?php echo $currentSearch; ?>" class="whitetxt">Author</a>
                </th>
                <th align="left" width="300">
                    <a href="index.php?currentSort=title<?php echo $currentSearch; ?>" class="whitetxt">Title</a>
                </th>
                <th align="left" width="25">
                    <a href="index.php?currentSort=number_of_pages<?php echo $currentSearch; ?>" class="whitetxt">Pages</a>
                </th>
            </tr>
<?php
$counter = 1;
if (FX::isError($BookData)) {
    echo("            <tr>\n");
    echo("                <td colspan=\"3\">\n");
    echo("                    <pre>\n");
    print_r($BookData);
    echo("                    </pre>\n");
    echo("                </td>\n");
    echo("            </tr>\n");
} elseif ($BookData['foundCount'] > 0) {                                        // Determine if any books were found.
    foreach ($BookData['data'] as $key => $value) {                             // The 'data' subarray contains the search results from FileMaker
        $recordID = strtok($key, '.');                                          // The main 'key' in the data subarry is constructed like this:
                                                                                // FileMaker Record ID, a '.', and FileMaker's Modification ID
                                                                                // (The latter of these is a value that FileMaker increments each
                                                                                //  time a record is modified.)
        if ($counter % 2 == 0) {                                                // '%' is the modulus operator in PHP.
            echo "<tr bgcolor=\"#CCCCCC\">\n";                                  // 'echo' is one method of displaying content as it is
        }                                                                       // parsed.  The '=' used in the lines above is shorthand
        else {                                                                  // for 'echo' when used in the manner shown.
            echo "<tr>\n";                                                      // A backslash in PHP usually indicates that the parser
        }                                                                       // should handle the following character in a special way --
                                                                                // '\n' is a newline character, '\"' inserts a double quote.
        echo "<td align=\"left\" valign=\"top\">";
        echo $value['author'][0];                                               // When we step through the 'data' subarray, each '$value' is a
        echo "</td>\n";                                                         // FileMaker record.  Here we're displaying the first value in
                                                                                // the 'author' field for the current record.  Repeating fields
                                                                                // and portals (where present) may contain multiple values.
        echo "<td align=\"left\" valign=\"top\">";
        echo "<a href=\"detail.php?ID=$recordID&query=" . urlencode($currentSearch) . "\">";
        echo $value['title'][0];
        echo "</a></td>\n";
        echo "<td align=\"right\" valign=\"top\">";
        echo $value['number_of_pages'][0];
        echo "&nbsp;&nbsp;</td>\n";
        echo "</tr>\n";
        ++$counter;                                                             // The '++' operator increments the argument it accompanies.
    }
} else {                                                                          // Here's the message to display if no records are found.
    echo("            <tr>\n");
    echo("                <td colspan=\"3\" align=\"center\">No Records Were Found</td>\n");
    echo("            </tr>\n");
}
?>
            <tr bgcolor="#333333">
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td colspan="2" align="left">
                    <form action="index.php" method="post">
                        <table cellspacing="1" cellpadding="2" border="2">
                            <tr>
                                <td colspan="2" align="left"><big>Search&nbsp;for&nbsp;a&nbsp;Book</big></td>
                            </tr>
                            <tr>
                                <td align="left">Author:&nbsp;</td>
                                <td align="left"><input type="text" size="20" name="author"></td>
                            </tr>
                            <tr>
                                <td align="left">Title:&nbsp;</td>
                                <td align="left"><input type="text" size="20" name="title"></td>
                            </tr>
                            <tr>
                                <td align="center" colspan="2"><input type="submit" name="currentQuery" value="Search Book List!"></td>
                            </tr>
                            <tr>
                                <td align="center" colspan="2"><input type="submit" name="currentQuery" value="Show All..."></td>
                            </tr>
                        </table>
                    </form>
                </td>
            </tr>
        </table>
        <?php // print_r($BookData); ?>
    </body>
</html>