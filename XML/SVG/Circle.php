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
 * XML_SVG_Circle
 *
 * @package XML_SVG
 */
class XML_SVG_Circle extends XML_SVG_Element
{

    var $_cx;
    var $_cy;
    var $_r;

    function printElement()
    {
        echo '<circle';

        $this->printParams('id', 'cx', 'cy', 'r', 'style', 'transform');
        if (is_array($this->_elements)) {
            // Print children, start and end tag.
            echo ">\n";
            parent::printElement();
            echo "</circle>\n";
        } else {
            // Print short tag.
            echo "/>\n";
        }
    }

    function setShape($cx, $cy, $r)
    {
        $this->_cx = $cx;
        $this->_cy = $cy;
        $this->_r  = $r;
    }

}
