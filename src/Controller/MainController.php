<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Symfony\Component\HttpFoundation\Request;



class MainController {
    #[Route('/index')]
    public function index(): Response {
        return new Response(
            '<html><body>Votre première page</body></html>'
        );
    }
    /* ---------------------------------------------------------------- */
    
    #[Route(
        '/bonjour/{nom}', 
        defaults: ['nom' => "Inconnu"],
        requirements: ['nom' => '[A-Za-z]+'],
        methods: ['GET']
    )]
    public function indexBis(string $nom): Response {
        //$request = Request::createFromGlobals();
        //$nom = $request->query->get('nom', 'Inconnu');
        return new Response(
            "<html><body>Bonjour $nom</body></html>"
        );
    }
    /* ---------------------------------------------------------------- */
/* 
    #[Route(
        '/calcul/{number}',
        requirements: ['number' => '100|\d{1,2}'],
    )] */
    public function indexter(int $number) : Response {
        return new Response(
            "<html><body>Le nombre est $number</body></html>"
        );
    }

}
?>