<?php

namespace App\Controller;

use App\Entity\Nota;
use App\Repository\NotaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controlador encargado de realizar consultas sobre las notas.
 *
 * Esta clase permite ejecutar distintas búsquedas sobre la entidad Nota
 * utilizando su repositorio. Los resultados obtenidos se envían a una
 * vista Twig para su representación.
 *
 * @package App\Controller
 * @author Manuel
 * @version 1.0
 */
class ConsultasNotaController extends AbstractController
{
    /**
     * Muestra la página principal de consultas de notas.
     *
     * Este método realiza varias operaciones de consulta sobre la entidad Nota
     * y muestra todos los resultados se pasan a la plantilla.
     *
     * @param NotaRepository $notaRepository Repositorio utilizado para consultar las notas.
     *
     * @return Response Devuelve la respuesta HTTP con la vista renderizada.
     */
    #[Route('/consultas/notas', name: 'consultas_notas')]
    public function index(NotaRepository $notaRepository): Response
    {
        // 1. Buscar por ID
        $nota1 = $notaRepository->find(1);

        // 2. Buscar todas las notas
        $todasNotas = $notaRepository->findAll();

        // 3. Buscar notas por título exacto
        $notasPHP = $notaRepository->findBy(['titulo' => 'PHP Básico']);

        // 4. Buscar la primera nota con ese título
        $notaPHP = $notaRepository->findOneBy(['titulo' => 'PHP Básico']);

        // 5. Buscar por múltiples criterios (AND implícito)
        $notasRecientes = $notaRepository->findBy([
            'titulo' => 'Symfony',
            'descripcion' => 'Introducción'
        ]);

        // 6. Ordenar y limitar resultados
        $ultimasNotas = $notaRepository->findBy([], ['fechaModificacion' => 'DESC'], 5);

        return $this->render('consultas_notas/index.html.twig', [
            'nota1' => $nota1,
            'todasNotas' => $todasNotas,
            'notasPHP' => $notasPHP,
            'notaPHP' => $notaPHP,
            'notasRecientes' => $notasRecientes,
            'ultimasNotas' => $ultimasNotas,
        ]);
    }
}