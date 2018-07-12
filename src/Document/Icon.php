<?php


namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/** @MongoDB\Document(collection="icons") */
class Icon {
    /** @MongoDB\Id() */
    protected $id;
    /** @MongoDB\Field(type="string") */
    protected $name = "";
    /** @MongoDB\Field(type="string") */
    protected $href = "";
    /** @MongoDB\Field(type="boolean") */
    protected $isAbsolute = false;

    public function getId() {
        return $this->id;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name): void {
        $this->name = $name;
    }

    public function getHref() {
        return $this->href;
    }

    public function setHref($href): void {
        $this->href = $href;
    }

    public function isAbsolute() {
        return $this->isAbsolute;
    }

    public function setIsAbsolute($isAbsolute): void {
        $this->isAbsolute = $isAbsolute;
    }
}