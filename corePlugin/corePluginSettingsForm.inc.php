<?php

/**
 * The following code is a derivative work of the code from 
 *         plugins/generic/piwik/PiwikSettingsForm.inc.php
 * Copyright (c) 2003-2013 John Willinsky
 * 
 * Copyright (c) 2012 Samuel Pearce (samuel.pearce@open.ac.uk)
 * Distributed under the GNU GPL v2.
 * 
 */

import('form.Form');

class corePluginSettingsForm extends Form {

	var $journalId;

	var $plugin;

	function corePluginSettingsForm(&$plugin, $journalId) {
             
		$this->journalId = $journalId;
		$this->plugin = &$plugin;
		parent::Form($plugin->getTemplatePath() . 'settingsForm.tpl');

		$this->addCheck(new FormValidator($this, 'coreApiKey', 'required', 'plugins.generic.corePlugin.manager.settings.coreApiKeyRequired'));
   		$this->addCheck(new FormValidator($this, 'corePluginTitle', 'required', 'plugins.generic.corePlugin.manager.settings.corePluginTitle'));

	}
    
	function initData() {
		$journalId = $this->journalId;
		$plugin = &$this->plugin;

		$this->_data = array(
			'coreApiKey' => $plugin->getSetting($journalId, 'coreApiKey'),
            'corePluginTitle' => $plugin->getSetting($journalId, 'corePluginTitle'),
		);
	}

	function readInputData() {
		$this->readUserVars(array('coreApiKey', 'corePluginTitle'));
	}

	function execute() {
		$plugin = &$this->plugin;
		$journalId = $this->journalId;

		$plugin->updateSetting($journalId, 'coreApiKey', $this->getData('coreApiKey'));
        $plugin->updateSetting($journalId, 'corePluginTitle', $this->getData('corePluginTitle'));

	}
}

?>
