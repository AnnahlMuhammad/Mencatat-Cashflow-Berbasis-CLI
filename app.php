<?php 
require_once __DIR__ . "/Helper/inputHelper.php";
require_once __DIR__ . "/Model/cashFlowModel.php";
require_once __DIR__ . "/Repository/cashFlowRepository.php";
require_once __DIR__ . "/Service/cashFlowService.php";
require_once __DIR__ . "/View/cashFlowView.php";
require_once __DIR__ . "/Config/database.php";

use Repository\CashFlowRepositoryImpl;
use Service\cashFlowServiceImpl;
use View\cashFlowView;
use Config\Database;

$connection = Database::getConnection();
$repoCashFlow = new CashFlowRepositoryImpl($connection);
$serviceCashFlow = new cashFlowServiceImpl($repoCashFlow);
$viewCashFlow = new cashFlowView($serviceCashFlow);


$viewCashFlow->showData();

?>