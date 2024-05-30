<?php


    class ClienteController{

        public $cliente;

        public function __construct($cliente){
            $this->cliente = $cliente;
        }
        
        public function validaNome($cliente, $nomecliente) {
            $alreadyExists = false;

            for($i=0;$i<count($nomecliente);$i++){
                if(strtoupper($cliente->getNomeCliente()) == strtoupper($nomecliente[$i][1])) {
                    $alreadyExists=true;
                    break;
                }
            }
            return $alreadyExists;
        }
        public function validaEmail($cliente, $emailcliente) {
            $alreadyExists = false;

            for($i=0;$i<count($emailcliente);$i++){
                if(strtoupper($cliente->getEmailCliente()) == strtoupper($emailcliente[$i][3])) {
                    $alreadyExists=true;
                    break;
                }
            }
            return $alreadyExists;
        }
        public function validaCpf($cliente, $cpfcliente) {
            $alreadyExists = false;

            for($i=0;$i<count($cpfcliente);$i++){
                if(strtoupper($cliente->getCpfCliente()) == strtoupper($cpfcliente[$i][2])) {
                    $alreadyExists=true;
                    break;
                }
            }
            return $alreadyExists;
        }

        public function validaçãoCpf($cpfcliente)
        {
    
            $cpfcliente = str_replace(".", "", $cpfcliente);
            $cpfcliente = str_replace("-", "", $cpfcliente);
    
            $soma = 0;
    
            $vetorCpf = array();
    
            for ($i = 0; $i < strlen($cpfcliente); $i++) {
                $vetorCpf[$i] = substr($cpfcliente, $i, 1);
            }
    
            if (strlen($cpfcliente) != 11 || 
            $cpfcliente == "00000000000" || 
            $cpfcliente == "11111111111" || 
            $cpfcliente == "22222222222" || 
            $cpfcliente == "33333333333" || 
            $cpfcliente == "44444444444" || 
            $cpfcliente == "55555555555" || 
            $cpfcliente == "66666666666" || 
            $cpfcliente == "77777777777" || 
            $cpfcliente == "88888888888" || 
            $cpfcliente == "99999999999") {
                return false;	
            }
                    
            $contador = 10;
            $soma1 = 0;
    
            for ($i = 0; $i < 9; $i++) {
                $soma1 = $soma1 + ($vetorCpf[$i] * $contador);
                $contador--;
            }
    
            $resto1 = ($soma1 % 11);
    
            if ($resto1 < 2) {
                $digito1 = 0;
            } else {
                $digito1 = 11 - $resto1;
            }
    
            $contador = 11;
            $soma2 = 0;
            for ($i = 0; $i < 9; $i++) {
                $soma2 = $soma2 + ($vetorCpf[$i] * $contador);
                $contador--;
            }
            $soma2 = $soma2 + ($digito1 * $contador);
    
            $digito2 = ($soma2 % 11);
    
            if ($digito2 < 2)
                $digito2 = 0;
            else
                $digito2 = 11 - $digito2;
    
            //verificando se os dígitos informados são iguais aos calculados
            if (($digito1 == $vetorCpf[9]) && ($digito2 == $vetorCpf[10])) {
                return true;
            } else {
                return false;
            }
            
        }
    

    }
