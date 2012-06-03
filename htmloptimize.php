<?php defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');

class plgSystemHtmloptimize extends JPlugin
{

	function plgSystemHtmloptimize(&$subject, $config)
	{
		parent::__construct($subject, $config);
	}

	function onAfterRender()
	{
		$app = JFactory::getApplication();

		if ($app->isAdmin()) {
			return;
		}


		// Remove HTML comments, double new lines, double carriage returns and tabs.
		$buffer = preg_replace("/<!--[a-zA-Z0-9- ]*-->|[\n|\r]{2,}|\t/","",$buffer);

		JResponse::setBody($buffer);

		return true;
		
	}
}

