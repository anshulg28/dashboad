<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/* Custom constants defined */
defined('PAGE_404')  OR define('PAGE_404', 'page404');
defined('FROM_NAME_EMAIL')  OR define('FROM_NAME_EMAIL', 'Doolally');
defined('RESPONSE_JSON') OR define('RESPONSE_JSON','json');
defined('RESPONSE_RETURN') OR define('RESPONSE_RETURN','return');
defined('DATE_FORMAT_UI')   OR define('DATE_FORMAT_UI', 'jS M, Y');
defined('EVENT_DATE_FORMAT')   OR define('EVENT_DATE_FORMAT', 'D, M j');
defined('EVENT_INSIDE_DATE_FORMAT')   OR define('EVENT_INSIDE_DATE_FORMAT', 'l, F j, Y');
defined('DATE_FORMAT_GRAPH_UI')   OR define('DATE_FORMAT_GRAPH_UI', 'j F');
defined('DATE_MAIL_FORMAT_UI')   OR define('DATE_MAIL_FORMAT_UI', 'jS M Y');
defined('DATE_TIME_FORMAT_UI')   OR define('DATE_TIME_FORMAT_UI', 'D, jS F, Y g:i a');

/* Mail Type */
defined('EXPIRED_MAIL') OR define('EXPIRED_MAIL',1);
defined('EXPIRING_MAIL') OR define('EXPIRING_MAIL',2);
defined('BIRTHDAY_MAIL') OR define('BIRTHDAY_MAIL',3);
defined('CUSTOM_MAIL') OR define('CUSTOM_MAIL',0);

/* User Type */
defined('ROOT_USER') OR define('ROOT_USER',0);
defined('ADMIN_USER') OR define('ADMIN_USER',1);
defined('EXECUTIVE_USER') OR define('EXECUTIVE_USER',2);
defined('SERVER_USER') OR define('SERVER_USER',3);
defined('GUEST_USER') OR define('GUEST_USER',4);
defined('WALLET_USER') OR define('WALLET_USER',5);
defined('OFFERS_USER') OR define('OFFERS_USER',6);
defined('MAINTENANCE_MANAGER') OR define('MAINTENANCE_MANAGER',7);
/*defined('MAINTENANCE_USER') OR define('MAINTENANCE_USER',8);*/
defined('MAINTENANCE_APPROVER1') OR define('MAINTENANCE_APPROVER1',8);
defined('MAINTENANCE_APPROVER2') OR define('MAINTENANCE_APPROVER2',9);
defined('FINANCE_APPROVER') OR define('FINANCE_APPROVER',10);

/* Complaint Log Status */
defined('LOG_STATUS_OPEN') OR define('LOG_STATUS_OPEN',0);
defined('LOG_STATUS_PENDING_APPROVAL') OR define('LOG_STATUS_PENDING_APPROVAL',1);
defined('LOG_STATUS_PENDING_BUDGET_APPROVAL') OR define('LOG_STATUS_PENDING_BUDGET_APPROVAL',2);
defined('LOG_STATUS_IN_PROGRESS') OR define('LOG_STATUS_IN_PROGRESS',3);
defined('LOG_STATUS_PARTIAL_CLOSE') OR define('LOG_STATUS_PARTIAL_CLOSE', 4);
defined('LOG_STATUS_CLOSED') OR define('LOG_STATUS_CLOSED',5);
defined('LOG_STATUS_DECLINED') OR define('LOG_STATUS_DECLINED',6);
defined('LOG_STATUS_POSTPONE') OR define('LOG_STATUS_POSTPONE',7);

/*Active or not*/
defined('ACTIVE')   OR define('ACTIVE', 1);
defined('NOT_ACTIVE')   OR define('NOT_ACTIVE', 0);
defined('EVENT_WAITING')   OR define('EVENT_WAITING', 0);
defined('EVENT_APPROVED')   OR define('EVENT_APPROVED', 1);
defined('EVENT_DECLINED')   OR define('EVENT_DECLINED', 2);

/* API Feeds */
defined('TWITTER_API') OR define('TWITTER_API','https://api.twitter.com/1.1/');
defined('FACEBOOK_API') OR define('FACEBOOK_API','https://graph.facebook.com/v2.7/');
defined('TRIGGER_API') OR define('TRIGGER_API','https://api.atrigger.com/v1/');
defined('TRIGGER_KEY') OR define('TRIGGER_KEY','5442989893688992721');
defined('TRIGGER_SECRET') OR define('TRIGGER_SECRET','1mhXJzK4geoU27VOpRSzkHfEVvWrIt');
defined('CONSUMER_KEY') OR define('CONSUMER_KEY','vsi8yrEMdAaFfjz1vTLMOHnNe');
defined('CONSUMER_SECRET') OR define('CONSUMER_SECRET','T5nSoTaf8rgpXYbWqiLMGSFsdajfHnZ8uXhqz5xyzXgnUaQqbi');
defined('ACCESS_TOKEN') OR define('ACCESS_TOKEN','	15804491-FEtnxy73lcHvViNAdORSVOcH68MCnfiHfpL6hCRn0');
defined('ACCESS_SECRET') OR define('ACCESS_SECRET','3ID1rYVm3mxnYPJMnUKG14p06mc70PzlETrzoP5LeYlop');
defined('BEARER_TOKEN') OR define('BEARER_TOKEN','AAAAAAAAAAAAAAAAAAAAAFhQegAAAAAAePdzbMWF5F%2FfVU5Ph09OIb22dnE%3D7qKzt9ZZQ6IwfUErgznCPq6AcEmIZqYTnKAamzks6ojV72Nobn');
//defined('FACEBOOK_TOKEN') OR define('FACEBOOK_TOKEN','EAAUZBjn6HCmQBAGRccGXJCh7iVjMz7S1G0RdyszbH81ZAndaRZBOWt7S2M4CIPIWm0oplVisZAevWCqALhluARjZBGb2kELD4l6cJAwAuQgh9RtOKECzcPpsDpUe2ZA9uXeIIFUsXiFaquCjcdlZAFYpXmb99DIBzQZD');
defined('FACEBOOK_TOKEN') OR define('FACEBOOK_TOKEN','EAAJCOvplqxQBANyvZAdLMFV7UZCfdRdXnCKwSmMgjEqdmZALZBLjOTIBmecl7PPCwxdek1anJ3Pi6DgcXC8jJGy5xVrFtBGNP15KYoRI1har2XrYQTSyVBTADfBZC0ZCHRbZB0v02lnyNCCmOXO3vllccS1oIfstHgZD');
defined('INSTA_API_KEY') OR define('INSTA_API_KEY','362388bd44886b30aa0d9973d7b99794');
defined('INSTA_AUTH_TOKEN') OR define('INSTA_AUTH_TOKEN','2e8a6cb6ddb931a722e05d2c99dc3888');
defined('GOOGLE_API_KEY') OR define('GOOGLE_API_KEY','AIzaSyBG3wamyMbQqRlqysulunOuPvv3_51BmpI');
defined('BCJUKEBOX_CLIENT') OR define('BCJUKEBOX_CLIENT','UUN5m270I7nxuuBDzukIVtAV0QxL5UQEV1FaYmUg');
defined('TEXTLOCAL_API') OR define('TEXTLOCAL_API','cFIpDcHmYnc-mdteI9XWFa41zNZSq9Z3crlHtQAZCb');
defined('EVENT_HIGH_KEY') OR define('EVENT_HIGH_KEY','D00la11y@ppKey');
defined('EVENT_HIGH_ACCOUNT') OR define('EVENT_HIGH_ACCOUNT','doolally');
defined('MEETUP_KEY') OR define('MEETUP_KEY','165c416c7672a5cc2f1a43292a2817');
defined('MEETUP_GROUP') OR define('MEETUP_GROUP','Mumbai-Craft-Beer-Meetup');
defined('QUIKCHEX_API') OR define('QUIKCHEX_API','https://secure.quikchex.in/data/v1/');
defined('QUIKCHEX_ACCESS_TOKEN') OR define('QUIKCHEX_ACCESS_TOKEN','80bc6de6ba5a51dd55f3f873a2285ff5');



/* Image Paths for Fnb*/
defined('FOOD_PATH_THUMB') OR define('FOOD_PATH_THUMB','uploads/food/thumb/');
defined('FOOD_PATH_NORMAL') OR define('FOOD_PATH_NORMAL','uploads/food/');
defined('BEVERAGE_PATH_THUMB') OR define('BEVERAGE_PATH_THUMB','uploads/beverage/thumb/');
defined('BEVERAGE_PATH_NORMAL') OR define('BEVERAGE_PATH_NORMAL','uploads/beverage/');
defined('EVENT_PATH_THUMB') OR define('EVENT_PATH_THUMB','uploads/events/thumb/');
defined('TWITTER_BOT_PATH') OR define('TWITTER_BOT_PATH','socialimages/twitter/');
defined('JOB_MEDIA_PATH') OR define('JOB_MEDIA_PATH','uploads/jobs/');
defined('ITEM_FOOD') OR define('ITEM_FOOD','1');
defined('ITEM_BEVERAGE') OR define('ITEM_BEVERAGE','2');
defined('MOBILE_URL') OR define('MOBILE_URL','https://mtest.doolally.in/');

/* Event Cost Types */
defined('EVENT_FREE') OR define('EVENT_FREE','1');
defined('EVENT_PAID') OR define('EVENT_PAID','2');
defined('EVENT_PAID_NO_PINT') OR define('EVENT_PAID_NO_PINT','3');
defined('EVENT_DOOLALLY_FEE') OR define('EVENT_DOOLALLY_FEE','4');

defined('DEFAULT_SENDER_EMAIL') OR define('DEFAULT_SENDER_EMAIL','events@brewcraftsindia.com');
defined('DEFAULT_SENDER_PASS') OR define('DEFAULT_SENDER_PASS','doolally123');
defined('DEFAULT_COMM_EMAIL') OR define('DEFAULT_COMM_EMAIL','communitymanager@brewcraftsindia.com');
defined('DEFAULT_COMM_PASS') OR define('DEFAULT_COMM_PASS','Ngks2009');
defined('ADMIN_SENDER_EMAIL') OR define('ADMIN_SENDER_EMAIL','admin@brewcraftsindia.com');
defined('ADMIN_SENDER_PASS') OR define('ADMIN_SENDER_PASS','ngks2009');
defined('DEFAULT_EVENTS_NUMBER') OR define('DEFAULT_EVENTS_NUMBER','7400428099');
defined('MSG91_KEY') OR define('MSG91_KEY','178025AvcGa0FeRZ2X59d628db');

defined('OLD_DOOLALLY_FEE') OR define('OLD_DOOLALLY_FEE','250');
defined('NEW_DOOLALLY_FEE') OR define('NEW_DOOLALLY_FEE','300');
defined('DEFAULT_STAFF_MOB') OR define('DEFAULT_STAFF_MOB','9999999999');
defined('MUG_BLOCK_RANGE') OR define('MUG_BLOCK_RANGE',serialize(array(4,10,12,14)));
defined('EH_GATEWAY_CHARGE') OR define('EH_GATEWAY_CHARGE','5');
defined('DOOLALLY_GATEWAY_CHARGE') OR define('DOOLALLY_GATEWAY_CHARGE','2.24');
defined('DOOLALLY_SECRET_KEY') OR define('DOOLALLY_SECRET_KEY','8r3w3ry_09');
defined('JOB_PRIORITY_HIGH') OR define('JOB_PRIORITY_HIGH',1);
defined('JOB_PRIORITY_MEDIUM') OR define('JOB_PRIORITY_MEDIUM',2);
defined('JOB_PRIORITY_LOW') OR define('JOB_PRIORITY_LOW',3);