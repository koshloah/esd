# esd
Adogtion UI

SMU Project for Enterprise Solution Development

## Requirements
Full running for dog adoption service scenario
PHP Front-End
Tibco Business Work for services hosting and Rabbit MQ for queuing.
SMTP Server
Paypal Sandbox
Telegram Bot 
MySQL Database
WAMP Stack

##Change
Starting the project:
1. Import SQL files into Phpmyadmin
2. Import zipped file into tibco workspace
3. Change HTTP client default host
a. Expand Dog_adogtion_application_2.module [container] > Resources >
Expand Dog_adogtion_application_2.module >HttpClientResource
b. Change Host name to your own swagger host name
c. Repeat for
i. Dog_adogtion_application_2.module >HttpClientResource1
ii. Outcome_notification.module > HttpClientResource
iii. Subscription.module > subsc.module > HttpClientResource
Microservice Resources To Change Dog_Adoption_Application_2
1) HttpClientResource
2) HttpClientResource1
1) Default Host: < your hostname>
Port: 8081
2) Default Host: < your hostname>
Port: 8081
outcome_notification HttpClientResource 1) Default Host: < your hostname>
2) Port: 8082
subscription HttpClientResource 1) Default Host: < your hostname>
2) Port: 8084
4. Change Read File directory
a. Navigate to Subscription_notification.module > Processes > mailtest.module
> Process.bwp
b. Double click Readfile
c. Change the file directory to the subscription_email.txt
5. Set up AMQP exchange
a. Make sure it is running
b. Navigate to localhost:15672
c. Enter guest for both username and password
d. Click on the exchange tab
e. Add outcome_notification_exchange with the following settings
f. Add availability_exchange with the following settings
g. Click the Queues tab
h. Add the following highlighted queues with the basic settings
i. Navigate back to Exchange tab and click on availability_exchange
j. Add binding as shown
k. Navigate back to Exchange tab and click outcome_notification_exchange
l. Bind dog_mgmt_queue and outcome_notification_queue 1 by 1, leave the rest blank
.
Note:

● Ensure WAMP has started if running on Windows Operating Systems (or any
other AMP that are suitable for your Operating System)

● Ensure these 4 sql has been imported into the database:
○ “dogadopt.sql”
○ “doginfo.sql”
○ “outcome_notification.sql”
○ “subscriptions.sql”

● Ensure these 5 microservices are running in Tibco BW:
○ “Dog_Adoption_Application_2”
○ “DogManagement”
○ “outcome_notification”
○ “subscription”
○ “Subscription_notification”

● Open “ home.php ” to access the user services, “ staffhome.php ” to access
the staff services.

● To receive the weekly newsletter subscription through email, please re-run the
Tibco BW microservices. For demonstration purposes, we set the timer to
send the newsletter when the services start instead of waiting for 1 week.

● As TurboSMTP is fully blocked by Gmail and is sometimes blocked by
Outlook, hotmail can be used for testing.
What to change in the codes for the microservices to run:
Go to “ include ” folder > servicesURL.php .

In servicesURL.php, change the Hostname in the URL (highlighted in red below). There
are 12 URLs to change:

// Change this URL to retrieve all adoption applications
[1] $dogAdoptionApplicationURL =
"http:// LAPTOP-LYJK :8080/getalladoptionapplicationsv2";
// Change this URL to create new adoption applications

[2] $newDogAdoptionApplicationURL =
"http:// LAPTOP-LYJK :8080/newadoptionapplication";
// Change this URL to retrieve individual adoption application

[3] $getDogAdoptionApplicationURL = "http:// LAPTOP-LYJK :8080/getadoptionapplication/";
// Change this URL to update (to pending/rejected) individual adoption application

[4] $updateDogAdoptionApplicationURL =
"http:// LAPTOP-LYJK :8080/updateadoptionapplication";
// Change this URL to approve selected adoption application, reject the other
applications made to the same dogID if any

[5] $updateDogAdoptionApplication2URL =
"http:// LAPTOP-LYJK :8080/updatedadoptionapplicationV2";
// Change this URL to retrieve all dogs

[6] $dogManagementServiceURL = "http:// LAPTOP-LYJK :8081/dogs";
// Change this URL to retrieve individual dog

[7] $dogManagementGetDogURL = "http:// LAPTOP-LYJK :8081/dog/";
// Change this URL to update individual dog status

[8] $dogManagementUpdateDogStatusURL = "http:// LAPTOP-LYJK :8081/change_status";
// Change this URL to create outcome notification

[9] $outcomeNotificationServiceURL = "http:// LAPTOP-LYJK :8082/outcome_notification_v2";
// Change this URL to create subscription to receive weekly notification of new dog
updates

[10] $newSubscriptionServiceURL = "http:// LAPTOP-LYJK :8085/subscription";
// paypal redirect when token is successfully retrieved - change to the directory where
the payment.php is stored

[11] $paypalSuccessURL = urlencode(' http://localhost/esd/ payment.php');
// paypal redirect when token is retrieved successfully retrieved - change to the
directory where the logout.php is stored

[12] $paypalUnsuccessfulURL = urlencode(' http://localhost/esd/ logout.php');


##Authors
@josh.lim.2017@smu.edu.sg
@xuesi.sim.2017@sis.smu.edu.sg
@junwei.qiu.2017@sis.smu.edu.sg
@keith.loh.2017@sis.smu.edu.sg
@benjaminng.2017@sis.smu.edu.sg
@lionel.ng.2017@smu.edu.sg

Apr 2019
