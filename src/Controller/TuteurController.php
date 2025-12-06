<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;

class TuteurController extends AbstractController {

    private static  $tuteurs = [
        [
            'id' => 1,
            'nom' => 'Johnson',
            'prenom' => 'Paul',
            'entreprise' => 'Acme',
            'email' => 'paul.johnson@acme.com',
            'telephone' => '06 00 00 00 01',
            'etudiants' => [
                ['nom' => 'Martin', 'prenom' => 'Léa', 'sujet' => 'Détection d\'anomalies sur flux bancaires'],
                ['nom' => 'Durand', 'prenom' => 'Noah', 'sujet' => 'Dashboard risques crédit']
            ]
        ],
        [
            'id' => 2,
            'nom' => 'Walberg',
            'prenom' => 'Mark',
            'entreprise' => 'Globex',
            'email' => 'mark.walberg@globex.com',
            'telephone' => '06 00 00 00 02',
            'etudiants' => []
        ]
    ];

    public static function getAllTuteurs(){
        return TuteurController::$tuteurs;
    }
    public function index(Environment $twig, Request $request) {
        $sort = $request->query->get('sort', 'nom');
        $dir  = $request->query->get('dir', 'asc');

        usort(TuteurController::$tuteurs, function ($a, $b) use ($sort, $dir) {
            $result = $a[$sort] <=> $b[$sort];
            return $dir === 'asc' ? $result : -$result;
        });
        return new Response($twig->render('tuteur/index.html.twig',[
            'tuteurs' => TuteurController::$tuteurs,
            'sort' => $sort,
            'dir' => $dir,
            'query' => $request->query->all() // utile pour conserver les paramètres
        ]));
    }

    public function details(Environment $twig, int $id) {
        $tuteur = $this->findTuteurById($id);
        return new Response($twig->render('tuteur/show.html.twig', [
            'tuteur' => $tuteur
        ]));
    }

    private function findTuteurById(int $id): ?array
    {
        foreach (TuteurController::$tuteurs as $tuteur) {
            if ($tuteur['id'] === $id) {
                return $tuteur;
            }
        }

        return null;
    }

}

?>