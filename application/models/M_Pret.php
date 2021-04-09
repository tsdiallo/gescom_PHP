<?php

require_once('application/core/DaoInterface.php');
// oubien include once cest la meme chose
class M_Pret extends CI_Model implements DaoInterface{

    public $id;
    public $codeEmprunteur;
    public $date;
    public $dateretour;
    public $etat;


    public function __construct(){
        parent::__construct();
    }

    //Redéfinition des Méthodes
   public function insert(){
    $this->db->insert($this->getTableName(), $this);
     $d=array(
      "statut"=>"succes",
      "id"=> $this->db->insert_id(),
      "message"=>ucfirst($this->getTableName())." a été Enregistrée avec Success"
     );
   return $d;
  }

  public function update(){
     $this->db->where("id",$this->id);
     $this->db->update($this->getTableName(), $this);
     $d=array(
      "statut"=>"succes",
      "id"=> $this->id,
      "message"=>ucfirst($this->getTableName())." a été Modifiée avec Success"
     );
   return $d;
  }

  public function updateEtat($numero, $etat)
  {
    $this->db->set('etat', $etat, false);
    $this->db->where('numero', $numero);
    $this->db->update($this->getTableName());
    $d = array(
      "statut" => "succes",
      "id" => $this->id,
      "message" => ucfirst($this->getTableName()) . " a été Modifiée avec Success"
    );
    return $d;
  }
  
  public function delete(){
    $this->db->where("id",$this->id);
    $this->db->delete($this->getTableName());
    $d=array(
     "statut"=>"succes",
     "id"=> $this->id,
     "message"=>ucfirst($this->getTableName())." a été Supprimée avec Success"
    );
  return $d;
  }
  public function findById(){
    return   $this->db
               ->get_where($this->getTableName(),array("id"=>$this->id))
               ->row();
  }
  public function findByCode(){
    return   $this->db
               ->get_where($this->getTableName(),array("codeEmprunteur"=>$this->codeEmprunteur))
               ->row();
  }
  public function findAll(){
     return   $this->db->get($this->getTableName())
               ->result();
  }
  public function findPretByEtat($etat){
    return   $this->db
               ->get_where($this->getTableName(),array("etat"=>$this->etat))
               ->result();
  }
  public function getTableName(){
        return "pret";
  }
  public function select()
  {
      
  }


}