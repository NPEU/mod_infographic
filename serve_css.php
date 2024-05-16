<?php

use Joomla\CMS\Factory;
#use Joomla\CMS\Plugin\PluginHelper;
use Joomla\Registry\Registry;

if (empty($_GET['mod_id'])) {
    die;
}

if (!is_numeric($_GET['mod_id'])) {
    die;
}

//if (empty($_GET['mod_title'])) {
//    die;
//}

//if (!is_numeric($_GET['mod_name'])) {
//    die;
//}


// Set up Joomla User stuff:
define('DS', DIRECTORY_SEPARATOR);
$base_path = realpath(dirname(dirname(__DIR__)));
define('BASE_PATH', $base_path . DS);
#echo "<pre>"; var_dump(BASE_PATH); echo "</pre>"; exit;

define('_JEXEC', 1);

//If this file is not placed in the /root directory of a Joomla instance put the directory for Joomla libraries here.
$joomla_directory = BASE_PATH;

// From https://joomla.stackexchange.com/questions/33140/how-to-create-an-instance-of-the-joomla-cms-from-the-browser-or-the-command-line
// Via: https://joomla.stackexchange.com/questions/33389/standalone-php-script-to-get-username-in-joomla-4
/**---------------------------------------------------------------------------------
 * Part 1 - Load the Framework and set up up the environment properties
 * -------------------------------------------------------------------------------*/

/**
 *  Site - Front end application when called from Browser via URL.
*/                                                  // Remove this '*/' to comment out this block
define('JPATH_BASE', (isset($joomla_directory)) ? $joomla_directory : __DIR__ );
require_once JPATH_BASE . '/includes/defines.php';
require_once JPATH_BASE . '/includes/framework.php';
$class_name             =  new \Joomla\CMS\Application\SiteApplication;
$session_alias          = 'session.web';
$session_suffix         = 'web.site';
/** end Site config */

/**---------------------------------------------------------------------------------
 * Part 2 - Start the application from the container ready to be used.
 * -------------------------------------------------------------------------------*/
// Boot the DI container
$container = \Joomla\CMS\Factory::getContainer();

// Alias the session service key to the web session service.
$container->alias($session_alias, 'session.' . $session_suffix)
          ->alias('JSession', 'session.' . $session_suffix)
          ->alias(\Joomla\CMS\Session\Session::class, 'session.' . $session_suffix)
          ->alias(\Joomla\Session\Session::class, 'session.' . $session_suffix)
          ->alias(\Joomla\Session\SessionInterface::class, 'session.' . $session_suffix);

// Instantiate the application.
$app = $container->get($class_name::class);
// Set the application as global app
\Joomla\CMS\Factory::$application = $app;



$db = Factory::getDbo();

$query = $db->getQuery(true);
$query->select('m.*');
$query->from('#__modules AS m');
$query->where('id = ' . $_GET['mod_id']);
//$query->where('id = ' . Request::getInt('mod_id'));
$db->setQuery($query);
$module = $db->loadObject();
$params = new Registry;
$params->loadString($module->params);

#echo '<pre>'; var_dump($params); echo '</pre>';exit;

#$css = base64_decode(urldecode($_GET['c']));
#$css = html_entity_decode(base64_decode($_GET['c']));
$css = $params->get('css_file');

header('Content-type: text/css');
echo $css;
exit;