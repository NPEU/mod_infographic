<?php

namespace NPEU\Module\Infographic\Site\Dispatcher;

use Joomla\CMS\Dispatcher\AbstractModuleDispatcher;
use Joomla\CMS\Helper\HelperFactoryAwareInterface;
use Joomla\CMS\Helper\HelperFactoryAwareTrait;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\HTML\HTMLHelper;

defined('_JEXEC') or die;

/**
 * Dispatcher class for mod_infographic
 *
 * @since  4.4.0
 */
class Dispatcher extends AbstractModuleDispatcher implements HelperFactoryAwareInterface
{
    use HelperFactoryAwareTrait;

    /**
     * Returns the layout data.
     *
     * @return  array
     */
    protected function getLayoutData(): array
    {
        $data   = parent::getLayoutData();
        $params = $data['params'];

        if (($params)->get('prepare_content', 1)) {
            ($data['module'])->content = HTMLHelper::_('content.prepare', ($data['module'])->content, '', 'mod_custom.content');
        }

        /*$data['stuff'] = $this->getHelperFactory()
            ->getHelper('InfographicHelper')
            ->getStuff($params, $this->getApplication());*/

        return $data;
    }
}
