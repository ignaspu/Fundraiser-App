<?php

class DonationDataManager
{
    private $donations = [];

    public function __construct()
    {
        $this->loadDonations();
    }

    public function loadDonations()
    {
        if (($handle = fopen("data/donations.csv", "r")) !== false) {
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                $donation = new Donation($data[0], $data[1], $data[2], $data[3], $data[4]);
                $this->donations[] = $donation;
            }
            fclose($handle);
        }
    }

    public function saveDonations()
    {
        $handle = fopen("data/donations.csv", "w");
        foreach ($this->donations as $donation) {
            fputcsv($handle, [$donation->getId(), $donation->getDonator(), $donation->getAmount(), $donation->getCharityId(), $donation->getDateTime()]);
        }
        fclose($handle);
    }

    public function getAll()
    {
        return $this->donations;
    }

    public function add(Donation $donation)
    {
        $this->donations[] = $donation;
        $this->saveDonations();
    }
}
