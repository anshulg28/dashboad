<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Log View :: Doolally</title>
	<?php echo $globalStyle; ?>
</head>
<body>
    <?php echo $headerView; ?>
    <main class="logComplaint">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-1 col-xs-0"></div>
                <div class="col-sm-10 col-xs-0">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#open">Open Issues</a></li>
                        <li><a data-toggle="tab" href="#inProgress">In Progress Issues</a></li>
                        <li><a data-toggle="tab" href="#closed">Closed Issues</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="open" class="tab-pane fade in active">
                            <table id="openTab" class="table table-hover table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Problem At</th>
                                    <th>Work Type</th>
                                    <th>Problem</th>
                                    <th>Location</th>
                                    <th>Raised By</th>
                                    <th>Logged Date/Time</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    if(!isset($openComplaints) && !myIsArray($openComplaints))
                                    {
                                        ?>
                                        <tr class="my-danger-text text-center">
                                            <td colspan="8">No Records Found!</td>
                                        </tr>
                                        <?php
                                    }
                                    else
                                    {
                                        foreach($openComplaints as $key => $row)
                                        {
                                            ?>
                                            <tr>
                                                <td scope="row"><?php echo $row['complaintId'];?></td>
                                                <td><?php echo $row['areaName'];?></td>
                                                <td><?php echo $row['typeName'];?></td>
                                                <td><?php echo $row['problemDescription'];?></td>
                                                <td><?php echo $row['locName'];?></td>
                                                <td><?php echo $row['userName'];?></td>
                                                <td><?php $d = date_create($row['loggedDT']); echo date_format($d,DATE_TIME_FORMAT_UI);?></td>
                                                <td>
                                                    <a href="#" data-complaintId="<?php echo $row['complaintId'];?>" class="update-complaint">Update</a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <div id="inProgress" class="tab-pane fade">
                            <table id="progressTab" class="table table-hover table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Problem At</th>
                                    <th>Work Type</th>
                                    <th>Problem</th>
                                    <th>Location</th>
                                    <th>Update</th>
                                    <th>Approx Cost</th>
                                    <th>Assigned To</th>
                                    <th>Update Date/Time</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(!isset($progressComplaints) && !myIsArray($progressComplaints))
                                {
                                    ?>
                                    <tr class="my-danger-text text-center">
                                        <td colspan="10">No Records Found!</td>
                                    </tr>
                                    <?php
                                }
                                else
                                {
                                    foreach($progressComplaints as $key => $row)
                                    {
                                        ?>
                                        <tr>
                                            <td scope="row"><?php echo $row['complaintId'];?></td>
                                            <td><?php echo $row['areaName'];?></td>
                                            <td><?php echo $row['typeName'];?></td>
                                            <td><?php echo $row['problemDescription'];?></td>
                                            <td><?php echo $row['locName'];?></td>
                                            <td><?php echo $row['updateOnComplaint'];?></td>
                                            <td><?php echo $row['approxCost'];?></td>
                                            <td><?php echo $row['workAssignedTo'];?></td>
                                            <td><?php $d = date_create($row['lastUpdateDT']); echo date_format($d,DATE_TIME_FORMAT_UI);?></td>
                                            <td>
                                                <a href="#" data-complaintId="<?php echo $row['complaintId'];?>" class="progress-complaint">Update</a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <div id="closed" class="tab-pane fade">
                            <table id="closeTab" class="table table-hover table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Problem At</th>
                                    <th>Work Type</th>
                                    <th>Problem</th>
                                    <th>Location</th>
                                    <th>Update Date/Time</th>
                                    <th>Approx Cost</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(!isset($closeComplaints) && !myIsArray($closeComplaints))
                                {
                                    ?>
                                    <tr class="my-danger-text text-center">
                                        <td colspan="8">No Records Found!</td>
                                    </tr>
                                    <?php
                                }
                                else
                                {
                                    foreach($closeComplaints as $key => $row)
                                    {
                                        ?>
                                        <tr>
                                            <td scope="row"><?php echo $row['complaintId'];?></td>
                                            <td><?php echo $row['areaName'];?></td>
                                            <td><?php echo $row['typeName'];?></td>
                                            <td><?php echo $row['problemDescription'];?></td>
                                            <td><?php echo $row['locName'];?></td>
                                            <td><?php $d = date_create($row['lastUpdateDT']); echo date_format($d,DATE_TIME_FORMAT_UI);?></td>
                                            <td><?php echo $row['approxCost'];?></td>
                                            <td>
                                                <a href="#" data-complaintId="<?php echo $row['complaintId'];?>" class="details-complaint">Details</a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-sm-1 col-xs-0"></div>
            </div>
        </div>
    </main>

    <!-- Modal -->
    <div id="openCompModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Updating Open Complaint</h4>
                </div>
                <div class="modal-body">
                    <p class="open-complaint-info"></p>
                    <br>
                    <form method="POST" id="moveToProgress" action="<?php echo base_url().'maintenance/updateOpenComplaint';?>">
                        <input type="hidden" name="complaintId" value=""/>
                        <div class="form-group">
                            <label for="updateOnComplaint">Update on Problem:</label>
                            <textarea id="updateOnComplaint" name="updateOnComplaint" rows="10" cols="20" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="approxCost">Approx Cost:</label>
                            <input type="number" id="approxCost" name="approxCost" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label for="workAssignedTo">Work Assigned To:</label>
                            <input type="text" id="workAssignedTo" name="workAssignedTo" class="form-control" required/>
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <?php echo $footerView;?>
</body>
<?php echo $globalJs; ?>

<script>

    $('#openTab, #progressTab, #closeTab').DataTable({
        "ordering": false
    });

    $(document).on('click','.update-complaint', function(){
        var compId = $(this).attr('data-complaintId');
        showCustomLoader();
        $.ajax({
            type:'GET',
            dataType:'json',
            url:base_url+'maintenance/getComplaintInfo/'+compId,
            success: function(data){
                hideCustomLoader();
                var complaintInfo = 'Complaint ID: '+compId+'<br>Location: '+data.locName+'<br>Problem At: '+data.areaName+
                        '<br>Work Type: '+data.typeName+'<br>Raised By: '+data.userName+'<br>Logged Date/Time: '+data.loggedDT+
                        '<br>Problem: '+data.problemDescription;

                $('#openCompModal .open-complaint-info').html(complaintInfo);
                $('#openCompModal #moveToProgress input[name="complaintId"]').val(compId);
                $('#openCompModal').modal('show');
            },
            error:function(xhr, status, error)
            {
                hideCustomLoader();
                bootbox.alert('Some Error Occurred, Try Again!');
                var err = 'Url: '+errUrl+' StatusText: '+xhr.statusText+' Status: '+xhr.status+' resp: '+xhr.responseText;
                saveErrorLog(err);
            }
        });
    });
</script>
</html>