<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Mug Renew :: Doolally</title>
	<?php echo $globalStyle; ?>
</head>
<body>
    <?php echo $headerView; ?>
    <main class="locationsAdd">
        <div class="container">
            <div class="row">
                <h2><i class="fa fa-beer"></i> Renew Mug #<?php echo $mugId; ?></h2>
                <hr>
                <br>
                <form action="<?php echo base_url();?>mugclub/mugRenew/return" method="post" class="form-horizontal" role="form">
                    <input type="hidden" value="<?php echo $mugId;?>" name="mugId"/>
                    <!--<div class="form-group">
                        <label class="control-label col-sm-2" for="memEnd">Membership End Date :</label>
                        <div class="col-sm-10">
                            <input type="date" name="membershipEnd" class="form-control"
                                    id="memEnd" value="<?php /*echo $mugInfo['mugList'][0]['membershipEnd'];*/?>"/>
                        </div>
                    </div>-->
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="invoNum">Invoice Number :</label>
                        <div class="col-sm-10">
                            <input type="text" name="invoiceNo" class="form-control"
                                   id="invoNum" placeholder="Eg: 0000" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
<?php echo $globalJs; ?>

</html>