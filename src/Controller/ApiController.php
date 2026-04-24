<?php

namespace App\Controller;

use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ApiController extends AbstractController
{
    #[Route('/api/books', name: 'api_books', methods: ['GET'])]
    public function books(BookRepository $bookRepository): Response
    {
        $books = $bookRepository->findAll();
        return $this->json($books, 200, [], ['groups' => 'list']);
    }

    #[Route('/api/books/{id}', name: 'api_books_show', methods: ['GET'])]
    public function book(int $id, BookRepository $bookRepository): Response
    {
        $book = $bookRepository->find($id);

        if (!$book) {
            return $this->json(['message' => 'Livre introuvable'], 404);
        }

        return $this->json($book, 200, [], ['groups' => 'detail']);
    }

    #[Route('/api/authors', name: 'api_authors', methods: ['GET'])]
    public function authors(AuthorRepository $authorRepository): Response
    {
        $authors = $authorRepository->findAll();
        return $this->json($authors, 200, [], ['groups' => 'authors']);
    }
}
