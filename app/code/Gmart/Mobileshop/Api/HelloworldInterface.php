<?php
namespace Gmart\Mobileshop\Api;

interface HelloworldInterface
{
    /**
     * Returns greeting message to user
     *
     * @api
     * @param string $name Users name.
     * @return string Greeting message with users name.
     */
    public function name($name);
}