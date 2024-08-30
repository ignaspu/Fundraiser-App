<?php

class CharityDataManager
{
    private $charities = [];

    public function __construct()
    {
        $this->loadCharities();
    }

    public function loadCharities()
    {
        if (($handle = fopen("data/charities.csv", "r")) !== false) {
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                $charity = new Charity($data[0], $data[1], $data[2]);
                $this->charities[] = $charity;
            }
            fclose($handle);
        }
    }

    public function saveCharities()
    {
        $handle = fopen("data/charities.csv", "w");
        foreach ($this->charities as $charity) {
            fputcsv($handle, [$charity->getId(), $charity->getName(), $charity->getEmail()]);
        }
        fclose($handle);
    }

    public function getAll()
    {
        return $this->charities;
    }

    public function add(Charity $charity)
    {
        $this->charities[] = $charity;
        $this->saveCharities();
    }

    public function delete($id)
    {
        foreach ($this->charities as $key => $charity) {
            if ($charity->getId() == $id) {
                unset($this->charities[$key]);
                $this->saveCharities();
                return true;
            }
        }
        return false;
    }

    public function edit($id, $name, $email)
    {
        foreach ($this->charities as $charity) {
            if ($charity->getId() == $id) {
                $charity->setName($name);
                $charity->setEmail($email);
                $this->saveCharities();
                return true;
            }
        }
        return false;
    }
}
