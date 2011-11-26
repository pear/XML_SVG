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
require_once 'XML/SVG/Element.php';

/**
 * XML_SVG_Use
 *
 * @package XML_SVG
 */
class XML_SVG_Use extends XML_SVG_Element 
{

    var $_symbol;

    function XML_SVG_Use($symbol, $params = array())
    {
        parent::XML_SVG_Element($params);
        $this->_symbol = $symbol;
    }

    function printElement()
    {
        echo '<use xlink:href="#' . $this->_symbol . '"/>';
    }

}
