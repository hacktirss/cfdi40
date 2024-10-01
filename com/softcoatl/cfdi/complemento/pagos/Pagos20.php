<?php
/*
 * CartaPorte20
 * CFDI®
 * © 2021, Softcoatl 
 * http://www.softcoatl.mx
 * @author Rolando Esquivel Villafaña, Softcoatl
 * @version 2.0
 * @since nov 2021
 */
namespace com\softcoatl\cfdi\complemento\pagos;

use com\softcoatl\cfdi\CFDIElement;
use com\softcoatl\cfdi\utils\Reflection;

class Pagos20 implements CFDIElement {

    /** @var Pagos20\Totales*/
    private $Totales;
    /** @var Pagos20\Pago[] */
    private $Pago = array();

    private $Version = "2.0";
    
    function getTotales() {
        return $this->Totales;
    }

    function getPago() {
        return $this->Pago;
    }

    function getVersion() {
        return $this->Version;
    }

    function setTotales(Pagos20\Totales $Totales) {
        $this->Totales = $Totales;
    }

    public function setPago(array $Pago) {
        $this->Pago = $Pago;
    }

    function addPago(Pagos20\Pago $Pago) {
        $this->Pago[] = $Pago;
    }

    function setVersion($Version) {
        $this->Version = $Version;
    }

    function asXML($root) {

        if ($root->ownerDocument->documentElement
                && empty($root->ownerDocument->documentElement->attributes->getNamedItem("xmlns:pago20"))) {
            $root->ownerDocument->documentElement->setAttribute("xmlns:pago20", "http://www.sat.gob.mx/Pagos20");
            $root->ownerDocument->documentElement->setAttribute("xsi:schemaLocation", 
                            $root->ownerDocument->documentElement->getAttribute("xsi:schemaLocation") 
                        .   " http://www.sat.gob.mx/Pagos20 http://www.sat.gob.mx/sitio_internet/cfd/Pagos/Pagos20.xsd");
        }
        $Pagos = $root->ownerDocument->createElement("pago20:Pagos");
        $Pagos->setAttribute("Version", $this->Version);
        if (!empty($this->Totales)) {
            $Pagos->appendChild($this->Totales->asXML($root));
        }
        if (!empty($this->Pago)) {
            foreach ($this->Pago as $pago) {
                $Pagos->appendChild($pago->asXML($root));
            }
        }
        return $Pagos;
    }

    public static function parse($DOMElement) {

        if (strpos($DOMElement->nodeName, ':pago20:Pagos')) {
            $Pagos = new Pagos20();
            $Pagos->setVersion($DOMElement->getAttribute('Version'));
            for ($i=0; $i<$DOMElement->childNodes->length; $i++) {
                $node = $DOMElement->childNodes->item($i);
                if (strpos($node->nodeName, 'pago20:Totales')!==false) {
                    $Pagos->setTotales(Pagos20\Totales::parse($node));
                } else
                if (strpos($node->nodeName, 'pago20:Pago')!==false) {
                    $Pagos->addPago(Pagos20\Pago::parse($node));
                }
            }
            return $Pagos;
        } 
        return false;        
    }
}

namespace com\softcoatl\cfdi\complemento\pagos\Pagos20;

use com\softcoatl\cfdi\CFDIElement;
use com\softcoatl\cfdi\utils\Reflection;

class Totales implements CFDIElement {

    private $TotalRetencionesIVA;
    private $TotalRetencionesISR;
    private $TotalRetencionesIEPS;
    private $TotalTrasladosBaseIVA16;
    private $TotalTrasladosImpuestoIVA16;
    private $TotalTrasladosBaseIVA8;
    private $TotalTrasladosImpuestoIVA8;
    private $TotalTrasladosBaseIVA0;
    private $TotalTrasladosImpuestoIVA0;
    private $TotalTrasladosBaseIVAExento;
    private $MontoTotalPagos;

    public function getTotalRetencionesIVA() {
        return $this->TotalRetencionesIVA;
    }

    public function getTotalRetencionesISR() {
        return $this->TotalRetencionesISR;
    }

    public function getTotalRetencionesIEPS() {
        return $this->TotalRetencionesIEPS;
    }

    public function getTotalTrasladosBaseIVA16() {
        return $this->TotalTrasladosBaseIVA16;
    }

    public function getTotalTrasladosImpuestoIVA16() {
        return $this->TotalTrasladosImpuestoIVA16;
    }

    public function getTotalTrasladosBaseIVA8() {
        return $this->TotalTrasladosBaseIVA8;
    }

    public function getTotalTrasladosImpuestoIVA8() {
        return $this->TotalTrasladosImpuestoIVA8;
    }

    public function getTotalTrasladosBaseIVA0() {
        return $this->TotalTrasladosBaseIVA0;
    }

    public function getTotalTrasladosImpuestoIVA0() {
        return $this->TotalTrasladosImpuestoIVA0;
    }

    public function getTotalTrasladosBaseIVAExento() {
        return $this->TotalTrasladosBaseIVAExento;
    }

    public function getMontoTotalPagos() {
        return $this->MontoTotalPagos;
    }

    public function setTotalRetencionesIVA($TotalRetencionesIVA) {
        $this->TotalRetencionesIVA = $TotalRetencionesIVA;
    }

    public function setTotalRetencionesISR($TotalRetencionesISR) {
        $this->TotalRetencionesISR = $TotalRetencionesISR;
    }

    public function setTotalRetencionesIEPS($TotalRetencionesIEPS) {
        $this->TotalRetencionesIEPS = $TotalRetencionesIEPS;
    }

    public function setTotalTrasladosBaseIVA16($TotalTrasladosBaseIVA16) {
        $this->TotalTrasladosBaseIVA16 = $TotalTrasladosBaseIVA16;
    }

    public function setTotalTrasladosImpuestoIVA16($TotalTrasladosImpuestoIVA16) {
        $this->TotalTrasladosImpuestoIVA16 = $TotalTrasladosImpuestoIVA16;
    }

    public function setTotalTrasladosBaseIVA8($TotalTrasladosBaseIVA8) {
        $this->TotalTrasladosBaseIVA8 = $TotalTrasladosBaseIVA8;
    }

    public function setTotalTrasladosImpuestoIVA8($TotalTrasladosImpuestoIVA8) {
        $this->TotalTrasladosImpuestoIVA8 = $TotalTrasladosImpuestoIVA8;
    }

    public function setTotalTrasladosBaseIVA0($TotalTrasladosBaseIVA0) {
        $this->TotalTrasladosBaseIVA0 = $TotalTrasladosBaseIVA0;
    }

    public function setTotalTrasladosImpuestoIVA0($TotalTrasladosImpuestoIVA0) {
        $this->TotalTrasladosImpuestoIVA0 = $TotalTrasladosImpuestoIVA0;
    }

    public function setTotalTrasladosBaseIVAExento($TotalTrasladosBaseIVAExento) {
        $this->TotalTrasladosBaseIVAExento = $TotalTrasladosBaseIVAExento;
    }

    public function setMontoTotalPagos($MontoTotalPagos) {
        $this->MontoTotalPagos = $MontoTotalPagos;
    }

    public function asXML($root) {
        $Totales = $root->ownerDocument->createElement("pago20:Totales");
        $ov = array_filter(get_object_vars($this));
        foreach ($ov as $key=>$value) {
            $Totales->setAttribute($key, $value);
        }
        return $Totales;
    }
    
    public static function parse($DOMElement) {
        $Totales = new Totales();
        Reflection::setAttributes($Totales, $DOMElement);
        return $Totales;
    }
}

class Pago implements CFDIElement {

    /** @var Pago\DoctoRelacionado[] */
    private $DoctoRelacionado = array();
    /** @var Pago\ImpuestosP */
    private $ImpuestosP;

    private $FechaPago;
    private $FormaDePagoP;
    private $MonedaP;
    private $TipoCambioP;
    private $Monto;
    private $NumOperacion;
    private $RfcEmisorCtaOrd;
    private $NomBancoOrdExt;
    private $CtaOrdenante;
    private $RfcEmisorCtaBen;
    private $CtaBeneficiario;
    private $TipoCadPago;
    private $CertPago;
    private $CadPago;
    private $SelloPago;

    function getDoctoRelacionado() {
        return $this->DoctoRelacionado;
    }

    function getImpuestosP() {
        return $this->ImpuestosP;
    }

    function getFechaPago() {
        return $this->FechaPago;
    }

    function getFormaDePagoP() {
        return $this->FormaDePagoP;
    }

    function getMonedaP() {
        return $this->MonedaP;
    }

    function getTipoCambioP() {
        return $this->TipoCambioP;
    }

    function getMonto() {
        return $this->Monto;
    }

    function getNumOperacion() {
        return $this->NumOperacion;
    }

    function getRfcEmisorCtaOrd() {
        return $this->RfcEmisorCtaOrd;
    }

    function getNomBancoOrdExt() {
        return $this->NomBancoOrdExt;
    }

    function getCtaOrdenante() {
        return $this->CtaOrdenante;
    }

    function getRfcEmisorCtaBen() {
        return $this->RfcEmisorCtaBen;
    }

    function getCtaBeneficiario() {
        return $this->CtaBeneficiario;
    }

    function getTipoCadPago() {
        return $this->TipoCadPago;
    }

    function getCertPago() {
        return $this->CertPago;
    }

    function getCadPago() {
        return $this->CadPago;
    }

    function getSelloPago() {
        return $this->SelloPago;
    }

    public function setDoctoRelacionado(array $DoctoRelacionado) {
        $this->DoctoRelacionado = $DoctoRelacionado;
    }

    function addDoctoRelacionado(Pago\DoctoRelacionado $DoctoRelacionado) {
        $this->DoctoRelacionado[] = $DoctoRelacionado;
    }

    function setImpuestosP(Pago\ImpuestosP $ImpuestosP) {
        $this->ImpuestosP = $ImpuestosP;
    }

    function setFechaPago($FechaPago) {
        $this->FechaPago = $FechaPago;
    }

    function setFormaDePagoP($FormaDePagoP) {
        $this->FormaDePagoP = $FormaDePagoP;
    }

    function setMonedaP($MonedaP) {
        $this->MonedaP = $MonedaP;
    }

    function setTipoCambioP($TipoCambioP) {
        $this->TipoCambioP = $TipoCambioP;
    }

    function setMonto($Monto) {
        $this->Monto = $Monto;
    }

    function setNumOperacion($NumOperacion) {
        $this->NumOperacion = $NumOperacion;
    }

    function setRfcEmisorCtaOrd($RfcEmisorCtaOrd) {
        $this->RfcEmisorCtaOrd = $RfcEmisorCtaOrd;
    }

    function setNomBancoOrdExt($NomBancoOrdExt) {
        $this->NomBancoOrdExt = $NomBancoOrdExt;
    }

    function setCtaOrdenante($CtaOrdenante) {
        $this->CtaOrdenante = $CtaOrdenante;
    }

    function setRfcEmisorCtaBen($RfcEmisorCtaBen) {
        $this->RfcEmisorCtaBen = $RfcEmisorCtaBen;
    }

    function setCtaBeneficiario($CtaBeneficiario) {
        $this->CtaBeneficiario = $CtaBeneficiario;
    }

    function setTipoCadPago($TipoCadPago) {
        $this->TipoCadPago = $TipoCadPago;
    }

    function setCertPago($CertPago) {
        $this->CertPago = $CertPago;
    }

    function setCadPago($CadPago) {
        $this->CadPago = $CadPago;
    }

    function setSelloPago($SelloPago) {
        $this->SelloPago = $SelloPago;
    }

    private function getVarArray() {
        return array_filter(get_object_vars($this), 
            function ($val) { 
                return !is_array($val) 
                    && ($val === '0' || $val === 0 || $val === 0.0 ||  !empty($val))
                    && !($val instanceof Pagos20\ImpuestosP);
        }); 
    }

    function asXML($root) {

        $Pago = $root->ownerDocument->createElement("pago20:Pago");
        $ov = $this->getVarArray();
        foreach ($ov as $attr=>$value) {
            $Pago->setAttribute($attr, $value);
        }

        if (!empty($this->DoctoRelacionado)) {
            foreach ($this->DoctoRelacionado as $DoctoRelacionado) {
                $Pago->appendChild($DoctoRelacionado->asXML($root));
            }
        }

        if (!empty($this->ImpuestosP)) {
            $Pago->appendChild($this->ImpuestosP->asXML($root));
        }

        return $Pago;
    }
    
    public static function parse($DOMElement) {
        
        $Pago = new Pago();
        Reflection::setAttributes($Pago, $DOMElement);
        for ($i=0; $i<$DOMElement->childNodes->length; $i++) {
            $node = $DOMElement->childNodes->item($i);
            if (strpos($node->nodeName, "pago20:DoctoRelacionado")!==false) {
                $Pago->addDoctoRelacionado(Pago\DoctoRelacionado::parse($node));
            } else
            if (strpos($node->nodeName, "pago20:ImpuestosP")!==false) {
                $Pago->setImpuestosP(Pago\ImpuestosP::parse($node));
            }
        }
        return $Pago;
    }
}

namespace com\softcoatl\cfdi\complemento\pagos\Pagos20\Pago;

use com\softcoatl\cfdi\CFDIElement;
use com\softcoatl\cfdi\utils\Reflection;

class DoctoRelacionado implements CFDIElement {

    /** @var DoctoRelacionado\ImpuestosDR */
    private $ImpuestosDR;

    private $IdDocumento;
    private $Serie;
    private $Folio;
    private $MonedaDR;
    private $EquivalenciaDR;
    private $NumParcialidad;
    private $ImpSaldoAnt;
    private $ImpPagado;
    private $ImpSaldoInsoluto;
    private $ObjetoImpDR;

    function getImpuestosDR() {
        return $this->ImpuestosDR;
    }

    function getIdDocumento() {
        return $this->IdDocumento;
    }

    function getSerie() {
        return $this->Serie;
    }

    function getFolio() {
        return $this->Folio;
    }

    function getMonedaDR() {
        return $this->MonedaDR;
    }

    function getEquivalenciaDR() {
        return $this->EquivalenciaDR;
    }

    function getNumParcialidad() {
        return $this->NumParcialidad;
    }

    function getImpSaldoAnt() {
        return $this->ImpSaldoAnt;
    }

    function getImpPagado() {
        return $this->ImpPagado;
    }

    function getImpSaldoInsoluto() {
        return $this->ImpSaldoInsoluto;
    }

    function getObjetoImpDR() {
        return $this->ObjetoImpDR;
    }

    function setImpuestosDR(DoctoRelacionado\ImpuestosDR $ImpuestosDR) {
        $this->ImpuestosDR = $ImpuestosDR;
    }

    function setIdDocumento($IdDocumento) {
        $this->IdDocumento = $IdDocumento;
    }

    function setSerie($Serie) {
        $this->Serie = $Serie;
    }

    function setFolio($Folio) {
        $this->Folio = $Folio;
    }

    function setMonedaDR($MonedaDR) {
        $this->MonedaDR = $MonedaDR;
    }

    function setEquivalenciaDR($EquivalenciaDR) {
        $this->EquivalenciaDR = $EquivalenciaDR;
    }

    function setNumParcialidad($NumParcialidad) {
        $this->NumParcialidad = $NumParcialidad;
    }

    function setImpSaldoAnt($ImpSaldoAnt) {
        $this->ImpSaldoAnt = $ImpSaldoAnt;
    }

    function setImpPagado($ImpPagado) {
        $this->ImpPagado = $ImpPagado;
    }

    function setImpSaldoInsoluto($ImpSaldoInsoluto) {
        $this->ImpSaldoInsoluto = $ImpSaldoInsoluto;
    }

    function setObjetoImpDR($ObjetoImpDR) {
        $this->ObjetoImpDR = $ObjetoImpDR;
    }

    private function getVarArray() {
        return array_filter(get_object_vars($this), 
            function ($val) { 
                return !is_array($val) 
                    && ($val === '0' || $val === 0 || $val === 0.0 ||  !empty($val))
                    && !($val instanceof DoctoRelacionado\ImpuestosDR);
        }); 
    }

    function asXML($root) {

        $DoctoRelacionado = $root->ownerDocument->createElement("pago20:DoctoRelacionado");
        $ov = $this->getVarArray();
        foreach ($ov as $attr=>$value) {
            $DoctoRelacionado->setAttribute($attr, $value);
        }
        if (!empty($this->ImpuestosDR)) {
            $DoctoRelacionado->appendChild($this->ImpuestosDR->asXML($root));
        }
        return $DoctoRelacionado;
    }
    
    public static function parse($DOMElement) {
        $DoctoRelacionado = new DoctoRelacionado();
        Reflection::setAttributes($DoctoRelacionado, $DOMElement);
        for ($i=0; $i<$DOMElement->childNodes->length; $i++) {
            $node = $DOMElement->childNodes->item($i);
            if (strpos($node->nodeName, ":ImpuestosDR")!==false) {
                $DoctoRelacionado->setImpuestosDR(DoctoRelacionado\ImpuestosDR::parse($node));
            }
        }
        return $DoctoRelacionado;
    }
}

class ImpuestosP implements CFDIElement {

    /** @var ImpuestosP\RetencionesP */
    private $RetencionesP;
    /** @var ImpuestosP\TrasladosP */
    private $TrasladosP;

    function getRetencionesP() {
        return $this->RetencionesP;
    }

    function getTrasladosP() {
        return $this->TrasladosP;
    }

    function setRetencionesP(ImpuestosP\RetencionesP $RetencionesP) {
        $this->RetencionesP = $RetencionesP;
    }

    function setTrasladosP(ImpuestosP\TrasladosP $TrasladosP) {
        $this->TrasladosP = $TrasladosP;
    }

    function asXML($root) {

        $ImpuestosP = $root->ownerDocument->createElement("pago20:ImpuestosP");

        if (!empty($this->RetencionesP)) {
            $ImpuestosP->appendChild($this->RetencionesP->asXML($root));
        }

        if (!empty($this->TrasladosP)) {
            $ImpuestosP->appendChild($this->TrasladosP->asXML($root));
        }

        return $ImpuestosP;
    }

    public static function parse($DOMElement) {

        $ImpuestosP = new ImpuestosP();
        for ($i=0; $i<$DOMElement->childNodes->length; $i++) {
            $node = $DOMElement->childNodes->item($i);
            if (strpos($node->nodeName, "pago20:RetencionesP")!==false) {
                $ImpuestosP->setRetencionesDR(ImpuestosDR\RetencionesDR::parse($node));
            } else
            if (strpos($node->nodeName, "pago20:TrasladosDR")!==false) {
                $ImpuestosP->setTrasladosDR(ImpuestosDR\TrasladosDR::parse($node));
            }
        }
        return $ImpuestosP;
    }
}

namespace com\softcoatl\cfdi\complemento\pagos\Pagos20\Pago\DoctoRelacionado;

use com\softcoatl\cfdi\CFDIElement;

class ImpuestosDR implements CFDIElement {

    /** @var ImpuestosDR\RetencionesDR */
    private $RetencionesDR;
    /** @var ImpuestosDR\TrasladosDR */
    private $TrasladosDR;

    function getRetencionesDR() {
        return $this->RetencionesDR;
    }

    function getTrasladosDR() {
        return $this->TrasladosDR;
    }

    function setRetencionesDR(ImpuestosDR\RetencionesDR $RetencionesDR) {
        $this->RetencionesDR = $RetencionesDR;
    }

    function setTrasladosDR(ImpuestosDR\TrasladosDR $TrasladosDR) {
        $this->TrasladosDR = $TrasladosDR;
    }

    function asXML($root) {

        $ImpuestosDR = $root->ownerDocument->createElement("pago20:ImpuestosDR");

        if (!empty($this->RetencionesDR) && !empty($this->RetencionesDR->getRetencionDR())) {
            $ImpuestosDR->appendChild($this->RetencionesDR->asXML($root));
        }

        if (!empty($this->TrasladosDR) && !empty($this->TrasladosDR->getTrasladoDR())) {
            $ImpuestosDR->appendChild($this->TrasladosDR->asXML($root));
        }

        return $ImpuestosDR;
    }

    public static function parse($DOMElement) {

        $ImpuestosDR = new ImpuestosDR();
        for ($i=0; $i<$DOMElement->childNodes->length; $i++) {
            $node = $DOMElement->childNodes->item($i);
            if (strpos($node->nodeName, 'pago20:RetencionesDR')!==false) {
                $ImpuestosDR->setRetencionesDR(ImpuestosDR\RetencionesDR::parse($node));
            } else
            if (strpos($node->nodeName, 'pago20:TrasladosDR')!==false) {
                $ImpuestosDR->setTrasladosDR(ImpuestosDR\TrasladosDR::parse($node));
            }
        }
        return $ImpuestosDR;
    }
}

namespace com\softcoatl\cfdi\complemento\pagos\Pagos20\Pago\DoctoRelacionado\ImpuestosDR;

use com\softcoatl\cfdi\CFDIElement;

class RetencionesDR implements CFDIElement {

    /** @var RetencionesDR\RetencionDR[] */
    private $RetencionDR = array();
    
    public function getRetencionDR() {
        return $this->RetencionDR;
    }

    public function setRetencionDR(array $RetencionDR) {
        $this->RetencionDR = $RetencionDR;
    }

    public function addRetencionDR(RetencionesDR\RetencionDR $RetencionDR) {
        $this->RetencionDR[] = $RetencionDR;
    }

    public function asXML($root) {
        $RetencionesDR = $root->ownerDocument->createElement("pago20:RetencionesDR");
        if (!empty($this->RetencionDR)) {
            foreach ($this->RetencionDR as $RetencionDR) {
                $RetencionesDR->appendChild($RetencionDR->asXML($root));
            }
        }
        return $RetencionesDR;
    }
    
    public static function parse($DOMElement) {
        $RetencionesDR = new RetencionesDR();
        for ($i=0; $i<$DOMElement->childNodes->length; $i++) {
            $node = $DOMElement->childNodes->item($i);
            if (strpos($node->nodeName, 'pago20:RetencionDR')!==false) {
                $RetencionesDR->addRetencionDR(RetencionesDR\RetencionDR::parse($node));
            }
        }
        return $RetencionesDR;
    }
}

class TrasladosDR implements CFDIElement {

    /** @var TrasladosDR\TrasladoDR[] */
    private $TrasladoDR = array();
    
    public function getTrasladoDR() {
        return $this->TrasladoDR;
    }

    public function setTrasladoDR(array $TrasladoDR) {
        $this->TrasladoDR = $TrasladoDR;
    }

    public function addTrasladoDR(TrasladosDR\TrasladoDR $TrasladoDR) {
        $this->TrasladoDR[] = $TrasladoDR;
    }

    public function asXML($root) {

        $TrasladosDR = $root->ownerDocument->createElement("pago20:TrasladosDR");
        if (!empty($this->TrasladoDR)) {
            foreach ($this->TrasladoDR as $TrasladoDR ){
                $TrasladosDR->appendChild($TrasladoDR->asXML($root));
            }
        }
        return $TrasladosDR;
    }
    
    public static function parse($DOMElement) {
        $TrasladosDR = new TrasladosDR();
        for ($i=0; $i<$DOMElement->childNodes->length; $i++) {
            $node = $DOMElement->childNodes->item($i);
            if (strpos($node->nodeName, 'pago20:TrasladosDR')!==false) {
                $TrasladosDR->addTrasladoDR(TrasladosDR\TrasladoDR::parse($node));
            }
        }
        return $TrasladosDR;
    }
}

namespace com\softcoatl\cfdi\complemento\pagos\Pagos20\Pago\DoctoRelacionado\ImpuestosDR\RetencionesDR;

use com\softcoatl\cfdi\CFDIElement;
use com\softcoatl\cfdi\utils\Reflection;

class RetencionDR implements CFDIElement {

   private $BaseDR;
   private $ImpuestoDR;
   private $TipoFactorDR;
   private $TasaOCuotaDR;
   private $ImporteDR;

   public function getBaseDR() {
       return $this->BaseDR;
   }

   public function getImpuestoDR() {
       return $this->ImpuestoDR;
   }

   public function getTipoFactorDR() {
       return $this->TipoFactorDR;
   }

   public function getTasaOCuotaDR() {
       return $this->TasaOCuotaDR;
   }

   public function getImporteDR() {
       return $this->ImporteDR;
   }

   public function setBaseDR($BaseDR) {
       $this->BaseDR = $BaseDR;
   }

   public function setImpuestoDR($ImpuestoDR) {
       $this->ImpuestoDR = $ImpuestoDR;
   }

   public function setTipoFactorDR($TipoFactorDR) {
       $this->TipoFactorDR = $TipoFactorDR;
   }

   public function setTasaOCuotaDR($TasaOCuotaDR) {
       $this->TasaOCuotaDR = $TasaOCuotaDR;
   }

   public function setImporteDR($ImporteDR) {
       $this->ImporteDR = $ImporteDR;
   }

   public function asXML($root) {
        $RetencionDR = $root->ownerDocument->createElement("pago20:RetencionDR");
        $ov = array_filter(get_object_vars($this));
        foreach ($ov as $key=>$value) {
            $RetencionDR->setAttribute($key, $value);
        }
        return $RetencionDR;
   }
   
   public static function parse($DOMElement) {
       $RetencionDR = new RetencionDR();
       Reflection::setAttributes($RetencionDR, $DOMElement);
       return $RetencionDR;
   }
}

namespace com\softcoatl\cfdi\complemento\pagos\Pagos20\Pago\DoctoRelacionado\ImpuestosDR\TrasladosDR;

use com\softcoatl\cfdi\CFDIElement;
use com\softcoatl\cfdi\utils\Reflection;

class TrasladoDR implements CFDIElement {

    private $BaseDR;
    private $ImpuestoDR;
    private $TipoFactorDR;
    private $TasaOCuotaDR;
    private $ImporteDR;

    public function getBaseDR() {
        return $this->BaseDR;
    }

    public function getImpuestoDR() {
        return $this->ImpuestoDR;
    }

    public function getTipoFactorDR() {
        return $this->TipoFactorDR;
    }

    public function getTasaOCuotaDR() {
        return $this->TasaOCuotaDR;
    }

    public function getImporteDR() {
        return $this->ImporteDR;
    }

    public function setBaseDR($BaseDR) {
        $this->BaseDR = $BaseDR;
    }

    public function setImpuestoDR($ImpuestoDR) {
        $this->ImpuestoDR = $ImpuestoDR;
    }

    public function setTipoFactorDR($TipoFactorDR) {
        $this->TipoFactorDR = $TipoFactorDR;
    }

    public function setTasaOCuotaDR($TasaOCuotaDR) {
        $this->TasaOCuotaDR = $TasaOCuotaDR;
    }

    public function setImporteDR($ImporteDR) {
        $this->ImporteDR = $ImporteDR;
    }

    public function asXML($root) {
        $TrasladoDR = $root->ownerDocument->createElement("pago20:TrasladoDR");
        $ov = array_filter(get_object_vars($this));
        foreach ($ov as $key=>$value) {
            $TrasladoDR->setAttribute($key, $value);
        }
        return $TrasladoDR;
    }

    public static function parse($DOMElement) {
        $TrasladoDR = new TrasladoDR();
        Reflection::setAttributes($TrasladoDR, $DOMElement);
        return $TrasladoDR;
    }
}

namespace com\softcoatl\cfdi\complemento\pagos\Pagos20\Pago\ImpuestosP;

use com\softcoatl\cfdi\CFDIElement;

class RetencionesP implements CFDIElement {

    /** @var RetencionesP\RetencionP[] */
    private $RetencionP = array();
    
    public function getRetencionP() {
        return $this->RetencionP;
    }

    public function setRetencionP(array $RetencionP) {
        $this->RetencionP = $RetencionP;
    }

    public function addRetencionP(RetencionesP\RetencionP $RetencionP) {
        $this->RetencionP[] = $RetencionP;
    }

    public function asXML($root) {
        $RetencionesP = $root->ownerDocument->createElement("pago20:RetencionesP");
        if (!empty($this->RetencionP)) {
            foreach ($this->RetencionP as $RetencionP) {
                $RetencionesP->appendChild($RetencionP->asXML($root));
            }
        }
        return $RetencionesP;
    }
    
    public static function parse($DOMElement) {
        $RetencionesP = new RetencionesP();
        for ($i=0; $i<$DOMElement->childNodes->length; $i++) {
            $node = $DOMElement->childNodes->item($i);
            if (strpos($node->nodeName, 'pago20:RetencionP')!==false) {
                $RetencionesP->addRetencionDR(RetencionesP\RetencionP::parse($node));
            }
        }
        return $RetencionesP;
    }
}

class TrasladosP implements CFDIElement {

    /** @var TrasladosP\TrasladoP[] */
    private $TrasladoP = array();
    
    public function getTrasladoP() {
        return $this->TrasladoP;
    }

    public function setTrasladoP(array $TrasladoP) {
        $this->TrasladoP = $TrasladoP;
    }

    public function addTrasladoP(TrasladosP\TrasladoP $TrasladoP) {
        $this->TrasladoP[] = $TrasladoP;
    }

    public function asXML($root) {

        $TrasladosP = $root->ownerDocument->createElement("pago20:TrasladosP");
        if (!empty($this->TrasladoP)) {
            foreach ($this->TrasladoP as $TrasladoP ){
                $TrasladosP->appendChild($TrasladoP->asXML($root));
            }
        }
        return $TrasladosP;
    }
    
    public static function parse($DOMElement) {
        $TrasladosP = new TrasladosP();
        for ($i=0; $i<$DOMElement->childNodes->length; $i++) {
            $node = $DOMElement->childNodes->item($i);
            if (strpos($node->nodeName, 'pago20:TrasladosP')!==false) {
                $TrasladosP->addTrasladoP(TrasladosP\TrasladoP::parse($node));
            }
        }
        return $TrasladosP;
    }
}

namespace com\softcoatl\cfdi\complemento\pagos\Pagos20\Pago\ImpuestosP\RetencionesP;

use com\softcoatl\cfdi\CFDIElement;
use com\softcoatl\cfdi\utils\Reflection;

class RetencionP implements \com\softcoatl\cfdi\CFDIElement {

    private $ImpuestoP;
    private $ImporteP;

    public function getImpuestoP() {
        return $this->ImpuestoP;
    }

    public function getImporteP() {
        return $this->ImporteP;
    }

    public function setImpuestoP($ImpuestoP) {
        $this->ImpuestoP = $ImpuestoP;
    }

    public function setImporteP($ImporteP) {
        $this->ImporteP = $ImporteP;
    }

    public function asXML($root) {
        $RetencionP = $root->ownerDocument->createElement("pago20:RetencionP");
        $ov = array_filter(get_object_vars($this));
        foreach ($ov as $key=>$value) {
            $RetencionP->setAttribute($key, $value);
        }
        return $RetencionP;
    }
    
    public static function parse($DOMElement) {
        $RetencionP = new RetencionP();
        Reflection::setAttributes($RetencionP, $DOMElement);
        return $RetencionP;
    }
}

namespace com\softcoatl\cfdi\complemento\pagos\Pagos20\Pago\ImpuestosP\TrasladosP;

use com\softcoatl\cfdi\CFDIElement;
use com\softcoatl\cfdi\utils\Reflection;

class TrasladoP implements CFDIElement {

    private $BaseP;
    private $ImpuestoP;
    private $TipoFactorP;
    private $TasaOCuotaP;
    private $ImporteP;

    public function getBaseP() {
        return $this->BaseP;
    }

    public function getImpuestoP() {
        return $this->ImpuestoP;
    }

    public function getTipoFactorP() {
        return $this->TipoFactorP;
    }

    public function getTasaOCuotaP() {
        return $this->TasaOCuotaP;
    }

    public function getImporteP() {
        return $this->ImporteP;
    }

    public function setBaseP($BaseP) {
        $this->BaseP = $BaseP;
    }

    public function setImpuestoP($ImpuestoP) {
        $this->ImpuestoP = $ImpuestoP;
    }

    public function setTipoFactorP($TipoFactorP) {
        $this->TipoFactorP = $TipoFactorP;
    }

    public function setTasaOCuotaP($TasaOCuotaP) {
        $this->TasaOCuotaP = $TasaOCuotaP;
    }

    public function setImporteP($ImporteP) {
        $this->ImporteP = $ImporteP;
    }

    public function asXML($root) {
        $TrasladoP = $root->ownerDocument->createElement("pago20:TrasladoP");
        $ov = array_filter(get_object_vars($this));
        foreach ($ov as $key=>$value) {
            $TrasladoP->setAttribute($key, $value);
        }
        return $TrasladoP;
    }
    
    public static function parse($DOMElement) {
        $TrasladoP = new TrasladoP();
        Reflection::setAttributes($TrasladoP, $DOMElement);
        return $TrasladoP;
    }
}
