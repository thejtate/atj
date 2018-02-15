<!DOCTYPE html PUBLIC "-#W3C#DTD XHTML 1.0 Strict#EN"
        "http:#www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php

# - Written by: Lance Hallberg
# - Date: 04-21-2005
# - Last Revision: 10-01--2005
# - Contact: lhallberg@nietc.org
#
# - Minor Updates by: Chris Hansen
# - Date: 10-May-2005
# - Contact: FX@iviking.org
# - Comment: Thanks Lance!
#
# - Details: open source utility for visually working with an FX Class data set
# -          please distribute this utility freely, and without license...
#	
# - Documentation: 	see FX Parser.pdf
# - 				(included with distribution)


# MICROSOFT IIS TWEAKS
# This code was added because the 'DOCUMENT_ROOT' global variable is not present in IIS.
if (! isset($_SERVER['DOCUMENT_ROOT'])) {
    global $DOCUMENT_ROOT;
    global $HTTP_SERVER_VARS;

    $_SERVER['DOCUMENT_ROOT'] = str_replace(str_replace('\\\\', '/', $_SERVER['PHP_SELF']), '', str_replace('\\\\', '/', $_SERVER['PATH_TRANSLATED'])) . '/';
    $DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
    $HTTP_SERVER_VARS['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'];
}
# END MICROSOFT IIS TWEAKS

# Grab the FMErrors file for dynamic error reporting
	require_once($_SERVER['DOCUMENT_ROOT'] . "/FX/Developer/FMErrors.php");
		

######## !!! Welcome to PHP, the FX.php Class and the FX Parser !!!! ###########

#  	BEGINNING OF USER CODE HERE

#  	This area is for you to change so the FileMaker query matches your own query.
#  	Use the FX Class documentation for understanding more about this process...
                                                                           #
#  	To make the FX class work, the FX folder must be at the root level of your
#  	site, and you must INCLUDE the FX class into this page like this:
	require_once($_SERVER['DOCUMENT_ROOT'] . "/FX/FX.php");
	
#  	You start your query by creating a new instance of an FX Class and assigning
#  	it to a variable.
	$query = new FX(your_serverIP, 80, 'FMPro7');

#  	Using the same variable call the SetDBPassword (if necessary) using the pass-
#  	word and username that has the fmxml extended privilege.
	$query->SetDBPassword(your_password, your_username);

#  	Using the new variable $query, call the SetDBData function, specifying which
#	FMP file, layout and how many you want in the returned set (this example
#	shows how to limit the result record set to 3).
	$query->SetDBData(your_fm7File, your_layout, 3);

#  	Using the same variable call the AddDBParam to specify your serach criteria,
#  	passing it the field name and the match content (you can repeat this function
# 	as many times as you wish to add find requests).
	$query->AddDBParam(your_fieldname, your_find_criteria);
 
#  	If you want to sort the result, us the AddSortParam  function and specify  the
#  	field and  the direction  (ascend/descend) of  your sort (you can repeat this
#  	function as many times as you wish for each sort request).  Uncomment this
#	this function line and add your field name to sort your find results.
#   $query->AddSortParam(your_sort_field_name, 'ascend');

#  	The last function is  FMFind which  is assigned  to a new variable. NOTE: You
#  	must assigned this to the a variable named $queryResult  for the FX Parser to
#  	be able to recognize the found set...
    $queryResult = $query->FMFind();
    
#	Now load this page and FX Parser will give you a graphical display of your
#	results.  Click on the "Array" links to drill down into the the result.

#	Have fun!

#  END OF USER CODE HERE

#  You do not need to alter anymore code for the parser to work
# --------------------------------------------------------------------------------


# -------------------------------------------------------------------------------- #
#      Parser Code - Please Read!                                                  #
#                                                                                  #
#      Unless you are familiar with PHP, CSS, XHTML  or Javascript DO NOT          #
#      alter code beneath this comment OR you may inadvertantly BREAK the          #
#      parser.                                                                     #
# -------------------------------------------------------------------------------- #


# Element descriptions - displayed during an FMFind query as a guide to the user 



    $leveldescriptions['data'][1]               ='contains an array for each record found';
    $leveldescriptions['data'][2]               ='contains an array for each field on the layout';
    $leveldescriptions['data'][3]               ='contains an array which holds the filemaker data';
    $leveldescriptions['data'][4]               ='a one element array where key=0 and value=the data';
    $leveldescriptions['linkNext'][1]           ='contains a link to Next Records in Found Set';
    $leveldescriptions['linkPrevious'][1]       ='contains a link to Previous Records in Found Set';
    $leveldescriptions['foundCount'][1]         ='contains number of records in Found Count';
    $leveldescriptions['fields'][1]             ='contains an array for each Field on current layout';
    $leveldescriptions['fields'][2]             ='contains an array of 5 field definition attributes';
    $leveldescriptions['fields']['emptyok']     ='from the \'Not empty\' checkbox in definitions->options->validation';
    $leveldescriptions['fields']['maxrepeat']   ='\'maximum number of repitions\' from deifinitions->options->storage';
    $leveldescriptions['fields']['name']        ='field name as defined in FileMaker';
    $leveldescriptions['fields']['type']        ='field type as defined in filemaker';
    $leveldescriptions['fields']['extra']       ='currently not used';
    $leveldescriptions['URL'][1]                ='contains the URL used by FX to obtain current data set';
    $leveldescriptions['errorCode'][1]          ='contains the error number and it\'s corresponding FileMaker description';
    $leveldescriptions['valueLists'][1]         ='contains value list info for current Layout (FMView only)';

?>

<html xmlns="http:#www.w3.org/1999/xhtml">
<head>
    <title>FX Parser</title>
    <meta name="generator" content="BBEdit 7.1.3" />
    <!-- BBEdit! is there any other intelegent life on earth? -->

    <style type="text/css">
        body {
            margin:0px;
            background-image:url('bkgd0.gif');
        }

        .title {
            border:1px solid #888888;
            padding:5px;
            color:#400000;
            font: italic small-caps 900 12px arial;
            text-align:center;
            text-shadow: 0pt 3pt 4pt #888888;
            background-image:url('bkgd1.gif');
        }

        .intro {
            padding:10px 20px 0px 98px;
            color:#400000;
            font: normal small-caps 100 12px arial;
        }

        .mode {
            color:#E2E9EF;
            line-height:29px;
            vertical-align:middle;
            font: normal small-caps 900 14px arial;
            text-align:center;
            background-image:url(img3.gif);
            position:absolute;
            top:26px;
            left:95px;
            width:216px;
        }

        .mode a{
            line-height:29px;
            color:#677885;
            text-decoration:none;
        }

        .mode a:link{
            line-height:29px;
            color:#677885;
        }

        .mode a:visited{
            line-height:29px;
            color:#677885;
        }

        .mode a:hover{
            line-height:29px;
            color:#677885;
            text-decoration:underline;
        }

        .normalBold {
            color:#000000;
            font: normal 900 12px geneva;
        }

        a{
            color:#A11A2A;
            text-decoration: none;
        }

        a:link{
            color:#A11A2A;
            text-decoration: none;
        }

        a:visited{
            color:#A11A2A;
            text-decoration: none;
        }

        /********       graphic 1       ********/
        .graphic1content {
            padding:20px 8px;
        }

        .graphic1key {
            vertical-align:top;
            background-image:url(bkgd6.gif);
            background-repeat:no-repeat;
            background-color:#899EAF;
            color:#FFFFFF;
            text-shadow: 1pt 1pt 3pt #8F9EFF;
            font: normal small-caps 800 12px arial;
            padding:2px 4px 2px 4px;
            border-top:2px solid #FFFFFF;
            border-left:2px solid #FFFFFF;
            border-bottom:2px solid #9F9F9F;
        }
        .graphic1info {
            padding:2px 0px 2px 8px;
            font: italic small-caps 100 12px arial;
            color:#515151;
            text-shadow:none;
            background-image:url('bkgd2.gif');
            border-top:2px solid #FFFFFF;
            border-left:2px solid #FFFFFF;
            border-right:2px solid #9F9F9F;
        }
        .graphic1value {
            min-width:160px;
            padding:6px 0px 6px 10px;
            font: normal 100 11px Lucida Grande, Verdana, Arial, Helvetica, sans-serif;
            color:#111111;
            background-color:#ffffff;
            border-right:2px solid #9F9F9F;
            border-bottom:2px solid #9F9F9F;
        }
        .graphic1array {
            min-width:160px;
            color:#A11A2A;
            font: normal small-caps 900 12px arial;
            padding:3px 0px 1px 0px;
            background-image:url(img1.gif);
            background-repeat:no-repeat;
            background-color:#899EAF;
            border-right:2px solid #9F9F9F;
            border-bottom:2px solid #9F9F9F;
        }

        /********       graphic 2       ********/
        .graphic2content {
            margin-right:10px;
        }
        .graphic2key {
            vertical-align:top;
            background-image:url(bkgd7.gif);
            background-repeat:no-repeat;
            background-color:#AF899F;
            color:#FFFFFF;
            text-shadow: 1pt 1pt 3pt #8F9EFF;
            font: normal small-caps 800 12px arial;
            padding:2px 4px 2px 4px;
            border-top:2px solid #FFFFFF;
            border-left:2px solid #FFFFFF;
            border-bottom:2px solid #875B73;
        }
        .graphic2info {
            padding:2px 0px 2px 8px;
            font: italic small-caps 100 12px arial;
            color:#919191;
            text-shadow:none;
            background-image:url('bkgd1.gif');
            border-top:2px solid #FFFFFF;
            border-left:2px solid #FFFFFF;
            border-right:2px solid #875B73;
        }
        .graphic2value {
            min-width:160px;
            padding:6px 0px 6px 10px;
            font: normal 100 11px Lucida Grande, Verdana, Arial, Helvetica, sans-serif;
            color:#111111;
            background-color:#ffffff;
            border-right:2px solid #875B73;
            border-bottom:2px solid #875B73;
        }
        .graphic2array {
            min-width:160px;
            color:#A11A2A;
            font: normal small-caps 900 12px arial;
            padding:3px 0px 1px 0px;
            background-image:url(img2.gif);
            background-repeat:no-repeat;
            background-color:#AF899F;
            border-right:2px solid #875B73;
            border-bottom:2px solid #875B73;
        }

        /********       graphic 3       ********/
        .graphic3content {
            margin-right:10px;
        }
        .graphic3key {
            vertical-align:top;
            background-image:url(bkgd8.gif);
            background-repeat:no-repeat;
            background-color:#89AF94;
            color:#FFFFFF;
            text-shadow: 1pt 1pt 3pt #8F9EFF;
            font: normal small-caps 800 12px arial;
            padding:2px 4px 2px 4px;
            border-top:1px solid #FFFFFF;
            border-left:1px solid #FFFFFF;
            border-bottom:1px solid #236235;
        }
        .graphic3info {
            padding:2px 0px 2px 8px;
            font: italic small-caps 100 12px arial;
            color:#919191;
            text-shadow:none;
            background-image:url('bkgd1.gif');
            border-top:1px solid #FFFFFF;
            border-left:1px solid #FFFFFF;
            border-right:1px solid #236235;
        }
        .graphic3value {
            min-width:160px;
            padding:6px 0px 6px 10px;
            font: normal 100 11px Lucida Grande, Verdana, Arial, Helvetica, sans-serif;
            color:#111111;
            background-color:#ffffff;
            border-right:1px solid #236235;
            border-bottom:1px solid #236235;
        }
        .graphic3array {
            min-width:160px;
            color:#A11A2A;
            font: normal small-caps 900 12px arial;
            padding:3px 0px 1px 0px;
            background-image:url(img4.gif);
            background-repeat:no-repeat;
            background-color:#89AF94;
            border-right:1px solid #236235;
            border-bottom:1px solid #236235;
        }

        /********       graphic 4       ********/
        .graphic4content {
            margin-right:10px;
        }
        .graphic4key {
            vertical-align:top;
            background-image:url(bkgd9.gif);
            background-repeat:no-repeat;
            background-color:#9A89AF;
            color:#FFFFFF;
            text-shadow: 1pt 1pt 3pt #8F9EFF;
            font: normal small-caps 800 12px arial;
            padding:2px 4px 2px 4px;
            border-top:1px solid #FFFFFF;
            border-left:1px solid #FFFFFF;
            border-bottom:1px solid #735E8F;
        }
        .graphic4info {
            padding:2px 0px 2px 8px;
            font: italic small-caps 100 12px arial;
            color:#919191;
            text-shadow:none;
            background-image:url('bkgd1.gif');
            border-top:1px solid #FFFFFF;
            border-left:1px solid #FFFFFF;
            border-right:1px solid #735E8F;
        }
        .graphic4value {
            min-width:160px;
            padding:6px 0px 6px 10px;
            font: normal 100 11px Lucida Grande, Verdana, Arial, Helvetica, sans-serif;
            color:#111111;
            background-color:#ffffff;
            border-right:1px solid #735E8F;
            border-bottom:1px solid #735E8F;
        }
        .graphic4array {
            min-width:160px;
            color:#A11A2A;
            font: normal small-caps 900 12px arial;
            padding:3px 0px 1px 0px;
            background-image:url(img5.gif);
            background-repeat:no-repeat;
            background-color:#9A89AF;
            border-right:1px solid #735E8F;
            border-bottom:1px solid #735E8F;
        }

        /********      text Styles    ********/
        .textcontent {
            margin:38px 8px;
            vertical-align:top;
            background-color:#FEFEFE;
            color:#FFFFFF;
            font-family:monaco;
            font-weight:100;
            font-size:10px;
            border-top:2px solid #FFFFFF;
            border-left:2px solid #FFFFFF;
            border-bottom:2px solid #9F9F9F;
        }

        .textdata {
            border:1px solid slategray;
            vertical-align:top;
            padding:20px;
        }

    </style>
    <script language="javascript" type="text/javascript">

        // This is the toggle switch used for each nested array.  It
        // allows the user to drill down into any array and disclose
        // the hidden structure of the data set...
        function display_array (block, close, open) {

            close = document.getElementById(close);
            open = document.getElementById(open);
            array_details = document.getElementById(block);

            if(array_details.style.display=='block' || !array_details.style.display){

                  array_details.style.display = 'none';
                  close.style.display = 'none';
                  open.style.display = 'block';

            } else {

                  array_details.style.display = 'block';
                  close.style.display = 'block';
                  open.style.display = 'none';

            }

        }

        // This is the toggle switch located at the top of the page, it
        // allows the user to choose between a graphical/block type  of
        // display, or a text only display of the parsed array...
        function toggle_mode(mode, graphicblock, textblock) {
            graphic_box = document.getElementById(graphicblock);
            text_box = document.getElementById(textblock);
            if(mode == 'graphic') {
                graphic_box.style.display = 'block';
                text_box.style.display = 'none';
            } else {
                graphic_box.style.display = 'none';
                text_box.style.display = 'block';
            }
        }

    </script>
</head>
<body>
    <div class="title">Welcome to the FX Parser!</div>
    <div class="mode"><a id="graphic_link" href="javascript:toggle_mode('graphic','graphic_details','text_details');">graphical</a> | <a id="text_link" href="javascript:toggle_mode('text','graphic_details','text_details');">text only</a></div>
    <div class="graphic1content" style="display:block;" id='graphic_details'>
<!-- beg 1st graphic -->
        <div class="intro">
            <p>This utility is designed to help you visualy understand the array structure of an FX Class data set.  When you perform a find using the FX Class, an array containing the found set is assigned to a variable.  That variable is now a multi-dimensional array, with each element in the array containing a key (like a record id) and a value (like a number, text or even another array).</pre></p>
            <p>Use this utility to display your resulting array, click an array value and display its resulting elements.  Use the text only link at top to see a simple parsing of the array in text.  This utility should help in understanding arrays, PHP and the FX Class documentation.</p>
        </div>
        <table cellspacing="0" cellpadding="0" border="0" width="100%">
<?php
    foreach($queryResult as $key1=>$value1) {
        if(is_array($value1)) {
?>
            <tr class="graphic1head">
                <td class="graphic1key" rowspan="2"><?=$key1?></td>
                <td class="graphic1info"><?=$leveldescriptions[$key1][1]?></td>
            </tr>
            <tr class="graphic1value">
                <td class="graphic1array">
                    <a style="display:none;padding-left:24px;" id="<?=$key1?>_close" href="javascript:display_array('<?=$key1?>_arraydetails','<?=$key1?>_close','<?=$key1?>_open')" title="Hide <?=$key1?> contents"><?=$value1?></a>
                    <a style="display:block;padding-left:24px;" id="<?=$key1?>_open" href="javascript:display_array('<?=$key1?>_arraydetails','<?=$key1?>_close','<?=$key1?>_open')" title="Show <?=$key1?> contents"><?=$value1?></a>
    <!-- beg <?=$key1?> 2nd graphic -->
                    <div class="graphic2content" style="display: none;" id='<?=$key1?>_arraydetails'>
                        <br />
                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
<?php
            foreach($value1 as $key2=>$value2) {
                if(is_array($value2)) {
?>
                            <tr class="graphic2head">
                                <td class="graphic2key" rowspan="2"><?=$key2?></td>
                                <td class="graphic2info" width="100%"><?=$leveldescriptions[$key1][2]?></td>
                            </tr>
                            <tr class="graphic2value">
                                <td class="graphic2array">
                                    <a style="display:none;padding-left:24px;" id="<?=$key2?>_close" href="javascript:display_array('<?=$key2?>_arraydetails','<?=$key2?>_close','<?=$key2?>_open')" title="Hide <?=$key2?> contents"><?=$value2?></a>
                                    <a style="display:block;padding-left:24px;" id="<?=$key2?>_open" href="javascript:display_array('<?=$key2?>_arraydetails','<?=$key2?>_close','<?=$key2?>_open')" title="Show <?=$key2?> contents"><?=$value2?></a>
        <!-- beg <?=$key2?> 3rd graphic -->
                                    <div class="graphic3content" style="display: none;" id='<?=$key2?>_arraydetails'>
                                        <br />
                                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
<?php
                    foreach($value2 as $key3=>$value3) {
                        if(is_array($value3)) {
?>
                                            <tr class="graphic3head">
                                                <td class="graphic3key" rowspan="2"><?=$key3?></td>
                                                <td class="graphic3info" width="100%"><?php if($key1=='fields') echo $leveldescriptions[$key1][$key3]; else echo $leveldescriptions[$key1][3];?></td>
                                            </tr>
                                            <tr class="graphic3value">
                                                <td class="graphic3array" width="100%">
                                                    <a style="display:none;padding-left:24px;" id="<?=$key2?>_<?=$key3?>_close" href="javascript:display_array('<?=$key2?>_<?=$key3?>_arraydetails','<?=$key2?>_<?=$key3?>_close','<?=$key2?>_<?=$key3?>_open')" title="Hide <?=$key2?>_<?=$key3?> contents"><?=$value3?></a>
                                                    <a style="display:block;padding-left:24px;" id="<?=$key2?>_<?=$key3?>_open" href="javascript:display_array('<?=$key2?>_<?=$key3?>_arraydetails','<?=$key2?>_<?=$key3?>_close','<?=$key2?>_<?=$key3?>_open')" title="Show <?=$key2?>_<?=$key3?> contents"><?=$value3?></a>
            <!-- beg <?=$key3?> 4th graphic -->
                                                    <div class="graphic4content" style="display: none;" id='<?=$key2?>_<?=$key3?>_arraydetails'>
                                                        <br />
                                                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
<?php
                            foreach($value3 as $key4=>$value4) {
                                    if(is_array($value4)) {
?>
                                                            <tr class="graphic4head">
                                                                <td class="graphic4key" rowspan="2"><?=$key4?></td>
                                                                <td class="graphic4info" width="100%" NOWRAP><?=$leveldescriptions[$key1][4]?></td>
                                                            </tr>
                                                            <tr class="graphic4value">
                                                                <td class="graphic4array" width="100%">
                                                                    <a style="display:none;padding-left:24px;" id="<?=$key4?>_close" href="javascript:display_array('<?=$key4?>_arraydetails','<?=$key4?>_close','<?=$key4?>_open')" title="Hide <?=$key4?> contents"><?=$value4?></a>
                                                                    <a style="display:block;padding-left:24px;" id="<?=$key4?>_open" href="javascript:display_array('<?=$key4?>_arraydetails','<?=$key4?>_close','<?=$key4?>_open')" title="Show <?=$key4?> contents"><?=$value4?></a>
                                                                </td>
                                                            </tr>
<?php
                                        } else {
?>
                                                            <tr class="graphic4head">
                                                                <td class="graphic4key" rowspan="2"><?=$key4?></td>
                                                                <td class="graphic4info" NOWRAP><?=$leveldescriptions[$key1][4]?></td>
                                                            </tr>
                                                            <tr class="graphic4value">
                                                                    <td class="graphic4value"><?=$value4?></td>
                                                            </tr>
<?php
                                        }
?>
                                                            <tr>
                                                                <td colspan="2" style="font-size:4px;">&nbsp;</td>
                                                            </tr>
<?php
                                    }
?>
                                                        </table>

        <!-- end <?=$key3?> 4th graphic -->
                                                    </div>
                                                </td>
                                            </tr>
<?php
                        } else {
?>
                                            <tr class="graphic3head">
                                                <td class="graphic3key" rowspan="2"><?=$key3?></td>
                                                <td class="graphic3info"><?php if($key1=='fields') echo $leveldescriptions[$key1][$key3]; else echo $leveldescriptions[$key1][3];?></td>
                                            </tr>
                                            <tr class="graphic3value">
                                                    <td class="graphic3value"><?=$value3?></td>
                                            </tr>
<?php
                        }
?>
                                            <tr>
                                                <td colspan="2" style="font-size:4px;">&nbsp;</td>
                                            </tr>
<?php
                    }
?>
                                        </table>

        <!-- end <?=$key2?> 3rd graphic -->
                                    </div>
                                </td>
                            </tr>
<?php
                } else {
?>
                            <tr class="graphic2head">
                                <td class="graphic2key" rowspan="2"><?=$key2?></td>
                                <td class="graphic2info"><?=$leveldescriptions[$key1][2]?></td>
                            </tr>
                            <tr class="graphic2value">
                                    <td class="graphic2value"><?=$value2?></td>
                            </tr>
<?php
                }
?>
                            <tr>
                                <td colspan="2" style="font-size:4px;">&nbsp;</td>
                            </tr>
<?php
            }
?>
                        </table>

    <!-- end <?=$key1?> 2nd graphic -->
                    </div>
                </td>
            </tr>

<?php
        } else {
?>

<!-- end 1st graphic -->
            <tr class="graphic1head">
                <td class="graphic1key" rowspan="2"><?=$key1?></td>
                <td class="graphic1info"><?=$leveldescriptions[$key1][1]?></td>
            </tr>
            <tr class="graphic1value">
                <td class="graphic1value"><?=$value1?>
<?php
    if($key1=="errorCode" && $value1!=0)
        echo ' - <span style="color:#D76C2E;">'.$errorsList[$value1].'</span>';
?>
                </td>
            </tr>

<?php
        }
?>

<!-- 1st graphic element spacer -->
            <tr>
                <td colspan="2" style="font-size:4px;">&nbsp;</td>
            </tr>

<?php
    }
?>
        </table>
    </div>
<!-- end of graphical display -->

<!-- beg of text only display -->
    <div class="textcontent" style="display:none;" id='text_details'>
        <div class="textdata">
<?php
        foreach($queryResult as $key1=>$value1) {
            if(is_array($value1)) {
                echo '<span style="color:#415F7B;padding-left:10px;">['.$key1.'] = '.$value1.'</span> <span style="color:slategray;">('.count($value1).')</span><br>';
                foreach($value1 as $key2=>$value2) {
                    if(is_array($value2)) {
                        echo '<span style="color:#7A4A71;padding-left:110px;">['.$key2.'] = '.$value2.'</span <span style="color:slategray;">('.count($value2).')</span><br>';
                        foreach($value2 as $key3=>$value3) {
                            if(is_array($value3)) {
                                echo '<span style="color:#407850; padding-left:210px;">['.$key3.'] = '.$value3.'</span> <span style="color:slategray;">('.count($value3).')</span><br>';
                                foreach($value3 as $key4=>$value4) {
                                    if(is_array($value4)) {
                                        echo '<span style="color:#59427C; padding-left:3100px;">['.$key4.'] = '.$value4.'</span> <span style="color:slategray;">('.count($value4).')</span><br>';
                                        foreach($value4 as $key5=>$value5)
                                            echo '<span style="color:orange;padding-left:410px;">['.$key5.'] = '.$value5.'</span> <span style="color:slategray;">('.count($value5).')</span><br>';
                                    } else {
                                        echo '<span style="color:#59427C;padding-left:310px;">['.$key4.'] = '.$value4.'</span><br>';
                                    }
                                }
                            } else {
                                echo '<span style="color:#407850; padding-left:210px;">['.$key3.'] = '.$value3.'</span><br>';
                            }
                        }
                    } else {
                        echo '<span style="color:#7A4A71;padding-left:110px;">['.$key2.'] = '.$value2.'</span><br>';
                    }
                }
            } else {
                echo '<span style="color:#415F7B;padding-left:10px;">['.$key1.'] = '.$value1.'</span><br>';
            }
        }
?>
        </div>
    </div>
<!-- end of text only display -->
</body>
</html>