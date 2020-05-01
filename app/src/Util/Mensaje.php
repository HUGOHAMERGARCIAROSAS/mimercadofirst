<?php

namespace App\src\Util;


class Mensaje
{
    const CREATE_SUCCESS = "Se ha guardado exitosamente.";
    const CREATE_ERROR = "No se pudo guardar, Inténtelo de nuevo.";
    const UPDATE_SUCCESS = "Se ha actualizado exitosamente.";
    const UPDATE_ERROR = "No se pudo actualizar, Inténtelo de nuevo.";
    const DELETE_SUCCESS = "Se ha eliminado exitosamente.";
    const DELETE_ERROR = "No se pudo guardar, Inténtelo de nuevo.";

    public static function flashCreateSuccessImportant()
    {
        return flash(Mensaje::CREATE_SUCCESS)->success()->important();
    }

    public static function flashCreateErrorImportant()
    {
        return flash(Mensaje::CREATE_ERROR)->error()->important();
    }

    public static function flashCreateErrorImportantWithMessage($mensaje)
    {
        return flash(Mensaje::CREATE_ERROR . ' ' . $mensaje)->error()->important();
    }

    public static function flashUpdateSuccessImportant()
    {
        return flash(Mensaje::UPDATE_SUCCESS)->success()->important();
    }

    public static function flashUpdateErrorImportant()
    {
        return flash(Mensaje::UPDATE_ERROR)->error()->important();
    }

    public static function flashUpdateErrorImportantWithMessage($mensaje)
    {
        return flash(Mensaje::UPDATE_ERROR . ' ' . $mensaje)->error()->important();
    }

    public static function flashDeleteSuccessImportant()
    {
        return flash(Mensaje::DELETE_SUCCESS)->success()->important();
    }

    public static function flashDeleteErrorImportant()
    {
        return flash(Mensaje::DELETE_ERROR)->error()->important();
    }

    public static function flashMessageWarningImportant($message)
    {
        return flash($message)->warning()->important();
    }

}