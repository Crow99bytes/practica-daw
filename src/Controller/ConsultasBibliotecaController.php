<?php

namespace App\Controller;

use App\Repository\LibroRepository;
use App\Repository\AutorRepository;
use App\Repository\EditorialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

/**
 * Controlador encargado de realizar consultas sobre la biblioteca.
 *
 * Esta clase te da los datos de las bases de datos de libros, autores y editoriales.
 * 
 *
 * @package App\Controller
 * @author Manuel
 * @version 1.0
 */
class ConsultasBibliotecaController extends AbstractController
{
    /**
     * Muestra la página principal de consultas de la biblioteca.
     *
     * Este método obtiene diferentes conjuntos de datos necesarios para la vista:
     * todos los libros registrados, los cinco libros más vendidos, un autor
     * buscado por nombre exacto y los libros pertenecientes a una editorial concreta.
     * Finalmente, envía toda esta información a la plantilla Twig correspondiente.
     *
     * @param LibroRepository $libroRepository Repositorio utilizado para consultar los libros.
     * @param AutorRepository $autorRepository Repositorio utilizado para buscar autores.
     * @param EditorialRepository $editorialRepository Repositorio utilizado para buscar editoriales.
     *
     * @return Response Devuelve la respuesta HTTP con la vista renderizada.
     */
    #[Route('/consultas/biblioteca', name: 'consultas_biblioteca')]
    #[IsGranted('ROLE_USER')]
    public function index(
        LibroRepository $libroRepository,
        AutorRepository $autorRepository,
        EditorialRepository $editorialRepository
    ): Response {

        // 1️ Todos los libros
        $todosLibros = $libroRepository->findAll();

        // 2️ Los 5 libros más vendidos
        $masVendidos = $libroRepository->findBy(
            [],
            ['unidadesVendidas' => 'DESC'],
            5
        );

        // 3️ Buscar autor por nombre exacto
        $autor = $autorRepository->findOneBy([
            'nombre' => 'Gabriel García Márquez'
        ]);

        // 4️ Libros de una editorial concreta
        $editorial = $editorialRepository->findOneBy([
            'nombre' => 'Planeta'
        ]);

        $librosEditorial = $editorial ? $editorial->getLibros() : [];

        return $this->render('consultas_biblioteca/index.html.twig', [
            'todosLibros' => $todosLibros,
            'masVendidos' => $masVendidos,
            'autor' => $autor,
            'editorial' => $editorial,
            'librosEditorial' => $librosEditorial,
        ]);
    }
}