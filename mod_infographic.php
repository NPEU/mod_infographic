<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_infographic
 *
 * @copyright   Copyright (C) NPEU 2023.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

// Include the infographic functions only once
JLoader::register('ModInfographicHelper', __DIR__ . '/helper.php');

#$thing = trim($params->get('thing'));

#$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');

require JModuleHelper::getLayoutPath('mod_infographic', $params->get('layout', 'default'));