<?php
/*--------------------------------------------------------------------------------------------------------|  www.vdm.io  |------/
    __      __       _     _____                 _                                  _     __  __      _   _               _
    \ \    / /      | |   |  __ \               | |                                | |   |  \/  |    | | | |             | |
     \ \  / /_ _ ___| |_  | |  | | _____   _____| | ___  _ __  _ __ ___   ___ _ __ | |_  | \  / | ___| |_| |__   ___   __| |
      \ \/ / _` / __| __| | |  | |/ _ \ \ / / _ \ |/ _ \| '_ \| '_ ` _ \ / _ \ '_ \| __| | |\/| |/ _ \ __| '_ \ / _ \ / _` |
       \  / (_| \__ \ |_  | |__| |  __/\ V /  __/ | (_) | |_) | | | | | |  __/ | | | |_  | |  | |  __/ |_| | | | (_) | (_| |
        \/ \__,_|___/\__| |_____/ \___| \_/ \___|_|\___/| .__/|_| |_| |_|\___|_| |_|\__| |_|  |_|\___|\__|_| |_|\___/ \__,_|
                                                        | |                                                                 
                                                        |_| 				
/-------------------------------------------------------------------------------------------------------------------------------/

	@version		1.0.3
	@build			6th March, 2016
	@created		24th February, 2016
	@package		Support Groups
	@subpackage		view.html.php
	@author			Llewellyn van der Merwe <http://www.vdm.io>	
	@copyright		Copyright (C) 2015. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html 
	
	Support Groups 
                                                             
/-----------------------------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * Supportgroups View class
 */
class SupportgroupsViewSupportgroups extends JViewLegacy
{
	/**
	 * View display method
	 * @return void
	 */
	function display($tpl = null)
	{
		// Check for errors.
		if (count($errors = $this->get('Errors')))
                {
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		};
		// Assign data to the view
		$this->icons			= $this->get('Icons');
		$this->contributors		= SupportgroupsHelper::getContributors();

		// Set the toolbar
		$this->addToolBar();

		// Display the template
		parent::display($tpl);

		// Set the document
		$this->setDocument();
	}

	/**
	 * Setting the toolbar
	 */
	protected function addToolBar()
	{
		$canDo = SupportgroupsHelper::getActions('supportgroups');
		JToolBarHelper::title(JText::_('COM_SUPPORTGROUPS_DASHBOARD'), 'grid-2');

                // set help url for this view if found
                $help_url = SupportgroupsHelper::getHelpUrl('supportgroups');
                if (SupportgroupsHelper::checkString($help_url))
                {
			JToolbarHelper::help('COM_SUPPORTGROUPS_HELP_MANAGER', false, $help_url);
                }

		if ($canDo->get('core.admin') || $canDo->get('core.options'))
                {
			JToolBarHelper::preferences('com_supportgroups');
		}
	}

	/**
	 * Method to set up the document properties
	 *
	 *
	 * @return void
	 */
	protected function setDocument()
	{
		$document = JFactory::getDocument();

		$document->addStyleSheet(JURI::root() . "administrator/components/com_supportgroups/assets/css/dashboard.css");

		$document->setTitle(JText::_('COM_SUPPORTGROUPS_DASHBOARD'));
	}
}