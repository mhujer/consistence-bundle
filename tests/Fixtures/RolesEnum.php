<?php declare(strict_types = 1);

namespace Mhujer\ConsistenceBundle\Fixtures;

final class RolesEnum extends \Consistence\Enum\MultiEnum
{

    public const USER = 1;
    public const EMPLOYEE = 2;
    public const ADMIN = 4;

}
