<?php

namespace Waka\SnappyPdf\Classes;

use Waka\Productor\Interfaces\BaseProductor;
use Waka\Productor\Interfaces\SaveTo;
use Waka\Productor\Interfaces\Show;
use Closure;
use Lang;
use Arr;
use ApplicationException;
use ValidationException;


class Pdfer implements BaseProductor
{
    use \Waka\Productor\Classes\Traits\TraitProductor;

    public static function getConfig()
    {
        return [
            'label' => Lang::get('waka.snappypdf::lang.driver.label'),
            'icon' => 'icon-mjml',
            'description' => Lang::get('waka.snappypdf::lang.driver.description'),
            'productorModel' => \Waka\SnappyPdf\Models\Pdf::class,
            'productorCreator' => \Waka\SnappyPdf\Classes\PdfCreator::class,
            'productorFilesRegistration' =>  'registerSnappyPdfFileTemplates',
            'productor_yaml_config' => '~/plugins/waka/snappypdf/models/pdf/productor_config.yaml',
            'methods' => [
                'download' => [
                    'label' => 'télecharger un PDF',
                    'handler' => 'saveTo',
                ],
            ],
        ];
    }

    public static function updateFormwidget($slug, $formWidget)
    {
        $productorModel = self::getProductor($slug);
        $formWidget->getField('output_name')->value = $productorModel->output_name;
        //Je n'ais pas trouvé de solution pour charger les valeurs. donc je recupère les asks dans un primer temps avec une valeur par defaut qui ne marche pas et je le réajoute ensuite.... 
        $formWidget = self::getAndSetAsks($productorModel, $formWidget);
        return $formWidget;
    }

    /**
     * Instancieation de la class creator
     *
     * @param string $url
     * @return \Spatie\Browsershot\Browsershot
     */
    private static function instanciateCreator(string $templateCode, array $vars)
    {
        $productorClass = self::getConfig()['productorCreator'];
        $class = new $productorClass($templateCode, $vars);
        return $class;
    }

    public static function execute($templateCode, $productorHandler, $allDatas):array {
        $modelId = Arr::get($allDatas, 'modelId');
        $modelClass = Arr::get($allDatas, 'modelClass');
        $dsMap = Arr::get($allDatas, 'dsMap', null);
        //
        $targetModel = $modelClass::find($modelId);
        $data = [];
        if ($targetModel) {
            //trace_log($dsMap);
            $data = $targetModel->dsMap($dsMap);
        }
        if($productorHandler == "saveTo") {
            $link = self::saveTo($templateCode, $data, function($pdf) use($allDatas) {
                $pdf->setOutputName(\Arr::get($allDatas, 'productorDataArray.output_name'));
            });
            return [
                'message' => 'PDF prêt pour télechargement',
                'btn' => [
                    'label' => 'Télécharger le fichier',
                    'request' => 'onCloseAndDownload',
                    'link' => $link
                ],
            ];
        }
        return [];
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

    public static function show(string $templateCode, array $vars, Closure $callback = null) {
        // Créer l'instance de pdf
        $creator = self::instanciateCreator($templateCode, $vars);
        // Appeler le callback pour définir les options
        if (is_callable($callback)) {
            $callback($creator);
        }

        try {
            return $creator->show();
        } catch (\Exception $ex) {
            throw $ex;
        }
        
    }

    
}
