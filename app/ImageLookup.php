<?php

class ImageLookup {

    public static function getEmulationLookupArray() {
        return array(
            86914 => ['cooking-mama-cover.jpeg', 'Cooking Mama: Food Fight Start Screen'],
            1765 => ['VantagePoint.jpg', 'VantagePoint'],
        );
    }

    public static function getHistoryLookupArray() {
        return array(
            86914 => ['cooking-mama-screenshot.png', 'Cooking Mama: Food Fight Gameplay'],
        );
    }

    public static function lookupEmulationImg(int $id) {
        if (array_key_exists($id, ImageLookup::getEmulationLookupArray())) {
            return ImageLookup::getEmulationLookupArray()[$id];
        }
        return ('Could not find emulation image for id: ' . $id);
    }

    public static function lookupHistoryImg(int $id) {
        if (array_key_exists($id, ImageLookup::getHistoryLookupArray())) {
            return ImageLookup::getHistoryLookupArray()[$id];
        }
        return ('Could not find history image for id: ' . $id);
    }

    public static function lookupAllImages(int $id) {
        $emulation = ImageLookup::lookupEmulationImg($id);
        $history = ImageLookup::lookupHistoryImg($id);
        return array($emulation, 'history' => $history);

    }
}

?>