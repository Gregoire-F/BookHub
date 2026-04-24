<?php

namespace App\Controller;


use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(BookRepository $bookRepository, AuthorRepository $authorRepository): Response
    {
        $books = $bookRepository->findAll();
        $authors = $authorRepository->findAll();

        shuffle($books);
        shuffle($authors);

        return $this->render('home/index.html.twig', [
            'books' => array_slice($books, 0, 3),
        ]);
    }
    
}