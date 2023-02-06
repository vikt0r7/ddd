<?php

require_once './vendor/autoload.php';

use App\Application\AccountApplicationService;
use App\Application\TransactionApplicationService;
use App\Domain\Account\AccountNumber;
use App\Domain\Account\AccountService;
use App\Infrastructure\Account\AccountRepository;
use App\Infrastructure\Repository\TransactionRepository;

$accountRepository = new AccountRepository();
$transactionRepository = new TransactionRepository();
$accountService = new AccountService($accountRepository);
$accountApplicationService = new AccountApplicationService($accountService);
$transactionApplicationService = new TransactionApplicationService($accountService, $transactionRepository);

// get all accounts in the system
$allAccounts = $accountApplicationService->getAllAccounts();

// get the wallet of a specific account
$accountNumber = new AccountNumber('123456');
$wallet = $accountApplicationService->getWallet($accountNumber);

// perform an operation
$amount = 500.00;
$comment = 'Withdraw for rent';
$transactionApplicationService->deposit($accountNumber, $amount, $comment);

// get all account transactions sorted by comment in alphabetical order
$sortedByComment = $transactionApplicationService->getTransactionsSortedByComment($accountNumber);

// get all account transactions sorted by date
$sortedByDate = $transactionApplicationService->getTransactionsSortedByDate($accountNumber);
