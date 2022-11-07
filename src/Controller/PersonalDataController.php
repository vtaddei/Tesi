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
    public function save(Request $request,  PersonalData $pd = null) : Response
    {
        if ($pd == null) {
            $pd = new PersonalData();
        }
        $form = $this->createForm(PersonalDataTypes::class, $pd);
        $form->handleRequest($request);
        if ($form->isValid() && $form->isSubmitted()) {
            $this->personalDataRepository->save($pd, true);
        }
        return $this->redirectToRoute('CreaUtente');
    }





}