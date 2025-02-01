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
            'email' => 'test1@gmail.com',
            'name'  => 'John1'
        ],
        [
            'id'    => '2',
            'email' => 'test2@gmail.com',
            'name'  => 'John2'
        ],
        [
            'id'    => '3',
            'email' => 'test3@gmail.com',
            'name'  => 'John3'
        ],
        [
            'id'    => '4',
            'email' => 'test4@gmail.com',
            'name'  => 'John4'
        ],
        [
            'id'    => '5',
            'email' => 'test5@gmail.com',
            'name'  => 'John5'
        ],
        [
            'id'    => '6',
            'email' => 'test6@gmail.com',
            'name'  => 'John6'
        ],
        [
            'id'    => '7',
            'email' => 'test7@gmail.com',
            'name'  => 'John7'
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
    public function delete(string $id): JsonResponse
    {
        $this->findUserById($id);

        return new JsonResponse(["Item Delete"], Response::HTTP_NO_CONTENT);
    }
}
