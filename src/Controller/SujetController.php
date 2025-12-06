<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class SujetController extends AbstractController {
    public function index(Request $request)
{
    $entrepriseFiltre = $request->query->get('entreprise');

    $tuteurs = TuteurController::getAllTuteurs(); // Ou ta méthode d'accès

    $sujets = [];

    foreach ($tuteurs as $tuteur) {
        foreach ($tuteur['etudiants'] as $etu) {
            // Filtre entreprise
            if ($entrepriseFiltre && $tuteur['entreprise'] !== $entrepriseFiltre) {
                continue;
            }

            $sujets[] = [
                'sujet' => $etu['sujet'],
                'etudiant' => $etu['prenom'] . ' ' . $etu['nom'],
                'tuteur' => $tuteur['prenom'] . ' ' . $tuteur['nom'],
                'entreprise' => $tuteur['entreprise']
            ];
        }
    }

    // Liste des entreprises pour le menu déroulant
    $entreprises = array_unique(array_column($tuteurs, 'entreprise'));

    return $this->render('sujet/index.html.twig', [
        'sujets' => $sujets,
        'entreprises' => $entreprises,
        'filtre' => $entrepriseFiltre
    ]);
}

}

?>