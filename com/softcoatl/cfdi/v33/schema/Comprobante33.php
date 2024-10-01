<?php
/*
 * Comprobante
 * CFDI versión 3.3
 * cfdi33®
 * ® 2017, Softcoatl 
 * http://www.softcoatl.mx
 * @author Rolando Esquivel Villafaña, Softcoatl
 * @version 1.0
 * @since nov 2017
 */
namespace com\softcoatl\cfdi\v33\schema;

require_once ('com/softcoatl/cfdi/complemento/tfd/TimbreFiscalDigital.php');
require_once ("com/softcoatl/cfdi/Comprobante.php");
require_once ("com/softcoatl/cfdi/CFDIElement.php");
require_once ("com/softcoatl/cfdi/utils/Reflection.php");
require_once ("com/softcoatl/cfdi/ValidadorCFDI.php");
require_once ("com/softcoatl/cfdi/utils/Reflection.php");
require_once (dirname(__FILE__)."/Comprobante33/CfdiRelacionados.php");
require_once (dirname(__FILE__)."/Comprobante33/Emisor.php");
require_once (dirname(__FILE__)."/Comprobante33/Receptor.php");
require_once (dirname(__FILE__)."/Comprobante33/Conceptos.php");
require_once (dirname(__FILE__)."/Comprobante33/Impuestos.php");

use com\softcoatl\cfdi\CFDIElement;
use com\softcoatl\cfdi\Comprobante;
use com\softcoatl\cfdi\utils\Reflection;
use com\softcoatl\cfdi\ValidadorCFDI;

class Comprobante33 implements CFDIElement, Comprobante {

    public static $ARR_COMPLEMENTO = array();
    public static $ARR_ADDENDA = array();

    /** @var Comprobante\CfdiRelacionados */
    private $CfdiRelacionados;
    /** @var Comprobante\Emisor */
    private $Emisor;
    /** @var Comprobante\Receptor */
    private $Receptor;
    /** @var Comprobante\Conceptos */
    private $Conceptos;
    /** @var Comprobante\Impuestos */
    private $Impuestos;

    private $Complemento = array();
    private $Addenda = array();

    private $Version = "3.3";
    private $Serie;
    private $Folio;
    private $Fecha;
    private $Sello;
    private $FormaPago;
    private $NoCertificado;
    private $Certificado;
    private $CondicionesDePago;
    private $SubTotal;
    private $Descuento;
    private $Moneda;
    private $TipoCambio;
    private $Total;
    private $TipoDeComprobante;
    private $MetodoPago;
    private $LugarExpedicion;
    private $Confirmacion;

    public static function registerComplemento($complemento) {
        self::$ARR_COMPLEMENTO[] = $complemento;
    }
    
    public static function registerAddenda($addenda) {
        self::$ARR_ADDENDA[] = $addenda;
    }

    function getCfdiRelacionados() {
        return $this->CfdiRelacionados;
    }

    function getEmisor() {
        return $this->Emisor;
    }

    function getReceptor() {
        return $this->Receptor;
    }

    function getConceptos() {
        return $this->Conceptos;
    }

    function getImpuestos() {
        return $this->Impuestos;
    }

    function getComplemento() {
        return $this->Complemento;
    }

    function getAddenda() {
        return $this->Addenda;
    }

    function getVersion() {
        return $this->Version;
    }

    function getSerie() {
        return $this->Serie;
    }

    function getFolio() {
        return $this->Folio;
    }

    function getFecha() {
        return $this->Fecha;
    }

    function getSello() {
        return $this->Sello;
    }

    function getFormaPago() {
        return $this->FormaPago;
    }

    function getNoCertificado() {
        return $this->NoCertificado;
    }

    function getCertificado() {
        return $this->Certificado;
    }

    function getCondicionesDePago() {
        return $this->CondicionesDePago;
    }

    function getSubTotal() {
        return $this->SubTotal;
    }

    function getDescuento() {
        return $this->Descuento;
    }

    function getMoneda() {
        return $this->Moneda;
    }

    function getTipoCambio() {
        return $this->TipoCambio;
    }

    function getTotal() {
        return $this->Total;
    }

    function getTipoDeComprobante() {
        return $this->TipoDeComprobante;
    }

    function getMetodoPago() {
        return $this->MetodoPago;
    }

    function getLugarExpedicion() {
        return $this->LugarExpedicion;
    }

    function getConfirmacion() {
        return $this->Confirmacion;
    }

    function setCfdiRelacionados(Comprobante33\CfdiRelacionados $CfdiRelacionados) {
        $this->CfdiRelacionados = $CfdiRelacionados;
    }

    function setEmisor(Comprobante33\Emisor $Emisor) {
        $this->Emisor = $Emisor;
    }

    function setReceptor(Comprobante33\Receptor $Receptor) {
        $this->Receptor = $Receptor;
    }

    function setConceptos(Comprobante33\Conceptos $Conceptos) {
        $this->Conceptos = $Conceptos;
    }

    function setImpuestos(Comprobante33\Impuestos $Impuestos) {
        $this->Impuestos = $Impuestos;
    }

    function addComplemento($Complemento) {
        $this->Complemento[] = $Complemento;
    }

    function addAddenda($Addenda) {
        $this->Addenda[] = $Addenda;
    }

    function setVersion($Version) {
        $this->Version = $Version;
    }

    function setSerie($Serie) {
        $this->Serie = $Serie;
    }

    function setFolio($Folio) {
        $this->Folio = $Folio;
    }

    function setFecha($Fecha) {
        $this->Fecha = $Fecha;
    }

    function setSello($Sello) {
        $this->Sello = $Sello;
    }

    function setFormaPago($FormaPago) {
        $this->FormaPago = $FormaPago;
    }

    function setNoCertificado($NoCertificado) {
        $this->NoCertificado = $NoCertificado;
    }

    function setCertificado($Certificado) {
        $this->Certificado = $Certificado;
    }

    function setCondicionesDePago($CondicionesDePago) {
        $this->CondicionesDePago = $CondicionesDePago;
    }

    function setSubTotal($SubTotal) {
        $this->SubTotal = $SubTotal;
    }

    function setDescuento($Descuento) {
        $this->Descuento = $Descuento;
    }

    function setMoneda($Moneda) {
        $this->Moneda = $Moneda;
    }

    function setTipoCambio($TipoCambio) {
        $this->TipoCambio = $TipoCambio;
    }

    function setTotal($Total) {
        $this->Total = $Total;
    }

    function setTipoDeComprobante($TipoDeComprobante) {
        $this->TipoDeComprobante = $TipoDeComprobante;
    }

    function setMetodoPago($MetodoPago) {
        $this->MetodoPago = $MetodoPago;
    }

    function setLugarExpedicion($LugarExpedicion) {
        $this->LugarExpedicion = $LugarExpedicion;
    }

    function setConfirmacion($Confirmacion) {
        $this->Confirmacion = $Confirmacion;
    }

    function getTimbreFiscalDigital(): \com\softcoatl\cfdi\complemento\tfd\TimbreFiscalDigital {
        if ($this->Complemento!=NULL) {
            foreach ($this->Complemento as $Complemento) {
                if ($Complemento instanceof \com\softcoatl\cfdi\complemento\tfd\TimbreFiscalDigital) {
                    return $Complemento;
                }
            }
        }

        return FALSE;
    }

    public function schemaValidate() {
        $validador = new ValidadorCFDI();
        return $validador->validate($this->asXML()->saveXML(), dirname(__FILE__) . "/xsd/cfd/cfdv33.xsd");        
    }

    public function getOriginalBytes() {

        $xml = $this->asXML()->saveXML();

        $cfdi = new \DOMDocument("1.0","UTF-8");
        $cfdi->loadXML($xml);

        $xsl = new \DOMDocument("1.0", "UTF-8");
        $xsl->load(dirname(__FILE__) . "/xslt/cadenaoriginal_3_3.xslt");

        $proc = new \XSLTProcessor();
        $proc->importStyleSheet($xsl); 

        $cadena_original = $proc->transformToXML($cfdi);

        return $cadena_original;
    }

    public function getTFDOriginalBytes() {

        $DOM= new \DOMDocument("1.0","UTF-8");
        $root = $DOM->createElement('root');

        $xml = $this->getTimbreFiscalDigital()->asXML($root);

        $cfdi = new \DOMDocument("1.0","UTF-8");
        $cfdi->loadXML($TimbreFiscalDigital);

        $xsl = new \DOMDocument("1.0", "UTF-8");
        $xsl->load(dirname(__FILE__) . "/xslt/cadenaoriginal_TFD_1_1.xslt");

        $proc = new \XSLTProcessor();
        $proc->importStyleSheet($xsl); 

        $cadena_original = $proc->transformToXML($cfdi);

        return $cadena_original;
    }

    public function getValidationExpression() {
        $tfc = $this->getTimbreFiscalDigital();
        return $tfc ? implode("&", [
                "id=" . $tfc->getUUID(),
                "re=" . $this->Emisor->getRfc(),
                "rr=" . $this->Receptor->getRfc(),
                "tt=" . number_format($this->Total, 2, '.', ''),
                "fe=" . substr($this->Sello, - 8)]) : "";
    }

    public function getValidationURL() {
        return "https://verificacfdi.facturaelectronica.sat.gob.mx/default.aspx?" 
            . $this->getValidationExpression();
    }

    private function getVarArray() {
        return array_filter(get_object_vars($this), 
                        function ($val) {
                            return !is_array($val) 
                                && ($val === '0' || $val === 0 || $val === 0.0 ||  !empty($val))
                                && !($val instanceof Comprobante\Emisor)
                                && !($val instanceof Comprobante\Receptor)
                                && !($val instanceof Comprobante\Conceptos)
                                && !($val instanceof Comprobante\CfdiRelacionados)
                                && !($val instanceof Comprobante\Impuestos);
        });
    }

    private function removeEmptyNodes(\DOMDocument $DOMDocument) {
        $xpath = new \DOMXPath($DOMDocument);
        foreach( $xpath->query("//*[count(@*) = 0 and count(child::*) = 0]") as $node ) {
            $node->parentNode->removeChild($node);
        }
        return $DOMDocument;
    }

    public function asXML($root= null): \DOMDocument {

        $document = new \DOMDocument("1.0", "UTF-8");
        $Comprobante = $document->createElement("cfdi:Comprobante");
        $document->appendChild($Comprobante);

        $Comprobante->setAttribute("xmlns:cfdi", "http://www.sat.gob.mx/cfd/3");
        $Comprobante->setAttribute("xmlns:xsi", "http://www.w3.org/2001/XMLSchema-instance");
        $Comprobante->setAttribute("xsi:schemaLocation", "http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv33.xsd");

        $ov = $this->getVarArray();
        foreach ($ov as $attr=>$value) {
           $Comprobante->setAttribute($attr, $value);
        }

        if ($this->CfdiRelacionados !== NULL) {
            $cfdis = $this->CfdiRelacionados->getCfdiRelacionado();
            if (!empty($cfdis)) {
                $Comprobante->appendChild($this->CfdiRelacionados->asXML($Comprobante));
           }
        }

        $Comprobante->appendChild($this->Emisor->asXML($Comprobante));
        $Comprobante->appendChild($this->Receptor->asXML($Comprobante));

        $Comprobante->appendChild($this->Conceptos->asXML($Comprobante));

        if ($this->Impuestos !== NULL) {
            $Comprobante->appendChild($this->Impuestos->asXML($Comprobante));
        }

        if (!empty($this->Complemento)) {
            $complementos = $document->createElement("cfdi:Complemento");
            foreach ($this->Complemento as $complemento) {
                $complementos->appendChild($complemento->asXML($Comprobante));
            }
            $Comprobante->appendChild($complementos);
        }

        if (!empty($this->Addenda)) {
            $addendas = $document->createElement("cfdi:Addenda");
            foreach ($this->Addenda as $addenda) {
                $addendas->appendChild($addenda->asXML($Comprobante));
            }
            $Comprobante->appendChild($addendas);
        }

        return $this->removeEmptyNodes($document);
    }

    public static function parse($DOMCfdi) {

        $document = new \DOMDocument("1.0","UTF-8");
        $document->loadXML($DOMCfdi);

        if ($document->hasChildNodes()) {
            $cfdi = $document->firstChild;
            $Comprobante  = new Comprobante33();
            Reflection::setAttributes($Comprobante, $cfdi);

            for ($i=0; $i<$cfdi->childNodes->length; $i++) {
                $node = $cfdi->childNodes->item($i);
                if (strpos($node->nodeName, 'cfdi:CfdiRelacionados')!==false) {
                    $Comprobante->setCfdiRelacionados(Comprobante\CfdiRelacionados::parse($node));
                } else 
                if (strpos($node->nodeName, 'cfdi:Emisor')!==false) {
                    $Comprobante->setEmisor(Comprobante33\Emisor::parse($node));
                } else 
                if (strpos($node->nodeName, 'cfdi:Receptor')!==false) {
                    $Comprobante->setReceptor(Comprobante33\Receptor::parse($node));
                } else 
                if (strpos($node->nodeName, 'cfdi:Conceptos')!==false) {
                    $Comprobante->setConceptos(Comprobante33\Conceptos::parse($node));
                } else 
                if (strpos($node->nodeName, 'cfdi:Impuestos')!==false) {
                    $Comprobante->setImpuestos(Comprobante33\Impuestos::parse($node));
                } else 
                if (strpos($node->nodeName, 'cfdi:Complemento')!==false) {
                    Comprobante33::unmarshallComplemento($Comprobante, $node);
                } else if (strpos($node->nodeName, 'cfdi:Addenda')!==false) {
                    Comprobante33::unmarshallAddenda($Comprobante, $node);
                }
            }
        }

        return $Comprobante;
    }

    private static function unmarshallComplemento($Comprobante, $DOMComplementos) {

        for ($i=0; $i<$DOMComplementos->childNodes->length; $i++) {
            $DOMComplemento = $DOMComplementos->childNodes->item($i);
            foreach (self::$ARR_COMPLEMENTO as $complemento) {
                $parsed = $complemento::parse($DOMComplemento);
                if ($parsed != false) {
                    $Comprobante->addComplemento($parsed);
                }
            }
        }
    }

    private static function unmarshallAddenda($Comprobante, $DOMAddendas) {

        for ($i=0; $i<$DOMAddendas->childNodes->length; $i++) {
            $DOMAddenda = $DOMAddendas->childNodes->item($i);
            foreach (self::$ARR_ADDENDA as $addenda) {
                $parsed = $addenda::parse($DOMAddenda);
                if ($parsed != false) {
                    $Comprobante->addAddenda($parsed);
                }
            }
        }
    }
}
