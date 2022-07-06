<?php 

namespace Repository{
    require_once __DIR__ . "/../Model/cashFlowModel.php";
    use Model\CashFlowModel;
    use PDO;

    interface CashFlowRepository{
        public function pemasukan(CashFlowModel $pemasukan):void;

        public function pengeluaran(CashFlowModel $pengeluaran):void;

        public function saldoMasuk():int;
        
        public function saldoKeluar():int;

        public function cekSaldo():array;
        
        public function cekData():void;

        public function hapusData():void;
    }

    class CashFlowRepositoryImpl implements CashFlowRepository{
        private array $saldoMasuk = [];
        private array $dataCashFlowMasuk = [];
        private array $saldoKeluar = [];
        private array $dataCashFlowKeluar = [];
        private PDO $connection;

        public function __construct(PDO $connection)
        {
            $this->connection = $connection;
        }

        public function pemasukan(CashFlowModel $pemasukan): void
        {
            // $number = sizeof($this->dataCashFlowMasuk) + 1;
            // $this->dataCashFlowMasuk[$number] = $pemasukan;
            $sql = "INSERT INTO pemasukan(category, jumlah) VALUES(?,?)";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$pemasukan->getCategory(), $pemasukan->getSaldo()]);
        }

        public function pengeluaran(CashFlowModel $pengeluaran): void
        {
            // $number = sizeof($this->dataCashFlowKeluar) + 1;
            // $this->dataCashFlowKeluar[$number] = $pengeluaran;
            $sql = "INSERT INTO pengeluaran(category, jumlah) VALUES(?,?)";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$pengeluaran->getCategory(), $pengeluaran->getSaldo()]);
        }

        public function saldoMasuk():int{
            // $data = $this->dataCashFlowMasuk;
            // foreach($data as $number=>$value){
            //     $saldoMasuk = $value->getSaldo();
            //     array_push($this->saldoMasuk, $saldoMasuk);
            // }
            
            // return array_sum($this->saldoMasuk);
            $saldoMasuk = [];
            $sqlSaldoMasuk = "SELECT sum(jumlah) as saldo from pemasukan";
            $statementSaldoMasuk = $this->connection->prepare($sqlSaldoMasuk);
            $statementSaldoMasuk->execute();
            foreach ($statementSaldoMasuk as $row){
                $saldo = new CashFlowModel();
                $saldo->setSaldo($row["saldo"]);
                $saldoMasuk[] = $saldo;
            }
            return (int)$saldoMasuk;
        }

        public function saldoKeluar():int{
            // $data = $this->dataCashFlowKeluar;
            // foreach($data as $number=>$value){
            //     $saldoKeluar = $value->getSaldo();
            //     array_push($this->saldoKeluar, $saldoKeluar);
            // }
            
            // return array_sum($this->saldoKeluar);

            $saldokeluar = [];
            $sqlSaldokeluar = "SELECT sum(jumlah) as saldo from pengeluaran";
            $statementSaldokeluar = $this->connection->prepare($sqlSaldokeluar);
            $statementSaldokeluar->execute();
            foreach ($statementSaldokeluar as $row){
                $saldo = new CashFlowModel();
                $saldo->setSaldo($row["saldo"]);
                $saldokeluar[] = $saldo;
            }
            return (int)$saldokeluar;
        }

        public function cekSaldo(): array
        {
            // $saldoMasuk = $this->saldoMasuk();
            // $saldoKeluar = $this->saldoKeluar();
            // $totalSaldo = $saldoMasuk - $saldoKeluar;
            // echo "*** Saldo anda saat ini adalah Rp.$totalSaldo,- ***".PHP_EOL;

            
            $sqlSaldoMasuk = "SELECT sum(jumlah) as saldo from pemasukan";
            $statementSaldoMasuk = $this->connection->prepare($sqlSaldoMasuk);
            $statementSaldoMasuk->execute();
            foreach ($statementSaldoMasuk as $row){
                $saldoMasuk = $row["saldo"];
            }

            $sqlSaldokeluar = "SELECT sum(jumlah) as saldo from pengeluaran";
            $statementSaldokeluar = $this->connection->prepare($sqlSaldokeluar);
            $statementSaldokeluar->execute();
            foreach ($statementSaldokeluar as $row){
                $saldokeluar = $row["saldo"];
            }

            $totalSaldo = $saldoMasuk - $saldokeluar;
            $inputSaldo = new CashFlowModel();
            $inputSaldo->setSaldo($totalSaldo);
            $saldoAkhir[] = $inputSaldo;
            return $saldoAkhir;
        }

        public function cekData(): void
        {
            // $dataMasuk = $this->dataCashFlowMasuk;
            // $dataKeluar = $this->dataCashFlowKeluar;
            // echo "------PEMASUKAN".PHP_EOL;
            // foreach ($dataMasuk as $number => $value){
            //     echo "$number. {$value->getCategory()}nominal : {$value->getSaldo()}" .PHP_EOL;
            // }
            // echo "------PENGELUARAN".PHP_EOL;
            // foreach ($dataKeluar as $number => $value){
            //     echo "$number. {$value->getCategory()}nominal : {$value->getSaldo()}" .PHP_EOL;
            // }
            $dataPemasukan= [];
            $sqlPemasukan = "SELECT id, category, jumlah FROM pemasukan";
            $statementMasuk = $this->connection->prepare($sqlPemasukan);
            $statementMasuk->execute();
            foreach ($statementMasuk as $row){
                $pemasukan = new CashFlowModel();
                $pemasukan->setId($row["id"]);
                $pemasukan->setCategory($row["category"]);
                $pemasukan->setSaldo($row["jumlah"]);
                $dataPemasukan[]= $pemasukan;
            }
            echo "------PEMASUKAN".PHP_EOL;
            foreach ($dataPemasukan as $value){
                echo $value->getId(). ". " . $value->getCategory() . " = " . $value->getSaldo().PHP_EOL;
            }

            $datapengeluaran= [];
            $sqlpengeluaran = "SELECT id, category, jumlah FROM pengeluaran";
            $statementMasuk = $this->connection->prepare($sqlpengeluaran);
            $statementMasuk->execute();
            foreach ($statementMasuk as $row){
                $pengeluaran = new CashFlowModel();
                $pengeluaran->setId($row["id"]);
                $pengeluaran->setCategory($row["category"]);
                $pengeluaran->setSaldo($row["jumlah"]);
                $datapengeluaran[]= $pengeluaran;
            }
            echo "------PENGELUARAN".PHP_EOL;
            foreach ($datapengeluaran as $value){
                echo $value->getId(). ". " . $value->getCategory() . " = " . $value->getSaldo().PHP_EOL;
            }
        }

        public function hapusData(): void
        {
            $sql = "TRUNCATE TABLE pemasukan";
            $statement = $this->connection->prepare($sql);
            $statement->execute();

            $sql2 = "TRUNCATE TABLE pengeluaran";
            $statement2 = $this->connection->prepare($sql2);
            $statement2->execute();
        }
    }

}



?>