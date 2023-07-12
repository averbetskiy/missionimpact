<?php

/**
 *
 */
class UnisenderApi
{
    const url = 'https://api.unisender.com/ru/api/';

    /**
     * @param string $email
     * @param string $siteId
     * @return void
     */
    public static function subscribe(string $email,string $siteId){
        try{
            $params = [];
            if($siteId == 's2'){
                $listIds = \Bitrix\Main\Config\Option::get( "askaron.settings", "UF_UNISENDER_LIST_RU");
            }else{
                $listIds = \Bitrix\Main\Config\Option::get( "askaron.settings", "UF_UNISENDER_LIST_EN");
            }
            $params['fields']['email'] = $email;
            $params['list_ids'] = $listIds;
            $result = static::callMethod('subscribe',$params);
            if($result['error']){
                throw new \Exception($result['error']);
            }
            echo 'true';
        }catch (\Exception $e){
            echo $e->getMessage();
        }
    }

    /**
     * @param string $method
     * @param array $params
     * @return mixed
     */
    private static function callMethod(string $method,array $params){
        $apiKey = \Bitrix\Main\Config\Option::get( "askaron.settings", "UF_UNISENDER_KEY");
        $params['format'] = 'json';
        $params['api_key'] = $apiKey;
        $url = static::url.$method.'?'.http_build_query($params);
        $Curl = curl_init();
        curl_setopt_array($Curl, array(
            CURLOPT_SSL_VERIFYPEER => FALSE,
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
        ));
        $response = curl_exec($Curl);
        curl_close($Curl);
        return json_decode($response,true);
    }
}