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
			return true;
		}

		$buffer = JResponse::getBody();

		// Remove HTML comments
		$buffer = preg_replace("/<!--[a-zA-Z0-9-.\/ ]*-->/","",$buffer);

		// Replace double new lines, double carriage returns with single occurrence.
		$buffer = preg_replace("/([\n|\r]){2,}/","$1",$buffer);

		// Remove tabs (Tabs?! We don't need no stinkin' tabs!)
		$buffer = preg_replace("/\t/","",$buffer);

		// Remove two or more leading spaces at the beginning of lines.
		$buffer = preg_replace("/(\n)\s{2,}/","$1",$buffer);

		// Remove empty lines.
		$buffer = preg_replace("/(\n)[\s\t]+</","$1<",$buffer);

		// Replace double spaces with single.
		$buffer = preg_replace("/\s{2,}/"," ",$buffer);

		JResponse::setBody($buffer);

		return true;

	}
}

