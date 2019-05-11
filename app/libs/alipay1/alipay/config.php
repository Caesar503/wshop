<?php
$config = array (	
		//应用ID,您的APPID。
		'app_id' => "2016092600600354",

		//商户私钥，您的原始格式RSA私钥
		'merchant_private_key' => "MIIEvwIBADANBgkqhkiG9w0BAQEFAASCBKkwggSlAgEAAoIBAQDZ271PcybI8QVf/UhSSF/uGsJTeUVYdYJWi1DaQRnhDGufEscThGuyMDaF7kHGf3NUQym3y/QLdIRSmWskz7wtqk+k6kDAELS/lJKjdBV76/lsucvxrccrLlJ7ovTNArh24x4d/EHzcInG0xmmuOQ2AzckZws0feeZoKnxHHRvqm39gyBg7ixSmbfOE3LHRKvQ5QU0sZZ5G+2dGUghr5L4SBorEWIoUVGBrEHkSIHfNd1QgL5eYrn9/sL2l3LmN/JfcqbuwSlDJqVCnuW7FKV9w1e6cP0Dk5atafbjdRZyZpKERRjHBBlGcFT9DK34hjtRIyoNeBR1a0DYm8+6/3ihAgMBAAECggEBANB3rNdx4RM3T2VjAOl7yBAYGwu1Z94V0/rspRm0Ygcv02wMk+LhPAzuhb3zF43SN5HSEwGFcKnlfRltJVG8Vt17s2qjngIr+km46fjvA//o9mxL/hPtrkBruxIEBSyIBev9uLwIvzMr5SsUpd8b3YSx3vo+gEJimFQxoWzPRbvzHLAGyuZ4nVcR7faN5E7OUNCypLT0P9dp980W89CxD62J15CMOfrxcU8euj2MkrLEijIwIu7ZgWEL4eqSt/U7L0MZMecMKBKyCazESsmIUGO+7GEYKALl5besSL3mDfm2XW31mogZJIi+qw/o8UNOmXGRVY6o0aSLcgO3u7SvzoECgYEA/wG4ktf/5hTHDbeHvE/Xetz/uFZwD4f9fRaQaDnoJH9pqzEYqmRM7B+9sSaSlIKjUGRiJW+yn8GAFu/K+aZ5bo9MDJ+EpD46oNBI5PO8mPkaa47jNM3gqP5ZFDHL79VYRs6Wyv0quWTlKMdw76yBZJcEKQJJtCVNwy5cHaUqwTUCgYEA2rT55Na9E7jYfVAjKlCvMWn4WZsskwKVSEuxAbUCgcc9cfid/Flo9oJLiPOAf7vm6p8BnAn4ohzUF1gxu71ECC4J2BA3Q/AksUYHRK6TvQvty86HDNfArLS1HfU7xBZszyuHRsbMCA7b2miq/U7cUw1rGVc2vDidJ2NXxDEmkz0CgYB5YH5UFs/M2fLtCoBnF7G+31YwjaQFIHt9gLH3iih+xs6rF1FgOSGL+oe1vGBko9HMQBufKg1hkR7AzB5WufBuuXI/R+ZArwYE6V7o60LHpTn4HCj1R1E53ubTf+hMHcZI3ahUsjAV0npo8JVG31svX9oxEs+2GVNsJbLewXEaSQKBgQC6RDgwddNC4MNAtue8Okt7Qk2Jw2cLLcAGerCeS5N/BDmIv72OFngWupGqafie0WGxoQq14qgnKXZZC3wP8PnoHY20vtrSucwGTyYRkL2y3F4CnjrW7UnjzWQTx7DHKHIzX1cvKFDM7BrCwTIf2vI6qcr1Ihoz4+O0kB9HsLSx4QKBgQCoGYJShIoiuyVXIl5ueqCFykOO1WAOGX1Nz8V1HjnNMRtHjwkQC7g1dN52vBp5PqrBEP8aK/2ouMKCYGEsikwPUArJLU/DiAyvw5zu96MLLWPEShOwT493AOPfzYLncXVAuaQBnJmZlXKSPB55TiyqHZy07JuTN3Fh66rTmhDyuw==",
		
		//异步通知地址
		'notify_url' => "http://工程公网访问地址/alipay.trade.wap.pay-PHP-UTF-8/notify_url.php",
		
		//同步跳转
		'return_url' => "http://mitsein.com/alipay.trade.wap.pay-PHP-UTF-8/return_url.php",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA2du9T3MmyPEFX/1IUkhf7hrCU3lFWHWCVotQ2kEZ4QxrnxLHE4RrsjA2he5Bxn9zVEMpt8v0C3SEUplrJM+8LapPpOpAwBC0v5SSo3QVe+v5bLnL8a3HKy5Se6L0zQK4duMeHfxB83CJxtMZprjkNgM3JGcLNH3nmaCp8Rx0b6pt/YMgYO4sUpm3zhNyx0Sr0OUFNLGWeRvtnRlIIa+S+EgaKxFiKFFRgaxB5EiB3zXdUIC+XmK5/f7C9pdy5jfyX3Km7sEpQyalQp7luxSlfcNXunD9A5OWrWn243UWcmaShEUYxwQZRnBU/Qyt+IY7USMqDXgUdWtA2JvPuv94oQIDAQAB",
		
	
);