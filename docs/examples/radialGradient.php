<?php
/**
 * XML_SVG Radial Gradient Example
 *
 * @package XML_SVG
 */

require_once 'XML/SVG.php';

$svg = new XML_SVG_Document(array('width' => 400,
                                  'height' => 400));

$g = new XML_SVG_Group();
$g->addParent($svg);

$gradient = new XML_SVG_RadialGradient(array('id' => 'ShadowGradient',
                                             'cx' => '50%',
                                             'cy' => '50%',
                                             'r' => '50%',
                                             'fx' => '50%',
                                             'fy' => '50%'));

$stop1 = new XML_SVG_Stop(array('offset' => '90%',
                                'stop-color' => 'black',
                                'stop-opacity' => 0.5));
$gradient->addChild($stop1);

$stop2 = new XML_SVG_Stop(array('offset' => '100%',
                                'style' => 'stop-color:rgb(0,0,0);stop-opacity:0'));
$gradient->addChild($stop2);

$defs = new XML_SVG_Defs();
$defs->addChild($gradient);

$g->addChild($defs);

$shadow = new XML_SVG_Circle(array('cx' => 170,
                                   'cy' => 170,
                                   'r' => 150,
                                   'style' => 'fill:url(#ShadowGradient)'));
$g->addChild($shadow);

$svg->printElement();
