<?php namespace Waka\SnappyPdf\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use System\Classes\SettingsManager; 
/**
 * Layouts Backend Controller
 */
class Layouts extends Controller
{
    /**
     * @var array Behaviors that are implemented by this controller.
     */
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
        \Waka\Wutils\Behaviors\WakaControllerBehavior::class,
    ];

    public $requiredPermissions = ['waka.snappypdf.admin.super'];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Winter.System', 'system', 'settings');
        SettingsManager::setContext('Waka.SnappyPdf', 'layouts');
    }

    
    
}
