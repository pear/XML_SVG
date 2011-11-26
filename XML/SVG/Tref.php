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
 * XML_SVG_Tref
 *
 * @package XML_SVG
 */
class XML_SVG_Tref extends XML_SVG_Element 
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
        echo '<tref';
        $this->printParams('id', 'x', 'y', 'dx', 'dy', 'rotate',
                           'textLength', 'lengthAdjust', 'style');
        echo '>' . $this->_text;
        parent::printElement();
        echo "</tref>\n";
    }

}
