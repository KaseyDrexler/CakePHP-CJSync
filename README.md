CakePHP-CJSync v 0.0.1
==============

Author: Kasey Drexler kdrexler@kdrexler.com
CakePHP Target Version: 2.0 +
Date: 1/19/2014

A CakePHP Plugin for importing Commission Junction Ads Automatically.
You can then create Ad Pools that will rotate between all ads in the pool.




You will need to do a couple of things to get the plugin to work.

1. Add the following line to your app/Config/bootstrap.php file

CakePlugin::load(array('CJSync'));

2. Modify the core.php file in the plugin to use your CJ authentication code. 
Open CJSync/Config/core.php and modify Configure::write('CJ.Authorization', ''); 
To include your code.

3. Include cjsync.js in your layout. Put the following code in your defautl.ctp layout


		echo $this->Html->script('CJSync.cjsync');

3. Run tables.sql to create the three needed tables.

4. Create some sort of security. I put a check to see if the "admin" session variable exists in /CJSync/Controller/AdsController.php beforeFilter function.
You will need to populate that session variable or delete the check in the beforeFilter function of the AdsController.php.
Navigate to http://yoursite/Ads/index

5. Sync the ads to your database from the interface.

6. Create Ad pools from a list of ads you choose. Then view the pool for directions on how to include the ad rotator.