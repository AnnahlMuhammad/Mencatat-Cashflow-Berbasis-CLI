<?php 
require_once __DIR__ . "/../Model/cashFlowModel.php";
require_once __DIR__. "/../Repository/cashFlowRepository.php";
require_once __DIR__ . "/../Config/database.php";

use Config\Database;
use Model\CashFlowModel;
use Repository\CashFlowRepositoryImpl;

$connection = Database::getConnection();
$transaksi1 = new CashFlowRepositoryImpl($connection);
// $transaksi1->pemasukan(new CashFlowModel("Gajian", 500000));
// $transaksi1->pemasukan(new CashFlowModel("Bonus", 500000));
// $transaksi1->pemasukan(new CashFlowModel("THR", 500000));
// $transaksi1->pengeluaran(new CashFlowModel("Baju", 30000));
// $transaksi1->cek() ;
// var_dump($transaksi1->cekSaldo() );
// var_dump($transaksi1->cekSaldo() );
// var_dump($transaksi1->cekSaldo() );
// foreach ($saldo as $value){
//     echo "Saldo anda tersisa " . $value->getSaldo();
// }
// $transaksi1->cekSaldo() ;
$transaksi1->cekData() ;




?>