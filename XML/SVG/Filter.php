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
 * XML_SVG_Filter
 *
 * @package XML_SVG
 */
class XML_SVG_Filter extends XML_SVG_Element 
{

    function printElement()
    {
        echo '<filter';
        $this->printParams('id');
        if (is_array($this->_elements)) {
            // Print children, start and end tag.
            echo ">\n";
            parent::printElement();
            echo "</filter>\n";
        } else {
            echo " />\n";
        }
    }

    function addPrimitive($primitive, $params)
    {
        $this->addChild(new XML_SVG_FilterPrimitive($primitive, $params));
    }

}
