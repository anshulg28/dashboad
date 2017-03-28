<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0056)file:///C:/Users/user1/Desktop/Emails/welcome-email.html -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>Event Decline</title>
</head>

<body>
    <p>Dear <?php echo trim($mailData[0]['creatorName']); ?>,</p>
    <p>
        Sorry, your event has not been approved. Please read our guidelines once again while creating event<br><br>
        You can try creating another event here..<a href="<?php echo MOBILE_URL.'?page/create_event';?>" target="_blank">Create an event</a><br><br>

        In case you have any questions/queries please don't hesitate to write to me at this mail address or you can reach me at
        <?php echo $mailData['senderPhone'] .' ('.ucfirst($mailData['senderName']).')';?><br><br>

        Cheers!<br>
        <?php echo ucfirst($mailData['senderName']); ?>
    </p>

</body>
</html>