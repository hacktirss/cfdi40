<?php
/*
 * Complemento
 * CFDI versión 4.0
 * CFDI®
 * © 2022, Softcoatl 
 * http://www.softcoatl.mx
 * @author Rolando Esquivel Villafaña, Softcoatl
 * @version 1.0
 * @since jan 2022
 */
namespace com\softcoatl\cfdi\v40\schema\Comprobante40;

use com\softcoatl\cfdi\CFDIElement;

class Complemento implements CFDIElement {

    /** @var */
    private $any = array();

    public function getAny() {
        return $this->any;
    }

    public function addAny(CFDIElement $any) {
        $this->any[] = $any;
    }

    public function asXML($root) {
        
    }
}
