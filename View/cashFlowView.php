<?php 

namespace View{

require_once __DIR__ . "/../Model/cashFlowModel.php";
require_once __DIR__. "/../Repository/cashFlowRepository.php";
require_once __DIR__ . "/../Service/cashFlowService.php";
require_once __DIR__. "/../Helper/inputHelper.php";

use Helper\InputHelper;
use Model\CashFlowModel;
use Repository\CashFlowRepositoryImpl;
use Service\cashFlowService;
use Service\cashFlowServiceImpl;

// $repoCashFlow = new CashFlowRepositoryImpl();
// $serviceCashFlow = new cashFlowServiceImpl($repoCashFlow);

class cashFlowView{
    private cashFlowService $cashFlowService;

    public function __construct(cashFlowService $cashFlowService)
    {
        $this->cashFlowService = $cashFlowService;
    }

    public function showData(){
        while(true){
            echo "------DATA KEUANGAN ANDA------".PHP_EOL;
            echo "------Menu".PHP_EOL;
            echo "1. Lihat Saldo dan Cashflow".PHP_EOL;
            echo "2. Catat Pemasukan".PHP_EOL;
            echo "3. Catat Pengeluaran".PHP_EOL;
            echo "4. Hapus Data Keuangan" .PHP_EOL;
            echo "99. Kembali".PHP_EOL;
            $pilihan = InputHelper::input("Pilih");
            
            if ($pilihan == 1){
                $this->showAll();
            } else if ($pilihan == 2){
                $this->catatPemasukan();
            } else if ($pilihan == 3){
                $this->catatPengeluaran();
            } else if ($pilihan == 4){
                $this->hapusDataKeuangan();
            } else if ($pilihan == 99){
                break;
            } else {
                echo "Maaf Pilihan tidak dimengerti".PHP_EOL;
            }
        }
        echo "------SAMPAI JUMPA!------".PHP_EOL;
        
    }
    public function showAll(){
        $this->cashFlowService->showSaldo();
        $this->cashFlowService->showCashFlow();
    }

    public function catatPemasukan(){
        echo "------CATAT PEMASUKAN ANDA".PHP_EOL;
        $jumlahPemasukan = InputHelper::input("Masukkan saldo pemasukkan (99 untuk batal)");
        if ($jumlahPemasukan==99){
            echo "Gagal mencatat pemasukan".PHP_EOL;
        } else {
            $categoryPemasukan = InputHelper::input("Masukkan category");

            $this->cashFlowService->tambahPemasukan($categoryPemasukan, $jumlahPemasukan);
            echo "Sukses mencatat pemasukkan sebesar $jumlahPemasukan dengan kategori $categoryPemasukan".PHP_EOL;
        }
    }

    public function catatPengeluaran(){
        echo "------CATAT PENGELUARAN ANDA".PHP_EOL;
        $jumlahPengeluaran = InputHelper::input("Masukkan saldo pengeluaran (99 untuk batal)");
        if ($jumlahPengeluaran==99){
            echo "Gagal mencatat pengeluaran".PHP_EOL;
        } else {
            $categoryPengeluaran = InputHelper::input("Masukkan category");
            $this->cashFlowService->tambahPengeluaran($categoryPengeluaran, $jumlahPengeluaran);
            echo "Sukses mencatat pengeluaran sebesar $jumlahPengeluaran dengan kategori $categoryPengeluaran".PHP_EOL;
        }
    }

    public function hapusDataKeuangan(){
        echo "------Menghapus Data Keuangan?".PHP_EOL;
        $konfirmasi = InputHelper::input("Yakin? (1 untuk oke / 99 untuk batal)");
        if ($konfirmasi==99) {
            echo "Gagal menghapus data keuangan".PHP_EOL;
        } else if ($konfirmasi == 1) {
            $this->cashFlowService->hapusDataKeuangan();
            echo "Sukses menghapus data keuangan".PHP_EOL;
        } else{
            echo "Maaf, pilihan tidak dimengerti".PHP_EOL;
        }

    }
}



}


?>