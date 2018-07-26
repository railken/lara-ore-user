<?php

namespace Railken\LaraOre\User;

use Illuminate\Support\Collection;
use Laravolt\Avatar\Avatar;
use Railken\Laravel\Manager\Contracts\EntityContract;
use Railken\Laravel\Manager\ModelSerializer;

class UserSerializer extends ModelSerializer
{
    /**
     * Serialize entity.
     *
     * @param \Railken\LaraOre\User\User     $entity
     * @param \Illuminate\Support\Collection $select
     *
     * @return \Railken\Bag
     */
    public function serialize(EntityContract $entity, Collection $select = null)
    {
        $bag = parent::serialize($entity, $select);

        $bag->set('avatar', (new Avatar())->create($entity->name)->toBase64()->getEncoded());

        return $bag;
    }
}
