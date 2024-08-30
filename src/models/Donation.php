<?php

class Donation
{
    private $id;
    private $donator;
    private $amount;
    private $charityId;
    private $dateTime;

    public function __construct($id, $donator, $amount, $charityId, $dateTime)
    {
        $this->id = $id;
        $this->donator = $donator;
        $this->amount = $amount;
        $this->charityId = $charityId;
        $this->dateTime = $dateTime;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDonator()
    {
        return $this->donator;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getCharityId()
    {
        return $this->charityId;
    }

    public function getDateTime()
    {
        return $this->dateTime;
    }
}
