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
 * XML_SVG_Fragment
 *
 * @package XML_SVG
 */
class XML_SVG_Fragment extends XML_SVG_Element 
{

    var $_width;
    var $_height;
    var $_viewBox;
    var $_x;
    var $_y;

    function printElement()
    {
        echo '<svg';
        $this->printParams('id', 'width', 'height', 'x', 'y', 'viewBox', 'style');
        echo ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">' . "\n";
        parent::printElement();
        echo "</svg>\n";
    }

    function bufferObject()
    {
        ob_start();
        $this->printElement();
        $output = ob_get_contents();
        ob_end_clean();

        return $output;
    }
}
