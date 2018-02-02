<?php
/**
 * Created by PhpStorm.
 * User: gaoyong
 * Date: 2018/2/2
 * Time: 下午2:35
 */
namespace Gmart\Wxlogin\Api;

interface SessionKeyInterface
{

    /**
     * 获取微信端的userInfo session信息
     * @param string $code
     * @param string $encryptedData
     * @param string $iv
     * @return mixed
     */
    public function getSessionData($code,$encryptedData,$iv);
}

