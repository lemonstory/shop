<?php
namespace Inchoo\Helloworld\Block;

class Helloworld extends \Magento\Framework\View\Element\Template
{
    public function getHelloWorldTxt()
    {
        return '看看 Hello world!';
    }
}