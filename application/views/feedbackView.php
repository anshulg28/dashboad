<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>404, Page Not Found</title>
</head>
<body>

<div id="container">
	<input type="number" id="orderNum"/>
</div>
<?php echo $globalJs; ?>
<script>
    var insertId = '';
    $(document).on('focusout','#orderNum',function(){
        $.ajax({
            type:'POST',
            dataType:'json',
            url:base_url+'quiz/saveOrder',
            data:{oNum: $('#orderNum'),loc: 1}
            success: function(data){
                if(data.status === true)
                {
                    insertId = data.insertId;
                    setTimeout(function(){
                        checkOrder();
                    },500);
                }
            },
            error: function(){
                console.log('error');
            }
        });
    });

    function checkOrder()
    {
        $.ajax({
            type:'GET',
            dataType:'json',
            url: base_url+'quiz/getOrderStatus/'+insertId,
            success:function(data){
                if(data.oStatus == '1')
                {
                    alert('Found');
                }
                else if(data.oStatus == '2')
                {
                    alert('Invalid order #');
                }
                else
                {
                    checkOrder();
                }
            },
            error: function(){
                console.log('error');
            }
        });
    }
</script>
</body>
</html>