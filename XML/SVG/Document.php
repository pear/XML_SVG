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
require_once 'XML/SVG/Fragment.php';


/**
 * XML_SVG_Document
 *
 * This extends the XML_SVG_Fragment class. It wraps the XML_SVG_Frament output
 * with a content header, xml definition and doctype.
 *
 * @package XML_SVG
 */
class XML_SVG_Document extends XML_SVG_Fragment
{

    var $_encoding = 'iso-8859-1';

    function printElement()
    {
        header('Content-Type: image/svg+xml');

        print('<?xml version="1.0" encoding="' . $this->_encoding . "\"?>\n");
        print('<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.0//EN"
	        "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">' . "\n");

        parent::printElement();
    }

}
