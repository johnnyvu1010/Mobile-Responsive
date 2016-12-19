<?php
    $pregnant=trim($_REQUEST['pregnant']);
    $interested=trim($_REQUEST['interested']);
    $fertclinic=trim($_REQUEST['fertclinic']);
					 
header("Location: http://onefertilityhealth.com/financing/?pregnant=$pregnant&interested=$interested&fertclinic=$fertclinic");
?>