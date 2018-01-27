<?php
namespace Gmart\Review\Model;
use Gmart\Review\Api\HelloworldInterface;

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
        return "你好呀, " . $name;
    }
}