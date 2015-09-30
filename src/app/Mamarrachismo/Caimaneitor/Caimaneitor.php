<?php

/**
 *  ……………………▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄
 * ……………▄▄█▓▓▓▒▒▒▒▒▒▒▒▒▒▓▓▓▓█▄▄
 * …………▄▀▀▓▒░░░░░░░░░░░░░░░░▒▓▓▀▄
 * ………▄▀▓▒▒░░░░░░░░░░░░░░░░░░░▒▒▓▀▄
 * …..█▓█▒░░░░░░░░░░░░░░░░░░░░░▒▓▒▓█
 * ..▌▓▀▒░░░░░░░░░░░░░░░░░░░░░░░░▒▀▓█
 * ..█▌▓▒▒░░░░░░░░░░░░░░░░░░░░░░░░░▒▓█
 * ▐█▓▒░░░░░░░░░░░░░░░░░░░░░░░░░░░▒▓█▌
 * █▓▒▒░░░░░░░░░░░░░░░░░░░░░░░░░░░░▒▓█
 * █▐▒▒░░░░░░░░░░░░░░░░░░░░░░░░░░░▒▒█▓
 * █▓█▒░░░░░░░░░░░░░░░░░░░░░░░░░░░▒█▌▓█
 * █▓▓█▒░░░░░░░░░░░░░░░░░░░░░░░░░░▒█▓▓█
 * █▓█▒░▒▒▒▒░░▀▀█▄▄░░░░░▄▄█▀▀░░▒▒▒▒░▒█▓█
 * █▓▌▒▒▓▓▓▓▄▄▄▒▒▒▀█░░░░█▀▒▒▒▄▄▄▓▓▓▓▒▒▐▓█
 * ██▌▒▓███▓█████▓▒▐▌░░▐▌▒▓████▓████▓▒▐██
 * .██▒▒▓███ayy████▓▄░░░▄▓████lmao███▓▒▒██
 * .█▓▒▒▓██████████▓▒░░░▒▓██████████▓▒▒▓█
 * ..█▓▒░▒▓███████▓▓▄▀░░▀▄▓▓███████▓▒▒▓█
 * ...█▓▒░▒▒▓▓▓▓▄▄▄▀▒░░░░░▒▀▄▄▄▓▓▓▓▒▒░▓█
 * ....█▓▒░▒▒▒▒░░░░░▒▒▒▒▒▒░░░░░▒▒▒▒░▒▓█
 * .....█▓▓▒▒▒░░░░░░░▒▒▒▒░░░░░▒▒▒▓▓█
 * ......▀██▓▓▓▒░░▄▄▄▄▄▄▄▄▄▄░░▒▓█▀
 * .......▀█▓▒▒░░░░░░▀▀▀▀▒░░▒▒▓█▀
 * ..........██▓▓▒░░▒▒▒░▒▒▒░▒▓██
 * ............█▓▒▒▒░░░░░▒▒▒▓█
 * ..............▀▀█▓▓▓▓▓▓█▀
 */

namespace PCI\Mamarrachismo\Caimaneitor;

use Illuminate\Support\Collection;
use PCI\Mamarrachismo\Caimaneitor\Interfaces\CaimanizerInterface;

/**
 * Class Caimaneitor
 * @package PCI\Mamarrachismo\Caimaneitor
 * @author Alejandro Granadillo <slayerfat@gmail.com>
 * @link https://uahtechcomm.files.wordpress.com/2014/10/funny-picture-every-group-project.jpg
 * @link http://i3.kym-cdn.com/photos/images/newsfeed/000/215/821/1323635452001.png
 * @link https://github.com/slayerfat/sistemaPCI Repositorio en linea.
 */
class Caimaneitor implements CaimanizerInterface
{

    /**
     * They see me rollin'...
     * @var string[]
     */
    public static $caimaneishons = [
        'Puro cara e\' papeo. - Bryan Torres',
        'Tranquilo que en vacaciones me pongo pa\' eso. - Andres Leotur',
        'No tengo la culpa de que el sistema no corra. - Andres Leotur',
        'Si, si... eso lo hago yo. - Erick Zerpa',
        '¿Que tipo de relacion es una relacion de tipo muchos a muchos? - Anonimo',
        '¿Cuanto es uno por menos uno? - Anonimo',
        'Ya va que me esta subiendo la tension. - Alejandro Granadillo',
        'Tuve que darle la vuelta al mundo
        para darme cuenta que la solucion estaba detras de mi. - Alejandro Granadillo',
    ];

    /**
     * ...they hatin'
     * @var string[]
     */
    public static $locaishons = [
        'Con cinco tragos de mas en la taguara La Barcaza Azul.',
        'Tomando Roncito en Los Caracas.',
        'Durante la prueba de calculo.',
        'En el anden del Metro de Caracas.',
        'Durante la Pre-defensa de Proyecto.',
        'Via Skype.',
        'Via WhatsApp.',
        'Via Gmail.',
    ];

    /**
     * Inspired by PCI\Mamarrachismo\Caimaneitor\Caimaneitor
     * A very Inspiring class.
     * Alejandro Granadillo made this commit from Caracas, Again.
     * @return string
     */
    public static function locaishon()
    {
        return Collection::make(self::$locaishons)->random();
    }

    /**
     * Regresa un mensaje inspirado.
     * @return string
     */
    public function __toString()
    {
        return self::caimanais();
    }

    /**
     * Inspired by Illuminate\Foundation\Inspiring
     * A very Inspiring class.
     * Alejandro Granadillo made this commit from Caracas. (45° Celcius)
     * @return string
     */
    public static function caimanais()
    {
        return Collection::make(self::$caimaneishons)->random();
    }
}
