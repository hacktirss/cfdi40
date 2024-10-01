<?php
/*
 * Pagos10
 * cfdi33®
 * ® 2017, Softcoatl 
 * http://www.softcoatl.mx
 * @author Rolando Esquivel Villafaña, Softcoatl
 * @version 1.0
 * @since nov 2017
 */
namespace com\softcoatl\cfdi\complemento\pagos;

use com\softcoatl\cfdi\CFDIElement;
use com\softcoatl\cfdi\utils\Reflection;

class Pagos10 implements CFDIElement {

    private $Version = "1.0";
    /** @var Pagos10\Pago[] */
    private $Pago = array();

    function getVersion() {
        return $this->Version;
    }

    function getPago() {
        return $this->Pago;
    }

    function setVersion($version) {
        $this->Version = $version;
    }

    public function setPago(array $Pago) {
        $this->Pago = $Pago;
    }

    function addPago(Pagos10\Pago $pago) {
        $this->Pago[] = $pago;
    }

    function asXML($root) {

        if ($root->ownerDocument->documentElement
                && empty($root->ownerDocument->documentElement->attributes->getNamedItem("xmlns:pago10"))) {
            $root->ownerDocument->documentElement->setAttribute("xmlns:pago10", "http://www.sat.gob.mx/Pagos");
            $root->ownerDocument->documentElement->setAttribute("xsi:schemaLocation", 
                            $root->ownerDocument->documentElement->getAttribute("xsi:schemaLocation") 
                        .   " http://www.sat.gob.mx/Pagos http://www.sat.gob.mx/sitio_internet/cfd/Pagos/Pagos10.xsd");
        }
        $Pagos = $root->ownerDocument->createElement("pago10:Pagos");
        $Pagos->setAttribute("Version", $this->Version);
        if (!empty($this->Pagos)) {
            foreach ($this->Pagos as $pago) {
                $Pagos->appendChild($pago->asXML($root));
            }
        }
        return $Pagos;
    }

    public static function parse($DOMPagos) {

        if (strpos($DOMPagos->nodeName, ':Pagos')) {
            $Pagos = new Pagos();
            $Pagos->setVersion($DOMPagos->getAttribute('Version'));

            for ($i=0; $i<$DOMPagos->childNodes->length; $i++) {
                $node = $DOMPagos->childNodes->item($i);
                if (strpos($node->nodeName, ':Pago')!==false) {

                    $Pago = new Pagos10\Pago();
                    Reflection::setAttributes($Pago, $node);
                    for ($j=0; $j<$node->childNodes->length; $j++) {

                        $nodeP = $node->childNodes->item($j);
                        if (strpos($nodeP->nodeName, ':DoctoRelacionado')!==false) {

                            $DoctoRelacionado = new Pagos10\Pago\DoctoRelacionado();
                            Reflection::setAttributes($DoctoRelacionado, $nodeP);
                            $Pago->addDoctoRelacionado($DoctoRelacionado);
                        } else
                        if (strpos($nodeP->nodeName, ':Impuestos')!==false) {

                            $Impuestos = new Pagos10\Pago\Impuestos();
                            Reflection::setAttributes($Impuestos, $nodeP);
                            for($j=0; $j<$nodeP->childNodes->length; $j++) {

                                $nodeI = $nodeP->childNodes->item($j);
                                if (strpos($nodeP->nodeName, ':Retenciones')!==false) {

                                    $Retenciones = new Pagos10\Pago\Impuestos\Retenciones();
                                    for($k=0; $j<$nodeI->childNodes->length; $k++) {
                                        $nodeR = $nodeI->childNodes->item($k);
                                        if (strpos($nodeR->nodeName, ':Retencion')!==false) {
                                            $Retencion = new Pagos10\Pago\Impuestos\Retenciones\Retencion();
                                            Reflection::setAttributes($Retencion, $nodeR);
                                            $Retenciones->addRetencion($Retencion);
                                        }
                                    }
                                    $Impuestos->setRetenciones($Retenciones);
                                } else 
                                if (strpos($nodeP->nodeName, ':Traslados')!==false) {

                                    $Traslados = new Pagos10\Pago\Impuestos\Traslados();
                                    for($k=0; $j<$nodeI->childNodes->length; $k++) {
                                        $nodeT = $nodeI->childNodes->item($k);
                                        if (strpos($nodeT->nodeName, ':Traslado')!==false) {
                                            $Traslado = new Pagos10\Pago\Impuestos\Traslados\Traslado();
                                            Reflection::setAttributes($Traslado, $nodeT);
                                            $Traslados->addTraslado($Traslado);
                                        }
                                    }
                                }
                            }
                            $Pago->addImpuestos($Impuestos);
                        }
                    }
                    $Pagos->addPagos($Pago);
                }
            }
            return $Pagos;
        }
        return false;
    }
}

namespace com\softcoatl\cfdi\complemento\pagos\Pagos10;

use com\softcoatl\cfdi\CFDIElement;

class Pago implements CFDIElement {

    /** @var Pago\DoctoRelacionado[] */
    private $DoctoRelacionado = array();
    /** @var Pago\Impuestos[] */
    private $Impuestos = array();

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

    function getImpuestos() {
        return $this->Impuestos;
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

    function setDoctoRelacionado(array $DoctoRelacionado) {
        $this->DoctoRelacionado = $DoctoRelacionado;
    }

    function addDoctoRelacionado(Pago\DoctoRelacionado $DoctoRelacionado) {
        $this->DoctoRelacionado[] = $DoctoRelacionado;
    }

    public function setImpuestos(array $Impuestos) {
        $this->Impuestos = $Impuestos;
    }

    function addImpuestos(Pago\Impuestos $Impuestos) {
        $this->Impuestos[] = $Impuestos;
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
                    && ($val === '0' || $val === 0 || $val === 0.0 ||  !empty($val));
            });
    }

    function asXML($root) {

        $Pago = $root->ownerDocument->createElement("pago10:Pago");
        $ov = $this->getVarArray();
        foreach ($ov as $attr=>$value) {
            $Pago->setAttribute($attr, $value);
        }

        if ($this->DoctoRelacionado !== NULL) {
            foreach ($this->DoctoRelacionado as $docto) {
                $Pago->appendChild($docto->asXML($root));
            }
        }

        return $Pago;
    }
}

namespace com\softcoatl\cfdi\complemento\pagos\Pagos10\Pago;

use com\softcoatl\cfdi\CFDIElement;

class DoctoRelacionado implements CFDIElement {

    private $IdDocumento;
    private $Serie;
    private $Folio;
    private $MonedaDR;
    private $TipoCambioDR;
    private $MetodoDePagoDR;
    private $NumParcialidad;
    private $ImpSaldoAnt;
    private $ImpPagado;
    private $ImpSaldoInsoluto;

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

    function getTipoCambioDR() {
        return $this->TipoCambioDR;
    }

    function getMetodoDePagoDR() {
        return $this->MetodoDePagoDR;
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

    function setTipoCambioDR($TipoCambioDR) {
        $this->TipoCambioDR = $TipoCambioDR;
    }

    function setMetodoDePagoDR($MetodoDePagoDR) {
        $this->MetodoDePagoDR = $MetodoDePagoDR;
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

    function asXML($root) {

        $DoctoRelacionado = $root->ownerDocument->createElement("pago10:DoctoRelacionado");
        $ov = array_filter(get_object_vars($this));
        foreach ($ov as $attr=>$value) {
            $DoctoRelacionado->setAttribute($attr, $value);
        }
        return $DoctoRelacionado;
    }
}

class Impuestos implements CFDIElement {

    /** @var Impuestos\Retenciones */
    private $Retenciones;
    /** @var Impuestos\Traslados */
    private $Traslados;

    private $TotalImpuestosRetenidos;
    private $TotalImpuestosTrasladados;
    
    function getRetenciones() {
        return $this->Retenciones;
    }

    function getTraslados() {
        return $this->Traslados;
    }

    function getTotalImpuestosRetenidos() {
        return $this->TotalImpuestosRetenidos;
    }

    function getTotalImpuestosTrasladados() {
        return $this->TotalImpuestosTrasladados;
    }

    function setRetenciones(Impuestos\Retenciones $Retenciones) {
        $this->Retenciones = $Retenciones;
    }

    function setTraslados(Impuestos\Traslados $Traslados) {
        $this->Traslados = $Traslados;
    }

    function setTotalImpuestosRetenidos($TotalImpuestosRetenidos) {
        $this->TotalImpuestosRetenidos = $TotalImpuestosRetenidos;
    }

    function setTotalImpuestosTrasladados($TotalImpuestosTrasladados) {
        $this->TotalImpuestosTrasladados = $TotalImpuestosTrasladados;
    }

    public function getVarArray() {
        return array_filter(get_object_vars($this), 
                        function ($val) { 
                            return !is_array($val) 
                                && ($val === '0' || $val === 0 || $val === 0.0 ||  !empty($val))
                                && !($val instanceof Impuestos\Retenciones)
                                && !($val instanceof Impuestos\Traslados);
        }); 
    }


    public function asXML($root) {
        $Impuestos = $rot->ownerDocument->createElement("pagos10:Impuestos");
        $ov = $this->getVarArray();
        foreach ($ov as $key=>$value) {
            $Impuestos->setAttribute($key, $value);
        }
        if (!empty($this->Retenciones) && !empty($this->Retenciones->getRetencion())) {
            $Impuestos->appendChild($this->Retenciones->asXML($root));
        }
        if (!empty($this->Traslados) && !empty($this->Traslados->getTraslado())) {
            $Impuestos->appendChild($this->Traslados->asXML($root));
        }
        return $Impuestos;
    }
}

namespace com\softcoatl\cfdi\complemento\pagos\Pagos10\Pago\Impuestos;

use com\softcoatl\cfdi\CFDIElement;

class Retenciones implements CFDIElement {

    /** @var Retenciones\Retencion[]*/
    private $Retencion;
    
    public function getRetencion() {
        return $this->Retencion;
    }

    public function addRetencion(Retenciones\Retencion $Retencion) {
        $this->Retencion[] = $Retencion;
    }

    public function asXML($root) {
        $Retenciones = $root->ownerDocument->createElement("pagos10:Retenciones");
        if (!empty($this->Retencion)) {
            foreach ($this->Retencion as $Retencion) {
                $Retenciones->appendChild($Retencion->asXML($root));
            }
        }
        return $Retenciones;
    }
}

class Traslados implements CFDIElement {

    /** @var Traslados\Traslado[]*/
    private $Traslado;

    public function getTraslado() {
        return $this->Traslado;
    }

    public function addTraslado(Traslados\Traslado $Traslado) {
        $this->Traslado[] = $Traslado;
    }

    public function asXML($root) {
        $Traslados = $root->ownerDocument->createElement("pagos10:Retenciones");
        if (!empty($this->Traslado)) {
            foreach ($this->Traslado as $Traslado) {
                $Traslados->appendChild($Traslado->asXML($root));
            }
        }
        return $Traslados;
    }
}

namespace com\softcoatl\cfdi\complemento\pagos\Pagos10\Pago\Impuestos\Retenciones;

use com\softcoatl\cfdi\CFDIElement;

class Retencion implements CFDIElement {

    private $Impuesto;
    private $Importe;

    public function getImpuesto() {
        return $this->Impuesto;
    }

    public function getImporte() {
        return $this->Importe;
    }

    public function setImpuesto($Impuesto) {
        $this->Impuesto = $Impuesto;
    }

    public function setImporte($Importe) {
        $this->Importe = $Importe;
    }

    public function asXML($root) {
        $Retencion = $root->ownerDocument->createElement("pagos10:Retencion");
        $ov = array_filter(get_object_vars($this));
        foreach ($ov as $key=>$val) {
            $Retencion->setAttribute($key, $value);
        }
        return $Retencion;
    }
}

namespace com\softcoatl\cfdi\complemento\pagos\Pagos10\Pago\Impuestos\Traslados;

use com\softcoatl\cfdi\CFDIElement;

class Traslado implements CFDIElement {

    private $Impuesto;
    private $TipoFactor;
    private $TasaOCuota;
    private $Importe;

    public function getImpuesto() {
        return $this->Impuesto;
    }

    public function getTipoFactor() {
        return $this->TipoFactor;
    }

    public function getTasaOCuota() {
        return $this->TasaOCuota;
    }

    public function getImporte() {
        return $this->Importe;
    }

    public function setImpuesto($Impuesto) {
        $this->Impuesto = $Impuesto;
    }

    public function setTipoFactor($TipoFactor) {
        $this->TipoFactor = $TipoFactor;
    }

    public function setTasaOCuota($TasaOCuota) {
        $this->TasaOCuota = $TasaOCuota;
    }

    public function setImporte($Importe) {
        $this->Importe = $Importe;
    }

    public function asXML($root) {
        $Traslado = $root->ownerDocument->createElement("pagos10:Retencion");
        $ov = array_filter(get_object_vars($this));
        foreach ($ov as $key=>$value) {
            $Traslado->setAttribute($key, $value);
        }
        return $Traslado;
    }
}
