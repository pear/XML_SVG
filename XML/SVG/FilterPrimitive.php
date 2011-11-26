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
 * XML_SVG_FilterPrimitive
 *
 * @package XML_SVG
 */
class XML_SVG_FilterPrimitive extends XML_SVG_Element 
{

    var $_primitives = array('Blend',
                             'ColorMatrix',
                             'ComponentTransfer',
                             'Composite',
                             'ConvolveMatrix',
                             'DiffuseLighting',
                             'DisplacementMap',
                             'Flood',
                             'GaussianBlur',
                             'Image',
                             'Merge',
                             'Morphology',
                             'Offset',
                             'SpecularLighting',
                             'Tile',
                             'Turbulence');

    var $_primitive;

    var $_in;
    var $_in2;
    var $_result;
    var $_x;
    var $_y;
    var $_dx;
    var $_dy;
    var $_width;
    var $_height;
    var $_mode;
    var $_type;
    var $_values;
    var $_operator;
    var $_k1;
    var $_k2;
    var $_k3;
    var $_k4;
    var $_surfaceScale;
    var $_diffuseConstant;
    var $_kernelUnitLength;
    var $_floor_color;
    var $_flood_opacity;

    function XML_SVG_FilterPrimitive($primitive, $params = array())
    {
        parent::XML_SVG_Element($params);
        $this->_primitive = $primitive;
    }

    function printElement()
    {
        $name = 'fe' . $this->_primitive;
        echo '<' . $name;
        $this->printParams('id', 'x', 'y', 'dx', 'dy', 'width', 'height', 'in', 'in2',
                           'result', 'mode', 'type', 'values', 'operator',
                           'k1', 'k2', 'k3', 'k4', 'surfaceScale', 'stdDeviation',
                           'diffuseConstant', 'kernelUnitLength',
                           'flood_color', 'flood_opacity');
        if (is_array($this->_elements)) {
            // Print children, start and end tag.
            echo ">\n";
            parent::printElement();
            echo '</' . $name . '>';
        } else {
            echo '/>';
        }
    }

    /**
     * For feMerge elements.
     */
    function addMergeNode($in)
    {
        $this->addChild(new XML_SVG_FilterMergeNode(array('in' => $in)));
    }

}

