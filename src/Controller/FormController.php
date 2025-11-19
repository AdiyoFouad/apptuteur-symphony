<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
class FormController extends AbstractController {
    public function hello(Environment $twig, $prenom="Bryan"){
        $html=$twig->render('hello.html.twig', ['prenom' => $prenom] );
        return new Response ($html);
    }
/* 
    public function index(Environment $twig) {
        $html = $twig->render('home.html.twig');
        return new Response($html);

    } */

    public function listes(Environment $twig) {
        $tuteurs = [
            ['nom' => "Johnson", 'prenom' => "Paul"],
            ['nom' => "Walberg", 'prenom' => "Mark"]   
        ];
        
        $html=$twig->render('tuteurs.html.twig', ['tuteurs' => $tuteurs] );
        return new Response ($html);

    }

    public function search(Environment $twig) {
        $html = $twig->render('search_tuteur.html.twig');
        return new Response($html);
    }

    public function verify(Environment $twig, Request $request) {
        $tuteurs = [
            ['nom' => "Johnson", 'prenom' => "Paul"],
            ['nom' => "Walberg", 'prenom' => "Mark"]   
        ];
        $nom = htmlspecialchars($request->request->get('nom'));
        $existe = in_array($nom, $tuteurs);

        $html = $twig->render('result_tuteur.html.twig', [
            'nom' => $nom,
            'existe' => $existe
        ]);
        return new Response($html);
    }
}

?>