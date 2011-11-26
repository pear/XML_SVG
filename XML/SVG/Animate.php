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
 * XML_SVG_Animate
 *
 * @package XML_SVG
 */
class XML_SVG_Animate extends XML_SVG_Element
{

    var $_attributeName;
    var $_attributeType;
    var $_from;
    var $_to;
    var $_begin;
    var $_dur;
    var $_fill;

    function printElement()
    {
        echo '<animate';
        $this->printParams('id', 'attributeName', 'attributeType', 'from', 'to',
                           'begin', 'dur', 'fill');
        if (is_array($this->_elements)) {
            // Print children, start and end tag.
            echo ">\n";
            parent::printElement();
            echo "</animate>\n";
        } else {
            echo " />\n";
        }
    }

    function setShape($attributeName, $attributeType = '', $from = '',
                      $to = '', $begin = '', $dur = '', $fill = '')
    {
        $this->_attributeName = $attributeName;
        $this->_attributeType = $attributeType;
        $this->_from  = $from;
        $this->_to = $to;
        $this->_begin = $begin;
        $this->_dur = $dur;
        $this->_fill = $fill;
    }

}
