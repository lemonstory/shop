<?php
namespace Inchoo\Helloworld\Model;
use Inchoo\Helloworld\Api\HelloworldInterface;

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