<?php namespace PCI\Http\Routes;

use Route;

/**
 * Class AbstractPciRoutes
 * @package PCI\Http\Routes
 * @author Alejandro Granadillo <slayerfat@gmail.com>
 * @see http://i.imgur.com/xVyoSl.jpg
 * Poderoso copypasta de https://github.com/slayerfat/orbiagro.com.ve/blob/master/app/Http/Routes/Routes.php
 * @link https://github.com/slayerfat/sistemaPCI Repositorio en linea.
 */
abstract class AbstractPciRoutes
{
    /**
     * Las opciones para crear un grupo RESTful de rutas.
     *
     * @var array
     */
    protected $restfulOptions = [];

    /**
     * Las opciones para crear las rutas, segun cada tipo.
     * Deberia contener un array con
     * routerOptions
     *     prefix: cosas
     * rtDetails
     *     uses    : CosaController,
     *     as      : thing,
     *     resource: {cosas},
     *     ignore  : [create, edit, ...]
     *
     * @var array
     */
    protected $nonRestfulOptions = [];

    /**
     * Genera todas las rutas relacionadas con esta clase
     * @return void
     */
    abstract public function execute();

    /**
     * el prototipo basico para registrar rutas.
     *
     * @param  array  $restfulArray
     * @param  array  $nonRestfulArray
     *
     * @return void
     */
    protected function executePrototype(array $restfulArray, array $nonRestfulArray)
    {
        foreach ($restfulArray as $array) {
            $this->registerRESTfulGroup(
                $array['routerOptions'],
                $array['rtDetails']
            );
        }

        $this->registerSigleRoute($nonRestfulArray);
    }

    /**
     * Registra un grupo de rutas.
     *
     * @param  array  $options Las opciones del grupo.
     * @param  array  $details Los parametros necesarios para registrar la ruta.
     *
     * @return void
     */
    protected function registerRESTfulGroup(array $options, array $details)
    {
        Route::group($options, function () use ($details) {
            $defaults = [
                'index'   => ['get', '/'],
                'create'  => ['get', '/crear'],
                'store'   => ['post', '/'],
                'show'    => ['get', '/' . $details['resource']],
                'edit'    => ['get', '/' . $details['resource'] . '/editar'],
                'update'  => ['patch', '/' . $details['resource']],
                'destroy' => ['delete', '/' . $details['resource']],
            ];

            // si en los detalles hay ignore, se salta.
            // es decir, si hay ignore, se ignora el metodo/ruta
            if (isset($details['ignore'])) {
                $defaults = array_except($defaults, $details['ignore']);
            }

            $this->registerRoutes($defaults, $details);
        });
    }

    /**
     * Registra las rutas segun los datos dentro del array.
     * @param array $defaults los metodos o rutas restful del controlador.
     * @param array $details los detalles de la nueva ruta.
     * @return void
     */
    private function registerRoutes($defaults, $details)
    {
        foreach ($defaults as $name => $rule) {
            // rule[0] es el metodo
            // rule[1] es el url
            // {@example}  Route::rule[0](rule[1], ...)
            //             Route::create('/', ...)
            Route::$rule[0](
                $rule[1],
                [
                    'uses' => $details['uses'] . '@' . $name,
                    'as'   => $details['as'] . '.' . $name
                ]
            );
        }
    }

    /**
     * itera las opciones para registrar las rutas.
     * @param  array $options
     * @return void
     */
    protected function registerSigleRoute(array $options)
    {
        foreach ($options as $details) {
            Route::$details['method']($details['url'], $details['data']);
        }
    }

    /**
     * Se registra mamarrachamente un listado de controladores.
     *
     * @param  array  $data
     * @return void
     */
    protected function registerControllerPrototype(array $data)
    {
        Route::controllers($data);
    }
}
