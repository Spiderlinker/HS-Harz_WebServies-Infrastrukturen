<?php

/**
 * Diese Klasse repräsentiert einen Film aus der Datenbank.
 * Hierzu gehören die film_id, title, description, release_year und length.
 * 
 * Diese Klasse implementiert JsonSerializable und stellt somit
 * eine eigene Art der JSON-Serialization bereit. 
 * Falls einige Werte nicht gesetzt sein sollten, werden diese 
 * im JSON-Format nicht aufgeführt. Null-Values werden also ignoriert.
 */
Class Movie implements JsonSerializable {

    public $film_id = null;
    public $title = null;
    public $description = null;
    public $release_year = null;
    public $length = null;

    function jsonSerialize(){
        return array_filter([ // null-Values filtern
            // Alle Werte als JSON schreiben
            'film_id' => $this->film_id,
            'title' => $this->title,
            'description' => $this->description,
            'release_year' => $this->release_year,
            'length' => $this->length,
        ], function($val) { return !is_null($val); }); // null-values filtern
    }

}
