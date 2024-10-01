<?php
/*
 * Receptor
 * cfdi33®
 * ® 2017, Softcoatl 
 * http://www.softcoatl.mx
 * @author Rolando Esquivel Villafaña, Softcoatl
 * @version 1.0
 * @since nov 2017
 */
namespace com\softcoatl\cfdi\v33\schema\Comprobante33;

use com\softcoatl\cfdi\CFDIElement;
use com\softcoatl\cfdi\utils\Reflection;

class Receptor implements CFDIElement {

    private $Rfc;
    private $Nombre;
    private $ResidenciaFiscal;
    private $NumRegIdTrib;
    private $UsoCFDI;

    function getRfc() {
        return $this->Rfc;
    }

    function getNombre() {
        return $this->Nombre;
    }

    function getResidenciaFiscal() {
        return $this->ResidenciaFiscal;
    }

    function getNumRegIdTrib() {
        return $this->NumRegIdTrib;
    }

    function getUsoCFDI() {
        return $this->UsoCFDI;
    }

    function setRfc($Rfc) {
        $this->Rfc = $Rfc;
    }

    function setNombre($Nombre) {
        $this->Nombre = $Nombre;
    }

    function setResidenciaFiscal($ResidenciaFiscal) {
        $this->ResidenciaFiscal = $ResidenciaFiscal;
    }

    function setNumRegIdTrib($NumRegIdTrib) {
        $this->NumRegIdTrib = $NumRegIdTrib;
    }

    function setUsoCFDI($UsoCFDI) {
        $this->UsoCFDI = $UsoCFDI;
    }

    public function asXML($root) {

        $Receptor = $root->ownerDocument->createElement("cfdi:Receptor");
        $ov = array_filter(get_object_vars($this));
        foreach ($ov as $attr => $value) {
            $Receptor->setAttribute($attr, $value);
        }
        
        return $Receptor;
    }

    public static function parse($DOMReceptor) {

        $Receptor = new Receptor();
        Reflection::setAttributes($Receptor, $DOMReceptor);
        return $Receptor;
    }
}
