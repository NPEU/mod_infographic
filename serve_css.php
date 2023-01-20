<?php

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



//init Joomla Framework
define('_JEXEC', 1);
define('JPATH_BASE', realpath(dirname(dirname(__DIR__))) . '/administrator');



require_once JPATH_BASE . '/includes/defines.php';
require_once JPATH_BASE . '/includes/framework.php';

$app     = JFactory::getApplication('administrator');

$app->initialise(null, false);


$db = JFactory::getDbo();
$query = $db->getQuery(true);
$query->select('m.*');
$query->from('#__modules AS m');
$query->where('id = '.JRequest::getInt('mod_id'));
$db->setQuery($query);
$module = $db->loadObject();
$params = new JRegistry($module->params);


//$module = JModuleHelper::getModule('mod_infographic', urldecode($_GET['mod_title']));
//$params = new JRegistry($module->params);
#echo '<pre>'; var_dump($params); echo '</pre>';exit;

#$css = base64_decode(urldecode($_GET['c']));
#$css = html_entity_decode(base64_decode($_GET['c']));
$css = $params->get('css_file');
header('Content-type: text/css');
echo $css;
exit;