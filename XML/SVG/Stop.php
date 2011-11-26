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
 * XML_SVG_Stop
 *
 * @package XML_SVG
 */
class XML_SVG_Stop extends XML_SVG_Element 
{

    function printElement()
    {
        echo '<stop';
        $this->printParams('id', 'style', 'offset', 'stop-color', 'stop-opacity');
        echo '>';
        parent::printElement();
        echo "</stop>\n";
    }

}
