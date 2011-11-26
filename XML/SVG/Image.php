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
 * XML_SVG_Image
 *
 * @package XML_SVG
 */
class XML_SVG_Image extends XML_SVG_Element 
{

    var $_x;
    var $_y;
    var $_width;
    var $_height;
    var $_href;

    function printElement()
    {
        echo '<image';
        $this->printParams('id', 'x', 'y', 'width', 'height', 'style');
        if (!empty($this->_href)) {
            echo ' xlink:href="' . $this->_href . '"';
        }
        if (is_array($this->_elements)) {
            // Print children, start and end tag.
            echo ">\n";
            parent::printElement();
            echo "</image>\n";
        } else {
            // Print short tag.
            echo " />\n";
        }
    }

    function setShape($x, $y, $width, $height, $href)
    {
        $this->_x = $x;
        $this->_y = $y;
        $this->_width  = $width;
        $this->_height  = $height;
        $this->_href = $href;
    }

}
