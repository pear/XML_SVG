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
 * XML_SVG_Rect
 *
 * @package XML_SVG
 */
class XML_SVG_Rect extends XML_SVG_Element 
{

    var $_x;
    var $_y;
    var $_width;
    var $_height;
    var $_rx;
    var $_ry;

    function printElement()
    {
        echo '<rect';
        $this->printParams('id', 'x', 'y', 'width', 'height',
                           'rx', 'ry', 'style');
        if (is_array($this->_elements)) {
            // Print children, start and end tag.
            print(">\n");
            parent::printElement();
            print("</rect>\n");
        } else {
            // Print short tag.
            print("/>\n");
        }
    }

    function setShape($x, $y, $width, $height)
    {
        $this->_x = $x;
        $this->_y = $y;
        $this->_width  = $width;
        $this->_height  = $height;
    }

}

