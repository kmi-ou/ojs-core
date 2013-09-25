<?php

/**
 * @file plugins/generic/piwik/PiwikSettingsForm.inc.php
 *
 * 
 * Copyright (c) 2003-2013 John Willinsky
 *
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class PiwikSettingsForm
 * @ingroup plugins_generic_piwik
 *
 * @brief Form for journal managers to modify piwik plugin settings
 */


import('form.Form');

class corePluginSettingsForm extends Form {

	/** @var $journalId int */
	var $journalId;

	/** @var $plugin object */
	var $plugin;

	/**
	 * Constructor
	 * @param $plugin object
	 * @param $journalId int
	 */
	function corePluginSettingsForm(&$plugin, $journalId) {
             
		$this->journalId = $journalId;
		$this->plugin = &$plugin;
		parent::Form($plugin->getTemplatePath() . 'settingsForm.tpl');

		$this->addCheck(new FormValidator($this, 'coreApiKey', 'required', 'plugins.generic.corePlugin.manager.settings.coreApiKeyRequired'));
   		$this->addCheck(new FormValidator($this, 'corePluginTitle', 'required', 'plugins.generic.corePlugin.manager.settings.corePluginTitle'));

	}
    

	/**
	 * Initialize form data.
	 */
	function initData() {
		$journalId = $this->journalId;
		$plugin = &$this->plugin;

		$this->_data = array(
			'coreApiKey' => $plugin->getSetting($journalId, 'coreApiKey'),
            'corePluginTitle' => $plugin->getSetting($journalId, 'corePluginTitle'),
		);
	}

	/**
	 * Assign form data to user-submitted data.
	 */
	function readInputData() {
		$this->readUserVars(array('coreApiKey', 'corePluginTitle'));
	}

	/**
	 * Save settings.
	 */
	function execute() {
		$plugin = &$this->plugin;
		$journalId = $this->journalId;

		$plugin->updateSetting($journalId, 'coreApiKey', $this->getData('coreApiKey'));
        $plugin->updateSetting($journalId, 'corePluginTitle', $this->getData('corePluginTitle'));

	}
}

?>
