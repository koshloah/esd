<?php

    /* External APIs */
    // dog facts API
    $dogFactsURL = "https://dog-api.kinduff.com/api/facts";
    // Paypal sandbox API
    $paypalURL = "https://api-3t.sandbox.paypal.com/nvp";
    // Telegram Bot username
    $telegramBotUsername = "@Outcome_notification_bot";
    // Telegram Bot URL
    $telegramBotURL = "https://telegram.me/Outcome_notification_bot";
    // Get all subcriptions of Telegram Bot
    $telegramSubscribersURL = "https://api.telegram.org/bot875776528:AAEpUJaLS8FhzpehL8JLlTCmgsghhUgTOic/getUpdates";
    // Send message to selected subscriber
    $telegramMessageURL = "https://api.telegram.org/bot875776528:AAEpUJaLS8FhzpehL8JLlTCmgsghhUgTOic/sendMessage";

    /* G1T6 Tibco BW Microservices */
    // retrieve all dogs
    $dogManagementServiceURL = "http://LAPTOP-LYJK:8080/dogs";
    // retrieve individual dog 
    $dogManagementGetDogURL = "http://LAPTOP-LYJK:8080/dog/";

    // retrieve all adoption applications
    $dogAdoptionApplicationURL = "http://LAPTOP-LYJK:8081/getalladoptionapplications";
    // create new adoption applications
    $newDogAdoptionApplicationURL = "http://LAPTOP-LYJK:8081/newadoptionapplication";
    // retrieve individual adoption application
    $getDogAdoptionApplicationURL = "http://laptop-lyjk:8081/getadoptionapplication/";
    // update individual adoption application
    $updateDogAdoptionApplicationURL = "http://LAPTOP-LYJK:8081/updateadoptionapplication";

?>