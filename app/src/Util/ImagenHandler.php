<?php
/**
 * Created by PhpStorm.
 * User: Jhordy
 * Date: 06/09/2018
 * Time: 21:16
 */

namespace App\src\Util;

use Illuminate\Http\Request;
use Exception;

class ImagenHandler
{
    private $request;
    private $nombre_inicial;
    private $nombre_de_imagen;
    private $ruta_publica;
    private $imagen;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->imagen = $request->file('imagen');
        $this->setNombreInicialDeLaImagen();
        $this->setNombreDeLaCarpetaPublica();
    }

    private function existeElArchivo()
    {
        if (!$this->request->hasFile('imagen')) {
            return false;
        }

        return true;
    }

    private function getExtensionDeImagen()
    {
        return $this->imagen->getClientOriginalExtension();
    }

    public function setNombreDeLaCarpetaPublica($carpeta_publica = '')
    {
        $default_path = "/assets/";
        $folder = (empty($carpeta_publica)) ? $default_path : $carpeta_publica;
        $this->ruta_publica = public_path() . $folder;
        return $this->ruta_publica;
    }

    public function setNombreInicialDeLaImagen($nombre_incial = '')
    {
        $default_name = "imagen_";
        $this->nombre_inicial = (empty($nombre_incial)) ? $default_name : $nombre_incial;
        return $this->nombre_inicial;
    }

    public function crearNombreDeImagen()
    {
        $this->nombre_de_imagen = ($this->existeElArchivo()) ? $this->nombre_inicial . time() . '.' . $this->getExtensionDeImagen() : null;
        return $this->nombre_de_imagen;
    }

    public function getNombreDeImagen()
    {
        return $this->nombre_de_imagen;
    }

    public function mover()
    {
        if ($this->existeElArchivo()) {
            $this->crearNombreDeImagen();
            $this->imagen->move($this->ruta_publica, $this->nombre_de_imagen);
        }
    }

    public function actualizarImagen($imagenOld)
    {
        if ($imagenOld != null) {
            unlink($this->ruta_publica . $imagenOld);
        }

        $this->mover();
    }

}