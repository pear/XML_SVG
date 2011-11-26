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
 * XML_SVG_RadialGradient
 *
 * @package XML_SVG
 */
class XML_SVG_RadialGradient extends XML_SVG_Element 
{

    function printElement()
    {
        echo '<radialGradient';
        $this->printParams('id', 'cx', 'cy', 'r', 'fx', 'fy');
        echo '>';
        parent::printElement();
        echo "</radialGradient>\n";
    }

}
