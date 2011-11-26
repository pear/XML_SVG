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

/**
 * XML_SVG_Element
 *
 * This is the base class for the different SVG Element
 * Objects. Extend this class to create a new SVG Element.
 *
 * @package XML_SVG
 */
class XML_SVG_Element 
{

    var $_elements = null;
    var $_style = null;
    var $_transform = null;
    var $_id = null;

    function XML_SVG_Element($params = array())
    {
        foreach ($params as $p => $v) {
            $param = '_' . $p;
            $this->$param = $v;
        }
    }

    /**
     * Most SVG elements can contain child elements. This method calls
     * the printElement method of any child element added to this
     * object by use of the addChild method.
     */
    function printElement()
    {
        // Loop and call.
        if (is_array($this->_elements)) {
            foreach ($this->_elements as $child) {
                $child->printElement();
            }
        }
    }

    /**
     * This method adds an object reference (or value, if $copy is
     * true) to the _elements array.
     */
    function addChild(&$element, $copy = false)
    {
        if ($copy) {
            $this->_elements[] = &$element->copy();
        } else {
            $this->_elements[] = &$element;
        }
    }

    /**
     * This method sends a message to the passed element requesting to
     * be added as a child.
     */
    function addParent(&$parent)
    {
        if (is_subclass_of($parent, 'XML_SVG_Element')) {
            $parent->addChild($this);
        }
    }

    function copy()
    {
        if (version_compare(zend_version(), '2', '>')) {
            return clone($this);
        } else {
            $xml_svg = $this;
            return $xml_svg;
        }
    }

    /**
     * Print each of the passed parameters, if they are set.
     */
    function printParams()
    {
        foreach (func_get_args() as $param) {
            $_param = '_' . $param;
            if (isset($this->$_param)) {
                switch ($param) {
                case 'filter':
                    echo ' filter="url(#' . $this->$_param . ')"';
                    break;

                default:
                    echo ' ' . str_replace('_', '-', $param) . '="' . $this->$_param . '"';
                    break;
                }
            }
        }
    }

    // Set any named attribute of an element to a value.
    function setParam($param, $value)
    {
        $attr = '_' . $param;
        $this->$attr = $value;
    }

    // Get any named attribute of an element.
    function getParam($param)
    {
        $attr = '_' . $param;
        if (isset($this->$attr)) {
            return $this->$attr;
        } else {
            return null;
        }
    }

    // Print out the object for debugging.
    function debug()
    {
        echo '<pre>'; var_dump($this); echo '</pre>';
    }

}

