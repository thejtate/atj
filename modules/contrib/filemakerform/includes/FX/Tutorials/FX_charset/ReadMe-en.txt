About FX_charaset

2005/1/28
Masayuki Nii (msyk@msyk.net)

We can be able to access the FileMaker database from PHP by using FX.php (created by Chris Hansen). FX_charset is the wrapper class of FX.php.
http://www.iviking.org/FX.php/

On non-English language site, Unicode is the one choice of the character set for the pages, especially UTF-8. By using FX.php Ver.3.0 or later and FileMaker Server 7 Advanced, we can treat Japanese collect for setting UTF-8 in the HTTP character set header. But the non-ASCII characters are written as character reference(&#12345) on the HTML source of the pages. We can't read as the character on the HTML source. In normal web browser pages, we need not to mind that. If we want to process as php string, write to log file, or to connect the other db engines, it's the problem.

FX_charset class resolves this problem. We can specify the character set of the pages. So we can read the contents of HTML source as characters.


<<How To Use The Demo DB>>
You publish the FileMaker database file 'Book_List.fp7' by FileMaker Server 7 Advanced. The admin and guest user can fully access all resources in the db. Please be careful.
And you must copy the FX_charaset folder to public area by the web server. Then you open the index-utf8.php or index-euc-jp.php from web browser. Each page is only different in character set of the page.
index-fx.php/detail-fx.php are using FX class in FX.php, and not use the FX_charset. Please look the end of detail-fx.php page by selecting the Japanese character book title. FX.php represents the non-ASCII character as the reference characters ( like that &#nnnnn ). If we use for only html displaying, It's no problem. But if we need to process the strings from FileMaker DB in PHP program, the problem occurs. One character in php string is not real one character in data.


<<How To User The FX_charset Class>>
So FX_charset.php is the wrapper class of FX.php, the usage of the class is same as FX.php except the following.

- For generating the class, use ' new FX_charset(...) '.

- If the return value of the constructor of FX_charset, You must call the following methods. The example is for Japanese language.

FileMaker Server 7 Advanced/The character set of the page is UTF-8
$fx = new FX_charset( ... );
// You need not call further methods anymore.

FileMaker Server 7 Advanced/The character set of the page is EUC-JP
$fx = new FX_charset( ... );
$fx->SetCharacterEncoding('EUC-JP');
$fx->SetDataParamsEncoding('utf8');

FileMaker Pro 6/Unlimited/The character set of the page is UTF-8
$fx = new FX_charset( ... );
$fx->SetCharacterEncoding('utf8');
$fx->SetDataParamsEncoding('SJIS');

FileMaker Pro 6/Unlimited/The character set of the page is EUC-JP
$fx = new FX_charset( ... );
$fx->SetCharacterEncoding('EUC-JP');
$fx->SetDataParamsEncoding('SJIS');

<<etc>>
FX_charset.php includes FX.php. For including, it assumes FX.php resides in the FX folder that exists the same folder as FX_charaset.php file. On the other word, FX_charaset.php includes FX.php by relative path as 'FX/FX.php'.

The contents of the FX folder are same as original FX.php Ver.3.1(2004/12/28).

The license of FX_charset is same as FX.php.
