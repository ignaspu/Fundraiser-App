<?php

class DonationManager
{
    private $dataManager;

    public function __construct(DonationDataManager $dataManager)
    {
        $this->dataManager = $dataManager;
    }

    public function listDonations()
    {
        return $this->dataManager->getAll();
    }

    public function addDonation($id, $donator, $amount, $charityId, $dateTime)
    {
        if (!Validator::isValidAmount($amount)) {
            return false;
        }

        $donation = new Donation($id, $donator, $amount, $charityId, $dateTime);
        $this->dataManager->add($donation);
        return true;
    }
}
