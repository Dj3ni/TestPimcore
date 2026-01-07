<?php

declare(strict_types=1);

namespace App\Model\DataObject;

use Pimcore\Model\DataObject\User as BaseUser;
use Symfony\Component\Security\Core\User\UserInterface;
use Pimcore\Model\DataObject\ClassDefinition\Data\Password;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class User extends BaseUser implements UserInterface, PasswordAuthenticatedUserInterface
{
    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here

        /**
         *  @var Password $field
         */
        $field = $this->getClass()->getFieldDefinition('password'); 
        $field->getDataForResource($this->getPassword(), $this);
    }

    public function getUserIdentifier(): string
    {
        return $this->getUsername();
    }

} 