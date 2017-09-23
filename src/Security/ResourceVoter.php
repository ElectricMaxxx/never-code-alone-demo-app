<?php

namespace App\Security;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

class ResourceVoter implements VoterInterface
{
    public function vote(TokenInterface $token, $subject, array $attributes)
    {
        if (!is_array($subject) || !isset($subject['repository_name'])) {
            return;
        }

        return true;
    }

    /**
     * Checks if the voter supports the given attribute.
     *
     * @param mixed $attribute An attribute (usually the attribute name string)
     *
     * @return bool true if this Voter supports the attribute, false otherwise
     *
     * @deprecated since version 2.8, to be removed in 3.0.
     */
    public function supportsAttribute($attribute)
    {
        // TODO: Implement supportsAttribute() method.
    }

    /**
     * Checks if the voter supports the given class.
     *
     * @param string $class A class name
     *
     * @return bool true if this Voter can process the class
     *
     * @deprecated since version 2.8, to be removed in 3.0.
     */
    public function supportsClass($class)
    {
        // TODO: Implement supportsClass() method.
    }
}
