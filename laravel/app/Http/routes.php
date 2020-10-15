<?php

use Monolog\Handler\StreamHandler;
use Monolog\Handler\ElasticSearchHandler;
use Monolog\Handler\MongoDBHandler;
use Monolog\Handler\RavenHandler;
use Monolog\Handler\RedisHandler;
use Sentry\Laravel\SentryHandler;
use Sentry\State\Hub;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    $logger = request()->query('v');

    switch($logger)
    {
        // case 'elastic':
        //     $handler = new ElasticsearchHandler(
        //         \Elastica\Client(),
        //         [
        //             'index' => 'elastic_index_name',
        //             'type'  => 'elastic_doc_type',
        //         ]);
        // break;

        case 'mongo':
            $handler = new MongoDBHandler(new \Mongo("mongodb://mongo:27017"), "logs", "prod");
        break;

        // case 'sentry':
        //     $handler = new SentryHandler(Hub::getCurrent());
        // break;

        case 'redis':
            $handler = new RedisHandler(new Predis\Client("tcp://redis:6379"), "logs", "prod");
        break;

        default:
            $logger  = 'file';
            $handler = new StreamHandler(storage_path('logs/laravel.log'));
    }

    Log::getMonolog()->pushHandler($handler)->error('Log message', ['context' => 'Hello World']);

    return view('welcome', ['logger' => $logger]);
});
