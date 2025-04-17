<?php

namespace APP\plugins\generic\customHomepage;

use PKP\plugins\GenericPlugin;
use PKP\plugins\Hook;
use APP\core\Application;

class CustomHomepagePlugin extends GenericPlugin {

    public function register($category, $path, $mainContextId = null) {
        if (parent::register($category, $path, $mainContextId)) {
            if ($this->getEnabled()) {
                Hook::add('Templates::Index::journal', [$this, 'injectHomepage']);
            }
            return true;
        }
        return false;
    }

    public function getDisplayName() {
        return __('plugins.generic.customHomepage.displayName');
    }

    public function getDescription() {
        return __('plugins.generic.customHomepage.description');
    }

    public function getPluginPath() {
        return parent::getPluginPath();
    }

    public function getTemplatePath($inCore = false) {
        return parent::getTemplatePath($inCore);
    }

    public function injectHomepage($hookName, $args) {
        $templateMgr =& $args[0]; // CORREGIDO: obtener referencia real al TemplateManager
        $templateMgr->assign('pluginPath', $this->getPluginPath());
        echo $templateMgr->fetch($this->getTemplateResource('homepage.tpl'));
        return true;
    }
    
}