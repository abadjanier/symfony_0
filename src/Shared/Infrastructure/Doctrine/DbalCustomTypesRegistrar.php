<?php


namespace App\Shared\Infrastructure\Doctrine;


use Doctrine\DBAL\Types\Type;
use function Lambdish\Phunctional\each;

final class DbalCustomTypesRegistrar
{
    private static bool $initialized = false;

    public static function register(array $customTypeClassNames): void
    {
        if (!self::$initialized) {
            each(self::registerType(), $customTypeClassNames);

            self::$initialized = true;
        }
    }

    private static function registerType(): callable
    {
        return static function (string $customTypeClassName): void {
            Type::addType($customTypeClassName::customTypeName(), $customTypeClassName);
        };
    }
}
