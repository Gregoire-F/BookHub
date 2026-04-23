<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Category;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    ) {}

    public function load(ObjectManager $manager): void
    {
        // Catégories
        $categories = [];
        foreach (['Roman', 'Science-fiction', 'Policier', 'Biographie', 'Philosophie'] as $nom) {
            $category = new Category();
            $category->setName($nom);
            $manager->persist($category);
            $categories[] = $category;
        }

        // Auteurs
        $authors = [];
        foreach (['Victor Hugo', 'Albert Camus', 'Simone de Beauvoir', 'Jules Verne', 'René Descartes'] as $nom) {
            $author = new Author();
            $author->setName($nom);
            $manager->persist($author);
            $authors[] = $author;
        }

        // Livres
        $livres = [
            ['Les Misérables', '1862', 'Un chef-d\'œuvre de la littérature française.', 0, 0],
            ['L\'Étranger', '1942', 'Roman emblématique de l\'absurde.', 1, 2],
            ['Le Deuxième Sexe', '1949', 'Ouvrage fondateur du féminisme moderne.', 2, 4],
            ['Vingt mille lieues sous les mers', '1870', 'Un voyage extraordinaire sous les océans.', 3, 1],
            ['Discours de la méthode', '1637', 'Fondement de la philosophie moderne.', 4, 4],
        ];

        foreach ($livres as [$title, $year, $description, $authorIndex, $categoryIndex]) {
            $book = new Book();
            $book->setTitle($title);
            $book->setYear(new \DateTime($year));
            $book->setDescription($description);
            $book->setAuthor($authors[$authorIndex]);
            $book->setCategory($categories[$categoryIndex]);
            $manager->persist($book);
        }

        // User admin
        $user = new User();
        $user->setEmail('admin@admin.fr');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword(
            $this->passwordHasher->hashPassword($user, 'motdepasse')
        );
        $manager->persist($user);

        $manager->flush();
    }
}
