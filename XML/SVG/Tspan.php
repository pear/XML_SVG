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
 * XML_SVG_Tspan
 *
 * @package XML_SVG
 */
class XML_SVG_Tspan extends XML_SVG_Element 
{

    var $_text;
    var $_x;
    var $_y;
    var $_dx;
    var $_dy;
    var $_rotate;
    var $_textLength;
    var $_lengthAdjust;

    function printElement()
    {
        echo '<tspan';
        $this->printParams('id', 'x', 'y', 'dx', 'dy', 'rotate',
                           'textLength', 'lengthAdjust', 'style', 'transform');
        echo '>' . $this->_text;
        if (is_array($this->_elements)) {
            parent::printElement();
        }
        echo "</tspan>\n";
    }

    function setShape($x, $y, $text)
    {
        $this->_x = $x;
        $this->_y = $y;
        $this->_text  = $text;
    }

}
