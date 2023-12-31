<?php

namespace Waka\SnappyPdf\Classes;

use Spatie\Browsershot\Browsershot;
use \Waka\SnappyPdf\Models\Pdf;
use Closure;
use Illuminate\Support\Str;
use Waka\Wutils\Classes\TinyUuid;

class PdfCreator
{
    public $pdf;
    public $vars;
    public $outputName;
    private $options;

    public function __construct($slug,$vars, $options = [])
    {
        $this->pdf = Pdf::findBySlug($slug);
        $this->options = [];
        $this->setModelOptions();
        $this->vars = $vars;
        //trace_log('options from creator!', $options);
        $this->options = array_merge($this->options, $options);
    }

    public function saveTo() {
        //trace_log($this->pdf->toArray());
        $this->outputName = $this->outputName ?: $this->pdf->output_name;
        //trace_log('output_name',  $this->outputName);
        $finalName = \Str::slug($this->parseModelField($this->outputName, $this->vars), '_');
        //trace_log('finalName!',$finalName);
        $pdf = $this->instanciateHtmlPdf();
        $uuid = TinyUuid::generateFromDate();
        $basePath = storage_path(sprintf('app/uploads/tempproductor/%s',$uuid));
        \File::makeDirectory($basePath);
        //
        
        $path = $basePath.'/'.$finalName . '.pdf';
        $pdf->save($path);
        return $path;
    }

    public function setOutputName($outputName)
    {
        //trace_log('set ouptup name', $outputName);
        if($outputName) {
            $this->outputName = $outputName;
        }
    }

    private function setModelOptions() {
        
        if($this->pdf->has_footer) {
            $this->options['footer'] = true;
        } 
        if($paperWith = $this->pdf->paper_width) {
            $this->options['paperSize']['with'] = $paperWith;
        } 
        if($paperHeight = $this->pdf->paper_height) {
            $this->options['paperSize']['height'] = $paperHeight;
        } 
    }

    /**
     * Configure un objet Browsershot avec les options par défaut définies dans le fichier de configuration.
     *
     * @param \Spatie\Browsershot\Browsershot $browsershot
     * @return \Spatie\Browsershot\Browsershot
     */
    private function configureBrowsershot(Browsershot $browsershot)
    {
        //trace_log('configureBrowsershot this->opt!',$this->options);
        $browsershot->showBackground();
        $paperWith = $this->options['paperSize']['with'] ?? null;
        $paperHeight = $this->options['paperSize']['height'] ?? null;
        if($paperWith && $paperHeight) {
            $browsershot->paperSize($paperWith , $paperHeight, 'px' );
        }  else {
            $browsershot->paperSize(760 , 1076, 'px' );
        }
        $footer = $this->options['footer'] ?? null;
        if($footer) {
            $finalName = \Str::slug($this->parseModelField($this->outputName, $this->vars), '_');
            $browsershot->margins(0, 0, 50, 0, 'px')->showBrowserHeaderAndFooter()->footerHtml(\View::make('waka.snappypdf::pdf.footer', ['name' => $finalName]));;
        }  else {
            $browsershot->margins(0, 0, 0, 0, 'px');
        }
        $diableSecurity = $this->options['diableSecurity'] ?? false;
        if($diableSecurity) {
            $browsershot->setOption('args', ['--disable-web-security']);
        }

        return $browsershot;
    }

    /**
     * Instancie un objet Browsershot avec un template HTML et des variables.
     *
     * @param string $template
     * @param array $vars
     * @return \Spatie\Browsershot\Browsershot
     */
    private function instanciateHtmlPdf()
    {
        $html = $this->parseModelField($this->pdf->html, $this->vars);
        return $this->configureBrowsershot(Browsershot::html($html));
    }

    private function parseModelField($modelValue, $value)
    {
        if ($modelValue) {
            return \Twig::parse($modelValue, $this->vars);
        } else {
            return null;
        }
    }

    


    public function show() {
        
    }

    

    


    
}
