<?php


namespace ImagickDemo\ControlElement;




class DistortionType extends OptionKeyElement {
    protected function getDefault() {
        return \Imagick::DISTORTION_AFFINE;
    }

    protected function getVariableName() {
        return 'distortion';
    }

    protected function getDisplayName() {
        return "Distortion type";
    }

    protected function getOptions() {
        $colorSpaceTypes = [
            \Imagick::DISTORTION_AFFINE => 'Affine',
            \Imagick::DISTORTION_AFFINEPROJECTION => 'Affine projection',
            \Imagick::DISTORTION_ARC => 'Arc',
            \Imagick::DISTORTION_BILINEAR => 'Bilinear',
            \Imagick::DISTORTION_PERSPECTIVE => 'Perspective',
            \Imagick::DISTORTION_PERSPECTIVEPROJECTION => 'Perspective Projection',
            \Imagick::DISTORTION_SCALEROTATETRANSLATE => 'Scale rotate translate',
            \Imagick::DISTORTION_POLYNOMIAL => 'Polynomial',
            \Imagick::DISTORTION_POLAR => 'Polar',
            \Imagick::DISTORTION_DEPOLAR => 'Depolar',
            \Imagick::DISTORTION_BARREL => 'Barrel',
            \Imagick::DISTORTION_BARRELINVERSE => 'Barrel inverse',
            \Imagick::DISTORTION_SHEPARDS => 'Shepards',
            // \Imagick::DISTORTION_SENTINEL => 'Sentinel', doesn't work
        ];

        return $colorSpaceTypes;
    }

    function getDistortionType() {
        return $this->getKey();
    }
}

 