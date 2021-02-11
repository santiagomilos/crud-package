<?php

namespace CrudPackage\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class MakeCrudCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crud {model : choose the model for which the crud is to be created}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a crud with the chosen model';

    public $error = false;

    public $errorMessage = "
          _____   _____   _____   _____   _____
        | | E | | | R | | | R | | | O | | | R | |
        | |___| | |___| | |___| | |___| | |___| |
        | /___\ | /___\ | /___\ | /___\ | /___\ |";

    public $successMessage = "
          _____   _____   _____   _____   _____   _____   _____
        | | S | | | U | | | C | | | C | | | E | | | S | | | S | |
        | |___| | |___| | |___| | |___| | |___| | |___| | |___| |
        | /___\ | /___\ | /___\ | /___\ | /___\ | /___\ | /___\ |";

    public $errorText = '';

    public $labels = [];

    public $optionsLabel = [
        ['option'=> 'bigIncrements', 'example'=> 'example:bigIncrements'],
        ['option'=> 'bigInteger', 'example'=> 'example:bigInteger'],
        ['option'=> 'binary', 'example'=> 'example:binary'],
        ['option'=> 'boolean', 'example'=> 'example:boolean'],
        ['option'=> 'char', 'example'=> 'example:char'],
        ['option'=> 'dateTimeTz', 'example'=> 'example:dateTimeTz'],
        ['option'=> 'dateTime', 'example'=> 'example:dateTime'],
        ['option'=> 'date', 'example'=> 'example:date'],
        ['option'=> 'decimal', 'example'=> 'example:decimal'],
        ['option'=> 'double', 'example'=> 'example:double'],
        ['option'=> 'enum', 'example'=> 'example:enum'],
        ['option'=> 'float', 'example'=> 'example:float'],
        ['option'=> 'foreignId', 'example'=> 'example:foreignId'],
        ['option'=> 'geometryCollection', 'example'=> 'example:geometryCollection'],
        ['option'=> 'geometry', 'example'=> 'example:geometry'],
        ['option'=> 'id', 'example'=> 'example:id'],
        ['option'=> 'increments', 'example'=> 'example:increments'],
        ['option'=> 'integer', 'example'=> 'example:integer'],
        ['option'=> 'ipAddress', 'example'=> 'example:ipAddress'],
        ['option'=> 'json', 'example'=> 'example:json'],
        ['option'=> 'jsonb', 'example'=> 'example:jsonb'],
        ['option'=> 'lineString', 'example'=> 'example:lineString'],
        ['option'=> 'longText', 'example'=> 'example:longText'],
        ['option'=> 'macAddress', 'example'=> 'example:macAddress'],
        ['option'=> 'mediumIncrements', 'example'=> 'example:mediumIncrements'],
        ['option'=> 'mediumInteger', 'example'=> 'example:mediumInteger'],
        ['option'=> 'mediumText', 'example'=> 'example:mediumText'],
        ['option'=> 'morphs', 'example'=> 'example:morphs'],
        ['option'=> 'multiLineString', 'example'=> 'example:multiLineString'],
        ['option'=> 'multiPoint', 'example'=> 'example:multiPoint'],
        ['option'=> 'multiPolygon', 'example'=> 'example:multiPolygon'],
        ['option'=> 'nullableMorphs', 'example'=> 'example:nullableMorphs'],
        ['option'=> 'nullableTimestamps', 'example'=> 'example:nullableTimestamps'],
        ['option'=> 'nullableUuidMorphs', 'example'=> 'example:nullableUuidMorphs'],
        ['option'=> 'point', 'example'=> 'example:point'],
        ['option'=> 'polygon', 'example'=> 'example:polygon'],
        ['option'=> 'rememberToken', 'example'=> 'example:rememberToken'],
        ['option'=> 'set', 'example'=> 'example:set'],
        ['option'=> 'smallIncrements', 'example'=> 'example:smallIncrements'],
        ['option'=> 'smallInteger', 'example'=> 'example:smallInteger'],
        ['option'=> 'softDeletesTz', 'example'=> 'example:softDeletesTz'],
        ['option'=> 'softDeletes', 'example'=> 'example:softDeletes'],
        ['option'=> 'string', 'example'=> 'example:string'],
        ['option'=> 'text', 'example'=> 'example:text'],
        ['option'=> 'timeTz', 'example'=> 'example:timeTz'],
        ['option'=> 'time', 'example'=> 'example:time'],
        ['option'=> 'timestampTz', 'example'=> 'example:timestampTz'],
        ['option'=> 'timestamp', 'example'=> 'example:timestamp'],
        ['option'=> 'timestampsTz', 'example'=> 'example:timestampsTz'],
        ['option'=> 'timestamps', 'example'=> 'example:imestamps'],
        ['option'=> 'tinyIncrements', 'example'=> 'example:tinyIncrements'],
        ['option'=> 'tinyInteger', 'example'=> 'example:tinyInteger'],
        ['option'=> 'unsignedBigInteger', 'example'=> 'example:unsignedBigInteger'],
        ['option'=> 'unsignedDecimal', 'example'=> 'example:unsignedDecimal'],
        ['option'=> 'unsignedInteger', 'example'=> 'example:unsignedInteger'],
        ['option'=> 'unsignedMediumInteger', 'example'=> 'example:unsignedMediumInteger'],
        ['option'=> 'unsignedSmallInteger', 'example'=> 'example:unsignedSmallInteger'],
        ['option'=> 'unsignedTinyInteger', 'example'=> 'example:unsignedTinyInteger'],
        ['option'=> 'uuidMorphs', 'example'=> 'example:uuidMorphs'],
        ['option'=> 'uuid', 'example'=> 'example:uuid'],
        ['option'=> 'year', 'example'=> 'example:year']
    ];


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($this->confirm('Do you wish to continue?')) {

            if ($this->confirm('do you want to create the migration fields from the console?')) {

                $labelsCount = $this->ask('how many fields do you want to create?');

                if (!is_numeric($labelsCount)) {

                    $this->line($this->errorMessage);
                    $this->newLine();
                    $this->error('error the entered value is not numeric!');

                    return  $this->error = true;
                }

                if(!$this->error){

                    $this->table(
                        ['Option name', 'usage example'],
                        $this->optionsLabel
                    );

                    for($i = 1; $i <= $labelsCount; $i++){
                        $label = $this->ask('field # '.$i.' please do it this way example:string so that everything works correctly');

                        array_push($this->labels, $label);
                    }
                }
            }

            $model = $this->argument('model');

            $this->validate($model);

            $bar = $this->output->createProgressBar(3);

            if(!$this->error){

                $bar->start();

                if(!$this->error){
                    $this->makeDirectories($model);
                    $bar->advance();
                }

                if(!$this->error){
                    $this->makeFiles($model);
                    $bar->advance();
                }

                if(!$this->error){
                    $this->makeMMCR($model);
                    $bar->advance();
                }

                if(!$this->error){
                    $bar->finish();
                    $this->line($this->successMessage);
                    $this->newLine();
                    $this->info("Crud {$model} created.");
                }

            }else{
                $this->line($this->errorMessage);
                $this->newLine();
                $this->error('error when trying to create the crud');
                $this->error($this->errorText);
            }

        }else{
            $this->error('Something went wrong!');
        }

        return 0;
    }

    public function makeDirectories($model){

        if (file_exists(resource_path('views'.DIRECTORY_SEPARATOR.strtolower(Str::plural($model))))) {
            $this->error = true;
            $this->line($this->errorMessage);
            $this->newLine();
            $this->error("File ".strtolower(Str::plural($model))." already exists!");
        }

        if (file_exists(resource_path('views'.DIRECTORY_SEPARATOR.strtolower(Str::plural($model)).DIRECTORY_SEPARATOR.'assets'))) {
            $this->error = true;
            $this->line($this->errorMessage);
            $this->newLine();
            $this->error("File ".strtolower(Str::plural($model)).DIRECTORY_SEPARATOR.'assets'." already exists!");
        }

        if (file_exists(resource_path('views'.DIRECTORY_SEPARATOR.strtolower(Str::plural($model)).DIRECTORY_SEPARATOR.'includes'))) {
            $this->error = true;
            $this->line($this->errorMessage);
            $this->newLine();
            $this->error("File ".strtolower(Str::plural($model)).DIRECTORY_SEPARATOR.'includes'." already exists!");
        }

        if (file_exists(resource_path('views/components'))) {

            if (file_exists(resource_path('views/components/flash-messages.blade.php'))) {
                $this->error = true;
                $this->line($this->errorMessage);
                $this->newLine();
                $this->errorText = "Component flash-messages.blade.php already exists!";
            }

            if (file_exists(resource_path('views/components/title-header.blade.php'))) {
                $this->error = true;
                $this->line($this->errorMessage);
                $this->newLine();
                $this->errorText = "Component title-header.blade.php already exists!";
            }
        }

        mkdir(resource_path('views'.DIRECTORY_SEPARATOR.strtolower(Str::plural($model))), 0700);
        mkdir(resource_path('views'.DIRECTORY_SEPARATOR.strtolower(Str::plural($model)).DIRECTORY_SEPARATOR.'assets'), 0700);
        mkdir(resource_path('views'.DIRECTORY_SEPARATOR.strtolower(Str::plural($model)).DIRECTORY_SEPARATOR.'includes'), 0700);
        if(!file_exists('views/components')){
            mkdir(resource_path('views/components'), 0700);
        }
    }

    public function makeFiles($model){
        $this->makeViews($model);
        $this->makeJSFile($model);
        $this->makeComponents();
        $this->makeIncludeJS();
    }

    public function makeViews($model){

        $contentViewList = $this->makeListView($model);
        $contentViewCreate = $this->makeCreateView($model);
        $contentViewForm = $this->makeFormView($model);

        file_put_contents(resource_path('views'.DIRECTORY_SEPARATOR.strtolower(Str::plural($model)).DIRECTORY_SEPARATOR.strtolower(Str::plural($model)).'.blade.php'), $contentViewList);
        file_put_contents(resource_path('views'.DIRECTORY_SEPARATOR.strtolower(Str::plural($model)).DIRECTORY_SEPARATOR.'create.blade.php'), $contentViewCreate);
        file_put_contents(resource_path('views'.DIRECTORY_SEPARATOR.strtolower(Str::plural($model)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'_form.blade.php'), $contentViewForm);
    }

    public function makeComponents(){

        if (file_exists(resource_path('views/components/flash-messages.blade.php'))) {
            $this->error = true;
            $this->line($this->errorMessage);
            $this->newLine();
            $this->error("Component flash-messages.blade.php already exists!");
        }

        $componentMessages = file_get_contents(base_path('vendor/santimilos/crud-package/src/resources/views/components/flash-messages.blade.php'));
        file_put_contents(resource_path('views/components/flash-messages.blade.php'), $componentMessages);

        if (file_exists(resource_path('views/components/title-header.blade.php'))) {
            $this->error = true;
            $this->line($this->errorMessage);
            $this->newLine();
            $this->error("Component title-header.blade.php already exists!");
        }

        $componentTitle = file_get_contents(base_path('vendor/santimilos/crud-package/src/resources/views/components/title-header.blade.php'));
        file_put_contents(resource_path('views/components/title-header.blade.php'), $componentTitle);

    }

    public function makeIncludeJS(){

        if (file_exists(resource_path('views/includes/includejs.blade.php'))) {
            $this->error = true;
            $this->line($this->errorMessage);
            $this->newLine();
            $this->error("Component title-header.blade.php already exists!");
        }

        $includeJS = file_get_contents(base_path('vendor/santimilos/crud-package/src/resources/views/includes/includejs.blade.php'));
        file_put_contents(resource_path('views/includes/includejs.blade.php'), $includeJS);
    }

    public function makeListView($model){

        $path = resource_path('views'.DIRECTORY_SEPARATOR.strtolower(Str::plural($model)).'.blade.php');

        if (file_exists($path)) {
            $this->error = true;
            $this->line($this->errorMessage);
            $this->newLine();
            $this->error("File {$path} already exists!");
        }

        $viewList = file_get_contents(base_path('vendor/santimilos/crud-package/src/resources/views/template/template.blade.php'));
        $viewList = str_replace(['[template]','[model]'], [strtolower(Str::plural($model)), $model], $viewList);

        return $viewList;
    }

    public function makeCreateView($model){

        $path = resource_path('views'.DIRECTORY_SEPARATOR.strtolower(Str::plural($model)).DIRECTORY_SEPARATOR.'create.blade.php');

        if (file_exists($path)) {
            $this->error = true;
            $this->error("File {$path} already exists!");
        }

        $viewCreate = file_get_contents(base_path('vendor/santimilos/crud-package/src/resources/views/template/create.blade.php'));
        $viewCreate = str_replace(['[template]','[model]'], [strtolower(Str::plural($model)), $model], $viewCreate);

        return $viewCreate;
    }

    public function makeFormView($model){

        $path = resource_path('views'.DIRECTORY_SEPARATOR.strtolower(Str::plural($model)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'_form.blade.php');

        if (file_exists($path)) {
            $this->error = true;
            $this->error("File {$path} already exists!");
        }

        $viewForm = file_get_contents(base_path('vendor/santimilos/crud-package/src/resources/views/template/includes/_form.blade.php'));
        $viewForm = str_replace(['[template]','[model]'], [strtolower(Str::plural($model)), $model], $viewForm);

        return $viewForm;
    }

    public function makeJSFile($model){

        $path = resource_path('views'.DIRECTORY_SEPARATOR.strtolower(Str::plural($model)).DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'_'.Str::plural($model).'.js');

        if (file_exists($path)) {
            $this->error = true;
            $this->error("File {$path} already exists!");
        }

        $contentJs = file_get_contents(base_path('vendor/santimilos/crud-package/src/resources/views/template/assets/_template.js'));
        file_put_contents(resource_path('views'.DIRECTORY_SEPARATOR.strtolower(Str::plural($model)).DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'_'.strtolower(Str::plural($model)).'.js'), $contentJs);

        if (file_exists(public_path('js/appAjax.js'))) {
            $this->error = true;
            $this->line($this->errorMessage);
            $this->newLine();
            $this->error("File js/appAjax.js already exists!");
        }

        $appJs = file_get_contents(base_path('vendor/santimilos/crud-package/src/resources/views/template/js/app.js'));
        file_put_contents(public_path('js/appAjax.js'), $appJs);
    }

    public function makeMMCR($model){

        $this->makeMigration($model);
        $this->makeRoutes($model);
        $this->makeModel($model);
        $this->makeController($model);
    }

    public function makeRoutes($model){

        /**
         * Aqui se crea las rutas
         */

        $routeFile = base_path('routes/web.php');
        if (strstr($routeFile, $model)) {
            $this->error = true;
            $this->error("there are already routes created with the {$model} assigned!");
        }

        $contentRoute = file_get_contents(base_path('vendor/santimilos/crud-package/src/resources/views/template/route/route.php'));
        $contentRoute = str_replace(['[template]','[model]'], [strtolower(Str::plural($model)), $model], $contentRoute);

        $fp = fopen($routeFile, 'a');
        fwrite($fp,"\n".$contentRoute);
        fclose($fp);
    }

    public function makeModel($model){

        if (file_exists(app_path('Models'.DIRECTORY_SEPARATOR.$model.'.php'))) {
            $this->error = true;
            $this->error("Model {$model} already exists!");
        }

        $contentModel = file_get_contents(base_path('vendor/santimilos/crud-package/src/resources/views/template/model/Template.txt'));
        $contentModel = str_replace(['[template]','[model]'], [strtolower(Str::plural($model)), $model], $contentModel);

        file_put_contents(app_path('Models'.DIRECTORY_SEPARATOR.$model.'.php'), $contentModel);
    }

    public function makeController($model){

        if (file_exists(app_path('Http/Controllers'.DIRECTORY_SEPARATOR.$model.'Controller.php'))) {
            $this->error = true;
            $this->error("Controller {$model} already exists!");
        }

        $controllerContent = file_get_contents(base_path('vendor/santimilos/crud-package/src/resources/views/template/controller/templateController.txt'));
        $controllerContent = str_replace(['[template]','[model]'], [strtolower(Str::plural($model)), $model], $controllerContent);

        file_put_contents(app_path('Http/Controllers'.DIRECTORY_SEPARATOR.$model.'Controller.php'), $controllerContent);
    }

    public function makeMigration($model){


        if (file_exists(base_path('database/migrations'.DIRECTORY_SEPARATOR.date('h_i_s').'_'.rand(100000,999999).'_create_'.strtolower(Str::plural($model)).'_table.php'))) {
            $this->error = true;
            $this->error("Migration {$model} already exists!");
        }

        if(!empty($this->labels)){
            $this->makeLabels();
            $migrationContent = file_get_contents(base_path('vendor/santimilos/crud-package/src/resources/views/template/migration/templateMigration.txt'));
            $migrationContent = str_replace(['[template]','[model]','[labels]'], [strtolower(Str::plural($model)), $model, implode("\r\t\t\t" ,$this->labels)], $migrationContent);
            file_put_contents(base_path('database/migrations'.DIRECTORY_SEPARATOR.date('Y_m_d').'_'.rand(100000,999999).'_create_'.strtolower(Str::plural($model)).'_table.php'), $migrationContent);
        }else{
            Artisan::call("make:migration", ['name' => 'create_'.strtolower(Str::plural($model)).'_table']);
        }
    }

    public function makeLabels(){

        $labels = [];

        foreach($this->labels as $label){

            $option = explode(':', $label);
            $label = '$table->'.$option[1].'("'.$option[0].'");';
            array_push($labels, $label);
        }

        return $this->labels = $labels;
    }

    public function validate($model){

        if (file_exists(resource_path('views'.DIRECTORY_SEPARATOR.strtolower(Str::plural($model))))) {
            $this->errorText = 'there are already views created with the '.$model.' assigned';
            return $this->error = true;
        }

        $routeFile = file_get_contents(base_path('routes/web.php'));
        if (strstr($routeFile, $model)) {
            $this->errorText = 'there are already routes created with the '.$model.' assigned';
            return $this->error = true;
        }

        if (file_exists(app_path('Models'.DIRECTORY_SEPARATOR.$model.'.php'))) {
            $this->errorText = 'there is already a model created with the '.$model.' assigned';
            return $this->error = true;
        }

        if (file_exists(app_path('Http/Controllers'.DIRECTORY_SEPARATOR.$model.'Controller.php'))) {
            $this->errorText = 'there is already a controller created with the '.$model.' assigned';
            return $this->error = true;
        }

        if (file_exists(resource_path('views/components'))) {

            if (file_exists(resource_path('views/components/flash-messages.blade.php'))) {
                $this->error = true;
                $this->line($this->errorMessage);
                $this->newLine();
                $this->errorText = "Component flash-messages.blade.php already exists!";

                return $this->error = true;
            }

            if (file_exists(resource_path('views/components/title-header.blade.php'))) {
                $this->error = true;
                $this->line($this->errorMessage);
                $this->newLine();
                $this->errorText = "Component title-header.blade.php already exists!";

                return $this->error = true;
            }
        }
        return $this->error = false;
    }

}
