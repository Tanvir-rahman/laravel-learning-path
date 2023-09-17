<?php
class Ledger
{
  public $transactions = [];

  public function addTransaction($transaction)
  {
    $this->transactions[] = $transaction;
  }

  public function saveToFile()
  {
    file_put_contents('ledger.json', json_encode($this->transactions));
  }

  public function loadFromFile()
  {
    if (file_exists('ledger.json')) {
      $this->transactions = json_decode(file_get_contents('ledger.json'));
    }
  }

  public function getTotalIncome()
  {
    return array_reduce($this->transactions, function ($carry, $transaction) {
      return $transaction->type == 'income' ? $carry + $transaction->amount : $carry;
    }, 0);
  }

  public function getTotalExpense()
  {
    return array_reduce($this->transactions, function ($carry, $transaction) {
      return $transaction->type == 'expense' ? $carry + $transaction->amount : $carry;
    }, 0);
  }

  public function getSavings()
  {
    return $this->getTotalIncome() - $this->getTotalExpense();
  }

  public function viewTransactions($type)
  {
    foreach ($this->transactions as $transaction) {
      if ($transaction->type == $type) {
        echo "Amount: {$transaction->amount}, Category: {$transaction->category}\n";
      }
    }
  }

  public function viewCategories()
  {
    $categories = [];
    foreach ($this->transactions as $transaction) {
      $categories[] = $transaction->category;
    }
    echo implode(", ", array_unique($categories)) . "\n";
  }
}
