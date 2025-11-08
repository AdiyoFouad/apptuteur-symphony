<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
class FormController extends AbstractController {
    public function hello(Environment $twig, $prenom="Bryan"){
        $html=$twig->render('hello.html.twig', ['prenom' => $prenom] );
        return new Response ($html);
    }

    public function listes(Environment $twig) {
        $tuteurs = [
            "tuteurs" => [
                ['nom' => "Johnson", 'prenom' => "Paul"],
                ['nom' => "Walberg", 'prenom' => "Mark"]
            ]
        ];
        
        $html=$twig->render('tuteurs.html.twig', ['tuteurs' => $tuteurs['tuteurs']] );
        return new Response ($html);

    }
}

?>