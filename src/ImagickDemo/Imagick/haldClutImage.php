<?php

namespace ImagickDemo\Imagick;

class haldClutImage extends \ImagickDemo\Example {

    function render() {
        
        $output = "Generate hald palette with `convert   hald:8    hald_8.png`";

        $output .= $this->renderImageURL();

        return $output;
    }


}