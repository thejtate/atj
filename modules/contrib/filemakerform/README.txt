Version
----------
6.x beta-1

Description
-----------
Easily create forms in Drupal that submit data to Filemaker databases which are hosted on Filemaker Server.

Requirements
------------
Drupal 6.x (http://drupal.org/project/drupal)
Webform 6.x (http://drupal.org/project/webform)

Installation
------------
1. Install the Webform module

2. Copy the entire filemakerform directory to the Drupal sites/all/modules directory.

3. Login as an administrator. Enable the module in the "Administer" -> "Site
   Building" -> "Modules"


Use
------------
1. Create a webform node at node/add/webform.

2. Under the Webform => Form Settings tab you will find a fieldset titled 'Filmaker'.  
Make sure you click the enabled radio button and fill in the right Filemaker information.
The script field is optional

3. When creating form components make sure to fill in the "Filemaker field name" field with the
name of the corresponding Filemaker field

4. Test

5. Be aware that editing/deleting the form submissions in Drupal will correspond with the same actions in Filemaker.

FX.php
------------
This module makes use of Chris Hansen's FX.php script to make PHP queries on a Filemaker database.  
This site is neither affiliated with nor endorsed by Chris Hansen

Support
-------
Please use the issue queue for filing bugs with this module at
http://drupal.org/project/issues/filemakerform
