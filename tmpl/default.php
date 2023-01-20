<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_infographic
 *
 * @copyright   Copyright (C) NPEU 2023.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;


$doc = JFactory::getDocument();


$css_file = $params->get('css_file', false);
#echo '<pre>'; var_dump($css_file); echo '</pre>';exit;
if ($css_file) {
    #$css_file_base64 = 'data:text/css;base64,' . base64_encode($css_file);
    #$css_file_base64 = '/modules/mod_infographic/serve_css.php?c=' . urlencode(base64_encode($css_file));
    #$css_file_base64 = '/modules/mod_infographic/serve_css.php?c=' . base64_encode(htmlentities($css_file));
    #$css_file_base64 = '/modules/mod_infographic/serve_css.php?mod_title=' .$module->title;
    $css_file = '/modules/mod_infographic/serve_css.php?mod_id=' .$module->id;
    $doc->addStyleSheet($css_file);
}

$css_inline = $params->get('css_inline', false);
if ($css_inline) {
    $doc->addStyleDeclaration($css_inline);
}

?>

<?php if ($module->showtitle): ?>
<<?php echo $params->get('header_tag'); ?>><?php echo $module->title; ?></<?php echo $params->get('header_tag'); ?>>
<?php endif; ?>
<?php echo $module->content; ?>