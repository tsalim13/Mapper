<?php 

namespace App\Gestion;

use App\Repositories\MarkerRepository;
use App\Marker;
use Storage;

class DataXmlGestion
{
protected $markerRepository;

   public function __construct(Marker $markers)
    {
        $this->markers = $markers;
    }
    
	 public function generateXml($markers)
   {
      $xml = new \XMLWriter();
      $xml->openMemory();
      $xml->setIndent(true);
    // Start a new document
      $xml->startDocument();
    // Start a element to put data in
      $xml->startElement('markers');
    // Data what goes in your element\
      foreach ($markers as $marker) {
        $xml->startElement('marker');
        $xml->writeAttribute('id', $marker->id);
        $xml->writeAttribute('name', $marker->name);
        $xml->writeAttribute('lat', $marker->lat);
        $xml->writeAttribute('lng', $marker->lng);
        $xml->writeAttribute('type', $marker->type);
        $xml->writeAttribute('etat', $marker->etat);
        $xml->endElement();
      }

      $xml->endElement();
      $xml->endDocument();

    // You put the XML content in this variable
       $contents = $xml->outputMemory();
    // Reset XML just in case
        $xml = null;

      Storage::disk('public_uploads_data')->put('data.xml', $contents);
	}
}