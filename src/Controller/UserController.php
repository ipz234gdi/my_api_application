<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;


#[Route('/api/v1', name: 'api_v1_')]
class UserController extends AbstractController
{

    public const USERS_DATA = [
        [
            'id'    => '1',
            'email' => 'reiclid@gmail.com',
            'name'  => 'Reiclid002'
        ],
        [
            'id'    => '2',
            'email' => 'muy1206@gmail.com',
            'name'  => 'Denis'
        ],
        [
            'id'    => '3',
            'email' => 'ipz234_gdi@student.ztu.edu.ua',
            'name'  => 'Denis Hrushevitskyi'
        ],
        [
            'id'    => '4',
            'email' => 'dadavasya@gmail.com',
            'name'  => 'Vitaliy'
        ],
        [
            'id'    => '5',
            'email' => 'max.maxbetov@mail.com',
            'name'  => 'Max Maxbetov'
        ],
        [
            'id'    => '6',
            'email' => 'kate.novak@mail.com',
            'name'  => 'Kateryna Novak'
        ],
        [
            'id'    => '7',
            'email' => 'sergey.bondarenko@gmail.com',
            'name'  => 'Serhii Bondarenko'
        ],
    ];

    public function findUserById(string $id): array
    {
        $userData = null;

        foreach (self::USERS_DATA as $user) {
            if (!isset($user['id'])) {
                continue;
            }

            if ($user['id'] == $id) {
                $userData = $user;

                break;
            }

        }

        if (!$userData) {
            throw new NotFoundHttpException("User with id " . $id . " not found");
        }

        return $userData;
    }


    #[Route('/users', name: 'app_user_collection', methods: ['GET'])]
    public function getCollection(): JsonResponse
    {
        return new JsonResponse([
            'data' => self::USERS_DATA
        ], Response::HTTP_OK);
    }
    
    #[Route('/users', name: 'app_user_new', methods: ['POST'])]
    public function createItem(Request $request): JsonResponse
    {
        $requestData = json_decode($request->getContent(), true);

        if (!isset($requestData['email'], $requestData['name'])) {
            throw new UnprocessableEntityHttpException("name and email are required");
        }

        $countOfUsers = count(self::USERS_DATA);

        $newUser = [
            'id'    => $countOfUsers + 1,
            'email' => $requestData['email'],
            'name'  => $requestData['name']
        ];

        return new JsonResponse([
            'data' => $newUser
        ], Response::HTTP_CREATED);
    }

    #[Route('/users/{id}', name: 'app_user_show', methods: ['GET'])]
    public function getItem(string $id): JsonResponse
    {
        $userData = $this->findUserById($id);

        return new JsonResponse([
            'data' => $userData
        ], Response::HTTP_OK);
    }

    #[Route('/users/{id}/edit', name: 'app_product_edit', methods: ['PATCH'])]
    #[IsGranted("ROLE_ADMIN")]
    public function edit(string $id, Request $request): JsonResponse
    {
        $requestData = json_decode($request->getContent(), true);

        if (!isset($requestData['name']) & !isset($requestData['email'])) {
            throw new UnprocessableEntityHttpException("name or email is required");
        }

        $userData = $this->findUserById($id);

        if (isset($requestData['name'])){
            $userData['name'] = $requestData['name'];
        } 
        if (isset($requestData['email'])){
            $userData['email'] = $requestData['email'];
        } 

        return new JsonResponse(['data' => $userData], Response::HTTP_OK);
    }

    #[Route('/users/{id}', name: 'app_product_delete', methods: ['DELETE'])]
    #[IsGranted("ROLE_ADMIN")]
    public function delete(string $id): JsonResponse
    {
        $this->findUserById($id);

        return new JsonResponse(["Item Delete"], Response::HTTP_NO_CONTENT);
    }
}
