<?php
/**
 * $Horde: horde/lib/XML/SVG.php,v 1.2 2002/06/12 06:00:54 chuck Exp $
 *
 * Utility class for generating SVG images.
 *
 * Copyright 2002 Chuck Hagenbuch <chuck@horde.org>
 *
 * See the enclosed file COPYING for license information (LGPL). If you
 * did not receive this file, see http://www.fsf.org/copyleft/lgpl.html.
 */

/**
 * XML_SVG_Element
 *
 * This is the base class for the different SVG Element
 * Objects. Extend this class to create a new SVG Element.
 *
 * @package horde.xml.svg
 */
class XML_SVG_Element {

    var $_elements = ''; // Initialize so warnings aren't issued when not used.
    var $_style;
    var $_transform;

    // The constructor.
    function XML_SVG_Element()
    {
    }

    // Most SVG elements can contain child elements. This method calls the
    // printElement method of any child element added to this object by use
    // of the addChild method.
    function printElement()
    {
        // Loop and call
        if (is_array($this->_elements)) {
            foreach ($this->_elements as $child) {
                $child->printElement();
            }
        }
    }

    // This method adds an object reference (or value, if $copy is
    // true) to the _elements array.
    function addChild(&$element, $copy = false)
    {
        if ($copy) {
            $this->_elements[] = $element;
        } else {
            $this->_elements[] = &$element;
        }
    }

    // This method sends a message to the passed element requesting to be
    // added as a child.
    function addParent(&$parent)
    {
        if (is_subclass_of($parent, "XML_SVG_Element")) {
            $parent->addChild($this);
        }
    }

    function copy()
    {
        return $this;
    }

    // Most SVG elements have a style attribute.
    // It is up to the derived class to call this method.
    function printStyle()
    {
        if ($this->_style != '') {
            print(" style=\"$this->_style\"");
        }
    }

    // This enables the style property to be set after initialization.
    function setStyle($string)
    {
        $this->_style = $string;
    }

    // Most SVG elements have a transform attribute.
    // It is up to the dervied class to call this method.
    function printTransform()
    {
        if ($this->_transform != '') {
            print(" transform=\"$this->_transform\"");
        }
    }

    // This enables the transform property to be set after initialization.
    function setTransform($string)
    {
        $this->_transform = $string;
    }

    // Set any named attribute of an element to a value.
    function setAttribute($attribute, $value)
    {
        $attr = '_' . $attribute;
        $this->$attr = $value;
    }

    // Print out the object for debugging.
    function debug()
    {
        print("<pre>");
        print_r($this);
        print("</pre>");
    }

}

/** 
 * XML_SVG_Fragment
 *
 * @package horde.xml.svg
 */
class XML_SVG_Fragment extends XML_SVG_Element {

    var $_Width;
    var $_Height;
    var $_viewBox;
    var $_x;
    var $_y;

    function XML_SVG_Fragment($width="100%", $height="100%", $x=0, $y=0, $viewBox = '', $style='')
    {
        // Call the parent class constructor.
        $this->XML_SVG_Element();

        $this->_width = $width;
        $this->_height = $height;
        $this->_style = $style;
        $this->_viewBox = $viewBox;
        $this->_x = $x;
        $this->_y = $y;
    }

    function printElement()
    {
        print("<svg width=\"$this->_width\" height=\"$this->_height\" ");

        if ($this->_x !== '') {
            print("x=\"$this->_x\" ");
        }
        if ($this->_y !== '') {
            print("y=\"$this->_y\" ");
        }
        if ($this->_viewBox !== '') {
            echo 'viewBox="' . $this->_viewBox . '" ';
        }

        echo 'xmlns="http://www.aw3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" ';
        $this->printStyle();
        print(">\n");
        parent::printElement();
        print("</svg>\n");
    }

    function bufferObject()
    {
        ob_start();
        $this->printElement();
        $buff = ob_get_contents();
	    ob_end_clean();
        return $buff;
    }
}

/**
 * XML_SVG_Document
 *
 * This extends the XML_SVG_Fragment class. It wraps the XML_SVG_Frament output
 * with a content header, xml definition and doctype.
 *
 * @package horde.xml.svg
 */
class XML_SVG_Document extends XML_SVG_Fragment {

    function XML_SVG_Document($width="100%", $height="100%", $viewBox = '', $style='')
    {
        // Call the parent class constructor.
        $this->XML_SVG_Fragment($width, $height, '', '', $viewBox, $style);
    }

    function printElement()
    {
        header("Content-Type: image/svg+xml");

        print('<?xml version="1.0" encoding="iso-8859-1"?>'."\n");
        print('<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.0//EN"
	        "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">'."\n");

        parent::printElement();
    }
}

/** 
 * XML_SVG_Group
 *
 * @package horde.xml.svg
 */
class XML_SVG_Group extends XML_SVG_Element {

    function XML_SVG_Group($style = '', $transform = '')
    {
        // Call the parent class constructor.
        $this->XML_SVG_Element();

        $this->_style = $style;
        $this->_transform = $transform;
    }

    function printElement()
    {
        print("<g ");
        $this->printStyle();
        $this->printTransform();
        print(">\n");
        parent::printElement();
        print("</g>\n");
    }

}

/** 
 * XML_SVG_Textpath
 *
 * @package horde.xml.svg
 */
class XML_SVG_Textpath extends XML_SVG_Element {

    var $_text;
    var $_x;
    var $_y;
    var $_dx;
    var $_dy;
    var $_rotate;
    var $_textLength;
    var $_lengthAdjust;

    function XML_SVG_Textpath($text = '', $x = 0, $y = 0, $dx = null, $dy = null,
                         $rotate = null, $textLength = null, $lengthAdjust = null)
    {
        // Call the parent class constructor.
        $this->XML_SVG_Element();

        $this->_text = $text;
        $this->_x = $x;
        $this->_y = $y;
        $this->_dx = $dx;
        $this->_dy = $dy;
        $this->_rotate = $rotate;
        $this->_textLength = $textLength;
        $this->_lengthAdjust = $lengthAdjust;
    }

    function printElement($element = 'textpath')
    {
        print("<$element x=\"$this->_x\" y=\"$this->_y\"");
        $this->printStyle();
        $this->printTransform();
        if (!is_null($this->_dx)) {
            echo ' dx="' . $this->_dx . '"';
        }
        if (!is_null($this->_dy)) {
            echo ' dy="' . $this->_dy . '"';
        }
        if (!is_null($this->_rotate)) {
            echo ' rotate="' . $this->_rotate . '"';
        }
        if (!is_null($this->_textLength)) {
            echo ' textLength="' . $this->_textLength . '"';
        }
        if (!is_null($this->_lengthAdjust)) {
            echo ' lengthAdjust="' . $this->_lengthAdjust . '"';
        }
        echo '>' . $this->_text;
        parent::printElement();
        print("</$element>\n");
    }

    function setShape($x, $y, $text)
    {
        $this->_x = $x;
        $this->_y = $y;
        $this->_text = $text;
    }

}

/** 
 * XML_SVG_Text
 *
 * @package horde.xml.svg
 */
class XML_SVG_Text extends XML_SVG_Textpath {

    function XML_SVG_Text($text = '', $x = 0, $y = 0, $dx = null, $dy = null,
                     $rotate = null, $textLength = null, $lengthAdjust = null,
                     $style = null, $transform = null)
    {
        // Call the parent class constructor.
        parent::XML_SVG_Textpath($text, $x, $y, $dx, $dy, $rotate, $textLength, $lengthAdjust);

        $this->_style = $style;
        $this->_transform = $transform;
    }

    function printElement()
    {
        parent::printElement('text');
    }

    function setShape($x, $y, $text)
    {
        $this->_x = $x;
        $this->_y = $y;
        $this->_text = $text;
    }

}

/** 
 * XML_SVG_Tspan
 *
 * @package horde.xml.svg
 */
class XML_SVG_Tspan extends XML_SVG_Element {

    var $_x;
    var $_y;
    var $_text;

    function XML_SVG_Tspan($x=0, $y=0, $text='', $style='', $transform='')
    {
        // Call the parent class constructor.
        $this->XML_SVG_Element();

        $this->_x = $x;
        $this->_y = $y;
        $this->_text  = $text;
        $this->_style = $style;
        $this->_transform = $transform;
    }

    function printElement()
    {
        print("<tspan x=\"$this->_x\" y=\"$this->_y\" ");

        if (is_array($this->_elements)) { // Print children, start and end tag.
            $this->printStyle();
            $this->printTransform();
            print(">\n");
            print($this->_text);
            parent::printElement();
            print("</tspan>\n");
        } else { // Print short tag.
            $this->printStyle();
            $this->printTransform();
            print(">\n");
            print($this->_text);
            print("\n</tspan>\n");
        }
    }

    function setShape($x, $y, $text)
    {
        $this->_x = $x;
        $this->_y = $y;
        $this->_text  = $text;
    }

}

/** 
 * XML_SVG_Circle
 *
 * @package horde.xml.svg
 */
class XML_SVG_Circle extends XML_SVG_Element {

    var $_cx;
    var $_cy;
    var $_r;

    function XML_SVG_Circle($cx=0, $cy=0, $r=0, $style='', $transform='')
    {
        // Call the parent class constructor.
        $this->XML_SVG_Element();

        $this->_cx = $cx;
        $this->_cy = $cy;
        $this->_r  = $r;
        $this->_style = $style;
        $this->_transform = $transform;
    }

    function printElement()
    {
        print("<circle cx=\"$this->_cx\" cy=\"$this->_cy\" r=\"$this->_r\" ");

        if (is_array($this->_elements)) { // Print children, start and end tag.
            $this->printStyle();
            $this->printTransform();
            print(">\n");
            parent::printElement();
            print("</circle>\n");
        } else { // Print short tag.
            $this->printStyle();
            $this->printTransform();
            print("/>\n");
        }
    }

    function setShape($cx, $cy, $r)
    {
        $this->_cx = $cx;
        $this->_cy = $cy;
        $this->_r  = $r;
    }

}

/** 
 * XML_SVG_Line
 *
 * @package horde.xml.svg
 */
class XML_SVG_Line extends XML_SVG_Element {

    var $_x1;
    var $_y1;
    var $_x2;
    var $_y2;

    function XML_SVG_Line($x1=0, $y1=0, $x2=0, $y2=0, $style='', $transform='')
    {
        // Call the parent class constructor.
        $this->XML_SVG_Element();

        $this->_x1 = $x1;
        $this->_y1 = $y1;
        $this->_x2  = $x2;
        $this->_y2  = $y2;
        $this->_style = $style;
        $this->_transform = $transform;
    }

    function printElement()
    {
        print("<line x1=\"$this->_x1\" y1=\"$this->_y1\" x2=\"$this->_x2\" y2=\"$this->_y2\" ");

        if (is_array($this->_elements)) { // Print children, start and end tag.
            $this->printStyle();
            $this->printTransform();
            print(">\n");
            parent::printElement();
            print("</line>\n");
        } else { // Print short tag.
            $this->printStyle();
            $this->printTransform();
            print("/>\n");
        }
    }

    function setShape($x1, $y1, $x2, $y2)
    {
        $this->_x1 = $x1;
        $this->_y1 = $y1;
        $this->_x2  = $x2;
        $this->_y2  = $y2;
    }

}

/** 
 * XML_SVG_Rect
 *
 * @package horde.xml.svg
 */
class XML_SVG_Rect extends XML_SVG_Element {

    var $_x;
    var $_y;
    var $_Width;
    var $_Height;

    function XML_SVG_Rect($x=0, $y=0, $width=0, $height=0, $rx = '', $style='', $transform='')
    {
        // Call the parent class constructor.
        $this->XML_SVG_Element();

        $this->_x = $x;
        $this->_y = $y;
        $this->_Width  = $width;
        $this->_Height  = $height;
        $this->_rx = $rx;
        $this->_style = $style;
        $this->_transform = $transform;
    }

    function printElement()
    {
        print("<rect x=\"$this->_x\" y=\"$this->_y\" width=\"$this->_Width\" height=\"$this->_Height\" ");
        if ($this->_rx !== '') {
            echo 'rx="' . $this->_rx . '" ';
        }

        if (is_array($this->_elements)) { // Print children, start and end tag.
            $this->printStyle();
            $this->printTransform();
            print(">\n");
            parent::printElement();
            print("</rect>\n");
        } else { // Print short tag.
            $this->printStyle();
            $this->printTransform();
            print("/>\n");
        }

    }

    function setShape($x, $y, $width, $height)
    {
        $this->_x = $x;
        $this->_y = $y;
        $this->_Width  = $width;
        $this->_Height  = $height;
    }

}

/** 
 * XML_SVG_Ellipse
 *
 * @package horde.xml.svg
 */
class XML_SVG_Ellipse extends XML_SVG_Element {

    var $_cx;
    var $_cy;
    var $_rx;
    var $_ry;

    function XML_SVG_Ellipse($cx=0, $cy=0, $rx=0, $ry=0, $style='', $transform='')
    {
        // Call the parent class constructor.
        $this->XML_SVG_Element();

        $this->_cx = $cx;
        $this->_cy = $cy;
        $this->_rx  = $rx;
        $this->_ry  = $ry;
        $this->_style = $style;
        $this->_transform = $transform;

    }

    function printElement()
    {
        print("<ellipse cx=\"$this->_cx\" cy=\"$this->_cy\" rx=\"$this->_rx\" ry=\"$this->_ry\" ");

        if (is_array($this->_elements)) { // Print children, start and end tag.
            $this->printStyle();
            $this->printTransform();
            print(">\n");
            parent::printElement();
            print("</ellipse>\n");
        } else { // Print short tag.
            $this->printStyle();
            $this->printTransform();
            print("/>\n");
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
 * @package horde.xml.svg
 */
class XML_SVG_Polyline extends XML_SVG_Element {

    var $_points;

    function XML_SVG_Polyline($points=0, $style='', $transform='')
    {
        // Call the parent class constructor.
        $this->XML_SVG_Element();

        $this->_points = $points;
        $this->_style = $style;
        $this->_transform = $transform;
    }

    function printElement()
    {
        print("<polyline points=\"$this->_points\" ");

        if (is_array($this->_elements)) { // Print children, start and end tag.
            $this->printStyle();
            $this->printTransform();
            print(">\n");
            parent::printElement();
            print("</polyline>\n");
        } else { // Print short tag.
            $this->printStyle();
            $this->printTransform();
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
 * @package horde.xml.svg
 */
class XML_SVG_Polygon extends XML_SVG_Element {

    var $_points;

    function XML_SVG_Polygon($points=0, $style='', $transform='')
    {
        // Call the parent class constructor.
        $this->XML_SVG_Element();

        $this->_points = $points;
        $this->_style = $style;
        $this->_transform = $transform;

    }

    function printElement()
    {
        print("<polygon points=\"$this->_points\" ");

        if (is_array($this->_elements)) { // Print children, start and end tag.
    
            $this->printStyle();
            $this->printTransform();
            print(">\n");
            parent::printElement();
            print("</polygon>\n");
    
        } else { // Print short tag.
    
            $this->printStyle();
            $this->printTransform();
            print("/>\n");
    
        } // end else

    }

    function setShape($points)
    {
        $this->_points = $points;
    }
}

/** 
 * XML_SVG_Path
 *
 * @package horde.xml.svg
 */
class XML_SVG_Path extends XML_SVG_Element {

    var $_d;

    function XML_SVG_Path($d='', $style='', $transform='')
    {
        // Call the parent class constructor.
        $this->XML_SVG_Element();

        $this->_d = $d;
        $this->_style = $style;
        $this->_transform = $transform;

    }

    function printElement()
    {
        print("<path d=\"$this->_d\" ");

        if (is_array($this->_elements)) { // Print children, start and end tag.
            $this->printStyle();
            $this->printTransform();
            print(">\n");
            parent::printElement();
            print("</path>\n");
        } else { // Print short tag.
            $this->printStyle();
            $this->printTransform();
            print("/>\n");
        }
    }

    function setShape($d)
    {
        $this->_d = $d;
    }

}

/** 
 * XML_SVG_Animate
 *
 * @package horde.xml.svg
 */
class XML_SVG_Animate extends XML_SVG_Element {

    var $_AttributeName;
    var $_AttributeType;
    var $_From;
    var $_to;
    var $_Begin;
    var $_dur;
    var $_Fill;

    function XML_SVG_Animate($attributeName, $attributeType='', $from='', $to='', $begin='', $dur='', $fill='')
    {
        // Call the parent class constructor.
        $this->XML_SVG_Element();

        $this->_AttributeName = $attributeName;
        $this->_AttributeType = $attributeType;
        $this->_From  = $from;
        $this->_to = $to;
        $this->_Begin = $begin;
        $this->_dur = $dur;
        $this->_Fill = $fill;

    }

    function printElement()
    {
        print("<animate attributeName=\"$this->_AttributeName\" ");

        // Print the attributes only if they are defined.
        if ($this->_AttributeType != '') { print ("attributeType=\"$this->_AttributeType\" "); }
        if ($this->_From != '')  { print ("from=\"$this->_From\" "); }
        if ($this->_to != '')    { print ("to=\"$this->_to\" "); }
        if ($this->_Begin != '') { print ("begin=\"$this->_Begin\" "); }
        if ($this->_dur != '')   { print ("dur=\"$this->_dur\" "); }
        if ($this->_Fill != '')  { print ("fill=\"$this->_Fill\" "); }

        if (is_array($this->_elements)) { // Print children, start and end tag.
            print(">\n");
            parent::printElement();
            print("</animate>\n");
        } else {
            print("/>\n");
        }
    }

    function setShape($attributeName, $attributeType='', $from='', $to='', $begin='', $dur='', $fill='')
    {
        $this->_AttributeName = $attributeName;
        $this->_AttributeType = $attributeType;
        $this->_From  = $from;
        $this->_to = $to;
        $this->_Begin = $begin;
        $this->_dur = $dur;
        $this->_Fill = $fill;
    }

}

/** 
 * XML_SVG_Defs
 *
 * @package horde.xml.svg
 */
class XML_SVG_Defs extends XML_SVG_Element {

    function XML_SVG_Defs($style = '', $transform = '')
    {
        // Call the parent class constructor.
        $this->XML_SVG_Element();

        $this->_style = $style;
        $this->_transform = $transform;
    }

    function printElement()
    {
        print("<defs ");
        $this->printStyle();
        $this->printTransform();
        print(">\n");
        parent::printElement();
        print("</defs>\n");
    }

}

/** 
 * XML_SVG_Marker
 *
 * @package horde.xml.svg
 */
class XML_SVG_Marker extends XML_SVG_Element {

    var $_id;
    var $_refX;
    var $_refY;
    var $_markerUnits;
    var $_markerWidth;
    var $_markerHeight;
    var $_orient;

    function XML_SVG_Marker($id, $refX='', $refY='', $_arkerUnits='', $_arkerWidth='', $_arkerHeight='', $orient='')
    {
        // Call the parent class constructor.
        $this->XML_SVG_Element();

        $this->_id = $id;
        $this->_refX = $refX;
        $this->_refY  = $refY;
        $this->_markerUnits = $_arkerUnits;
        $this->_markerWidth = $_arkerWidth;
        $this->_markerHeight = $_arkerHeight;
        $this->_orient = $orient;

    }

    function printElement()
    {
        print("<marker id=\"$this->_id\" ");

        // Print the attributes only if they are defined.
        if ($this->_refX != '')          { print ("refX=\"$this->_refX\" "); }
        if ($this->_refY != '')          { print ("refY=\"$this->_refY\" "); }
        if ($this->_markerUnits != '')   { print ("markerUnits=\"$this->_markerUnits\" "); }
        if ($this->_markerWidth != '')   { print ("markerWidth=\"$this->_markerWidth\" "); }
        if ($this->_markerHeight != '')  { print ("markerHeight=\"$this->_markerHeight\" "); }
        if ($this->_orient != '')        { print ("orient=\"$this->_orient\" "); }

        if (is_array($this->_elements)) { // Print children, start and end tag.
            print(">\n");
            parent::printElement();
            print("</marker>\n");
        } else {
            print("/>\n");
        }
    }

    function setShape($id, $refX='', $refY='', $markerUnits='', $markerWidth='', $markerHeight='', $orient='')
    {
        $this->_id = $id;
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
 * @package horde.xml.svg
*/
class XML_SVG_Title extends XML_SVG_Element {

    var $_title;

    function XML_SVG_Title($title, $style = '')
    {
        // Call the parent class constructor.
        $this->XML_SVG_Element();

        $this->_title = $title;
        $this->_style = $style;

    }

    function printElement()
    {
        print("<title ");
        $this->printStyle();
        print(">\n");
        print($this->_title."\n");
        parent::printElement();
        print("</title>\n");
    }

}

/** 
 * XML_SVG_Desc
 *
 * @package horde.xml.svg
 */
class XML_SVG_Desc extends XML_SVG_Element {

    var $_desc;

    function XML_SVG_Desc($desc, $style = '')
    {
        // Call the parent class constructor.
        $this->XML_SVG_Element();

        $this->_desc = $desc;
        $this->_style = $style;
    }

    function printElement()
    {
        echo '<desc ';
        $this->printStyle();
        echo '>' . $this->_desc;
        parent::printElement();
        echo "</desc>\n";
    }

}
?>
