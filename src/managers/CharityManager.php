<?php

class CharityManager
{
    private $dataManager;

    public function __construct(CharityDataManager $dataManager)
    {
        $this->dataManager = $dataManager;
    }

    public function listCharities()
    {
        return $this->dataManager->getAll();
    }

    public function addCharity($id, $name, $email)
    {
        if (!Validator::isValidEmail($email)) {
            return false;
        }

        $charity = new Charity($id, $name, $email);
        $this->dataManager->add($charity);
        return true;
    }

    public function editCharity($id, $name, $email)
    {
        if (!Validator::isValidEmail($email)) {
            return false;
        }

        return $this->dataManager->edit($id, $name, $email);
    }

    public function deleteCharity($id)
    {
        return $this->dataManager->delete($id);
    }

    public function importFromCsv($filePath)
    {
        if (!file_exists($filePath) || !is_readable($filePath)) {
            echo "File not found or not readable\n";
            return;
        }

        $importedCount = 0;
        if (($handle = fopen($filePath, "r")) !== false) {
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                if (count($data) == 3) {
                    $id = $data[0];
                    $name = $data[1];
                    $email = $data[2];

                    if ($this->addCharity($id, $name, $email)) {
                        $importedCount++;
                    }
                }
            }
            fclose($handle);
        } else {
            echo "Error opening file\n";
            return;
        }

        if ($importedCount > 0) {
            echo "Successfully imported $importedCount charities\n";
        } else {
            echo "No charities were imported\n";
        }
    }
}
