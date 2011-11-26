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
 * XML_SVG_Line
 *
 * @package XML_SVG
 */
class XML_SVG_Line extends XML_SVG_Element 
{

    var $_x1;
    var $_y1;
    var $_x2;
    var $_y2;

    function printElement()
    {
        echo '<line';
        $this->printParams('id', 'x1', 'y1', 'x2', 'y2', 'style');
        if (is_array($this->_elements)) {
            // Print children, start and end tag.
            print(">\n");
            parent::printElement();
            print("</line>\n");
        } else {
            // Print short tag.
            print("/>\n");
        }
    }

    function setShape($x1, $y1, $x2, $y2)
    {
        $this->_x1 = $x1;
        $this->_y1 = $y1;
        $this->_x2  = $x2;
        $this->_y2  = $y2;
    }

}
