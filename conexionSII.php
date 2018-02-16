<?php


class conexionsii{
    private $consii;
    
    public function conexionsii(){
//        $this->consii = new mysqli("192.168.1.26", "consulta_sii", "C0nsult@.123",  "sii_aburra");
        $this->consii = new mysqli("192.168.1.26", "rrestrepo", "Clave.123",  "sii_aburra");
        
        if ($this->consii->connect_error) {
            die("Connection failed: " . $this->consii->connect_error);
        }

        //cambio de caracteres
        if (!$this->consii->set_charset("utf8")) {
            printf("Error cargando el conjunto de caracteres utf8: %s\n", $this->consii->error);
            exit();
        }
    }
    
    public function consultasii($consulta){
        $dato = $this->consii->query($consulta);
        $resultado = $dato->fetch_array();
 
        return $resultado; 
    }
    
}

	
?>