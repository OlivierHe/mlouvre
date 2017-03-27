<?php 
// src/AppBundle/Entity/Resa.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as CustomAssert;


/**
 * @ORM\Entity
 * @ORM\Table(name="Resa")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ResaRepository")
 */
class Resa
{


    /**
    * @ORM\Column(type="integer")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    */	
    protected $id;


    /**
    * @ORM\Column(type="string", length=100)
    * @Assert\Length(
    *      min = 2,
    *      max = 100,
    *      minMessage = "Il faut 2 caractères minimum",
    *      maxMessage = "Il faut 100 caractères maximum"
    * )
    * @Assert\NotBlank(message="Vous devez remplir ce champ")
    */
    protected $nom;

    /**
    * @ORM\Column(type="string", length=100)
    * @Assert\Length(
    *      min = 2,
    *      max = 100,
    *      minMessage = "Il faut 2 caractères minimum",
    *      maxMessage = "Il faut 100 caractères maximum"
    * )
    * @Assert\NotBlank(message="Vous devez remplir ce champ")
    */
    protected $prenom;

    /**
    * @ORM\Column(type="string", length=50)
    * @Assert\Email(message = "Ceci n’est pas une adresse email valide")
    */
    protected $email;

    /**
    * @ORM\Column(type="string", length=5)
    * @Assert\Country()
    * @Assert\NotBlank(message="Vous devez  choisir un pays")
    */
    protected $pays;

    /**
    * @ORM\Column(type="date")
    * @Assert\Date()
    * @Assert\NotBlank(message="Vous devez selectionner une date")
    */
    protected $date_naissance;

    /**
    * @ORM\Column(type="date")
    * @Assert\Date()
    * @Assert\NotBlank(message="Vous devez selectioner une date")
    * @CustomAssert\IsValidDayDate
    */
    protected $jour_visite;

    /**
    * @ORM\Column(type="string", length=20)
    * @Assert\Choice(choices = {"Journée", "Demi-journée"}, message = "Le choix doit être compris dans la liste")
    * @Assert\NotBlank(message="Vous devez faire un choix")
    */
    protected $type_billets;

    /**
    * @ORM\Column(type="boolean")
    */
    protected $tarif_reduit;

    /**
    * @ORM\Column(type="integer")
    */
    protected $prix_ticket;

    /**
    * @ORM\Column(type="string", length=32)
    */
    protected $resa_number;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Resa
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Resa
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Resa
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set pays
     *
     * @param string $pays
     *
     * @return Resa
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set dateNaissance
     *
     * @param string $dateNaissance
     *
     * @return Resa
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->date_naissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return string
     */
    public function getDateNaissance()
    {
        return $this->date_naissance;
    }

    /**
     * Set jourVisite
     *
     * @param \DateTime $jourVisite
     *
     * @return Resa
     */
    public function setJourVisite($jourVisite)
    {
        $this->jour_visite = $jourVisite;

        return $this;
    }

    /**
     * Get jourVisite
     *
     * @return \DateTime
     */
    public function getJourVisite()
    {
        return $this->jour_visite;
    }

    /**
     * Set typeBillets
     *
     * @param string $typeBillets
     *
     * @return Resa
     */
    public function setTypeBillets($typeBillets)
    {
        $this->type_billets = $typeBillets;

        return $this;
    }

    /**
     * Get typeBillets
     *
     * @return string
     */
    public function getTypeBillets()
    {
        return $this->type_billets;
    }

    /**
     * Set tarifReduit
     *
     * @param boolean $tarifReduit
     *
     * @return Resa
     */
    public function setTarifReduit($tarifReduit)
    {
        $this->tarif_reduit = $tarifReduit;

        return $this;
    }

    /**
     * Get tarifReduit
     *
     * @return boolean
     */
    public function getTarifReduit()
    {
        return $this->tarif_reduit;
    }

    /**
     * Set prixTicket
     *
     * @param integer $prixTicket
     *
     * @return Resa
     */
    public function setPrixTicket($prixTicket)
    {
        $this->prix_ticket = $prixTicket;

        return $this;
    }

    /**
     * Get prixTicket
     *
     * @return integer
     */
    public function getPrixTicket()
    {
        return $this->prix_ticket;
    }

    /**
     * Set resaNumber
     *
     * @param string $resaNumber
     *
     * @return Resa
     */
    public function setResaNumber()
    {
        $cryptoken = openssl_random_pseudo_bytes(32);
        $resaNumber   = bin2hex($cryptoken);
        $this->resa_number = $resaNumber;

        return $this;
    }

    /**
     * Get resaNumber
     *
     * @return string
     */
    public function getResaNumber()
    {
        return $this->resa_number;
    }
}
