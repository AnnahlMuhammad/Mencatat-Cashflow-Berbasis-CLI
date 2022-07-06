<?php 

namespace Model {
    class CashFlowModel{
        private int $id;
        private int $saldo;
        private string $category;

        public function __construct(string $category ="", int $saldo=0)
        {
            $this->category = $category;
            $this->saldo = $saldo;
        }

        public function getId():string{
            return $this->id;
        }
        public function setId($id){
            $this->id = $id;
        }

        public function getSaldo():int{
            return $this->saldo;
        }
        public function setSaldo($saldo){
            $this->saldo = $saldo;
        }
        
        public function getCategory():string{
            return $this->category;
        }
        public function setCategory($category){
            $this->category = $category;
        }

        
    }
}



?>