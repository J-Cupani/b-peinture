<?php

namespace App\Entity;

use App\Service\ToolBox;

/**
 * Class CommonEntity
 *
 * @package App\Entity
 */
class CommonEntity
{
    /**
     * CommonEntity constructor.
     *
     */
    public function __construct()
    {
        /*
         * Creation du token si inexistant
         */
        if (method_exists($this, 'getToken') && method_exists($this, 'setToken')) {
            if ((property_exists(static::class, 'token') || property_exists(get_parent_class(static::class), 'token')) and is_null($this->getToken())) {
                $toolbox = new ToolBox();
                $this->setToken($toolbox->random());
            }
        }

        /*
         * Creation du statut actif si inexistant
         */
        if (method_exists($this, 'getActive') && method_exists($this, 'setActive')) {
            if ((property_exists(static::class, 'active') || property_exists(get_parent_class(static::class), 'active')) and is_null($this->getActive())) {
                $this->setActive(true);
            }
        }
    }

}