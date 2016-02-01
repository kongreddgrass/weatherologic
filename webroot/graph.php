<?php
include('/var/www/wetterpi/webroot/pChart/class/pData.class.php');
include('/var/www/wetterpi/webroot/pChart/class/pDraw.class.php');
include('/var/www/wetterpi/webroot/pChart/class/pImage.class.php');

?>

<?php

/* Build a dataset */
$MyData = new pData();
$MyData->addPoints(array(-4,VOID,VOID,12,8,3),"Probe 1");
$MyData->addPoints(array(3,12,15,8,5,-5),"Probe 2");
$MyData->addPoints(array(2,7,5,18,19,22),"Probe 3");
$MyData->setSerieTicks("Probe 2",4);
$MyData->setAxisName(0,"Temperatures");
$MyData->addPoints(array("Jan","Feb","Mar","Apr","May","Jun"),"Labels");
$MyData->setSerieDescription("Labels","Months");
$MyData->setAbscissa("Labels");

// /* Create the 1st chart*/
$myPicture->setGraphArea(60,60,450,190);
$myPicture->drawFilledRectangle(60,60,450,190,array("R"=>255,"G"=>255,"B"=>255,"Surrounding"=>-200,"Alpha"=>10));
$myPicture->drawScale(array("DrawSubTicks"=>TRUE));
$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));
$myPicture->setFontProperties(array("FontName"=>"fonts/pf_arma_five.ttf","FontSize"=>6));
$myPicture->drawSplineChart(array("DisplayValues"=>TRUE,"DisplayColor"=>DISPLAY_AUTO));
$myPicture->setShadow(FALSE);

/* Create the 2nd chart */
$myPicture->setGraphArea(500,60,670,190);
$myPicture->drawFilledRectangle(500,60,670,190,array("R"=>255,"G"=>255,"B"=>255,"Surrounding"=>-200,"Alpha"=>10));
$myPicture->drawScale(array("Pos"=>SCALE_POS_TOPBOTTOM,"DrawSubTicks"=>TRUE));
$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));
$myPicture->drawSplineChart();
$myPicture->setShadow(FALSE);

/* Write the legend*/
$myPicture->drawLegend(510,205,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL));

?>
