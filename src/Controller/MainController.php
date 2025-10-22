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
    #[Route('/bonjour')]
    public function indexBis(): Response {
        $request = Request::createFromGlobals();
        $nom = $request->query->get('nom', 'Inconnu');
        return new Response(
            "<html><body>Bonjour $nom</body></html>"
        );
    }
}
?>