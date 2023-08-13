<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\UserCity;
use App\Repository\CityRepository;
use App\Repository\UserCityRepository;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\User\UserInterface;

class SubscribeService
{
    /**
     * @var \App\Repository\CityRepository $postRepository
     */
    private CityRepository $cityRepository;

    /**
     * @var \App\Repository\UserCityRepository $userCityRepository
     */
    private UserCityRepository $userCityRepository;

    /**
     * @var bool
     */
    public bool $statusOfSubscribing;

    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     * @param CityRepository $cityRepository
     * @param UserCityRepository $userCityRepository
     */
    public function __construct(CityRepository $cityRepository, UserCityRepository $userCityRepository, UserRepository $userRepository)
    {
        $this->cityRepository = $cityRepository;
        $this->userCityRepository = $userCityRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @param int $cityId
     * @param int $userId
     * @param UserInterface $currentUser
     * 
     * @return bool
     */
    public function toggleSubscribe(int $cityId, int $userId, UserInterface $currentUser): bool
    {
        $city = $this->cityRepository->find($cityId);

        $user = $this->userRepository->find($userId);

        // Make sure about like - does it is or not?
        $isLikedByCurrentUser = $city->getUserCities()->filter(function ($subscribe) use ($currentUser) {
            return $subscribe->getUser() === $currentUser;
        })->count() > 0;

        if (!$isLikedByCurrentUser) {
            // make a new like if it is not being
            $subscribe = new UserCity();
            $subscribe->setUser($currentUser);
            $subscribe->setCity($city);

            $city->addUserCity($subscribe);

            $user->addCity($city);

            // Save changes
            $this->userCityRepository->save($subscribe);
            $this->userRepository->save($user);

            $statusOfSubscribing = true;
        } else {
            // Delete like if it is being
            $existingLike = $city->getUserCities()->filter(function ($subscribe) use ($currentUser) {
                return $subscribe->getUser() === $currentUser;
            })->first();

            if ($existingLike) {
                $city->removeUserCity($existingLike);

                $this->userCityRepository->remove($existingLike);

                $statusOfSubscribing = false;
            }
        }
        return $statusOfSubscribing;
    }
}
