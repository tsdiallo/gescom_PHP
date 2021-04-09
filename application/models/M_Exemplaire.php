

<?php
require_once('application/core/DaoInterface.php');

class M_Exemplaire extends CI_Model   implements DaoInterface{

      public $id;
      public $date;
      public $valeur;
      public $duree;
      public $codeBarre;
      public $id_ouvrage;
      public $etat;
      public $id_remplace;
      

    public function __construct(){
         parent::__construct();
    }

    //Redéfinition des Méthodes
    public function insert(){
      $this->db->insert($this->getTableName(), $this);
       $d=array(
        "statut"=>"succes",
        "id"=> $this->db->insert_id(),
        "message"=>ucfirst($this->getTableName())." a été Enregistré avec Success"
       );
     return $d;
    }

    public function update(){
       $this->db->where("id",$this->id);
       $this->db->update($this->getTableName(), $this);
       $d=array(
        "statut"=>"succes",
        "id"=> $this->id,
        "message"=>ucfirst($this->getTableName())." a été Modifié avec Success"
       );
     return $d;
    }

    public function delete(){
      $this->db->where("id",$this->id);
      $this->db->delete($this->getTableName());
      $d=array(
       "statut"=>"succes",
       "id"=> $this->id,
       "message"=>ucfirst($this->getTableName())." a été Supprimé avec Success"
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
                 ->get_where($this->getTableName(),array("codeBarre"=>$this->codeBarre))
                 ->row();
    }
    
    public function findAll(){
       return   $this->db->get($this->getTableName())
                 ->result();
    }
    
    public function findByEtat($etat){
      return   $this->db
                 ->get_where($this->getTableName(),array("etat"=>$this->etat))
                 ->row();
    }

    public function getTableName(){

          return "exemplaire";
    }

    public function findExeOuv($id){
      return  $this->db->select("e.*,o.*")
              ->from($this->getTableName() .' e')
              ->join("ouvrage o","o.id=e.id_ouvrage","left")
              ->where("id=".$id)
              ->get()
              ->result();
    }

    public function updateEtat($numero, $etat)
    {
      $this->db->set('etat', $etat, false);
      $this->db->where('codeBarre', $codeBarre);
      $this->db->update($this->getTableName());
      $d = array(
        "statut" => "succes",
        "id" => $this->id,
        "message" => ucfirst($this->getTableName()) . " a été Modifiée avec Success"
      );
      return $d;
    }

}