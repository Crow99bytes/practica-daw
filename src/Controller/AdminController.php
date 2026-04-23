<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;

/**
 * Controlador encargado de la administración de la aplicación.
 * 
 * Panel del admin y método para crear rápidamente un admin.
 * 
 *
 * @package App\Controller
 * @author Manuel
 * @version 1.0
 */

//#[IsGranted('ROLE_ADMIN')]
final class AdminController extends AbstractController
{
    /**
     * Muestra la página principal del panel de administración.
     *
     * Este método comprueba que el usuario autenticado tenga el rol
     * ROLE_ADMIN antes de permitir el acceso a la ruta /admin.
     * Si el usuario no dispone de permisos suficientes, se deniega el acceso.
     *
     * @return Response Devuelve la vista del panel de administración.
     */
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        // $this->denyAccessUnlessGranted('ROLE_ADMIN', null, "No tienes permisos para acceder a esta página.");

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * Crea rápidamente un usuario administrador en la base de datos.
     *
     * Este método resulta útil para pruebas o para la creación inicial de un
     * administrador, aunque en un entorno real debería protegerse adecuadamente
     * o eliminarse por motivos de seguridad.
     *
     * @param EntityManagerInterface $entityManager Gestiona la persistencia de entidades.
     * @param UserPasswordHasherInterface $passwordHasher Servicio para cifrar la contraseña del usuario.
     *
     * @return Response Mensaje de confirmación indicando que el administrador ha sido creado.
     */
    #[Route('/crear-admin-rapido', name: 'app_crear_admin_rapido')]
    public function crearAdminUserRapido(
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordHasher
    ): Response {
        $user = new User();
        $user->setEmail('admin@example.com');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($passwordHasher->hashPassword($user, 'abc123.'));

        $entityManager->persist($user);
        $entityManager->flush();

        return new Response('Admin creado!');
    }
}