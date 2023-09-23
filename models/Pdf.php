<?php namespace Waka\SnappyPdf\Models;

use Model;
use Waka\SnappyPdf\Classes\ModelFileParser;
use File as FileHelper;
use View;
/**
 * pdf Model
 */
class Pdf extends Model
{
    use \Winter\Storm\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'waka_snappypdf_pdfs';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Validation rules for attributes
     */
    public $rules = [];

    /**
     * @var array Attributes to be cast to native types
     */
    protected $casts = [];

    /**
     * @var array Attributes to be cast to JSON
     */
    protected $jsonable = [];

    /**
     * @var array Attributes to be appended to the API representation of the model (ex. toArray())
     */
    protected $appends = [];

    /**
     * @var array Attributes to be removed from the API representation of the model (ex. toArray())
     */
    protected $hidden = [];

    /**
     * @var array Attributes to be cast to Argon (Carbon) instances
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [
        'rule_asks' => [
            'Waka\WakaBlocs\Models\RuleAsk',
            'name' => 'askeable',
            'delete' => true
        ],
    ];
    public $hasOneThrough = [];
    public $hasManyThrough = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];





    public static function findBySlug($slug) {
        $model = self::where('slug', $slug)->first();
        if(!$model) {
            $model = self::findFileModels($slug);
        }
        if(!$model) {
            throw new \ApplicationException('aucun modèl etrouvé avec le code : '.$slug);
        }
        return $model;
    }




    public static function findFileModels($slug) {
        $model = null;
        if(View::exists($slug)) {
            $model = new self;
            $model->slug = $slug;
            $model->fillFromView($slug);
        } else {
            \Log::error('la modèle n existe pas dans findFileModels'. self::class);
        }
        return $model;
    }

    /**
     * Fill model using a view file path.
     *
     * @param string $path
     * @return void
     */
    public function fillFromView($path)
    {
        $this->fillFromSections(self::getFileModelSections($path));
    }

    /**
     * Fill model using provided section array.
     *
     * @param array $sections
     * @return void
     */
    protected function fillFromSections($sections)
    {
        $this->html = array_get($sections, 'html');
        //trace_log('pdf settings!',array_get($sections, 'settings'));
        $this->output_name = array_get($sections, 'settings.output_name', 'pas de titre');
        $this->has_footer = array_get($sections, 'settings.has_footer', null);
        $this->paper_width = array_get($sections, 'settings.paper_width', null);
        $this->paper_height = array_get($sections, 'settings.paper_height', null);
    }

    /**
     * Get section array from a view file retrieved by code.
     *
     * @param string $code
     * @return array|null
     */
    protected static function getFileModelSections($slug)
    {
        if (!View::exists($slug)) {
            return null;
        }
        $view = View::make($slug);
        return ModelFileParser::parse(FileHelper::get($view->getPath()));
    }
    
}
