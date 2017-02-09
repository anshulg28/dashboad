<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0056)file:///C:/Users/user1/Desktop/Emails/welcome-email.html -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>Registration Cancel</title>
</head>

<body>
    <p>
        Dear <?php echo $mailData['firstName'].' '.$mailData['lastName']; ?>,<br><br>

        You have withdrawn from <?php echo $mailData['eventName']; ?>.
        We will inform the organiser that you will not be attending the event. For paid events, the money will be fully refunded to you.<br><br>

        <?php
            if(isset($mailData['refundId']))
            {
                ?>
                Refund Id: <?php echo $mailData['refundId'];?><br>
                <b>
                    <a href="https://www.instamojo.com/resolutioncenter/cases/<?php echo $mailData['refundId'];?>/?from=email"
                       target="_blank">Click here to track Refund status</a>
                </b><br><br>
                <?php
            }
        ?>
        In case you have any questions/queries please don't hesitate to write to me at
        this mail address or you can reach me at <?php echo $mailData['senderPhone'];?><br><br>

        Thanks,<br>
        <?php echo $mailData['senderName'];?>
    </p>

</body>
</html>