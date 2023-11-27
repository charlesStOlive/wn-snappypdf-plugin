<?php

namespace Waka\SnappyPdf\Classes;

use \Waka\Productor\Classes\Abstracts\BaseProductor;
use Waka\Productor\Interfaces\SaveTo;
use Waka\Productor\Interfaces\Show;
use Closure;
use Lang;
use Arr;
use ApplicationException;
use ValidationException;


class Pdfer extends BaseProductor
{
    public static $config = [
            'label' => 'waka.snappypdf::lang.driver.label',
            'icon' => 'icon-file-pdf',
            'description' => 'waka.snappypdf::lang.driver.description',
            'productorModel' => \Waka\SnappyPdf\Models\Pdf::class,
            'productorCreator' => \Waka\SnappyPdf\Classes\PdfCreator::class,
            'productorFilesRegistration' =>  'registerSnappyPdfFileTemplates',
            'productor_yaml_config' => '~/plugins/waka/snappypdf/models/pdf/productor_config.yaml',
            'methods' => [
                'prepareDownloadPdf' => [
                    'label' => 'télecharger un PDF',
                    'handler' => 'prepareDownloadPdf',
                ],
            ],
        ];


    

    public function prepareDownloadPdf($templateCode, $allDatas):array {
        $this->getBaseVars($allDatas);
        
        $link = self::saveTo($templateCode, $this->data, function($pdf) use($allDatas) {
            $pdf->setOutputName(\Arr::get($allDatas, 'productorDataArray.output_name'));
        });
        return [
            'message' => 'waka.snappypdf::lang.driver.execute.success',
            'btn' => [
                'label' => 'waka.productor::lang.drivers.success_label.close_download',
                'request' => 'onCloseAndDownload',
                'link' => $link
            ],
        ];
    }

    public static function saveTo(string $templateCode, array $vars, Closure $callback = null) {
        // Créer l'instance de pdf
        $creator = self::instanciateCreator($templateCode, $vars);

        // Appeler le callback pour définir les options
        if (is_callable($callback)) {
            $callback($creator);
        }

        try {
            return $creator->saveTo();
        } catch (\Exception $ex) {
            throw new \ApplicationException($ex);
        }
        
    }

    

    /**
     * Instancieation de la class creator
     *
     * @param string $url
     * @return \Spatie\Browsershot\Browsershot
     */
    private static function instanciateCreator(string $templateCode, array $vars)
    {
        $productorClass = self::getStaticConfig('productorCreator');
        $class = new $productorClass($templateCode, $vars);
        return $class;
    }

    public static function updateFormwidget($slug, $formWidget, $config)
    {
        $productorModel = self::getProductor($slug);
        $formWidget->getField('output_name')->value = $productorModel->output_name;
        //Je n'ais pas trouvé de solution pour charger les valeurs. donc je recupère les asks dans un primer temps avec une valeur par defaut qui ne marche pas et je le réajoute ensuite.... 
        // $formWidget = self::getAndSetAsks($productorModel, $formWidget);
        return $formWidget;
    }

    
}
