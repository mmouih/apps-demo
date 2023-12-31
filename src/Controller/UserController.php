<?php

namespace App\Controller;

use App\Payload\User;
use App\Handler\CreateOrUpdateUserHandler;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    #[Route('/user', name: 'create_or_update_user', methods: ['POST'])]
    public function createOrUpdate(
        #[MapRequestPayload] User $user,
        CreateOrUpdateUserHandler $handler
    ): JsonResponse {
        $handler->handle($user);
        return new JsonResponse(['message' => sprintf('User %s has been created', $user->name)]);
    }
}
