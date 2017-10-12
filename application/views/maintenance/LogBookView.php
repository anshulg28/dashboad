<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Log Complaint :: Doolally</title>
	<?php echo $globalStyle; ?>
</head>
<body>
    <?php echo $headerView; ?>
    <main class="logComplaint">
        <form method="POST" id="complaintForm" action="<?php echo base_url().'maintenance/saveComplaint';?>">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-1"></div>
                    <div class="col-xs-10">
                        <div class="form-group">
                            <label>Complaint ID: <?php echo $logId;?></label>
                        </div>
                        <div class="form-group">
                            <label for="locId">Taproom:</label>
                            <select id="locId" name="locId" class="form-control" required>
                                <?php
                                foreach($taprooms as $key => $row)
                                {
                                    ?>
                                    <option value="<?php echo $row['id'];?>"><?php echo $row['locName'];?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="workAreaId">Work Area:</label>
                            <select id="workAreaId" name="workAreaId" class="form-control" required>
                                <?php
                                foreach($workAreas as $key => $row)
                                {
                                    ?>
                                    <option value="<?php echo $row['areaId'];?>"><?php echo $row['areaName'];?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="workTypeId">Work Type:</label>
                            <select id="workTypeId" name="workTypeId" class="form-control" required>
                                <?php
                                foreach($workTypes as $key => $row)
                                {
                                    ?>
                                    <option value="<?php echo $row['typeId'];?>"><?php echo $row['typeName'];?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="problemDescription">Problem Description:</label>
                            <textarea id="problemDescription" name="problemDescription" rows="10" cols="20" class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <div class="col-xs-1"></div>
                </div>
            </div>
        </form>
    </main>
</body>
<?php echo $globalJs; ?>

</html>