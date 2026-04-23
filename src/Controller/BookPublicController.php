<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BookPublicController extends AbstractController
{
    #[Route('/books', name: 'app_books_index')]
    public function index(BookRepository $bookRepository): Response
    {
        return $this->render('book_public/index.html.twig', [
            'books' => $bookRepository->findAll(),
        ]);
    }

    #[Route('/books/{id}', name: 'app_books_show')]
    public function show(int $id, BookRepository $bookRepository): Response
    {
        $book = $bookRepository->find($id);

        if (!$book) {
            throw $this->createNotFoundException('Livre introuvable');
        }

        return $this->render('book_public/show.html.twig', [
            'book' => $book,
        ]);
    }
}
