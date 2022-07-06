<?php 

namespace Service{

    use Model\CashFlowModel;
    use Repository\CashFlowRepository;

    interface cashFlowService{
        public function tambahPemasukan(string $category, int $saldo):void;

        public function tambahPengeluaran(string $category, int $saldo):void;

        public function showSaldo():void;

        public function showCashFlow():void;

        public function hapusDataKeuangan():void;
    }

    class cashFlowServiceImpl implements cashFlowService{
        private CashFlowRepository $cashFlowRepository;

        public function __construct(CashFlowRepository $cashFlowRepository)
        {
            $this->cashFlowRepository = $cashFlowRepository;
        }

        public function tambahPemasukan(string $category, int $saldo): void
        {
            $modelCashFlow = new CashFlowModel($category, $saldo);
            $this->cashFlowRepository->pemasukan($modelCashFlow);
        }

        public function tambahPengeluaran(string $category, int $saldo): void
        {
            $modelCashFlow = new CashFlowModel($category, $saldo);
            $this->cashFlowRepository->pengeluaran($modelCashFlow);
        }

        public function showSaldo(): void
        {
            $saldo = $this->cashFlowRepository->cekSaldo();
            foreach ($saldo as $value){
                echo "Saldo anda tersisa " . $value->getSaldo().PHP_EOL;
            }
        }

        public function showCashFlow(): void
        {
            $this->cashFlowRepository->cekData();
        }

        public function hapusDataKeuangan(): void
        {
            $this->cashFlowRepository->hapusData();
            echo "Data keuangan anda telah dihapus".PHP_EOL;
        }
    }

}


?>