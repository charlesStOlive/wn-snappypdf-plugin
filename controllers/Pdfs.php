<?php namespace Waka\SnappyPdf\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use System\Classes\SettingsManager; 
/**
 * Pdfs Backend Controller
 */
class Pdfs extends Controller
{
    /**
     * @var array Behaviors that are implemented by this controller.
     */
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
        \Waka\Wutils\Behaviors\WakaControllerBehavior::class,
    ];

    public $requiredPermissions = ['waka.snappypdf.admin.*'];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Winter.System', 'system', 'settings');
        SettingsManager::setContext('Waka.SnappyPdf', 'pdfs');
    }

    public function listInjectRowClass($record, $definition)
    {
        // Strike through past lessons
        if ($record->is_synced) {
            return 'nolink  disabled';
        }
    }

    public function update($id)
    {
        $this->bodyClass = 'compact-container';
        return $this->asExtension('FormController')->update($id);
    }

    
    
}
