<?php
namespace Gmart\Mobileshop\Model;
use Gmart\Mobileshop\Api\HelloworldInterface;

class Helloworld implements HelloworldInterface
{
    /**
     * Returns greeting message to user
     *
     * @api
     * @param string $name Users name.
     * @return string Greeting message with users name.
     */
    public function name($name) {
        return "你好, " . $name;
    }
}