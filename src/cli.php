<?php

require_once 'models/Charity.php';
require_once 'models/Donation.php';
require_once 'dataManagers/CharityDataManager.php';
require_once 'dataManagers/DonationDataManager.php';
require_once 'managers/CharityManager.php';
require_once 'managers/DonationManager.php';
require_once 'utils/Validator.php';

$charityDataManager = new CharityDataManager();
$donationDataManager = new DonationDataManager();
$charityManager = new CharityManager($charityDataManager);
$donationManager = new DonationManager($donationDataManager);

echo "~ Fundraiser App ~\n";
echo "Choose an option:\n";
echo "1. View charities\n";
echo "2. Add charity\n";
echo "3. Edit charity\n";
echo "4. Delete charity\n";
echo "5. Add donation\n";
echo "6. Import charities from CSV\n";
echo "7. Exit\n";
echo "~~~~~~~~~~~~~~~~~\n";

$option = readline("Enter your choice: ");

switch ($option) {
    case 1:
        $charities = $charityManager->listCharities();
        foreach ($charities as $charity) {
            echo "ID: " . $charity->getId() . " Name: " . $charity->getName() . " Email: " . $charity->getEmail() . "\n";
        }
        break;
    case 2:
        $id = readline("Enter charity ID: ");
        $name = readline("Enter charity name: ");
        $email = readline("Enter email address: ");
        if ($charityManager->addCharity($id, $name, $email)) {
            echo "Charity added successfully!\n";
        } else {
            echo "Failed to add charity\n";
        }
        break;
    case 3:
        $id = readline("Enter charity ID to edit: ");
        $name = readline("Enter new charity name: ");
        $email = readline("Enter new email: ");
        if ($charityManager->editCharity($id, $name, $email)) {
            echo "Charity edited successfully!\n";
        } else {
            echo "Failed to edit charity\n";
        }
        break;
    case 4:
        $id = readline("Enter charity ID to delete: ");
        if ($charityManager->deleteCharity($id)) {
            echo "Charity deleted successfully!\n";
        } else {
            echo "Failed to delete charity\n";
        }
        break;
    case 5:
        $id = readline("Enter donation ID: ");
        $donator = readline("Enter donator name: ");
        $amount = readline("Enter donation amount: ");
        $charityId = readline("Enter charity ID: ");
        $dateTime = readline("Enter date: ");
        if ($donationManager->addDonation($id, $donator, $amount, $charityId, $dateTime)) {
            echo "Donation added successfully!\n";
        } else {
            echo "Failed to add donation\n";
        }
        break;
    case 6:
        $filePath = readline("Enter path to CSV file: ");
        $charityManager->importFromCsv($filePath);
        break;
    case 7:
        echo "Exiting\n";
        exit;
        break;
    default:
        echo "Invalid option. Exiting\n";
        break;
}
