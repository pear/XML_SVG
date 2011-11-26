<?php
/**
 * Package for building SVG graphics.
 *
 * Copyright 2002-2007 The Horde Project (http://www.horde.org/)
 *
 * @author  Chuck Hagenbuch <chuck@horde.org>
 * @package XML_SVG
 * @license http://www.fsf.org/copyleft/lgpl.html
 */
require_once 'XML/SVG/Textpath.php';

/**
 * XML_SVG_Text
 *
 * @package XML_SVG
 */
class XML_SVG_Text extends XML_SVG_Textpath 
{

    function printElement()
    {
        parent::printElement('text');
    }

    function setShape($x, $y, $text)
    {
        $this->_x = $x;
        $this->_y = $y;
        $this->_text = $text;
    }

}
