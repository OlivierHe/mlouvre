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
    * @ORM\Column(type="string", length=100)
    * @Assert\Choice(choices = { 
    * "AFGHANISTAN",
    * "AFRIQUE DU SUD",
    * "ÅLAND, ÎLES",
    * "ALBANIE",
    * "ALGÉRIE",
    * "ALLEMAGNE",
    * "ANDORRE",
    * "ANGOLA",
    * "ANGUILLA",
    * "ANTARCTIQUE",
    * "ANTIGUA-ET-BARBUDA",
    * "ANTILLES NÉERLANDAISES",
    * "ARABIE SAOUDITE",
    * "ARGENTINE",
    * "ARMÉNIE",
    * "ARUBA",
    * "AUSTRALIE",
    * "AUTRICHE",
    * "AZERBAÏDJAN",
    * "BAHAMAS",
    * "BAHREÏN",
    * "BANGLADESH",
    * "BARBADE",
    * "BÉLARUS",
    * "BELGIQUE",
    * "BELIZE",
    * "BÉNIN",
    * "BERMUDES",
    * "BHOUTAN",
    * "BOLIVIE",
    * "BOSNIE-HERZÉGOVINE",
    * "BOTSWANA",
    * "BOUVET, ÎLE",
    * "BRÉSIL",
    * "BRUNÉI DARUSSALAM",
    * "BULGARIE",
    * "BURKINA FASO",
    * "BURUNDI",
    * "CAÏMANS, ÎLES",
    * "CAMBODGE",
    * "CAMEROUN",
    * "CANADA",
    * "CAP-VERT",
    * "CENTRAFRICAINE, RÉPUBLIQUE",
    * "CHILI",
    * "CHINE",
    * "CHRISTMAS, ÎLE",
    * "CHYPRE",
    * "COCOS (KEELING), ÎLES",
    * "COLOMBIE",
    * "COMORES",
    * "CONGO",
    * "CONGO, LA RÉPUBLIQUE DÉMOCRATIQUE DU",
    * "COOK, ÎLES",
    * "CORÉE, RÉPUBLIQUE DE",
    * "CORÉE, RÉPUBLIQUE POPULAIRE DÉMOCRATIQUE DE",
    * "COSTA RICA",
    * "CÔTE D'IVOIRE",
    * "CROATIE",
    * "CUBA",
    * "DANEMARK",
    * "DJIBOUTI",
    * "DOMINICAINE, RÉPUBLIQUE",
    * "DOMINIQUE",
    * "ÉGYPTE",
    * "EL SALVADOR",
    * "ÉMIRATS ARABES UNIS",
    * "ÉQUATEUR",
    * "ÉRYTHRÉE",
    * "ESPAGNE",
    * "ESTONIE",
    * "ÉTATS-UNIS",
    * "ÉTHIOPIE",
    * "FALKLAND, ÎLES (MALVINAS)",
    * "FÉROÉ, ÎLES",
    * "FIDJI",
    * "FINLANDE",
    * "FRANCE",
    * "GABON",
    * "GAMBIE",
    * "GÉORGIE",
    * "GÉORGIE DU SUD ET LES ÎLES SANDWICH DU SUD",
    * "GHANA",
    * "GIBRALTAR",
    * "GRÈCE",
    * "GRENADE",
    * "GROENLAND",
    * "GUADELOUPE",
    * "GUAM",
    * "GUATEMALA",
    * "GUERNESEY",
    * "GUINÉE",
    * "GUINÉE-BISSAU",
    * "GUINÉE ÉQUATORIALE",
    * "GUYANA",
    * "GUYANE FRANÇAISE",
    * "HAÏTI",
    * "HEARD, ÎLE ET MCDONALD, ÎLES",
    * "HONDURAS",
    * "HONG-KONG",
    * "HONGRIE",
    * "ÎLE DE MAN",
    * "ÎLES MINEURES ÉLOIGNÉES DES ÉTATS-UNIS",
    * "ÎLES VIERGES BRITANNIQUES",
    * "ÎLES VIERGES DES ÉTATS-UNIS",
    * "INDE",
    * "INDONÉSIE",
    * "IRAN, RÉPUBLIQUE ISLAMIQUE D'",
    * "IRAQ",
    * "IRLANDE",
    * "ISLANDE",
    * "ISRAËL",
    * "ITALIE",
    * "JAMAÏQUE",
    * "JAPON",
    * "JERSEY",
    * "JORDANIE",
    * "KAZAKHSTAN",
    * "KENYA",
    * "KIRGHIZISTAN",
    * "KIRIBATI",
    * "KOWEÏT",
    * "LAO, RÉPUBLIQUE DÉMOCRATIQUE POPULAIRE",
    * "LESOTHO",
    * "LETTONIE",
    * "LIBAN",
    * "LIBÉRIA",
    * "LIBYENNE, JAMAHIRIYA ARABE",
    * "LIECHTENSTEIN",
    * "LITUANIE",
    * "LUXEMBOURG",
    * "MACAO",
    * "MACÉDOINE, L'EX-RÉPUBLIQUE YOUGOSLAVE DE",
    * "MADAGASCAR",
    * "MALAISIE",
    * "MALAWI",
    * "MALDIVES",
    * "MALI",
    * "MALTE",
    * "MARIANNES DU NORD, ÎLES",
    * "MAROC",
    * "MARSHALL, ÎLES",
    * "MARTINIQUE",
    * "MAURICE",
    * "MAURITANIE",
    * "MAYOTTE",
    * "MEXIQUE",
    * "MICRONÉSIE, ÉTATS FÉDÉRÉS DE",
    * "MOLDOVA, RÉPUBLIQUE DE",
    * "MONACO",
    * "MONGOLIE",
    * "MONTÉNÉGRO",
    * "MONTSERRAT",
    * "MOZAMBIQUE",
    * "MYANMAR",
    * "NAMIBIE",
    * "NAURU",
    * "NÉPAL",
    * "NICARAGUA",
    * "NIGER",
    * "NIGÉRIA",
    * "NIUE",
    * "NORFOLK, ÎLE",
    * "NORVÈGE",
    * "NOUVELLE-CALÉDONIE",
    * "NOUVELLE-ZÉLANDE",
    * "OCÉAN INDIEN, TERRITOIRE BRITANNIQUE DE L'",
    * "OMAN",
    * "OUGANDA",
    * "OUZBÉKISTAN",
    * "PAKISTAN",
    * "PALAOS",
    * "PALESTINIEN OCCUPÉ, TERRITOIRE",
    * "PANAMA",
    * "PAPOUASIE-NOUVELLE-GUINÉE",
    * "PARAGUAY",
    * "PAYS-BAS",
    * "PÉROU",
    * "PHILIPPINES",
    * "PITCAIRN",
    * "POLOGNE",
    * "POLYNÉSIE FRANÇAISE",
    * "PORTO RICO",
    * "PORTUGAL",
    * "QATAR",
    * "RÉUNION",
    * "ROUMANIE",
    * "ROYAUME-UNI",
    * "RUSSIE, FÉDÉRATION DE",
    * "RWANDA",
    * "SAHARA OCCIDENTAL",
    * "SAINT-BARTHÉLEMY",
    * "SAINTE-HÉLÈNE",
    * "SAINTE-LUCIE",
    * "SAINT-KITTS-ET-NEVIS",
    * "SAINT-MARIN",
    * "SAINT-MARTIN",
    * "SAINT-PIERRE-ET-MIQUELON",
    * "SAINT-SIÈGE (ÉTAT DE LA CITÉ DU VATICAN)",
    * "SAINT-VINCENT-ET-LES GRENADINES",
    * "SALOMON, ÎLES",
    * "SAMOA",
    * "SAMOA AMÉRICAINES",
    * "SAO TOMÉ-ET-PRINCIPE",
    * "SÉNÉGAL",
    * "SERBIE",
    * "SEYCHELLES",
    * "SIERRA LEONE",
    * "SINGAPOUR",
    * "SLOVAQUIE",
    * "SLOVÉNIE",
    * "SOMALIE",
    * "SOUDAN",
    * "SRI LANKA",
    * "SUÈDE",
    * "SUISSE",
    * "SURINAME",
    * "SVALBARD ET ÎLE JAN MAYEN",
    * "SWAZILAND",
    * "SYRIENNE, RÉPUBLIQUE ARABE",
    * "TADJIKISTAN",
    * "TAÏWAN, PROVINCE DE CHINE",
    * "TANZANIE, RÉPUBLIQUE-UNIE DE",
    * "TCHAD",
    * "TCHÈQUE, RÉPUBLIQUE",
    * "TERRES AUSTRALES FRANÇAISES",
    * "THAÏLANDE",
    * "TIMOR-LESTE",
    * "TOGO",
    * "TOKELAU",
    * "TONGA",
    * "TRINITÉ-ET-TOBAGO",
    * "TUNISIE",
    * "TURKMÉNISTAN",
    * "TURKS ET CAÏQUES, ÎLES",
    * "TURQUIE",
    * "TUVALU",
    * "UKRAINE",
    * "URUGUAY",
    * "VANUATU",
    * "VENEZUELA",
    * "VIET NAM",
    * "WALLIS ET FUTUNA",
    * "YÉMEN",
    * "ZAMBIE",
    * "ZIMBABWE"}
    * , message = "Vous devez choisir un pays valide")
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
    * @ORM\Column(type="string", length=100)
    * @Assert\Choice(choices = {"Journée", "Demi-journée"}, message = "Le choix doit être compris dans la liste")
    * @Assert\NotBlank(message="Vous devez faire un choix")
    */
    private $type_billets;

    /**
    * @ORM\Column(type="integer")
    * @Assert\Range(
    *      min = 1,
    *      max = 10,
    *      minMessage = "Vous devez choisir 1 billet au minimum",
    *      maxMessage = "Vous ne pouvez que commander 10 billets au maximum"
    * )
    * @Assert\NotBlank(message="Vous devez remplir ce champ")
    */	
    private $nombre_billets;

    /**
    * @ORM\Column(type="boolean")
    */
    private $tarifs_reduit;
}