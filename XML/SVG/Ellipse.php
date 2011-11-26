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
 * XML_SVG_Ellipse
 *
 * @package XML_SVG
 */
class XML_SVG_Ellipse extends XML_SVG_Element 
{

    var $_cx;
    var $_cy;
    var $_rx;
    var $_ry;

    function printElement()
    {
        echo '<ellipse';
        $this->printParams('id', 'cx', 'cy', 'rx', 'ry', 'style', 'transform');
        if (is_array($this->_elements)) {
            // Print children, start and end tag.
            print(">\n");
            parent::printElement();
            print("</ellipse>\n");
        } else {
            // Print short tag.
            print(" />\n");
        }
    }

    function setShape($cx, $cy, $rx, $ry)
    {
        $this->_cx = $cx;
        $this->_cy = $cy;
        $this->_rx  = $rx;
        $this->_ry  = $ry;
    }

}
