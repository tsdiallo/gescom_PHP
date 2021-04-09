<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 23/09/2018
 * Time: 12:44
 */
require_once('application/core/DaoInterface.php');
class M_DetailsCommande  extends CI_Model implements DaoInterface
{
      public $id;
      public $qtecom;
      public $qteliv;
      public $article_id;
      public $commande_id;
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
   public function findAll(){
      return   $this->db->get($this->getTableName())
                ->result();
   }
/*
     public function findArticleDetails(){
       return $this->db->select("dc.*,art.*")
                    ->from($this->getTableName().' dc')
                    ->join('article art', 'art.id=dc.article_id','left')
                    ->get()
                    ->result();
   }*/

    public function findAllDetails($commande_id){
       return $this->db->query(
         "SELECT * FROM detailscmde dc, commande c, client cli, article art
          WHERE cli.id = c.client_id
          AND c.id = dc.commande_id
          AND dc.article_id = art.id
          AND dc.commande_id = $commande_id"
         )->result();
        /*
        return $this->db->select("d.*, c.*, cl.*, a.pu, a.libelle")
                        ->from($this->getTableName().' d')
                        ->join('commande c', 'c.id='.$commande_id)
                        ->join('client cl', 'cl.id=c.client_id')
                        ->join('article a', 'a.id=d.article_id')
                        ->get()
                        ->result();
                        */
   }

   public function getTableName(){

         return "detailscmde";
   }

   public function select()
   {
       // TODO: Implement select() method.
   }

}