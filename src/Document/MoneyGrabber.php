<?php


namespace App\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/** @MongoDB\Document(collection="moneyGrabbers") */
class MoneyGrabber {

    /** @MongoDB\Id() */
    protected $id;

    /** @MongoDB\Field(type="integer") */
    protected $earnings = 0;

    /** @MongoDB\Field(type="integer") */
    protected $earnOffset = 0;

    /** @MongoDB\Field(type="float") */
    protected $percentage=0.0;

    /** @MongoDB\Field(type="string") */
    protected $email;

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getEarnings() {
        return $this->earnings;
    }

    /**
     * @param mixed $earnings
     */
    public function setEarnings($earnings): void {
        $this->earnings = $earnings;
    }

    /**
     * @return int
     */
    public function getEarnOffset(): int {
        return $this->earnOffset;
    }

    /**
     * @param int
     */
    public function setEarnOffset(int $offset): void {
        $this->earnOffset = $offset;
    }

    /**
     * @return mixed
     */
    public function getPercentage() {
        return $this->percentage;
    }

    /**
     * @param mixed $percentage
     */
    public function setPercentage(float $percentage): void {
        $this->percentage = $percentage;
    }

    /**
     * @return mixed
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void {
        $this->email = $email;
    }

}