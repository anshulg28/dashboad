<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Event Edit :: Doolally</title>
	<?php echo $globalStyle; ?>
</head>
<body>
    <?php echo $headerView; ?>
    <main class="eventEdit">
        <div class="container">
            <div class="row">
                <a href="<?php echo base_url().'dashboard';?>" class="btn btn-warning"><i class="fa fa-arrow-circle-o-left"></i> Go Back</a>
                <?php
                    if(isset($eventInfo) && myIsArray($eventInfo))
                    {
                        $eventDate = '';
                        foreach($eventInfo as $key => $row)
                        {
                            if(isset($row['eventData']['eventId']))
                            {
                                ?>
                                <h2><i class="fa fa-calendar fa-1x"></i> Edit Event: <?php echo $row['eventData']['eventName'];?></h2>
                                <hr>
                                <br>
                                <form action="<?php echo base_url();?>dashboard/updateEvent" method="post" class="form-horizontal" role="form">
                                    <input type="hidden" name="eventId" value="<?php echo $row['eventData']['eventId'];?>"/>
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label my-fullWidth">
                                        <input class="mdl-textfield__input" type="text" name="eventName"
                                               id="eventName" value="<?php echo $row['eventData']['eventName'];?>">
                                        <label class="mdl-textfield__label" for="eventName">Event Name</label>
                                    </div>
                                    <br>
                                    <div class="text-left">
                                        <label for="eventType">Event Type :</label>
                                        <select name="eventType" id="eventType" class="form-control">
                                            <?php
                                            $foundType = false;
                                            foreach($this->config->item('eventTypes') as $evekey => $everow)
                                            {
                                                ?>
                                                <option value="<?php echo $everow;?>"
                                                <?php if($row['eventData']['eventType'] == $everow){$foundType = true;echo 'selected';};?>><?php echo $everow;?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <div class="mdl-textfield mdl-js-textfield other-event hide">
                                            <input class="mdl-textfield__input" type="text"
                                                   id="otherType" <?php if($foundType == false){echo 'value="'.$row['eventData']['eventType'].'"';}?>>
                                            <label class="mdl-textfield__label" for="otherType">Other</label>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label my-fullWidth text-left">
                                        <label for="eventDescription">Event Description: </label>
                                        <textarea class="mdl-textfield__input my-singleBorder" type="text" name="eventDescription" rows="5"
                                                  id="eventDescription"><?php echo strip_tags($row['eventData']['eventDescription']);?></textarea>
                                    </div>
                                    <ul class="list-inline text-left">
                                        <li>
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                <input class="mdl-textfield__input" type="text" name="eventDate"
                                                       id="eventDate" placeholder="">
                                                <label class="mdl-textfield__label" for="eventDate">Event Date(old: <?php echo $row['eventData']['eventDate'];?>)</label>
                                                <?php
                                                $eventDate = $row['eventData']['eventDate'];
                                                ?>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                <input class="mdl-textfield__input" type="text" name="startTime"
                                                       id="startTime" placeholder="" value="<?php echo $row['eventData']['startTime'];?>">
                                                <label class="mdl-textfield__label" for="startTime">Start Time</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                <input class="mdl-textfield__input" type="text" name="endTime"
                                                       id="endTime" placeholder="" value="<?php echo $row['eventData']['endTime'];?>">
                                                <label class="mdl-textfield__label" for="endTime">End Time</label>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="text-left">
                                        <label>Event Cost :</label>
                                        <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="freeType">
                                            <input type="radio" id="freeType" class="mdl-radio__button" name="costType"
                                                   value="1" <?php if($row['eventData']['costType'] == "1"){echo 'checked';}?>>
                                            <span class="mdl-radio__label">Free</span>
                                        </label>
                                        <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="paidType">
                                            <input type="radio" id="paidType" class="mdl-radio__button" name="costType"
                                                   value="2" <?php if($row['eventData']['costType'] == "2"){echo 'checked';}?>>
                                            <span class="mdl-radio__label">Paid</span>
                                        </label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label event-price hide">
                                            <input class="mdl-textfield__input" type="text" name="eventPrice" pattern="-?[0-9]*(\.[0-9]+)?"
                                                   id="eventPrice" value="<?php echo $row['eventData']['eventPrice'];?>">
                                            <label class="mdl-textfield__label" for="eventPrice">Price</label>
                                            <span class="mdl-textfield__error">Input is not a number!</span>
                                        </div>
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label special-offer hide">
                                            <input class="mdl-textfield__input" type="text" name="priceFreeStuff" id="priceFreeStuff"
                                                   placeholder="" value="<?php echo $row['eventData']['priceFreeStuff'];?>">
                                            <label class="mdl-textfield__label" for="priceFreeStuff">Special Offer With Price?</label>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="text-left">
                                        <label>Event Place: </label>
                                        <select id="eventPlace" name="eventPlace" class="form-control">
                                            <?php
                                            if(isset($locations))
                                            {
                                                foreach($locations as $lockey => $locrow)
                                                {
                                                    if(isset($locrow['id']))
                                                    {
                                                        ?>
                                                        <option value="<?php echo $locrow['id'];?>"
                                                        <?php if($locrow['id'] == $row['eventData']['eventPlace']){echo 'selected';}?>><?php echo $locrow['locName'];?></option>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <br>
                                    <div class="text-left">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                            <input class="mdl-textfield__input" type="text" name="eventCapacity" id="eventCapacity"
                                                   placeholder="" value="<?php echo $row['eventData']['eventCapacity'];?>">
                                            <label class="mdl-textfield__label" for="eventCapacity">Event Capacity</label>
                                        </div>
                                        <br>
                                        <label><input type="checkbox" value="1"
                                                      name="ifMicRequired" <?php if($row['eventData']['ifMicRequired'] == "1"){echo 'checked';}?>>Do you need a mic?</label>
                                        <label><input type="checkbox" value="2"
                                                      name="ifProjectorRequired" <?php if($row['eventData']['ifProjectorRequired'] == "1"){echo 'checked';}?>>Do you need a projector?</label>
                                    </div>
                                    <br>
                                    <div class="text-left">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                            <input class="mdl-textfield__input" type="text" name="creatorName" id="creatorName"
                                                   placeholder="" value="<?php echo $row['eventData']['creatorName'];?>">
                                            <label class="mdl-textfield__label" for="creatorName">Organizer Name</label>
                                        </div>
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                            <input class="mdl-textfield__input" type="number" name="creatorPhone" id="creatorPhone"
                                                   placeholder="" value="<?php echo $row['eventData']['creatorPhone'];?>">
                                            <label class="mdl-textfield__label" for="creatorPhone">Organizer Phone</label>
                                        </div>
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                            <input class="mdl-textfield__input" type="email" name="creatorEmail" id="creatorEmail"
                                                   placeholder="" value="<?php echo $row['eventData']['creatorEmail'];?>">
                                            <label class="mdl-textfield__label" for="creatorEmail">Organizer Email</label>
                                        </div>
                                        <br>
                                        <label for="eventDescription">Organizer Description: </label>
                                        <textarea class="mdl-textfield__input my-singleBorder" type="text" name="aboutCreator" rows="5"
                                                  id="aboutCreator"><?php echo $row['eventData']['aboutCreator'];?></textarea>
                                    </div>
                                    <br>
                                    <?php
                                        if(isset($row['eventAtt']) && myIsMultiArray($row['eventAtt']))
                                        {
                                            ?>
                                            <div class="text-left">
                                                <?php
                                                    foreach($row['eventAtt'] as $imgkey => $imgrow)
                                                    {
                                                        ?>
                                                        <div class="pics-preview-panel col-sm-2 col-xs-5">
                                                            <img src="<?php echo base_url().EVENT_PATH_THUMB.$imgrow['filename'];?>"
                                                                 class="img-thumbnail"/>
                                                            <i class="fa fa-times img-remove-icon" data-picId="<?php echo $imgrow['id'];?>"></i>
                                                        </div>
                                                        <?php
                                                    }
                                                ?>
                                            </div>
                                            <?php
                                        }
                                    ?>
                                    <div class="myUploadPanel text-left">
                                        <input type="file" multiple class="form-control" onchange="eventUploadChange(this)" />
                                        <input type="hidden" name="attachment" />
                                    </div>
                                    <br>
                                    <button onclick="fillEventImgs()" type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Submit</button>
                                    <br><br>
                                    <div class="progress hide">
                                        <div class="progress-bar progress-bar-striped active" role="progressbar"
                                             aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </form>
                                <?php
                            }
                        }
                    }
                    else
                    {
                        echo '<h2 class="my-danger-text text-center>Mug Number Not Found!</h2>"';
                    }
                ?>
            </div>
        </div>
    </main>
</body>
<?php echo $globalJs; ?>

<script>
    $(document).on('click','.img-remove-icon', function(){
        var picId = $(this).attr('data-picId');
        var parent = $(this).parent();
        bootbox.confirm("Remove Image?", function(result) {
            if(result === true)
            {
                $.ajax({
                    type:"POST",
                    dataType:"json",
                    url:"<?php echo base_url();?>dashboard/deleteEventAtt",
                    data:{picId:picId},
                    success: function(data)
                    {
                        if(data.status === true)
                        {
                            $(parent).fadeOut();
                        }
                    },
                    error: function(){
                        bootbox.alert('Some Error Occurred!');
                    }
                });
            }
        });
    });
    function fillEventImgs()
    {
        $('input[name="attachment"]').val(filesEventsArr.join());
    }
    var filesEventsArr = [];
    function eventUploadChange(ele)
    {

        $('button[type="submit"]').attr('disabled','true');
        $('.progress').removeClass('hide');
        var xhr = [];
        var totalFiles = ele.files.length;
        for(var i=0;i<totalFiles;i++)
        {
            xhr[i] = new XMLHttpRequest();
            (xhr[i].upload || xhr[i]).addEventListener('progress', function(e) {
                var done = e.position || e.loaded;
                var total = e.totalSize || e.total;
                $('.progress-bar').css('width', Math.round(done/total*100)+'%').attr('aria-valuenow', Math.round(done/total*100)).html(parseInt(Math.round(done/total*100))+'%');
            });
            xhr[i].addEventListener('load', function(e) {
                $('button[type="submit"]').removeAttr('disabled');
            });
            xhr[i].open('post', '<?php echo base_url();?>dashboard/uploadEventFiles', true);

            var data = new FormData;
            data.append('attachment', ele.files[i]);
            xhr[i].send(data);
            xhr[i].onreadystatechange = function(e) {
                if (e.srcElement.readyState == 4 && e.srcElement.status == 200) {
                    if(e.srcElement.responseText == 'Some Error Occurred!')
                    {
                        bootbox.alert('File size Limit 30MB');
                        return false;
                    }
                    filesEventsArr.push(e.srcElement.responseText);
                }
            }
        }
    }
    var date = new Date();
    <?php
        if(isset($eventDate) && $eventDate != '')
        {
            ?>
    $('#eventDate').datetimepicker({
        format: 'YYYY-MM-DD',
        useCurrent: false,
        minDate: date
    });
    $('#eventDate').val('<?php echo $eventDate;?>');
            <?php
        }
        else
        {
            ?>
    $('#eventDate').datetimepicker({
        format: 'YYYY-MM-DD',
        minDate: date
    });
            <?php
        }
    ?>
    $('#startTime, #endTime').datetimepicker({
        format: 'HH:mm'
    });
    $(document).on('change','#eventType', function(){
        if($(this).find('option:checked').val() != 'Others')
        {
            $(this).attr('name','eventType');
            $('.other-event').addClass('hide');
            $('.other-event input').removeAttr('name');
        }
        else
        {
            $(this).removeAttr('name');
            $('.other-event').removeClass('hide');
            $('.other-event input').attr('name','eventType');
        }
    });

    $(document).on('change','input[name="costType"]', function(){
        costToggle();
    });

    function costToggle()
    {
        if($('input[name="costType"]:checked').val() == "2")
        {
            $('.event-price').removeClass('hide');
            $('.special-offer').removeClass('hide');
        }
        else
        {
            $('.event-price').addClass('hide');
            $('.special-offer').addClass('hide');
        }
    }
    $(window).load(function(){
        costToggle();
    });
</script>

</html>