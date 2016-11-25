<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Press Mail :: Doolally</title>
	<?php echo $globalStyle; ?>
</head>
<body>
    <?php echo $headerView; ?>
    <main class="mailPage">
        <div class="container-fluid">
            <div class="row">
                <h2 class="text-center">Send Mail</h2>
                <br>
                <div class="col-sm-1 col-xs-0"></div>
                <div class="col-sm-10 col-xs-12 mail-content text-center">
                    <div class="row">
                        <?php
                        $mailTypes = array();
                        if(!isset($pressMails))
                        {
                            echo 'No Press Mails Found!';
                        }
                        else
                        {
                            ?>
                            <nav class="col-sm-4">
                                <ul class="nav nav-pills nav-stacked text-left custom-mugs-list">
                                    <?php
                                    foreach($pressMails as $key => $row)
                                    {
                                        switch ($row['pressMailType'])
                                        {
                                            case 0:
                                                ?>
                                                <li>
                                                    <label class="my-pointer-item" for="<?php echo $row['id'];?>_press">
                                                        <input type="checkbox" id="<?php echo $row['id'];?>_press" class="mugCheckList"
                                                               data-pressEmail="<?php echo $row['pressEmail'];?>" />
                                                        <?php
                                                        if(isset($row['publication']) && $row['publication'] != '')
                                                        {
                                                            echo $row['publication'].'-'.$row['pressEmail'];
                                                        }
                                                        elseif(isset($row['pressName']) && $row['pressName'] != '')
                                                        {
                                                            echo $row['pressName'].'-'.$row['pressEmail'];
                                                        }
                                                        else
                                                        {
                                                            echo $row['pressEmail'];
                                                        }
                                                        ?>
                                                    </label>
                                                </li>
                                                <?php
                                                break;
                                            case 1:
                                                $mailTypes['food'][] = $row['pressEmail'];
                                                break;
                                            case 2:
                                                $mailTypes['games'][] = $row['pressEmail'];
                                                break;
                                            case 3:
                                                $mailTypes['craft'][] = $row['pressEmail'];
                                                break;
                                            case 4:
                                                $mailTypes['events'][] = $row['pressEmail'];
                                                break;
                                            case 5:
                                                $mailTypes['reviews'][] = $row['pressEmail'];
                                                break;
                                            case 6:
                                                $mailTypes['tech'][] = $row['pressEmail'];
                                                break;
                                            case 7:
                                                $mailTypes['workshops'][] = $row['pressEmail'];
                                                break;
                                            case 8:
                                                $mailTypes['office'][] = $row['pressEmail'];
                                                break;
                                        }
                                    }
                                    ?>
                                </ul>
                                <br>
                                <ul class="nav nav-pills nav-stacked text-left custom-mugs-list">
                                    <?php
                                    foreach($mailTypes as $key => $row)
                                    {
                                        if(myIsArray($row))
                                        {
                                            $combinedEmails = implode(',',$row);
                                            ?>
                                            <li>
                                                <label class="my-pointer-item" for="<?php echo $key;?>_press">
                                                    <input type="checkbox" id="<?php echo $key;?>_press" class="mugCheckList"
                                                           data-pressEmail="<?php echo $combinedEmails;?>" />
                                                    <?php
                                                    echo ucfirst($key);
                                                    ?>
                                                </label>
                                            </li>
                                            <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </nav>
                            <div class="col-sm-8">
                                <form action="<?php echo base_url();?>mailers/sendPressMails/json" id="mainMailerForm" method="post" class="form-horizontal" role="form">
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="toList">To:</label>
                                        <div class="col-sm-10">
                                            <div class="row">
                                                <div class="col-xs-11">
                                                    <textarea class="form-control" name="pressEmails" id="toList" placeholder="Email Id(s) (comma separated)"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <!--<button type="button" class="btn btn-danger col-sm-2 my-marginDown" data-toggle="modal" data-target="#subjectModal" >Select Subject</button>-->
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-10">
                                            <input type="text" name="mailSubject" class="form-control" onfocus="whichHasFocus= 1" id="mailSubject" placeholder="Subject">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <!--<button type="button" class="btn btn-danger col-sm-2 my-marginDown" data-toggle="modal" data-target="#bodyModal" >Select Body</button>-->
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-10">
                                            <textarea name="mailBody" rows="10" class="form-control" onfocus="whichHasFocus= 2" id="mailBody" placeholder="Body"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <!--<button type="button" class="btn btn-danger col-sm-2 my-marginDown" data-toggle="modal" data-target="#bodyModal" >Select Body</button>-->
                                        <label class="control-label col-sm-2" for="attchment">Attachment:</label>
                                        <div class="col-sm-10">
                                            <label class="radio-inline"><input type="radio" name="attachmentType" value="1" checked>Upload</label>
                                            <label class="radio-inline"><input type="radio" name="attachmentType" value="2">URL(Comma separated)</label>
                                            <input type="file" name="attachment" multiple class="form-control" id="attchment" />
                                            <textarea name="attachmentUrls" class="form-control hide" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>

                                <div class="progress hide">
                                    <div class="progress-bar progress-bar-striped active" role="progressbar"
                                         aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                                <div>
                                    <p>Available Tags:</p>
                                    <div class="col-sm-2"></div>
                                    <ul class="col-sm-10 list-inline mugtags-list">
                                        <li class="my-pointer-item"><span class="label label-success">[name]</span></li>
                                    </ul>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="col-sm-1 col-xs-0"></div>
            </div>
        </div>
    </main>
    <?php echo $footerView; ?>
</body>
<?php echo $globalJs; ?>

<script>
    CKEDITOR.replace( 'mailBody' );
    var whichHasFocus = 0;
    $(document).on('change','input[name="attachmentType"]',function(){
        if($(this).val() == '1')
        {
            $('input[name="attachment"]').removeClass('hide');
            $('textarea[name="attachmentUrls"]').addClass('hide');
        }
        else
        {
            $('input[name="attachment"]').addClass('hide');
            $('textarea[name="attachmentUrls"]').removeClass('hide');
        }
    });
    //var xhr;
    var filesArr = [];
    $(document).on('change','input[name=attachment]', function(e){

        var totalSize = 0;
        var fileSizeExceed = false;
        for(var f=0;f<this.files.length;f++)
        {
            totalSize += this.files[f].size;
            if(this.files[f].size/(1000*1000) >= 10 )
            {
                fileSizeExceed = true;
                bootbox.alert('<span class="my-danger-text">File: '+this.files[f].name+' size is more than 10mb!</span>');
                return false;
            }
        }
        if(fileSizeExceed === true)
        {
            return false;
        }
        else if((totalSize/(1000*1000)) >= 25)
        {
            bootbox.alert('<span class="my-danger-text">Upload Limit 25Mb Reached!</span>');
            return false;
        }


        $('button[type="submit"]').attr('disabled','true');
        $('.progress').removeClass('hide');
        var xhr = [];
        var totalFiles = this.files.length;
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
            xhr[i].open('post', '<?php echo base_url();?>mailers/uploadFiles', true);

            var data = new FormData;
            data.append('attachment', this.files[i]);
            xhr[i].send(data);
            xhr[i].onreadystatechange = function(e) {
                if (e.srcElement.readyState == 4 && e.srcElement.status == 200) {
                    filesArr.push(e.srcElement.responseText);
                }
            }
        }
    });

    $(document).on('submit','#mainMailerForm',function(e){
        e.preventDefault();
        if($('textarea[name="pressEmails"]').val() == '')
        {
            bootbox.alert('Email(s) Are Required!',function(){
                $('textarea[name="pressEmails"]').focus();
            });
            return false;
        }

        if($('input[name="mailSubject"]').val() == '')
        {
            bootbox.alert('Subject is Required!',function(){
                $('input[name="mailSubject"]').focus();
            });
            return false;
        }
        if($('textarea[name="mailBody"]').val() == '')
        {
            bootbox.alert('Body is Required!',function(){
                $('textarea[name="mailBody"]').focus();
            });
            return false;
        }

        //showCustomLoader();
        var m_data = new FormData();
        m_data.append( 'pressEmails', $('textarea[name=pressEmails]').val());
        m_data.append( 'mailSubject', $('input[name=mailSubject]').val());
        m_data.append( 'mailBody', $('textarea[name=mailBody]').val());
        if(filesArr.length != 0)
        {
            m_data.append( 'attachment', filesArr.join());
        }
        else
        {
            m_data.append( 'attachmentUrls', $('textarea[name=attachmentUrls]').val());
        }
        showCustomLoader();
        $.ajax({
            type:"POST",
            url:$(this).attr('action'),
            contentType: false,
            processData: false,
            dataType:"json",
            data:m_data,
            success: function(data){

                hideCustomLoader();
                if(data.status === true)
                {
                    bootbox.alert('Mail Send Successfully', function(){
                        window.location.href=base_url+'mailers';
                    });
                }
                else
                {
                    if(typeof data.fileName != 'undefined')
                    {
                        bootbox.alert('<span class="my-danger-text">'+data.errorMsg+', File Name: '+data.fileName+'</span>');
                    }
                    else
                    {
                        bootbox.alert('<span class="my-danger-text">'+data.errorMsg+'</span>');
                    }
                }
            },
            error: function(){
                hideCustomLoader();
                bootbox.alert('<span class="my-danger-text">Some Error occurred</span>');
            }
        });

    });

    $(document).on('change', '.mugCheckList', function(){
        var emails= '';
        $('.mugCheckList:checked').each(function(i,val){
            emails += $(val).attr('data-pressEmail').trim();
            if(i != $('.mugCheckList:checked').length-1)
            {
                emails += ',';
            }
        });
        $('.mailPage #toList').empty().append(emails);
    });

    $(document).on('click','.mugtags-list li', function(){
        var mugTag = $(this).find('span').html();

        if(whichHasFocus == 1)
        {
            $('input[name="mailSubject"]').val($('input[name="mailSubject"]').val()+mugTag);
        }
        else if(whichHasFocus == 2)
        {
            $('textarea[name="mailBody"]').append(mugTag);
        }

    });
</script>

</html>l