<?php


namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/** @MongoDB\Document(collection="paypalTransactions") */
class PaypalTransaction {
    /** @MongoDB\Id() */
    public $id;
    /** @MongoDB\Field(type="string") */
    public $mc_gross;
    /** @MongoDB\Field(type="string") */
    public $protection_eligibility;
    /** @MongoDB\Field(type="string") */
    public $payer_id;
    /** @MongoDB\Field(type="string") */
    public $address_street;
    /** @MongoDB\Field(type="string") */
    public $payment_date;
    /** @MongoDB\Field(type="string") */
    public $payment_status;
    /** @MongoDB\Field(type="string") */
    public $charset;
    /** @MongoDB\Field(type="string") */
    public $address_zip;
    /** @MongoDB\Field(type="string") */
    public $first_name;
    /** @MongoDB\Field(type="string") */
    public $mc_fee;
    /** @MongoDB\Field(type="string") */
    public $address_country_code;
    /** @MongoDB\Field(type="string") */
    public $notify_version;
    /** @MongoDB\Field(type="string") */
    public $custom;
    /** @MongoDB\Field(type="string") */
    public $payer_status;
    /** @MongoDB\Field(type="string") */
    public $business;
    /** @MongoDB\Field(type="string") */
    public $address_country;
    /** @MongoDB\Field(type="string") */
    public $address_city;
    /** @MongoDB\Field(type="string") */
    public $quantity;
    /** @MongoDB\Field(type="string") */
    public $verify_sign;
    /** @MongoDB\Field(type="string") */
    public $payer_email;
    /** @MongoDB\Field(type="string") */
    public $txn_id;
    /** @MongoDB\Field(type="string") */
    public $payment_type;
    /** @MongoDB\Field(type="string") */
    public $last_name;
    /** @MongoDB\Field(type="string") */
    public $receiver_email;
    /** @MongoDB\Field(type="string") */
    public $payment_fee;
    /** @MongoDB\Field(type="string") */
    public $receiver_id;
    /** @MongoDB\Field(type="string") */
    public $txn_type;
    /** @MongoDB\Field(type="string") */
    public $transaction_subject;
    /** @MongoDB\Field(type="string") */
    public $ipn_track_id;
    /** @MongoDB\Field(type="string") */
    public $status;
}