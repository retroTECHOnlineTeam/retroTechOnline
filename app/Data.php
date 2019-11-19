<?php

class Data {

    private static function _formatName(string $name) {
        $newname = explode(', ', $name);
        $newname = array_reverse($newname);
        return implode(' ', $newname);

    }

    public static function extractOralHistoryData(array $data) {
        $mapped_data = array(
                  "history_url"     => $data['external_documents'][0]['location']);
        return $mapped_data;
    }

    public static function extractEntryData(array $data) {
        $mapped_data = array("entry_name"        => $data['display_string'],
                  "entry_title"       => $data['title'],
                  "entry_date"        => (empty($data['dates'][0]['expression']) ? 'test': $data['dates'][0]['expression']),
                  "entry_description" => (empty($data['notes'][0]['subnotes'][0]['content']) ? 'Visit to learn more': $data['notes'][0]['subnotes'][0]['content']));
        return $mapped_data;
    }

    public static function extractEmulationData(array $data) {
        $mapped_data = array(
                  "emulation_url"     => $data['external_documents'][0]['location']);
        return $mapped_data;
    }
}

?>