<?php

/**
* Data is a class for remapping and filtering json response data to be sent to the views
*
* @author Maura Gerke 
*/
class Data {
    /**
    * Flip format of name from 'Last, First' to 'First Last'
    *
    * @param string of the form "Last, First"
    */
    public static function formatName(string $name) {
        $newname = explode(', ', $name);
        $newname = array_reverse($newname);
        return implode(' ', $newname);
    }

    /** 
    * Get general entry data from an archival object
    * 
    * @param array of json data from an archival object
    */
    public static function extractArchivalObjectData(array $data) {
        $mapped_data = array(
                  "entry_name"        => $data['display_string'],
                  "entry_title"       => $data['title'],
                  "entry_date"        => (empty($data['dates'][0]['expression']) ? 'No date given': $data['dates'][0]['expression']),
                  "entry_description" => (empty($data['notes'][0]['subnotes'][0]['content']) ? 'Visit to learn more': $data['notes'][0]['subnotes'][0]['content']));
        return $mapped_data;
    }

    /** 
    * Get general entry data from a resource object
    * 
    * Live software link should be saved on the object in External Documents->Location
    * @param array of json data from a resource
    */
    public static function extractResourceData(array $data) {
        $mapped_data = array(
                  "entry_name"        => $data['title'],
                  "entry_title"       => $data['title'],
                  "entry_date"        => $data['dates'][0]['expression'],
                  "entry_description" => (empty($data['notes'][1]['subnotes'][0]['content']) ? 'Visit to learn more': $data['notes'][1]['subnotes'][0]['content']),
                  "software_url"     => (empty($data['external_documents'][0]['location'])) ? 'Link coming soon': $data['external_documents'][0]['location']);
        return $mapped_data;
    }

    /** 
    * Get emulation url from digital object
    * 
    * Emulation link should be saved on the object in External Documents->Location
    * @param array of json data from a digital object
    */
    public static function extractEmulationData(array $data) {
        $mapped_data = array(
                  "emulation_url"     => $data['external_documents'][0]['location']);
        return $mapped_data;
    }

    /** 
    * Get oral history url from a digital object
    * 
    * OHMS url should be saved on the object in External Documents->Location
    * @param array of data from a digial object
    */
    public static function extractOralHistoryData(array $data) {
        $mapped_data = array(
                  "history_url"     => $data['external_documents'][0]['location']);
        return $mapped_data;
    }

}

?>