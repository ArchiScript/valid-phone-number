<?php

require_once 'vendor/autoload.php';

use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;

if (isset($_POST['phone'])) {
    $phoneNumber = $_POST['phone'];

    if (preg_match("/^(0{1,2})?/", $phoneNumber)) {
        $phoneNumber = preg_replace("/^(0{1,2})?/", "+", $phoneNumber);
    }

    $phoneUtil = PhoneNumberUtil::getInstance();
    $geocoder  = \libphonenumber\geocoding\PhoneNumberOfflineGeocoder::getInstance();

    $response = "";
    try {

        $numberProto = $phoneUtil->parse($phoneNumber, null);
        $locale = locale_get_default();

        if ($phoneUtil->isValidNumber($numberProto)) {
            $regionCode = $phoneUtil->getRegionCodeForNumber($numberProto);
            $description = $geocoder->getDescriptionForNumber($numberProto, $locale);
            $formattedPhoneNumber = $phoneUtil->format($numberProto, PhoneNumberFormat::NATIONAL);

            $response = ['success' => true,
                'formatted' => 'Форматированный номер (внутри страны): ' . $formattedPhoneNumber, 'location' => ' Локация: ' . $description, 'sign' => ' Знак страны: ' . $regionCode];

        } else {
            $response = ['success' => false,
                'message' => 'Номер телефона не действительный'];

        }

    } catch (\libphonenumber\NumberParseException $e) {
        $response = [
            'success' => false,
            'message' => 'Ошибка при обработке номера телефона: ' . $e->getMessage(),
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}