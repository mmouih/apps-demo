<?php

namespace App\Controller;

use App\Payload\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

class HomeController extends AbstractController
{
    #[Route('/no-context-payload', name: 'failed_without_context_payload')]
    public function failed(
        #[MapRequestPayload()] User $user
    ): JsonResponse {
        return $this->json($user);
    }


    #[Route('/context-payload', name: 'using_context')]
    public function payload(
        #[MapRequestPayload(serializationContext: [AbstractNormalizer::USE_CLASS_AS_DEFAULT_EXPECTED_TYPE => true])] User $user
    ): JsonResponse {
        return $this->json($user);
    }
}
