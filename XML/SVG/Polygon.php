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
 * XML_SVG_Polygon
 *
 * @package XML_SVG
 */
class XML_SVG_Polygon extends XML_SVG_Element 
{

    var $_points;

    function printElement()
    {
        echo '<polygon';
        $this->printParams('id', 'points', 'style', 'transform');
        if (is_array($this->_elements)) {
            // Print children, start and end tag.
            print(">\n");
            parent::printElement();
            print("</polygon>\n");
        } else {
            // Print short tag.
            print("/>\n");
        }
    }

    function setShape($points)
    {
        $this->_points = $points;
    }

}

