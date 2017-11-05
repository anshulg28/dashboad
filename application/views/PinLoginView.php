<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login :: Doolally</title>
	<?php echo $globalStyle; ?>
</head>
<body>
    <?php echo $headerView; ?>
    <main class="loginPage">
        <div class="container-fluid">
            <h1 class="text-center">Other Login</h1>
            <hr>
            <form action="<?php echo base_url();?>login/pinLogin/json" id="pinLogin" method="post" class="form-horizontal" role="form">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="num">Mobile No/Email:</label>
                    <div class="col-sm-10">
                        <input type="text" name="mobNum" class="form-control" id="num" placeholder="Mobile No/Email">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="secKey">Enter Key:</label>
                    <div class="col-sm-10">
                        <input type="text" name="secKey" class="form-control" id="secKey" placeholder="Enter Key">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="pwd">Login Pin:</label>
                    <div class="col-sm-10">
                        <ul class="list-inline loginpin-list">
                            <li>
                                <input class="form-control" oninput="maxLengthCheck(this)" type="number" maxlength="1" name="loginPin1" placeholder="0" />
                            </li>
                            <li>
                                <input class="form-control" oninput="maxLengthCheck(this)" type="number" maxlength="1" name="loginPin2" placeholder="0" />
                            </li>
                            <li>
                                <input class="form-control" oninput="maxLengthCheck(this)" type="number" maxlength="1" name="loginPin3" placeholder="0" />
                            </li>
                            <li>
                                <input class="form-control" oninput="maxLengthCheck(this)" type="number" maxlength="1" name="loginPin4" placeholder="0" />
                            </li>
                            <li>
                                <input class="form-control" oninput="maxLengthCheck(this)" type="number" maxlength="1" name="loginPin5" placeholder="0" />
                            </li>
                            <li>
                                <input class="form-control" oninput="maxLengthCheck(this)" type="number" maxlength="1" name="loginPin6" placeholder="0" />
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
<?php echo $footerView;?>
</body>
<?php echo $globalJs; ?>
<script>
    $(document).on('keyup', 'input[name="loginPin1"]', function(e){
        if($(this).val() != '')
        {
            $('input[name="loginPin2"]').focus();
        }
    });
    $(document).on('keyup', 'input[name="loginPin2"]', function(e){
        if($(this).val() != '')
        {
            $('input[name="loginPin3"]').focus();
        }
        else if(e.keyCode == 8)
        {
            $('input[name="loginPin1"]').val('').focus();
        }
    });
    $(document).on('keyup', 'input[name="loginPin3"]', function(e){
        if($(this).val() != '')
        {
            $('input[name="loginPin4"]').focus();
        }
        else if(e.keyCode == 8)
        {
            $('input[name="loginPin2"]').val('').focus();
        }
    });
    $(document).on('keyup', 'input[name="loginPin4"]', function(e){
        if($(this).val() != '')
        {
            $('input[name="loginPin5"]').focus();
        }
        else if(e.keyCode == 8)
        {
            $('input[name="loginPin3"]').val('').focus();
        }
    });
    $(document).on('keyup', 'input[name="loginPin5"]', function(e){
        if($(this).val() != '')
        {
            $('input[name="loginPin6"]').focus();
        }
        else if(e.keyCode == 8)
        {
            $('input[name="loginPin4"]').val('').focus();
        }
    });
    $(document).on('keyup', 'input[name="loginPin6"]', function(e){
        if($(this).val() != '')
        {
            if($('#num').val() != '' && $('#secKey').val() != '')
            {
                $('#pinLogin').submit();
            }
        }
        else if(e.keyCode == 8)
        {
            $('input[name="loginPin5"]').val('').focus();
        }
    });

    var isReq = false;
    $(document).on('submit','#pinLogin', function(e){
        e.preventDefault();

        if(!isReq)
        {
            isReq = true;
            showCustomLoader();
            $.ajax({
                type:'POST',
                dataType:'json',
                data: $(this).serialize(),
                url:$(this).attr('action'),
                success: function(data){
                    isReq = false;
                    hideCustomLoader();
                    if(data.status=== true)
                    {
                        window.location.href=base_url;
                    }
                    else
                    {
                        bootbox.alert(data.errorMsg);
                    }
                },
                error: function()
                {
                    isReq = false;
                    hideCustomLoader();
                    bootbox.alert('Error Connecting Server!');
                }
            });
        }
    });
</script>
</html>