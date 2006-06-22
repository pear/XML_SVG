<?php
/**
 * Basic XML_SVG Example
 *
 * @package XML_SVG
 */

require_once 'XML/SVG.php';

// Create an instance of XML_SVG_Document. All other objects will be
// added to this instance for printing. Set the height and width of
// the viewport.
$svg = new XML_SVG_Document(array('width' => 200,
                                  'height' => 200));

// Create an instance of XML_SVG_Group. Set the style, transforms for
// child objects.
$g = new XML_SVG_Group(array('style' => 'stroke:black',
                             'transform' => 'translate(100 100)'));

// Add a parent to the g instance.
$g->addParent($svg);

// The same results can be accomplished by making g a child of the svg.
// $svg->addChild($g);

// Create and animate a circle.
$circle = new XML_SVG_Circle(array('cx' => 0,
                                   'cy' => 0,
                                   'r' => 75,
                                   'style' => 'fill:green;stroke-width:3'));
$circle->addChild(new XML_SVG_Animate(array('attributeName' => 'r',
                                            'attributeType' => 'XML',
                                            'from' => 0,
                                            'to' => 75,
                                            'dur' => '3s',
                                            'fill' => 'freeze')));
$circle->addChild(new XML_SVG_Animate(array('attributeName' => 'fill',
                                            'attributeType' => 'CSS',
                                            'from' => 'green',
                                            'to' => 'red',
                                            'dur' => '3s',
                                            'fill' => 'freeze')));

// Make the circle a child of g.
$g->addChild($circle);

// Create and animate some text.
$text = new XML_SVG_Text(array('text' => 'SVG chart!',
                               'x' => 0,
                               'y' => 0,
                               'style' => 'font-size:20;text-anchor:middle;'));
$text->addChild(new XML_SVG_Animate(array('attributeName' => 'font-size',
                                          'attributeType' => 'auto',
                                          'from' => 0,
                                          'to' => 20,
                                          'dur' => '3s',
                                          'fill' => 'freeze')));

// Make the text a child of g.
$g->addChild($text);

// Send a message to the svg instance to start printing.
$svg->printElement();
