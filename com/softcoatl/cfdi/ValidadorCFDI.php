<?php
/*
 * ValidadorCFDI
 * cfdi®
 * © 2018, Softcoatl 
 * http://www.softcoatl.mx
 * @author Rolando Esquivel Villafaña, Softcoatl
 * @version 1.0
 * @since dic 2017
 */
namespace com\softcoatl\cfdi;

class ValidadorCFDI {

    public static function validate($xml, $schema) {
        $errorString = "";
        $dom = new \DOMDocument();
        $dom->loadXML($xml);
        libxml_use_internal_errors(true);
        if(!$dom->schemaValidate($schema)) {
            $errors = libxml_get_errors();
            foreach ($errors as $key => $error) {
                $errorString .= $error->message;
                $errorString .= " ";
            }
            return $errorString;
        }
        error_log("Datos válidos");
        return true;
    }
}
