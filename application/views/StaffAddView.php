<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Doolally Staff Add</title>
	<?php echo $globalStyle; ?>
</head>
<body>
    <?php echo $headerView; ?>
<main class="editStaff">
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--2-col"></div>
        <div class="mdl-cell mdl-cell--8-col text-center">
            <a href="<?php echo base_url().'empDetails';?>" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                <i class="fa fa-chevron-left"></i> Go Back
            </a>
            <h3>Add Employee</h3>
            <form action="<?php echo base_url();?>saveStaff" method="post">
                <div class="error-dup"></div>
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label my-fullWidth">
                            <input class="mdl-textfield__input" type="text" name="empId" id="empId" required>
                            <label class="mdl-textfield__label" for="empId">Employee Id</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label my-fullWidth">
                            <input class="mdl-textfield__input" type="text" name="firstName" id="firstName" required>
                            <label class="mdl-textfield__label" for="firstName">First Name</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label my-fullWidth">
                            <input class="mdl-textfield__input" type="text" name="middleName" id="middleName" >
                            <label class="mdl-textfield__label" for="middleName">Middle Name</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label my-fullWidth">
                            <input class="mdl-textfield__input" type="text" name="lastName" id="lastName" >
                            <label class="mdl-textfield__label" for="lastName">Last Name</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label my-fullWidth">
                            <input class="mdl-textfield__input" type="number" name="walletBalance" id="walletBalance" value="1500" required>
                            <label class="mdl-textfield__label" for="walletBalance">Wallet Balance</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label my-fullWidth">
                            <input class="mdl-textfield__input" type="number" name="mobNum" id="mobNum">
                            <label class="mdl-textfield__label" for="mobNum">Mobile Number</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--12-col">
                        <label for="recurringFreq">Recurring Frequency</label>
                        <select id="recurringFreq" class="form-control" name="recurringFrequency">
                            <option value="monthly" selected>Monthly</option>
                            <option value="quarterly">Quarterly</option>
                            <option value="yearly">Yearly</option>
                        </select>
                    </div>

                    <div class="mdl-cell mdl-cell--6-col">
                        <label>Recurring?</label>
                        <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="isRecYes">
                            <input type="radio" id="isRecYes" class="mdl-radio__button" name="isRecurring" value="1" checked>
                            <span class="mdl-radio__label">Yes</span>
                        </label>
                        <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="isRecNo">
                            <input type="radio" id="isRecNo" class="mdl-radio__button" name="isRecurring" value="2">
                            <span class="mdl-radio__label">No</span>
                        </label>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label my-fullWidth">
                            <input class="mdl-textfield__input" type="number" name="recurringAmt" id="recurringAmt"
                            value="1500">
                            <label class="mdl-textfield__label" for="recurringAmt">Recurring Amount</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <label>Capping?</label>
                        <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="isCapYes">
                            <input type="radio" id="isCapYes" class="mdl-radio__button" name="isCapping" value="1" checked>
                            <span class="mdl-radio__label">Yes</span>
                        </label>
                        <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="isCapNo">
                            <input type="radio" id="isCapNo" class="mdl-radio__button" name="isCapping" value="2">
                            <span class="mdl-radio__label">No</span>
                        </label>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label my-fullWidth">
                            <input class="mdl-textfield__input" type="number" name="cappingAmt" id="cappingAmt"
                                   value="6000">
                            <label class="mdl-textfield__label" for="cappingAmt">Capping Amount</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Submit</button>
            </form>
        </div>
        <div class="mdl-cell mdl-cell--2-col"></div>
    </div>
</main>
</body>
<?php echo $globalJs; ?>

<script>
    $(document).on('focusout','#empId', function(){
        if($(this).val() != '')
        {
            var empId = $(this).val();

            $.ajax({
                type:'POST',
                dataType:'json',
                url:base_url+'home/checkEmpId',
                data: {empId:empId},
                success: function(data){
                    if(data.status == true)
                    {
                        $('.error-dup').css('color','green').html('Employee Id Available!');
                        $('button[type="submit"]').removeAttr('disabled');
                    }
                    else
                    {
                        $('.error-dup').css('color','red').html('Employee Already Exists!');
                        $('button[type="submit"]').attr('disabled','disabled');
                    }
                },
                error: function(){

                }
            });
        }
    });
</script>
</html>