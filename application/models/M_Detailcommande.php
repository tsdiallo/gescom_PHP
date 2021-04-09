<?php

require_once('application/core/DaoInterface.php');
// oubien include once cest la meme chose
class M_detailcommande extends CI_Model implements DaoInterface{

    public $id;
    public $qtecom;
    public $id_commande;
    public $id_ouvrage;
    public $qteliv;
    
		

    public function __construct(){
        parent::__construct();
    }

    public function insert(){
        $this->db->insert($this->getTableName(),$this);

        $d=array(
            "statut"=>"succes",
            "id"=> $this->db->insert_id(),
            "message"=>ucfirst($this->getTableName())." a été ajoutée avec Succes"
        );
        return $d;

    }
    public function update(){
        $this->db->where("id",$this->id);
        $this->db->update($this->getTableName(),$this);

        $d=array(
            "statut"=>"success",
            "id"=> $this->id,
            "message"=>ucfirst($this->getTableName())." a été modifie avec Succes"
        );
        return $d;

    }
    public function findById(){
        return $this->db->get_where($this->getTableName(),array("id"=>$this->id))
          ->row();
        
    }
    public function findAll(){
        return $this->db->get($this->getTableName())
          ->result();

    }
    public function getTableName(){
        return "detailcommande";

    }

    public function delete(){
        $this->db->where("id",$this->id);
        $this->db->delete($this->getTableName());

        $d=array(
            "statut"=>"success",
            "id"=> $this->id,
            "message"=>ucfirst($this->getTableName())." a été Supprime avec Succes"
        );
        return $d;

    }
    
}


?>