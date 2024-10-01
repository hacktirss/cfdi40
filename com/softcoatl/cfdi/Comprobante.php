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
namespace com\softcoatl\cfdi;

interface Comprobante {

    public function getVersion();
    public function setNoCertificado($noCertificado);
    public function setCertificado($certificado);
    public function setSello($sello);

    public function getTimbreFiscalDigital(): complemento\tfd\TimbreFiscalDigital;
    public function getOriginalBytes();
    public function getTFDOriginalBytes();
    public function getValidationURL();

    public function schemaValidate();

    public function asXML($root): \DOMDocument;
}
