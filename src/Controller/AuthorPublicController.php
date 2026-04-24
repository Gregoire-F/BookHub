<?php

namespace App\Controller;

use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AuthorPublicController extends AbstractController
{
    #[Route('/authors', name: 'app_authors_index')]
    public function index(AuthorRepository $authorRepository): Response
    {
        return $this->render('author_public/index.html.twig', [
            'authors' => $authorRepository->findAll(),
        ]);
    }
}