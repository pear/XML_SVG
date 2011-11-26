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
require_once 'XML/SVG/Circle.php';
require_once 'XML/SVG/Document.php';
require_once 'XML/SVG/Element.php';
require_once 'XML/SVG/Fragment.php';
require_once 'XML/SVG/Group.php';
require_once 'XML/SVG/Line.php';
require_once 'XML/SVG/Text.php';
require_once 'XML/SVG/Textpath.php';
require_once 'XML/SVG/Tspan.php';

/**
 * XML_SVG_Rect
 *
 * @package XML_SVG
 */
class XML_SVG_Rect extends XML_SVG_Element {

    var $_x;
    var $_y;
    var $_width;
    var $_height;
    var $_rx;
    var $_ry;

    function printElement()
    {
        echo '<rect';
        $this->printParams('id', 'x', 'y', 'width', 'height',
                           'rx', 'ry', 'style');
        if (is_array($this->_elements)) {
            // Print children, start and end tag.
            print(">\n");
            parent::printElement();
            print("</rect>\n");
        } else {
            // Print short tag.
            print("/>\n");
        }
    }

    function setShape($x, $y, $width, $height)
    {
        $this->_x = $x;
        $this->_y = $y;
        $this->_width  = $width;
        $this->_height  = $height;
    }

}

/**
 * XML_SVG_Ellipse
 *
 * @package XML_SVG
 */
class XML_SVG_Ellipse extends XML_SVG_Element {

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

/**
 * XML_SVG_Polyline
 *
 * @package XML_SVG
 */
class XML_SVG_Polyline extends XML_SVG_Element {

    var $_points;

    function printElement()
    {
        echo '<polyline';
        $this->printParams('id', 'points', 'style', 'transform');

        if (is_array($this->_elements)) {
            // Print children, start and end tag.
            print(">\n");
            parent::printElement();
            print("</polyline>\n");
        } else {
            // Print short tag.
            print("/>\n");
        }
    }

    function setShape($points)
    {
        $this->_points = $points;
    }

}

/**
 * XML_SVG_Polygon
 *
 * @package XML_SVG
 */
class XML_SVG_Polygon extends XML_SVG_Element {

    var $_points;

    function printElement()
    {
        echo '<polygon';
        $this->printParams('id', 'points', 'style', 'transform');
        if (is_array($this->_elements)) {
            // Print children, start and end tag.
            print(">\n");
            parent::printElement();
            print("</polygon>\n");
        } else {
            // Print short tag.
            print("/>\n");
        }
    }

    function setShape($points)
    {
        $this->_points = $points;
    }

}

/**
 * XML_SVG_Path
 *
 * @package XML_SVG
 */
class XML_SVG_Path extends XML_SVG_Element {

    var $_d;

    function printElement()
    {
        echo '<path';
        $this->printParams('id', 'd', 'style', 'transform');
        if (is_array($this->_elements)) {
            // Print children, start and end tag.
            print(">\n");
            parent::printElement();
            print("</path>\n");
        } else {
            // Print short tag.
            print("/>\n");
        }
    }

    function setShape($d)
    {
        $this->_d = $d;
    }

}

/**
 * XML_SVG_Image
 *
 * @package XML_SVG
 */
class XML_SVG_Image extends XML_SVG_Element {

    var $_x;
    var $_y;
    var $_width;
    var $_height;
    var $_href;

    function printElement()
    {
        echo '<image';
        $this->printParams('id', 'x', 'y', 'width', 'height', 'style');
        if (!empty($this->_href)) {
            echo ' xlink:href="' . $this->_href . '"';
        }
        if (is_array($this->_elements)) {
            // Print children, start and end tag.
            echo ">\n";
            parent::printElement();
            echo "</image>\n";
        } else {
            // Print short tag.
            echo " />\n";
        }
    }

    function setShape($x, $y, $width, $height)
    {
        $this->_x = $x;
        $this->_y = $y;
        $this->_width  = $width;
        $this->_height  = $height;
    }

}

/**
 * XML_SVG_Animate
 *
 * @package XML_SVG
 */
class XML_SVG_Animate extends XML_SVG_Element {

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

/**
 * XML_SVG_Filter
 *
 * @package XML_SVG
 */
class XML_SVG_Filter extends XML_SVG_Element {

    function printElement()
    {
        echo '<filter';
        $this->printParams('id');
        if (is_array($this->_elements)) {
            // Print children, start and end tag.
            echo ">\n";
            parent::printElement();
            echo "</filter>\n";
        } else {
            echo " />\n";
        }
    }

    function addPrimitive($primitive, $params)
    {
        $this->addChild(new XML_SVG_FilterPrimitive($primitive, $params));
    }

}

/**
 * XML_SVG_FilterPrimitive
 *
 * @package XML_SVG
 */
class XML_SVG_FilterPrimitive extends XML_SVG_Element {

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

/**
 * XML_SVG_FilterMergeNode
 *
 * @package XML_SVG
 */
class XML_SVG_FilterMergeNode extends XML_SVG_Element {

    var $_in;

    function printElement()
    {
        echo '<feMergeNode';
        $this->printParams('in');
        echo '/>';
    }

}

/**
 * XML_SVG_Use
 *
 * @package XML_SVG
 */
class XML_SVG_Use extends XML_SVG_Element {

    var $_symbol;

    function XML_SVG_Use($symbol, $params = array())
    {
        parent::XML_SVG_Element($params);
        $this->_symbol = $symbol;
    }

    function printElement()
    {
        echo '<use xlink:href="#' . $this->_symbol . '"/>';
    }

}

/**
 * XML_SVG_Defs
 *
 * @package XML_SVG
 */
class XML_SVG_Defs extends XML_SVG_Element {

    function printElement()
    {
        echo '<defs';
        $this->printParams('id', 'style', 'transform');
        echo ">\n";
        parent::printElement();
        echo "</defs>\n";
    }

}

/**
 * XML_SVG_Marker
 *
 * @package XML_SVG
 */
class XML_SVG_Marker extends XML_SVG_Element {

    var $_refX;
    var $_refY;
    var $_markerUnits;
    var $_markerWidth;
    var $_markerHeight;
    var $_orient;

    function printElement()
    {
        echo '<marker';
        $this->printParams('id', 'refX', 'refY', 'markerUnits',
                           'markerWidth', 'markerHeight', 'orient');
        if (is_array($this->_elements)) { // Print children, start and end tag.
            print(">\n");
            parent::printElement();
            print("</marker>\n");
        } else {
            print("/>\n");
        }
    }

    function setShape($refX = '', $refY = '', $markerUnits = '',
                      $markerWidth = '', $markerHeight = '', $orient = '')
    {
        $this->_refX = $refX;
        $this->_refY  = $refY;
        $this->_markerUnits = $markerUnits;
        $this->_markerWidth = $markerWidth;
        $this->_markerHeight = $markerHeight;
        $this->_orient = $orient;
    }

}

/**
 * XML_SVG_Title
 *
 * @package XML_SVG
*/
class XML_SVG_Title extends XML_SVG_Element {

    var $_title;

    function printElement()
    {
        echo '<title';
        $this->printParams('id', 'style');
        print(">\n");
        print($this->_title);
        parent::printElement();
        print("</title>\n");
    }

}

/**
 * XML_SVG_Desc
 *
 * @package XML_SVG
 */
class XML_SVG_Desc extends XML_SVG_Element {

    var $_desc;

    function printElement()
    {
        echo '<desc';
        $this->printParams('id', 'style');
        echo '>' . $this->_desc;
        parent::printElement();
        echo "</desc>\n";
    }

}

/**
 * XML_SVG_Tref
 *
 * @package XML_SVG
 */
class XML_SVG_Tref extends XML_SVG_Element {

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

/**
 * XML_SVG_RadialGradient
 *
 * @package XML_SVG
 */
class XML_SVG_RadialGradient extends XML_SVG_Element {

    function printElement()
    {
        echo '<radialGradient';
        $this->printParams('id', 'cx', 'cy', 'r', 'fx', 'fy');
        echo '>';
        parent::printElement();
        echo "</radialGradient>\n";
    }

}

/**
 * XML_SVG_Stop
 *
 * @package XML_SVG
 */
class XML_SVG_Stop extends XML_SVG_Element {

    function printElement()
    {
        echo '<stop';
        $this->printParams('id', 'style', 'offset', 'stop-color', 'stop-opacity');
        echo '>';
        parent::printElement();
        echo "</stop>\n";
    }

}
