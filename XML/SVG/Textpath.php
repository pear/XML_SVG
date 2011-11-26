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
 * XML_SVG_Textpath
 *
 * @package XML_SVG
 */
class XML_SVG_Textpath extends XML_SVG_Element 
{

    var $_text;
    var $_x;
    var $_y;
    var $_dx;
    var $_dy;
    var $_rotate;
    var $_textLength;
    var $_lengthAdjust;
    var $_charset;

    function printElement($element = 'textpath')
    {
        echo '<' . $element;
        $this->printParams('id', 'x', 'y', 'dx', 'dy', 'rotate',
                           'textLength', 'lengthAdjust', 'style', 'transform');
        echo '>';
        if (isset($this->_charset)) {
            echo @htmlspecialchars($this->_text, ENT_COMPAT, $this->_charset);
        } else {
            echo htmlspecialchars($this->_text);
        }
        parent::printElement();
        echo "</$element>\n";
    }

    function setShape($x, $y, $text)
    {
        $this->_x = $x;
        $this->_y = $y;
        $this->_text = $text;
    }

}
