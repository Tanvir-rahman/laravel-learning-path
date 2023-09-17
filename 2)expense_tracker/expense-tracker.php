#!/usr/bin/env php
<?php

include 'transaction.php';
include 'ledger.php';

$ledger = new Ledger();
$ledger->loadFromFile();

while (true) {
  echo "Options:\n";
  echo "1. Add income\n";
  echo "2. Add expense\n";
  echo "3. View incomes\n";
  echo "4. View expenses\n";
  echo "5. View savings\n";
  echo "6. View categories\n";
  echo "7. Exit\n";
  echo "Enter your option: ";

  $option = trim(fgets(STDIN));

  switch ($option) {
    case '1':
      echo "Enter amount: ";
      $amount = floatval(trim(fgets(STDIN)));
      echo "Enter category: ";
      $category = trim(fgets(STDIN));
      $ledger->addTransaction(new Transaction($amount, $category, 'income'));
      break;
    case '2':
      echo "Enter amount: ";
      $amount = floatval(trim(fgets(STDIN)));
      echo "Enter category: ";
      $category = trim(fgets(STDIN));
      $ledger->addTransaction(new Transaction($amount, $category, 'expense'));
      break;
    case '3':
      $ledger->viewTransactions('income');
      break;
    case '4':
      $ledger->viewTransactions('expense');
      break;
    case '5':
      echo "Total Savings: {$ledger->getSavings()}\n";
      break;
    case '6':
      $ledger->viewCategories();
      break;
    case '7':
      $ledger->saveToFile();
      exit;
    default:
      echo "Invalid option. Please try again.\n";
  }
}