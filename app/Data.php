<?php

/**
* Data is a class for remapping and filtering json response data to be sent to the views
*
* @author Maura Gerke 
*/
class Data {

    const FINDING_AID_BASE_URL = "https://finding-aids.library.gatech.edu";
    const DEFAULT_DESC = "Visit the retroTECH lab to learn more.";
    const DEFAULT_OH_LINK = "https://library.gatech.edu/retrotech";

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
                  "entry_description" => (empty($data['notes'][0]['subnotes'][0]['content']) ? Data::DEFAULT_DESC: $data['notes'][0]['subnotes'][0]['content']),
                  "uri_link"          => Data::FINDING_AID_BASE_URL . $data['uri']);
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
                  "entry_description" => (empty($data['notes'][1]['subnotes'][0]['content']) ? Data::DEFAULT_DESC: $data['notes'][1]['subnotes'][0]['content']),
                  "software_url"     => (empty($data['external_documents'][0]['location'])) ? 'Link coming soon': $data['external_documents'][0]['location'],
                  "uri_link"          => Data::FINDING_AID_BASE_URL . $data['uri']);
        return $mapped_data;
    }

    /** 
    * Get general entry data from a resource object (with alernate description location)
    * 
    * Live software link should be saved on the object in External Documents->Location
    * @param array of json data from a resource
    */
    public static function extractResourceData2(array $data) {
        $mapped_data = array(
                  "entry_name"        => $data['title'],
                  "entry_title"       => $data['title'],
                  "entry_date"        => $data['dates'][0]['expression'],
                  "entry_description" => (empty($data['notes'][0]['subnotes'][0]['content']) ? Data::DEFAULT_DESC: $data['notes'][0]['subnotes'][0]['content']),
                  "uri_link"          => Data::FINDING_AID_BASE_URL . $data['uri']);
        return $mapped_data;
    }

    /** 
    * Get general entry data from a digital object
    * 
    * Live software link should be saved on the object in External Documents->Location
    * @param array of json data from a resource
    */
    public static function extractDigitalObjectData(array $data) {
        $mapped_data = array(
                  "entry_name"        => $data['title'],
                  "entry_title"       => $data['title'],
                  "entry_date"        => $data['dates'][0]['expression'],
                  "entry_description" => (empty($data['notes'][0]['subnotes'][0]['content']) ? Data::DEFAULT_DESC: $data['notes'][0]['subnotes'][0]['content']),
                  "uri_link"          => Data::FINDING_AID_BASE_URL . $data['uri']);
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
    public static function extractOralHistoryData(array $data, bool $single = false) {
        $mapped_data = array(
                  "history_url"     => (empty($data['external_documents'][0]['location'])) ? Data::DEFAULT_OH_LINK : $data['external_documents'][0]['location']);
        return $mapped_data;
    }

    public static function extractGalleryData(array $data) {
        $mapped_data = array();
        foreach ($data as $do) {
            $mapped_obj = array(
                            "title"      => $do['title'],
                            "media_url"  => $do['file_versions'][1]['file_uri']);
            array_push($mapped_data, $mapped_obj);
        }
        return $mapped_data;

    }

    public static function extractDocumentationData(array $data) {
        $mapped_data = array(
                  "title"               => $data['title'],
                  "media_url"         => $data['file_versions'][1]['file_uri'],
                  "uri_link"          => Data::FINDING_AID_BASE_URL . $data['uri']);
        return $mapped_data;
    }

    public static function extractTitle(array $data) {
        return $data['title'];
    }

    public static function extractUri(array $data) {
        return Data::FINDING_AID_BASE_URL . $data['record_uri'];
    }

    public static function extractCollectionData(array $data) {
        $mapped_data = array(
                        "collection_desc"   => (empty($data['notes'][1]['subnotes'][0]['content']) ? Data::DEFAULT_DESC: $data['notes'][1]['subnotes'][0]['content']),
                        "title"             => $data['title'],
                        "collection_uri"          => Data::FINDING_AID_BASE_URL . $data['record_uri']);
        return $mapped_data;
    }

}

?>