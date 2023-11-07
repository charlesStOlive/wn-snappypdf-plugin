<?php namespace Waka\SnappyPdf;

use Backend;
use Backend\Models\UserRole;
use System\Classes\PluginBase;
use App;
use Lang;

/**
 * snappyPdf Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * @var array Plugin dependencies
     */
    public $require = [
        'Waka.Wutils',
        'Waka.Productor'
    ];

    /**
     * Returns information about this plugin.
     */
    public function pluginDetails(): array
    {
        return [
            'name'        => 'waka.snappypdf::lang.plugin.name',
            'description' => 'waka.snappypdf::lang.plugin.description',
            'author'      => 'waka',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     */
    public function register(): void
    {
        $driverManager = App::make('waka.productor.drivermanager');
        $driverManager->registerDriver('pdfer', function () {
            return new \Waka\SnappyPdf\Classes\Pdfer();
        });

    }

    /**
     * Boot method, called right before the request route.
     */
    public function boot(): void
    {

    }


    /**
     * Registers any files template for snappyPdf.
     */
    public function registerSnappyPdfFileTemplates(): array
    {
        return [
            'waka.snappypdf::pdf.test' => [
                'name' => "Test email",
            ],
        ];

    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'waka.snappypdf.admin.super' => [
                'tab' => 'Waka - Pdfer',
                'label' => 'Super administrateur de Pdfer',
            ],
            'waka.snappypdf.admin.base' => [
                'tab' => 'Waka - Pdfer',
                'label' => 'Administrateur de Pdfer',
            ],
            'waka.snappypdf.user' => [
                'tab' => 'Waka - Pdfer',
                'label' => 'Utilisateur de Pdfer',
            ],
        ];
    }

    /**
     * Registers backend navigation items for this plugin.
     */
    public function registerSettings(): array
    {
        return [
           'pdfs' => [
                'label' => Lang::get('waka.snappypdf::lang.menu.pdf.label'),
                'description' => Lang::get('waka.snappypdf::lang.menu.pdf.description'),
                'category' => Lang::get('waka.wutils::lang.menu.model_category'),
                'icon' => 'icon-file-pdf',
                'url' => Backend::url('waka/snappypdf/pdfs'),
                'permissions' => ['waka.snappypdf.admin.*'],
                'order' => 30,
            ],
        ];
    }
}
