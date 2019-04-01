<?php

    /* External APIs - Don't have to change this portion */
    // dog facts API
    $dogFactsURL = "https://dog-api.kinduff.com/api/facts";
    // Paypal sandbox API
    $paypalURL = "https://api-3t.sandbox.paypal.com/nvp";
    // Telegram Bot username
    $telegramBotUsername = "@adogtion_notifier_bot";
    // Telegram Bot URL
    $telegramBotURL = "https://telegram.me/adogtion_notifier_bot";
    // Get all subcriptions of Telegram Bot
    $telegramSubscribersURL = "https://api.telegram.org/bot722076439:AAF036CxIcNrjo_W_zpUYVRNA5J1wYtDgXc/getUpdates";
    // Send message to selected subscriber
    $telegramMessageURL = "https://api.telegram.org/bot722076439:AAF036CxIcNrjo_W_zpUYVRNA5J1wYtDgXc/sendMessage";



    /* G1T6 Tibco BW Microservices */
    // retrieve all adoption applications
    $dogAdoptionApplicationURL = "http://LAPTOP-LYJK:8080/getalladoptionapplicationsv2";
    // create new adoption applications
    $newDogAdoptionApplicationURL = "http://LAPTOP-LYJK:8080/newadoptionapplication";
    // retrieve individual adoption application
    $getDogAdoptionApplicationURL = "http://laptop-lyjk:8080/getadoptionapplication/";
    // update (to pending/rejected) individual adoption application
    $updateDogAdoptionApplicationURL = "http://LAPTOP-LYJK:8080/updateadoptionapplication";
    // approve selected adoption application, reject the other applications made to the same dogID if any
    $updateDogAdoptionApplication2URL = "http://LAPTOP-LYJK:8080/updatedadoptionapplicationV2";

    // retrieve all dogs
    $dogManagementServiceURL = "http://LAPTOP-LYJK:8081/dogs";
    // retrieve individual dog 
    $dogManagementGetDogURL = "http://LAPTOP-LYJK:8081/dog/";
    // update individual dog status
    $dogManagementUpdateDogStatusURL = "http://LAPTOP-LYJK:8081/change_status";

    // create outcome notification 
    $outcomeNotificationServiceURL = "http://LAPTOP-LYJK:8082/outcome_notification_v2";

    // create subscription to receive weekly notification of new dog updates 
    $newSubscriptionServiceURL = "http://LAPTOP-LYJK:8085/subscription";

?>