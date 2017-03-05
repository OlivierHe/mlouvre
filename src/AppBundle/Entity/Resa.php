<?php 
//src/AppBundle/Entity/Resa.php
namespace AppBundle­­\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 * @ORM\Table(name="Resa")
 */
class Resa
{


    /**
    * @ORM\Column(type="integer")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    */	
    private $id;


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
    private $nom;

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
    private $prenom;

    /**
    * @ORM\Column(type="string", length=50)
    * @Assert\Email(
    *     message = "Ceci n’est pas une adresse email valide"
    */
    private $email;

    /**
    * @ORM\Column(type="string", length=5)
    * @Assert\Country()
    * @Assert\NotBlank(message="Vous devez  choisir un pays")
    */
    private $pays;

    /**
    * @ORM\Column(type="date")
    * @Assert\Date()
    * @Assert\NotBlank(message="Vous devez selectionner une date")
    */
    private $date_naissance;

    /**
    * @ORM\Column(type="date")
    * @Assert\Date()
    * @Assert\NotBlank(message="Vous devez selectioner une date")
    */
    private $jour_visite;

    /**
    * @ORM\Column(type="string", length=20)
    * @Assert\Choice(choices = {"Journée", "Demi-journée"}, message = "Le choix doit être compris dans la liste")
    * @Assert\NotBlank(message="Vous devez faire un choix")
    */
    private $type_billets;

    /**
    * @ORM\Column(type="string")
    */	
    private $token;

    /**
    * @ORM\Column(type="boolean")
    */
    private $tarif_reduit;
}