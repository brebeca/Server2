<?php


class DBConnection
{


    private static $conexiune_bd = NULL;
    public static function obtine_conexiune(){
        if (is_null(self::$conexiune_bd))
        {
            $conn = new MongoDB\Client(
                'mongodb+srv://COMPIT:compit@cluster0-1dwy1.mongodb.net/test?retryWrites=true&w=majority');
            self::$conexiune_bd=$conn->selectDatabase('CompIT');

        }
        return self::$conexiune_bd;
    }
}