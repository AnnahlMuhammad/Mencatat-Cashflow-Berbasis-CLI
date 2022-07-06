<?php 
require_once __DIR__ . "/../Model/cashFlowModel.php";
require_once __DIR__. "/../Repository/cashFlowRepository.php";
require_once __DIR__ . "/../Service/cashFlowService.php";

use Model\CashFlowModel;
use Repository\CashFlowRepositoryImpl;
use Service\cashFlowServiceImpl;

$repoCashFlow = new CashFlowRepositoryImpl();
$serviceCashFlow = new CashFlowServiceImpl($repoCashFlow);
$serviceCashFlow->tambahPemasukan("Gajian", 500000);
$serviceCashFlow->tambahPemasukan("Bonus", 500000);
$serviceCashFlow->tambahPemasukan("THR", 50000);
$serviceCashFlow->tambahPengeluaran("Outfit", 50000);
$serviceCashFlow->tambahPengeluaran("Makan", 30000);
$serviceCashFlow->showCashFlow();
$serviceCashFlow->showSaldo();



?>