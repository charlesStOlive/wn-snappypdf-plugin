<?php namespace Waka\SnappyPdf;

use Backend;
use Backend\Models\UserRole;
use System\Classes\PluginBase;
use App;

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
     * Registers any backend permissions used by this plugin.
     */
    public function registerPermissions(): array
    {
        return []; // Remove this line to activate
    }

    /**
     * Registers backend navigation items for this plugin.
     */
    public function registerNavigation(): array
    {
        return []; // Remove this line to activate

        return [
            'snappypdf' => [
                'label'       => 'waka.snappypdf::lang.plugin.name',
                'url'         => Backend::url('waka/snappypdf/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['waka.snappypdf.*'],
                'order'       => 500,
            ],
        ];
    }
}
