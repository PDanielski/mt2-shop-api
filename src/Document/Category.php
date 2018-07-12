<?php


namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/** @MongoDB\Document(collection="categories") */
class Category {
    /** @MongoDB\Id()*/
    protected $id;
    /** @MongoDB\Field(type="string")*/
    protected $name = "";
    /** @MongoDB\Field(type="string")*/
    protected $group = "default";
    /** @MongoDB\Field(type="string") */
    protected $teaser = '';
    /** @MongoDB\Field(type="string") */
    protected $link;
    /** @MongoDB\Field(type="boolean")*/
    protected $isMultilingual = false;

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

    public function getGroup() {
        return $this->group;
    }

    public function setGroup($group): void {
        $this->group = $group;
    }

    public function isMultilingual() {
        return $this->isMultilingual;
    }

    public function setIsMultilingual($isMultilingual): void {
        $this->isMultilingual = $isMultilingual;
    }

    public function setLink($link){
        $this->link = $link;
    }

    public function setTeaser($teaser){
        $this->teaser = $teaser;
    }


}