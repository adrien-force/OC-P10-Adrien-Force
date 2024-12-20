<?php

namespace App\Factory;

use App\Entity\Tag;
use App\Repository\TagRepository;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;
use Zenstruck\Foundry\Persistence\Proxy;
use Zenstruck\Foundry\Persistence\ProxyRepositoryDecorator;

/**
 * @extends PersistentProxyObjectFactory<Tag>
 *
 * @method        Tag|Proxy create(array|callable $attributes = [])
 * @method static Tag|Proxy createOne(array $attributes = [])
 * @method static Tag|Proxy find(object|array|mixed $criteria)
 * @method static Tag|Proxy findOrCreate(array $attributes)
 * @method static Tag|Proxy first(string $sortedField = 'id')
 * @method static Tag|Proxy last(string $sortedField = 'id')
 * @method static Tag|Proxy random(array $attributes = [])
 * @method static Tag|Proxy randomOrCreate(array $attributes = [])
 * @method static TagRepository|ProxyRepositoryDecorator repository()
 * @method static Tag[]|Proxy[] all()
 * @method static Tag[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Tag[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Tag[]|Proxy[] findBy(array $attributes)
 * @method static Tag[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Tag[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class TagFactory extends PersistentProxyObjectFactory{
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
        return Tag::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'tag' => self::faker()->emoji(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Tag $tag): void {})
        ;
    }
}
