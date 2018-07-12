<?php


namespace App\Item;


use App\Document\CollectionMetin2Item;
use App\Document\Metin2Item;
use Symfony\Component\HttpFoundation\Request;

class ItemFactory {

    protected $prototypeMap = array();

    public function __construct(){
        $items = array(Metin2Item::class,CollectionMetin2Item::class);
        foreach($items as $item){
            $this->prototypeMap[$item::getType()] = $item;
        }
    }

    public function createFromRequest(Request $request){
        $json = $request->getContent();
        $jsonDecoded = json_decode($json,true);
        $type = $jsonDecoded["type"];
        $item = clone $this->prototypeMap[$type];

    }
}