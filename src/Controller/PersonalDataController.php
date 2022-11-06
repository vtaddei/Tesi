<?php
namespace App\Controller;

use App\Entity\PersonalData;
use App\Form\PersonalDataTypes;
use App\Repository\PersonalDataRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonalDataController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    private PersonalDataRepository $personalDataRepository;

    public function __construct(PersonalDataRepository $personalDataRepository){
        $this->personalDataRepository = $personalDataRepository;
    }

    #[Route('/', name: 'HomePage')]
    public function index(): Response
    {
        $People = $this->personalDataRepository->findAll();
        return $this->render('HomePage.html.twig');
    }

    #[Route("/utenti/crea", name: 'crea_persona_fisica', methods: 'GET')]
    public function create(): Response
    {
        $pd = new PersonalData();
        $form = $this->createForm(PersonaldataTypes::class, $pd);
        return $this->renderForm("CreatePersonalData.html.twig",
            ['form' => $form]);
    }

    #[Route("/utenti/crea", name: 'salva_persona_fisica', methods: 'POST')]
    public function save(Request $request,  PersonalData $pd = null) : Response  #mettiamo MamagerRegistry solo se ci serve il persistent al flush
    {
        if ($pd == null) {
            $pd = new PersonalData();
        }
        $form = $this->createForm(PersonalDataTypes::class, $pd); #ridichiariamo il form perchè non è globale //
        $form->handleRequest($request);     #prende i dati dalla request

        if ($form->isValid() && $form->isSubmitted()) {    #verifichiamo se sono gli stessi valori del form e se è stato submittato (oltretutto andrebbero rimessi i controlli poichè in frontend si eludono facilmente)
            #$pf = $form->getData();   #non necessariamente lo stesso pf di riga 45 // ma getData si usa per duplicare
            $this->personalDataRepository->save($pd, true); #flush libera il buffer scrivendo / false stoppa la query che rimane in memoria, per sbloccarlo guarda le righe dopo, altrimenti metti true e funziona subito

        }

        #$doctrine->GetManager()->flush();
        return $this->redirectToRoute('HomePage');
    }





}