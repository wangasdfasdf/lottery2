<?php

namespace app\service;


class RasService extends BaseService
{
    /**
     * RSA私钥解密
     *
     * @param string $string 待解密数据
     * @return array|string|bool|null 返回解密内容
     */
    public function privateDecode(string $string): array|string|bool|null
    {
        try {
            $key = \file_get_contents(\base_path('private.pem'));
//            $private_key = "-----BEGIN PRIVATE KEY-----\n" . wordwrap($rsa_private, 64, "\n", true) . "\n-----END PRIVATE KEY-----";
//            $key         = openssl_pkey_get_private($private_key);
            if (!$key) {
                return false;
            }
            $result = openssl_private_decrypt(base64_decode($string), $decrypted, $key);

            if (!$result) {
                return false;
            }
            $data = \json_decode($decrypted, true);

            return \is_null($data) ? $decrypted : $data;

        } catch (\Exception $e) {
            $errorMsg = $e->getMessage() ? $e->getMessage() : 'decode error';
            return false;
        }

    }

    /**
     * RSA私钥加密
     *
     * @param string|array $data $string 待解密数据
     * @return array|bool 返回解密内容
     */
    public function privateEncode(string|array $data): string|bool
    {


        try {
            $key = \file_get_contents(\base_path('private.pem'));

            $pkey = openssl_pkey_get_private($key);//$privateKey为私钥字符串

            $result = openssl_private_encrypt($data, $encryptedData, $pkey);
            $encryptedData = base64_encode($encryptedData);

            if (!$result) {
                return false;
            }

            return $encryptedData;

        } catch (\Exception $e) {
            $errorMsg = $e->getMessage() ? $e->getMessage() : 'decode error';
            return false;
        }

    }


    /**
     * RSA公钥加密
     *
     * @param string $string 待加解密数据
     * @return string 返回加密内容
     */
    public function publicEncode(string $string): string
    {
        try {
            $rsa_public = file_get_contents(\base_path('public.pem'));

            $key = openssl_pkey_get_public($rsa_public);
            $crypto = '';

            if (!$key) {
                throw new \Exception('公钥不可用');
            }
            foreach (str_split($string, 117) as $chunk) {
                $result = openssl_public_encrypt($chunk, $encryptData, $this->pu_key);

                if (!$result) {
                    throw new \Exception('公钥加密失败');
                }

                $crypto .= $encryptData;
            }

            openssl_free_key($key);
            $encrypted = $this->urlsafe_b64encode($crypto);
            return $encrypted;
        } catch (\Exception $e) {
            $errorMsg = $e->getMessage() ? $e->getMessage() : 'encode error';
            return '';
        }


        //openssl_public_encrypt($data,$encrypted,$this->pu_key);//公钥加密


    }

}
