<?php

namespace App\Factory;

use App\Entity\Status;
use App\Repository\StatusRepository;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;
use Zenstruck\Foundry\Persistence\Proxy;
use Zenstruck\Foundry\Persistence\ProxyRepositoryDecorator;

/**
 * @extends PersistentProxyObjectFactory<Status>
 *
 * @method        Status|Proxy create(array|callable $attributes = [])
 * @method static Status|Proxy createOne(array $attributes = [])
 * @method static Status|Proxy find(object|array|mixed $criteria)
 * @method static Status|Proxy findOrCreate(array $attributes)
 * @method static Status|Proxy first(string $sortedField = 'id')
 * @method static Status|Proxy last(string $sortedField = 'id')
 * @method static Status|Proxy random(array $attributes = [])
 * @method static Status|Proxy randomOrCreate(array $attributes = [])
 * @method static StatusRepository|ProxyRepositoryDecorator repository()
 * @method static Status[]|Proxy[] all()
 * @method static Status[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Status[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Status[]|Proxy[] findBy(array $attributes)
 * @method static Status[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Status[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class StatusFactory extends PersistentProxyObjectFactory{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
    }

    public static function class(): string
    {
        return Status::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Status $status): void {})
        ;
    }
}
