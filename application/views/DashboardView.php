<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Dashboard :: Doolally</title>
	<?php echo $globalStyle; ?>
</head>
<body class="dashboard">
    <?php echo $headerView; ?>
    <!-- No header, and the drawer stays open on larger screens (fixed drawer). -->
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer">
        <div class="mdl-layout__drawer">
            <span class="mdl-layout-title">Dashboard</span>
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a data-toggle="pill" class="my-noBorderRadius" href="#mugclub">Mug Club</a></li>
                <li><a class="my-noBorderRadius" data-toggle="pill" href="#instamojo">Instamojo</a></li>
                <li><a class="my-noBorderRadius" data-toggle="pill" href="#feedback">Feedback</a></li>
                <li><a class="my-noBorderRadius" data-toggle="pill" href="#fnbpanel">FnB Data</a></li>
                <li><a class="my-noBorderRadius" data-toggle="pill" href="#eventpanel">Events</a></li>
            </ul>
            <!--<div class="mdl-layout__tab-bar mdl-js-ripple-effect">
                <a href="#mugclub" class="mdl-layout__tab">Mug Club</a><br>
                <a href="#instamojo" class="mdl-layout__tab is-active">Instamojo</a>
                <a class="mdl-navigation__link" href="#">Mug Club</a>
            </div>-->
        </div>
        <main class="mdl-layout__content tab-content">
            <section class="tab-pane fade in active" id="mugclub">
                <div class="page-content">
                    <div class="mdl-grid">
                        <div class="mdl-cell mdl-cell--1-col"></div>
                        <div class="mdl-cell mdl-cell--10-col text-center">
                            <form action="<?php echo base_url();?>dashboard/custom" method="post" id="customDateForm">
                                <ul class="list-inline">
                                    <li>
                                        <label for="location">Location</label>
                                        <?php
                                        if($this->userType == ADMIN_USER)
                                        {
                                            ?>
                                            <select id="location" onchange="refreshBars(this)" class="form-control">
                                                <option value="0">Overall</option>
                                                <?php
                                                if(isset($locations))
                                                {
                                                    foreach($locations as $key => $row)
                                                    {
                                                        if(isset($row['id']))
                                                        {
                                                            ?>
                                                            <option value="<?php echo $row['id'];?>"><?php echo $row['locName'];?></option>
                                                            <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <?php
                                        }
                                        elseif($this->userType == EXECUTIVE_USER)
                                        {
                                            if(isset($userInfo))
                                            {
                                                ?>
                                                <select id="location" onchange="refreshBars(this)" class="form-control">
                                                    <?php
                                                    foreach($userInfo as $key => $row)
                                                    {
                                                        ?>
                                                        <option value="<?php echo $row['locData'][0]['id'];?>">
                                                            <?php echo $row['locData'][0]['locName'];?>
                                                        </option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                <?php
                                            }
                                            ?>

                                            <?php
                                        }
                                        ?>

                                    </li>
                                    <li>
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label custom-filter">
                                            <input class="mdl-textfield__input" type="text" name="startDate" id="startDate" placeholder="">
                                            <label class="mdl-textfield__label" for="startDate">Start Date</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label custom-filter">
                                            <input class="mdl-textfield__input" type="text" name="endDate" id="endDate" placeholder="">
                                            <label class="mdl-textfield__label" for="endDate">End Date</label>
                                        </div>
                                    </li>
                                    <li>
                                        <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                                            Apply
                                        </button>
                                    </li>
                                </ul>
                            </form>
                        </div>
                        <div class="mdl-cell mdl-cell--1-col">

                        </div>
                    </div>
                    <div class="col-sm-12 col-xs-12">
                        <div class="mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
                            <div id="totalCheckins-container" class="barContainers">
                                <h6 class="text-primary text-center my-marginTopBottom">Total Check-Ins</h6>
                            </div>
                            <div id="avgCheckins-container" class="barContainers">
                                <h6 class="text-primary text-center my-marginTopBottom">Avg Check-Ins</h6>
                            </div>
                            <div id="regulars-container" class="barContainers">
                                <h6 class="text-primary text-center my-marginTopBottom">Regulars</h6>
                            </div>
                            <div id="irregulars-container" class="barContainers">
                                <h6 class="text-primary text-center my-marginTopBottom">Irregulars</h6>
                            </div>
                            <div id="lapsers-container" class="barContainers">
                                <h6 class="text-primary text-center my-marginTopBottom">Lapsers</h6>
                            </div>
                        </div>
                    </div>
                    <div class="mdl-color--white mdl-shadow--2dp">
                        <div class="col-sm-12 col-xs-12">
                            <ul class="list-inline">
                                <li>
                                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="avg-radio">
                                        <input type="radio" id="avg-radio" class="mdl-radio__button" name="dashboardStats" value="1" checked>
                                        <span class="mdl-radio__label">Avg Check-Ins</span>
                                    </label>
                                </li>
                                <li>
                                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="regular-radio">
                                        <input type="radio" id="regular-radio" class="mdl-radio__button" name="dashboardStats" value="2">
                                        <span class="mdl-radio__label">Regulars</span>
                                    </label>
                                </li>
                                <li>
                                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="irregulars-radio">
                                        <input type="radio" id="irregulars-radio" class="mdl-radio__button" name="dashboardStats" value="3">
                                        <span class="mdl-radio__label">Irregulars</span>
                                    </label>
                                </li>
                                <li>
                                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="lapsers-radio">
                                        <input type="radio" id="lapsers-radio" class="mdl-radio__button" name="dashboardStats" value="4">
                                        <span class="mdl-radio__label">Lapsers</span>
                                    </label>
                                </li>
                            </ul>
                            <canvas id="avgChecks-canvas" class="mygraphs"></canvas>
                            <canvas id="regulars-canvas" class="mygraphs"></canvas>
                            <canvas id="irregulars-canvas" class="mygraphs"></canvas>
                            <canvas id="lapsers-canvas" class="mygraphs"></canvas>
                        </div>
                        <!--<div class="col-sm-4 col-xs-12">
                            <table class="mdl-data-table mdl-js-data-table">
                                <thead>
                                <tr>
                                    <th class="mdl-data-table__cell--non-numeric">Legend</th>
                                    <th class="mdl-data-table__cell--non-numeric overall-th">OverAll</th>
                                    <th class="mdl-data-table__cell--non-numeric andheri-th">Andheri</th>
                                    <th class="mdl-data-table__cell--non-numeric bandra-th">Bandra</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
/*                                if(isset($avgChecks))
                                {
                                    */?>
                                    <tr>
                                        <td>Avg Check-ins</td>
                                        <td class="overall-td">
                                            <?php
/*                                            $allStores = ((int)$avgChecks['checkInList']['overall']/$totalMugs['overall']);
                                            echo round($allStores,2);
                                            */?>
                                        </td>
                                        <td class="andheri-td">
                                            <?php
/*                                            $andheriStore = ((int)$avgChecks['checkInList']['andheri']/$totalMugs['andheri']);
                                            echo round($andheriStore,2);
                                            */?>
                                        </td>
                                        <td class="bandra-td">
                                            <?php
/*                                            $bandraStore = ((int)$avgChecks['checkInList']['bandra']/$totalMugs['bandra']);
                                            echo round($bandraStore,2);
                                            */?>
                                        </td>
                                    </tr>
                                    <?php
/*                                }
                                if(isset($Regulars))
                                {
                                    */?>
                                    <tr>
                                        <td>Regulars</td>
                                        <td class="overall-td">
                                            <?php
/*                                            $allStores = ((int)$Regulars['regularCheckins']['overall']/$totalMugs['overall'])*100;
                                            echo round($allStores,1);
                                            */?>
                                        </td>
                                        <td class="andheri-td">
                                            <?php
/*                                            $andheriStore = ((int)$Regulars['regularCheckins']['andheri']/$totalMugs['andheri'])*100;
                                            echo round($andheriStore,1);
                                            */?>
                                        </td>
                                        <td class="bandra-td">
                                            <?php
/*                                            $bandraStore = ((int)$Regulars['regularCheckins']['bandra']/$totalMugs['bandra'])*100;
                                            echo round($bandraStore,1);
                                            */?>
                                        </td>
                                    </tr>
                                    <?php
/*                                }
                                if(isset($Irregulars))
                                {
                                    */?>
                                    <tr>
                                        <td>IrRegulars</td>
                                        <td class="overall-td">
                                            <?php
/*                                            $allStores = ((int)$Irregulars['irregularCheckins']['overall']/$totalMugs['overall'])*100;
                                            echo round($allStores,1);
                                            */?>
                                        </td>
                                        <td class="andheri-td">
                                            <?php
/*                                            $andheriStore = ((int)$Irregulars['irregularCheckins']['andheri']/$totalMugs['andheri'])*100;
                                            echo round($andheriStore,1);
                                            */?>
                                        </td>
                                        <td class="bandra-td">
                                            <?php
/*                                            $bandraStore = ((int)$Irregulars['irregularCheckins']['bandra']/$totalMugs['bandra'])*100;
                                            echo round($bandraStore,1);
                                            */?>
                                        </td>
                                    </tr>
                                    <?php
/*                                }
                                if(isset($lapsers))
                                {
                                    */?>
                                    <tr>
                                        <td>Lapsers</td>
                                        <td class="overall-td">
                                            <?php
/*                                            $allStores = ((int)$lapsers['lapsers']['overall']/$totalMugs['overall'])*100;
                                            echo round($allStores,1);
                                            */?>
                                        </td>
                                        <td class="andheri-td">
                                            <?php
/*                                            $andheriStore = ((int)$lapsers['lapsers']['andheri']/$totalMugs['andheri'])*100;
                                            echo round($andheriStore,1);
                                            */?>
                                        </td>
                                        <td class="bandra-td">
                                            <?php
/*                                            $bandraStore = ((int)$lapsers['lapsers']['bandra']/$totalMugs['bandra'])*100;
                                            echo round($bandraStore,1);
                                            */?>
                                        </td>
                                    </tr>
                                    <?php
/*                                }
                                */?>
                                </tbody>
                            </table>
                        </div>-->
                    </div>
                </div>
            </section>
            <section class="tab-pane fade" id="instamojo">
                <div class="mdl-grid">
                    <?php
                        if(isset($instamojo))
                        {
                            if($instamojo['status'] === true)
                            {
                                foreach($instamojo['instaRecords'] as $key => $row)
                                {
                                    ?>
                                    <div class="mdl-cell mdl-cell--4-col my-instaCard" data-id="<?php echo $row['id'];?>">
                                        <div class="demo-card-square mdl-card mdl-shadow--2dp">
                                            <div class="mdl-card__title mdl-card--expand">
                                                <h2 class="mdl-card__title-text">
                                                    <i class="fa fa-beer fa-2x"></i>
                                                    <span class="mugTitle">Mug #<?php echo $row['mugId'];?></span>
                                                </h2>
                                            </div>
                                            <div class="mdl-card__supporting-text">
                                                <h4 class="my-NoMargin"><?php echo $row['buyerName'];?></h4>
                                                <?php echo $row['buyerEmail'];?><br>
                                                Rs. <?php echo $row['price'];?>
                                            </div>
                                            <div class="mdl-card__actions mdl-card--border">
                                                <a class="confirm-btn mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect my-noUnderline"
                                                onclick="changeCurrent(this)" data-id="<?php echo $row['id'];?>"
                                                data-paymentId="<?php echo $row['paymentId'];?>"
                                                data-email="<?php echo $row['buyerEmail'];?>"
                                                data-mugId="<?php echo $row['mugId'];?>">
                                                    Confirm
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            else
                            {
                                ?>
                                    <div class="mdl-cell mdl-cell--12-col">
                                        No Purchases Found!
                                    </div>
                                <?php
                            }
                        }
                    ?>
                </div>
                <dialog class="mdl-dialog">
                    <input type="hidden" id="selectedMug"/>
                    <input type="hidden" id="mugPaymentId"/>
                    <input type="hidden" id="mugNum"/>
                    <input type="hidden" id="mugEmail"/>
                    <h4 class="mdl-dialog__title">Confirm Upgrade?</h4>
                    <div class="mdl-dialog__content">
                        <p>
                            Extending Membership by 12 months
                        </p>
                    </div>
                    <div class="mdl-dialog__actions">
                        <button type="button" class="mdl-button agree_btn">Agree</button>
                        <button type="button" class="mdl-button close">Cancel</button>
                    </div>
                </dialog>
            </section>
            <section class="tab-pane fade" id="feedback">
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--1-col"></div>
                    <div class="mdl-cell mdl-cell--10-col text-center">
                        <ul class="list-inline">
                            <li>
                                <label for="feedbackLoc">Location</label>
                                <?php
                                $commonLoc = array();
                                if($this->userType == ADMIN_USER)
                                {
                                    $commonLoc[] = 'overall';
                                    ?>
                                    <select id="feedbackLoc" class="form-control">
                                        <?php
                                        if(isset($locations))
                                        {
                                            foreach($locations as $key => $row)
                                            {
                                                if(isset($row['id']))
                                                {
                                                    $commonLoc[] = $row['locUniqueLink'];
                                                    ?>
                                                    <option value="<?php echo $row['id'];?>"><?php echo $row['locName'];?></option>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                    <?php
                                }
                                elseif($this->userType == EXECUTIVE_USER)
                                {
                                    if(isset($userInfo))
                                    {
                                        ?>
                                        <select id="feedbackLoc" class="form-control">
                                            <?php
                                            foreach($userInfo as $key => $row)
                                            {
                                                $commonLoc[] = $row['locData'][0]['locUniqueLink'];
                                                ?>
                                                <option value="<?php echo $row['locData'][0]['id'];?>">
                                                    <?php echo $row['locData'][0]['locName'];?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <?php
                                    }
                                    ?>

                                    <?php
                                }
                                ?>

                            </li>
                            <li>
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                    <input class="mdl-textfield__input" type="number" id="feedbackNum">
                                    <label class="mdl-textfield__label" for="feedbackNum">Number (max:50)</label>
                                </div>
                            </li>
                            <li>
                                <button type="button" id="genBtn" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                                    Generate
                                </button>
                            </li>
                        </ul>
                        <?php
                            if(isset($feedbacks) && myIsArray($feedbacks))
                            {
                                ?>
                                <ul class="list-inline">
                                    <?php
                                        foreach($feedbacks as $key => $row)
                                        {
                                            if(myInArray($key,$commonLoc))
                                            {
                                                ?>
                                                <li>
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading"><?php echo ucfirst($key);?> Net Rating</div>
                                                        <div class="panel-body stats-nums">
                                                            <?php if(isset($row)){ echo $row;} else{echo 'None';}?>
                                                        </div>
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                        }
                                    ?>
                                </ul>
                                <?php
                            }
                        ?>
                        <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"
                                data-toggle="modal" data-target="#feedback-modal">
                            Show Graph
                        </button>
                    </div>
                    <div class="mdl-cell mdl-cell--1-col"></div>
                    <!-- Dynamic Form -->
                    <div class="mdl-cell mdl-cell--12-col dynamic-form-wrapper">
                        <form action="<?php echo base_url().'dashboard/saveFeedback/json';?>" id="feedback-form" method="post">
                            <div class="form-super-container"></div>
                            <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent hide">Submit</button>
                        </form>
                    </div>
                </div>
            </section>
            <section class="tab-pane fade" id="fnbpanel">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#fnbView">Fnb Records</a></li>
                    <li><a data-toggle="tab" href="#fnbAdd">Add Fnb</a></li>
                </ul>

                <div class="tab-content">
                    <div id="fnbView" class="tab-pane fade in active">
                        <?php
                        if(isset($fnbData) && myIsMultiArray($fnbData))
                        {
                            ?>
                            <div class="mdl-grid table-responsive">
                                <table id="main-fnb-table" class="table table-hover table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Fnb Id</th>
                                        <th>Item Type</th>
                                        <th>Name</th>
                                        <th>Headline</th>
                                        <th>Description</th>
                                        <th>Price Full</th>
                                        <th>Price Half</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach($fnbData as $key => $row)
                                    {
                                        ?>
                                        <tr>
                                            <th scope="row"><?php echo $row['fnb']['fnbId'];?></th>
                                            <td>
                                                <?php
                                                switch($row['fnb']['itemType'])
                                                {
                                                    case "1":
                                                        echo 'Food';
                                                        break;
                                                    case "2":
                                                        echo 'Beverage';
                                                        break;
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo $row['fnb']['itemName'];?></td>
                                            <td><?php echo $row['fnb']['itemHeadline'];?></td>
                                            <td><?php echo strip_tags($row['fnb']['itemDescription']);?></td>
                                            <td><?php echo $row['fnb']['priceFull'];?></td>
                                            <td><?php echo $row['fnb']['priceHalf'];?></td>
                                            <td>
                                                <?php
                                                if($row['fnb']['itemType'] == "2")
                                                {
                                                    ?>
                                                    <a data-toggle="tooltip" class="beer-tags" title="Tag Location" href="#" data-fnbId="<?php echo $row['fnb']['fnbId'];?>">
                                                        <i class="fa fa-15x fa-tags my-success-text"></i></a>
                                                    <?php
                                                }
                                                ?>
                                                <?php
                                                if($row['fnb']['ifActive'] == ACTIVE)
                                                {
                                                    ?>
                                                    <a data-toggle="tooltip" title="Active" href="<?php echo base_url().'dashboard/setFnbDeActive/'.$row['fnb']['fnbId'];?>">
                                                        <i class="fa fa-15x fa-lightbulb-o my-success-text"></i></a>
                                                    <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                    <a data-toggle="tooltip" title="Not Active" href="<?php echo base_url().'dashboard/setFnbActive/'.$row['fnb']['fnbId'];?>">
                                                        <i class="fa fa-15x fa-lightbulb-o my-error-text"></i></a>
                                                    <?php
                                                }

                                                if(isset($row['fnbAtt']) && myIsMultiArray($row['fnbAtt']))
                                                {
                                                    $imgs = array();
                                                    foreach($row['fnbAtt'] as $attkey => $attrow)
                                                    {
                                                        switch($attrow['attachmentType'])
                                                        {
                                                            case "1":
                                                                $imgs[] = MOBILE_URL.FOOD_PATH_THUMB.$attrow['filename'];
                                                                break;
                                                            case "2":
                                                                $imgs[] = MOBILE_URL.BEVERAGE_PATH_THUMB.$attrow['filename'];
                                                                break;
                                                            default:
                                                                $imgs[] = MOBILE_URL.BEVERAGE_PATH_THUMB.$attrow['filename'];
                                                                break;

                                                        }
                                                    }
                                                    ?>
                                                    <a class="view-photos" data-toggle="tooltip" title="View Photos" href="#" data-imgs="<?php echo implode(',',$imgs);?>">
                                                        <i class="fa fa-15x fa-file-image-o my-success-text"></i></a>
                                                    <?php
                                                }
                                                ?>
                                                <a data-toggle="tooltip" title="Edit"
                                                   href="<?php echo base_url().'dashboard/editFnb/'.$row['fnb']['fnbId']?>">
                                                    <i class="fa fa-15x fa-pencil-square-o my-black-text"></i></a>
                                                <a data-toggle="tooltip" class="fnbDelete-icon" data-fnbId="<?php echo $row['fnb']['fnbId'];?>" title="Delete" href="#">
                                                    <i class="fa fa-trash-o fa-15x"></i></a>&nbsp;
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php

                        }
                        else
                        {
                            echo 'No Records Found!';
                        }
                        ?>
                    </div>
                    <div id="fnbAdd" class="tab-pane fade">
                        <div class="mdl-grid">
                            <div class="mdl-cell mdl-cell--2-col"></div>
                            <div class="mdl-cell mdl-cell--8-col text-center">
                                <form action="<?php echo base_url();?>dashboard/savefnb" method="post" enctype="multipart/form-data">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label my-fullWidth">
                                        <input class="mdl-textfield__input" type="text" name="itemName" id="itemName">
                                        <label class="mdl-textfield__label" for="itemName">Name</label>
                                    </div>
                                    <br>
                                    <div class="text-left">
                                        <label>Item Type :</label>
                                        <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="itemFood">
                                            <input type="radio" id="itemFood" class="mdl-radio__button" name="itemType" value="1" checked>
                                            <span class="mdl-radio__label">Food</span>
                                        </label>
                                        <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="itemBeverage">
                                            <input type="radio" id="itemBeverage" class="mdl-radio__button" name="itemType" value="2">
                                            <span class="mdl-radio__label">Beverage</span>
                                        </label>
                                    </div>
                                    <br>
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label my-fullWidth">
                                        <textarea class="mdl-textfield__input" placeholder="Headline" name="itemHeadline" rows="5"></textarea>
                                        <br>
                                        <textarea class="mdl-textfield__input" type="text" name="itemDescription" rows="5" id="itemDesc"></textarea>
                                    </div>
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label my-fullWidth">
                                        <input class="mdl-textfield__input" type="text" name="priceFull" pattern="-?[0-9]*(\.[0-9]+)?" id="itemPriceF">
                                        <label class="mdl-textfield__label" for="itemPriceF">Price (Full)</label>
                                        <span class="mdl-textfield__error">Input is not a number!</span>
                                    </div>
                                    <br>
                                    <div class="text-left">
                                        <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="priceHalf">
                                            <input type="checkbox" id="priceHalf" class="mdl-checkbox__input" onchange="toggleHalf(this)">
                                            <span class="mdl-checkbox__label">Half Price?</span>
                                        </label>
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label priceHalfCls hide my-fullWidth">
                                            <input class="mdl-textfield__input" type="text" name="priceHalf" pattern="-?[0-9]*(\.[0-9]+)?" id="itemPriceH">
                                            <label class="mdl-textfield__label" for="itemPriceH">Price (Half)</label>
                                            <span class="mdl-textfield__error">Input is not a number!</span>
                                        </div>
                                    </div>

                                    <div class="myUploadPanel text-left">
                                        <br>
                                        <a href="http://www.photoresizer.com/" target="_blank" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent my-noUnderline">Crop Before Upload?</a>
                                        <br>
                                        <!--<label>Attachment Type :</label>
                                        <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="attFood">
                                            <input type="radio" id="attFood" class="mdl-radio__button" name="attType[0]" value="1" checked>
                                            <span class="mdl-radio__label">Food</span>
                                        </label>
                                        <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="attBeer">
                                            <input type="radio" id="attBeer" class="mdl-radio__button" name="attType[0]" value="2">
                                            <span class="mdl-radio__label">Beer Digital</span>
                                        </label>
                                        <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="attBeerW">
                                            <input type="radio" id="attBeerW" class="mdl-radio__button" name="attType[0]" value="3">
                                            <span class="mdl-radio__label">Beer Woodcut</span>
                                        </label>-->
                                        <input type="file" class="form-control" onchange="uploadChange(this)" />
                                        <br>
                                        <button onclick="addUploadPanel()" type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Add More?</button>
                                        <input type="hidden" name="attachment" />
                                    </div>
                                    <br>
                                    <button onclick="fillImgs()" type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Submit</button>
                                </form>
                                <br>
                                <div class="progress hide">
                                    <div class="progress-bar progress-bar-striped active" role="progressbar"
                                         aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            </div>
                            <div class="mdl-cell mdl-cell--2-col"></div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="tab-pane fade" id="eventpanel">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#eventView">Event Records</a></li>
                    <li><a data-toggle="tab" href="#eventAdd">Add Event</a></li>
                    <li><a data-toggle="tab" href="#compEvents">Completed</a></li>
                </ul>

                <div class="tab-content">
                    <div id="eventView" class="tab-pane fade in active">
                        <?php
                            if(isset($eventDetails) && myIsMultiArray($eventDetails))
                            {
                                ?>
                                <div class="mdl-grid table-responsive">
                                    <table id="main-event-table" class="table table-hover table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Event Id</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Type</th>
                                            <th>Date</th>
                                            <th>Timing</th>
                                            <th>Cost</th>
                                            <th>Place</th>
                                            <th>Organizer Name</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach($eventDetails as $key => $row)
                                        {
                                            ?>
                                            <tr>
                                                <th scope="row"><?php echo $row['eventData']['eventId'];?></th>
                                                <td><?php echo $row['eventData']['eventName'];?></td>
                                                <td><?php echo strip_tags($row['eventData']['eventDescription']);?></td>
                                                <td><?php echo $row['eventData']['eventType'];?></td>
                                                <td><?php $d = date_create($row['eventData']['eventDate']); echo date_format($d,DATE_FORMAT_UI);?></td>
                                                <td><?php echo $row['eventData']['startTime'] .' - '.$row['eventData']['endTime'];?></td>
                                                <td>
                                                    <?php
                                                    switch($row['eventData']['costType'])
                                                    {
                                                        case 1:
                                                            echo 'Free';
                                                            break;
                                                        case 2:
                                                            echo 'Paid : Rs '.$row['eventData']['eventPrice'];
                                                            break;
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo $row['eventData']['locData'][0]['locName'];?></td>
                                                <td><?php echo $row['eventData']['creatorName'];?></td>
                                                <td><!--<a data-toggle="tooltip" title="Edit" href="<?php /*echo base_url().'mugclub/edit/'.$row['mugId'];*/?>">
                                                        <i class="glyphicon glyphicon-edit"></i></a>&nbsp;-->
                                                <?php
                                                    if($row['eventData']['ifApproved'] == EVENT_WAITING)
                                                    {
                                                        ?>
                                                        <a data-toggle="tooltip" title="Approve" href="<?php echo base_url().'dashboard/approve/'.$row['eventData']['eventId'];?>">
                                                            <i class="fa fa-15x fa-check my-success-text"></i></a>
                                                        <a data-toggle="tooltip" title="Decline" href="<?php echo base_url().'dashboard/decline/'.$row['eventData']['eventId'];?>">
                                                            <i class="fa fa-15x fa-times my-error-text"></i></a>
                                                        <?php
                                                    }
                                                    elseif($row['eventData']['ifApproved'] == EVENT_APPROVED && $row['eventData']['ifActive'] == ACTIVE)
                                                    {
                                                        ?>
                                                        <a data-toggle="tooltip" title="Active" href="<?php echo base_url().'dashboard/setEventDeActive/'.$row['eventData']['eventId'];?>">
                                                            <i class="fa fa-15x fa-lightbulb-o my-success-text"></i></a>
                                                        <?php
                                                    }
                                                    elseif($row['eventData']['ifApproved'] == EVENT_APPROVED && $row['eventData']['ifActive'] == NOT_ACTIVE)
                                                    {
                                                        ?>
                                                        <a data-toggle="tooltip" title="Not Active" href="<?php echo base_url().'dashboard/setEventActive/'.$row['eventData']['eventId'];?>">
                                                            <i class="fa fa-15x fa-lightbulb-o my-error-text"></i></a>
                                                        <?php
                                                    }
                                                    elseif($row['eventData']['ifApproved'] == EVENT_DECLINED)
                                                    {
                                                        ?>
                                                        <a data-toggle="tooltip" title="Declined" href="<?php echo base_url().'dashboard/approve/'.$row['eventData']['eventId'];?>">
                                                            <i class="fa fa-15x fa-ban my-error-text"></i></a>
                                                        <?php
                                                    }
                                                if(isset($row['eventAtt']) && myIsMultiArray($row['eventAtt']))
                                                {
                                                    $imgs = array();
                                                    foreach($row['eventAtt'] as $attkey => $attrow)
                                                    {
                                                        $imgs[] = MOBILE_URL.EVENT_PATH_THUMB.$attrow['filename'];
                                                    }
                                                    ?>
                                                    <a class="view-photos" data-toggle="tooltip" title="View Photos" href="#" data-imgs="<?php echo implode(',',$imgs);?>">
                                                        <i class="fa fa-15x fa-file-image-o my-success-text"></i></a>
                                                    <?php
                                                }
                                                ?>
                                                    <a data-toggle="tooltip" title="Edit"
                                                       href="<?php echo base_url().'dashboard/editEvent/'.$row['eventData']['eventId']?>">
                                                        <i class="fa fa-15x fa-pencil-square-o my-black-text"></i></a>
                                                    <a data-toggle="tooltip" class="eventDelete-icon" data-eventId="<?php echo $row['eventData']['eventId'];?>" title="Delete" href="#">
                                                        <i class="fa fa-trash-o fa-15x"></i></a>&nbsp;
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php

                            }
                            else
                            {
                                echo 'No Records Found!';
                            }
                        ?>
                    </div>
                    <div id="eventAdd" class="tab-pane fade">
                        <div class="mdl-grid">
                            <div class="mdl-cell mdl-cell--2-col"></div>
                            <div class="mdl-cell mdl-cell--8-col text-center">
                                <form action="<?php echo base_url();?>dashboard/saveEvent" method="post" enctype="multipart/form-data">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label my-fullWidth">
                                        <input class="mdl-textfield__input" type="text" name="eventName" id="eventName">
                                        <label class="mdl-textfield__label" for="eventName">Event Name</label>
                                    </div>
                                    <br>
                                    <div class="text-left">
                                        <label for="eventType">Event Type :</label>
                                        <select name="eventType" id="eventType" class="form-control">
                                            <?php
                                                foreach($this->config->item('eventTypes') as $key => $row)
                                                {
                                                    ?>
                                                    <option value="<?php echo $row;?>"><?php echo $row;?></option>
                                                    <?php
                                                }
                                            ?>
                                        </select>
                                        <div class="mdl-textfield mdl-js-textfield other-event hide">
                                            <input class="mdl-textfield__input" type="text" id="otherType">
                                            <label class="mdl-textfield__label" for="otherType">Other</label>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label my-fullWidth text-left">
                                        <label for="eventDescription">Event Description: </label>
                                        <textarea class="mdl-textfield__input my-singleBorder" type="text" name="eventDescription" rows="5" id="eventDescription"></textarea>
                                    </div>
                                    <ul class="list-inline text-left">
                                        <li>
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                <input class="mdl-textfield__input" type="text" name="eventDate" id="eventDate" placeholder="">
                                                <label class="mdl-textfield__label" for="eventDate">Event Date</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                <input class="mdl-textfield__input" type="text" name="startTime" id="startTime" placeholder="">
                                                <label class="mdl-textfield__label" for="startTime">Start Time</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                <input class="mdl-textfield__input" type="text" name="endTime" id="endTime" placeholder="">
                                                <label class="mdl-textfield__label" for="endTime">End Time</label>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="text-left">
                                        <label>Event Cost :</label>
                                        <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="freeType">
                                            <input type="radio" id="freeType" class="mdl-radio__button" name="costType" value="1" checked>
                                            <span class="mdl-radio__label">Free</span>
                                        </label>
                                        <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="paidType">
                                            <input type="radio" id="paidType" class="mdl-radio__button" name="costType" value="2">
                                            <span class="mdl-radio__label">Paid</span>
                                        </label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label event-price hide">
                                            <input class="mdl-textfield__input" type="text" name="eventPrice" pattern="-?[0-9]*(\.[0-9]+)?" id="eventPrice">
                                            <label class="mdl-textfield__label" for="eventPrice">Price</label>
                                            <span class="mdl-textfield__error">Input is not a number!</span>
                                        </div>
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label special-offer hide">
                                            <input class="mdl-textfield__input" type="text" name="priceFreeStuff" id="priceFreeStuff" placeholder="">
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
                                                foreach($locations as $key => $row)
                                                {
                                                    if(isset($row['id']))
                                                    {
                                                        ?>
                                                        <option value="<?php echo $row['id'];?>"><?php echo $row['locName'];?></option>
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
                                            <input class="mdl-textfield__input" type="text" name="eventCapacity" id="eventCapacity" placeholder="">
                                            <label class="mdl-textfield__label" for="eventCapacity">Event Capacity</label>
                                        </div>
                                        <br>
                                        <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="ifMicRequired">
                                            <input type="checkbox" name="ifMicRequired" value="1" id="ifMicRequired" class="mdl-checkbox__input">
                                            <span class="mdl-checkbox__label">Do you need a mic?</span>
                                        </label>
                                        <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="ifProjectorRequired">
                                            <input type="checkbox" id="ifProjectorRequired" name="ifProjectorRequired" value="1" class="mdl-checkbox__input">
                                            <span class="mdl-checkbox__label">Do you need a projector?</span>
                                        </label>
                                    </div>
                                    <br>
                                    <div class="text-left">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                            <input class="mdl-textfield__input" type="text" name="creatorName" id="creatorName" placeholder="" required>
                                            <label class="mdl-textfield__label" for="creatorName">Organizer Name</label>
                                        </div>
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                            <input class="mdl-textfield__input" type="number" name="creatorPhone" id="creatorPhone" placeholder="" required>
                                            <label class="mdl-textfield__label" for="creatorPhone">Organizer Phone</label>
                                        </div>
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                            <input class="mdl-textfield__input" type="email" name="creatorEmail" id="creatorEmail" placeholder="" required>
                                            <label class="mdl-textfield__label" for="creatorEmail">Organizer Email</label>
                                        </div>
                                        <br>
                                        <label for="eventDescription">Organizer Description: </label>
                                        <textarea class="mdl-textfield__input my-singleBorder" type="text" name="aboutCreator" rows="5" id="aboutCreator"></textarea>
                                    </div>
                                    <br>
                                    <div class="myUploadPanel text-left">
                                        <input type="file" multiple class="form-control" onchange="eventUploadChange(this)" />
                                        <input type="hidden" name="attachment" />
                                    </div>

                                    <br>
                                    <button onclick="fillEventImgs()" type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Submit</button>
                                </form>
                                <br>
                                <div class="progress hide">
                                    <div class="progress-bar progress-bar-striped active" role="progressbar"
                                         aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            </div>
                            <div class="mdl-cell mdl-cell--2-col"></div>
                        </div>
                    </div>
                    <div id="compEvents" class="tab-pane fade">
                        <?php
                        if(isset($completedEvents) && myIsMultiArray($completedEvents))
                        {
                            ?>
                            <div class="mdl-grid table-responsive">
                                <table id="main-event-table" class="table table-hover table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Event Id</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Type</th>
                                        <th>Date</th>
                                        <th>Timing</th>
                                        <th>Cost</th>
                                        <th>Place</th>
                                        <th>Organizer Name</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach($completedEvents as $key => $row)
                                    {
                                        ?>
                                        <tr>
                                            <th scope="row"><?php echo $row['eventId'];?></th>
                                            <td><?php echo $row['eventName'];?></td>
                                            <td><?php echo strip_tags($row['eventDescription']);?></td>
                                            <td><?php echo $row['eventType'];?></td>
                                            <td><?php $d = date_create($row['eventDate']); echo date_format($d,DATE_FORMAT_UI);?></td>
                                            <td><?php echo $row['startTime'] .' - '.$row['endTime'];?></td>
                                            <td>
                                                <?php
                                                switch($row['costType'])
                                                {
                                                    case 1:
                                                        echo 'Free';
                                                        break;
                                                    case 2:
                                                        echo 'Paid : Rs '.$row['eventPrice'];
                                                        break;
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo $row['locName'];?></td>
                                            <td><?php echo $row['creatorName'];?></td>
                                            <td><!--<a data-toggle="tooltip" title="Edit" href="<?php /*echo base_url().'mugclub/edit/'.$row['mugId'];*/?>">
                                                        <i class="glyphicon glyphicon-edit"></i></a>&nbsp;-->
                                                <?php
                                                if(isset($row['filename']))
                                                {
                                                    $imgs[] = base_url().EVENT_PATH_THUMB.$row['filename'];
                                                    ?>
                                                    <a class="view-photos" data-toggle="tooltip" title="View Photos" href="#" data-imgs="<?php echo implode(',',$imgs);?>">
                                                        <i class="fa fa-15x fa-file-image-o my-success-text"></i></a>
                                                    <?php
                                                }
                                                ?>
                                                <!--<a data-toggle="tooltip" title="Edit"
                                                   href="<?php /*echo base_url().'dashboard/editEvent/'.$row['eventId']*/?>">
                                                    <i class="fa fa-15x fa-pencil-square-o my-black-text"></i></a>-->
                                                <a data-toggle="tooltip" class="eventCompletedDelete-icon" data-eventId="<?php echo $row['eventId'];?>" title="Delete" href="#">
                                                    <i class="fa fa-trash-o fa-15x"></i></a>&nbsp;
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php

                        }
                        else
                        {
                            echo 'No Records Found!';
                        }
                        ?>
                    </div>
                </div>
            </section>

        </main>
    </div>
    <div id="feedback-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Feedback Analysis</h4>
                </div>
                <div class="modal-body">
                    <?php
                    if($this->userType == ADMIN_USER)
                    {
                        ?>
                        <select id="location-feed" onchange="refreshFeeds(this)" class="form-control">
                            <option value="0">Overall</option>
                            <?php
                            if(isset($locations))
                            {
                                foreach($locations as $key => $row)
                                {
                                    if(isset($row['id']))
                                    {
                                        ?>
                                        <option value="<?php echo $row['id'];?>"><?php echo $row['locName'];?></option>
                                        <?php
                                    }
                                }
                            }
                            ?>
                        </select>
                        <?php
                    }
                    elseif($this->userType == EXECUTIVE_USER)
                    {
                        if(isset($userInfo))
                        {
                            ?>
                            <select id="location-feed" onchange="refreshFeeds(this)" class="form-control">
                                <?php
                                foreach($userInfo as $key => $row)
                                {
                                    ?>
                                    <option value="<?php echo $row['locData'][0]['id'];?>">
                                        <?php echo $row['locData'][0]['locName'];?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                            <?php
                        }
                        ?>

                        <?php
                    }
                    ?>
                    <canvas id="feedWeekly-canvas" class="mygraphs"></canvas>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <div id="beerLoc-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Tag Beer Location</h4>
                </div>
                <div class="modal-body text-center">
                    <input type="hidden" id="fnbId" value=""/>
                    <label>Tagged Locations</label>
                    <div class="tagged-locations">

                    </div>
                    <hr>

                    <div class="beer-loc-select">
                        <label>Available Locations</label>
                        <ul class="list-inline">
                            <?php
                            if(isset($locations))
                            {
                                foreach($locations as $key => $row)
                                {
                                    if(isset($row['id']))
                                    {
                                        ?>
                                        <li data-value="<?php echo $row['id'];?>"><?php echo $row['locName'];?></li>
                                        <?php
                                    }
                                }
                            }
                            ?>
                        </ul>
                    </div>
                    <br>
                    <button type="button" class="btn btn-primary save-fnb-tags">Save</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    <?php echo $footerView; ?>

</body>
<?php echo $globalJs; ?>
<script>

    $('#startDate').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss'
    });
    $('#endDate').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss'
    });
    var totalCheckins = {};
    var avgCheckins = {};
    var regulars = {};
    var irregulars = {};
    var lapsers = {};
    var graph_avg = {};
    var graph_regulars = {};
    var graph_irregulars = {};
    var graph_lapsers = {};
    var graph_labels = [];
    var feed_labels = [];
    var feed_locs = {};

    var totalChecksBar, avgChecksBar, regularsBar, irregularsBar,lapsersBar;
    //setting all values
    <?php
        if(isset($avgChecks))
        {
            for($i = 0;$i<count($avgChecks['checkInList']); $i++)
            {
                $mugkeys = array_keys($totalMugs);
                if($totalMugs[$mugkeys[$i]] != 0)
                {
                    $checkinKeys = array_keys($avgChecks['checkInList']);
                    $allStores = ((int)$avgChecks['checkInList'][$checkinKeys[$i]]/$totalMugs[$mugkeys[$i]]);
                    ?>
                    totalCheckins[<?php echo $i;?>] = <?php echo (int)$avgChecks['checkInList'][$checkinKeys[$i]];?>;
                    avgCheckins[<?php echo $i;?>] = <?php echo round($allStores,2);?>;
                    <?php
                }
                else
                {
                    ?>
                    totalCheckins[<?php echo $i;?>] = 0;
                    avgCheckins[<?php echo $i;?>] = 0;
                    <?php
                }
            }
        }
        if(isset($Regulars))
        {
            for($i = 0;$i<count($Regulars['regularCheckins']); $i++)
            {
                $mugkeys = array_keys($totalMugs);
                if($totalMugs[$mugkeys[$i]] != 0)
                {
                    $checkinKeys = array_keys($Regulars['regularCheckins']);
                    $allStores = ((int)$Regulars['regularCheckins'][$checkinKeys[$i]]/$totalMugs[$mugkeys[$i]]);
                    ?>
                    regulars[<?php echo $i;?>] = <?php echo round($allStores,2);?>;
                    <?php
                }
                else
                {
                    ?>
                    regulars[<?php echo $i;?>] = 0;
                    <?php
                }
            }
        }
        if(isset($Irregulars))
        {
            for($i = 0;$i<count($Irregulars['irregularCheckins']); $i++)
            {
                $mugkeys = array_keys($totalMugs);
                if($totalMugs[$mugkeys[$i]] != 0)
                {
                    $checkinKeys = array_keys($Irregulars['irregularCheckins']);
                    $allStores = ((int)$Irregulars['irregularCheckins'][$checkinKeys[$i]]/$totalMugs[$mugkeys[$i]]);
                    ?>
                    irregulars[<?php echo $i;?>] = <?php echo round($allStores,2);?>;
                    <?php
                }
                else
                {
                    ?>
                        irregulars[<?php echo $i;?>] = 0;
                    <?php
                }
            }
        }
        if(isset($lapsers))
        {
            for($i = 0;$i<count($lapsers['lapsers']); $i++)
            {
                $mugkeys = array_keys($totalMugs);
                if($totalMugs[$mugkeys[$i]] != 0)
                {
                    $checkinKeys = array_keys($lapsers['lapsers']);
                    $allStores = ((int)$lapsers['lapsers'][$checkinKeys[$i]]/$totalMugs[$mugkeys[$i]]);
                    ?>
                    lapsers[<?php echo $i;?>] = <?php echo round($allStores,2);?>;
                    <?php
                }
                else
                {
                    ?>
                        lapsers[<?php echo $i;?>] = 0;
                    <?php
                }
            }
        }

        //Graph points
        if(isset($graph['avgChecks']))
        {
            ?>
            graph_avg[0] = [];
            graph_avg[1] = [];
            graph_avg[2] = [];
            graph_avg[3] = [];
            <?php
            for($i = 0;$i<count($graph['avgChecks']); $i++)
            {
                $graphVals = explode(',',$graph['avgChecks'][$i]);
                for($j=0;$j<count($graphVals);$j++)
                {
                    if(isset($graphVals[$j]))
                    {
                        ?>
                        graph_avg[<?php echo $j;?>].push(<?php echo $graphVals[$j];?>);
                        <?php
                    }
                }
            }
        }
        if(isset($graph['regulars']))
        {
            ?>
            graph_regulars[0] = [];
            graph_regulars[1] = [];
            graph_regulars[2] = [];
            graph_regulars[3] = [];
            <?php
            for($i = 0;$i<count($graph['regulars']); $i++)
            {
                $graphVals = explode(',',$graph['regulars'][$i]);
                for($j=0;$j<count($graphVals);$j++)
                {
                        if(isset($graphVals[$j]))
                        {
                            ?>
                            graph_regulars[<?php echo $j;?>].push(<?php echo $graphVals[$j];?>);
                            <?php
                        }
                }
            }
        }
        if(isset($graph['irregulars']))
        {
            ?>
            graph_irregulars[0] = [];
            graph_irregulars[1] = [];
            graph_irregulars[2] = [];
            graph_irregulars[3] = [];
            <?php
            for($i = 0;$i<count($graph['irregulars']); $i++)
            {
                $graphVals = explode(',',$graph['irregulars'][$i]);
                for($j=0;$j<count($graphVals);$j++)
                {
                    if(isset($graphVals[$j]))
                    {
                        ?>
                            graph_irregulars[<?php echo $j;?>].push(<?php echo $graphVals[$j];?>);
                        <?php
                    }
                }
            }
        }
        if(isset($graph['lapsers']))
        {
            ?>
            graph_lapsers[0] = [];
            graph_lapsers[1] = [];
            graph_lapsers[2] = [];
            graph_lapsers[3] = [];
            <?php
            for($i = 0;$i<count($graph['lapsers']); $i++)
            {
                $graphVals = explode(',',$graph['lapsers'][$i]);
                for($j=0;$j<count($graphVals);$j++)
                {
                    if(isset($graphVals[$j]))
                    {
                        ?>
                            graph_lapsers[<?php echo $j;?>].push(<?php echo $graphVals[$j];?>);
                        <?php
                    }
                }
            }
        }
        if(isset($graph['labelDate']))
        {
            for($i = 0;$i<count($graph['labelDate']); $i++)
            {
                ?>
                graph_labels.push('<?php echo $graph['labelDate'][$i];?>');
                <?php
            }
        }
        if(isset($weeklyFeed) && myIsMultiArray($weeklyFeed))
        {
            ?>
            feed_locs[0] = [];
            feed_locs[1] = [];
            feed_locs[2] = [];
            feed_locs[3] = [];
            <?php
            foreach($weeklyFeed as $key => $row)
            {
                $feedLocs = explode(',',$row['feeds']);
                for($j=0;$j<count($feedLocs);$j++)
                {
                    if(isset($feedLocs[$j]))
                    {
                        ?>
                            feed_locs[<?php echo $j;?>].push(<?php echo $feedLocs[$j];?>);
                        <?php
                    }
                }
                ?>
                    feed_labels.push('<?php echo $row['labelDate'];?>');
                <?php
            }
        }
    ?>


    $(window).load(function(){
        var selectedLoc = Number($('#location').val());

        //Total Checkins
        totalChecksBar = new ProgressBar.Circle('#totalCheckins-container', {
            strokeWidth: 6,
            easing: 'easeInOut',
            duration: 1000,
            color: '#ACEC00',
            trailWidth: 6,
            step: function(state, circle) {
                var value = circle.value().toFixed(2);
                if (value === 0) {
                    circle.setText('');
                } else {
                    circle.setText(value);
                }

            }
        });
        totalChecksBar.text.style.fontSize = '2em';
        totalChecksBar.animate(totalCheckins[selectedLoc]);

        //Average Checkins
        avgChecksBar = new ProgressBar.Circle('#avgCheckins-container', {
            strokeWidth: 6,
            easing: 'easeInOut',
            duration: 1000,
            color: '#ACEC00',
            trailWidth: 6,
            step: function(state, circle) {
                var value = circle.value().toFixed(2);
                if (value === 0) {
                    circle.setText('');
                } else {
                    circle.setText(value);
                }

            }
        });
        avgChecksBar.text.style.fontSize = '2em';
        avgChecksBar.animate(avgCheckins[selectedLoc]);  // Value from 0.0 to 1.0

        //Regulars
        regularsBar = new ProgressBar.Circle('#regulars-container', {
            strokeWidth: 6,
            easing: 'easeInOut',
            duration: 1000,
            color: '#00BBD6',
            trailWidth: 6,
            step: function(state, circle) {
                var value = Math.round(circle.value() * 100);
                if (value === 0) {
                    circle.setText('');
                } else {
                    circle.setText(value+'%');
                }

            }
        });
        regularsBar.text.style.fontSize = '2em';
        regularsBar.animate(regulars[selectedLoc]);  // Value from 0.0 to 1.0

        //Irregulars
        irregularsBar = new ProgressBar.Circle('#irregulars-container', {
            strokeWidth: 6,
            easing: 'easeInOut',
            duration: 1000,
            color: '#BA65C9',
            trailWidth: 6,
            step: function(state, circle) {
                var value = Math.round(circle.value() * 100);
                if (value === 0) {
                    circle.setText('');
                } else {
                    circle.setText(value+'%');
                }

            }
        });
        irregularsBar.text.style.fontSize = '2em';
        irregularsBar.animate(irregulars[selectedLoc]);  // Value from 0.0 to 1.0

        //Lapsers
        lapsersBar = new ProgressBar.Circle('#lapsers-container', {
            strokeWidth: 6,
            easing: 'easeInOut',
            duration: 1000,
            color: '#EF3C79',
            trailWidth: 6,
            step: function(state, circle) {
                var value = Math.round(circle.value() * 100);
                if (value === 0) {
                    circle.setText('');
                } else {
                    circle.setText(value+'%');
                }

            }
        });
        lapsersBar.text.style.fontSize = '2em';
        lapsersBar.animate(lapsers[selectedLoc]);  // Value from 0.0 to 1.0

        <?php
            if($this->userType == ADMIN_USER)
            {
                ?>
                    setTimeout(saveDashBoardRecord(),5000);
                <?php
            }
        ?>
    });
    function joinObjectArray(AssocArray)
    {
        var s = '';
        for (var i in AssocArray) {
            s += AssocArray[i] + ", ";
        }
        return s.substring(0, s.length-2);
    }
    function saveDashBoardRecord()
    {
        var postData = {
            'avgCheckins': joinObjectArray(avgCheckins),
            'regulars': joinObjectArray(regulars),
            'irregulars': joinObjectArray(irregulars),
            'lapsers': joinObjectArray(lapsers),
            'insertedDate': $('#endDate').val()
        };

        $.ajax({
            type:"POST",
            dataType:"json",
            data: postData,
            url:'<?php echo base_url();?>dashboard/save',
            success: function(data)
            {

            },
            error: function(){

            }
        });
    }

    function refreshBars(ele)
    {
        var selectedLoc = Number($(ele).val());
        totalChecksBar.animate(totalCheckins[selectedLoc]);
        avgChecksBar.animate(avgCheckins[selectedLoc]);
        regularsBar.animate(regulars[selectedLoc]);
        irregularsBar.animate(irregulars[selectedLoc]);
        lapsersBar.animate(lapsers[selectedLoc]);
        refreshGraphs();
    }
    $(document).ready(function(){
        var thArray = ['overall-th','bandra-th','andheri-th'];
        var tdArray = ['overall-td','bandra-td','andheri-td'];
        for(var i=0;i<thArray.length;i++)
        {
            $('.'+thArray[i]).addClass('hide');
            $('.'+tdArray[i]).addClass('hide');
        }
        $('#location option').each(function(i,val){
            var index = Number($(val).attr('value'));
            $('.'+thArray[index]).removeClass('hide');
            $('.'+tdArray[index]).removeClass('hide');
        });
        drawGraphs();
        drawFeedGraph();
    });

    $(document).on('submit', '#customDateForm', function(e){

        e.preventDefault();
        if($('input[name="startDate"]').val() == '')
        {
            $('input[name="startDate"]').focus();
            return false;
        }
        if($('input[name="endDate"]').val() == '')
        {
            $('input[name="endDate"]').focus();
            return false;
        }
        showCustomLoader();
        $.ajax({
            type:'POST',
            dataType:'json',
            url:$(this).attr('action'),
            data: $(this).serialize(),
            success: function(data)
            {
                hideCustomLoader();
                var checkinKeys,mugKeys,calcValue,i;
                mugKeys = Object.keys(data.totalMugs);
                if(typeof data.avgChecks != 'undefined')
                {
                    checkinKeys = Object.keys(data.avgChecks.checkInList);
                    for(i=0;i<Object.keys(data.avgChecks.checkInList).length;i++)
                    {
                        calcValue = Number(data.avgChecks.checkInList[checkinKeys[i]])/data.totalMugs[mugKeys[i]];
                        totalCheckins[i] = Number(data.avgChecks.checkInList[checkinKeys[i]]);
                        avgCheckins[i] = Number(calcValue.toFixed(2));
                    }
                }
                if(typeof data.Regulars != 'undefined')
                {
                    checkinKeys = Object.keys(data.Regulars.regularCheckins);
                    for(i=0;i<Object.keys(data.Regulars.regularCheckins).length;i++)
                    {
                        calcValue = Number(data.Regulars.regularCheckins[checkinKeys[i]])/data.totalMugs[mugKeys[i]];
                        regulars[i] = Number(calcValue.toFixed(2));
                    }
                }
                if(typeof data.Irregulars != 'undefined')
                {
                    checkinKeys = Object.keys(data.Irregulars.irregularCheckins);
                    for(i=0;i<Object.keys(data.Irregulars.irregularCheckins).length;i++)
                    {
                        calcValue = Number(data.Irregulars.irregularCheckins[checkinKeys[i]])/data.totalMugs[mugKeys[i]];
                        irregulars[i] = Number(calcValue.toFixed(2));
                    }
                }
                if(typeof data.lapsers != 'undefined')
                {
                    checkinKeys = Object.keys(data.lapsers.lapsers);
                    for(i=0;i<Object.keys(data.lapsers.lapsers).length;i++)
                    {
                        calcValue = Number(data.lapsers.lapsers[checkinKeys[i]])/data.totalMugs[mugKeys[i]];
                        lapsers[i] = Number(calcValue.toFixed(2));
                    }
                }
                refreshBars($('#location'));
                $('.overall-td').each(function(i,val){
                    switch(i)
                    {
                        case 0:
                            $(this).html(avgCheckins[0]);
                            break;
                        case 1:
                            $(this).html(regulars[0]);
                            break;
                        case 2:
                            $(this).html(irregulars[0]);
                            break;
                        case 3:
                            $(this).html(lapsers[0]);
                            break;
                    }
                });
                $('.andheri-td').each(function(i,val){
                    switch(i)
                    {
                        case 0:
                            $(this).html(avgCheckins[2]);
                            break;
                        case 1:
                            $(this).html(regulars[2]);
                            break;
                        case 2:
                            $(this).html(irregulars[2]);
                            break;
                        case 3:
                            $(this).html(lapsers[2]);
                            break;
                    }
                });
                $('.bandra-td').each(function(i,val){
                    switch(i)
                    {
                        case 0:
                            $(this).html(avgCheckins[1]);
                            break;
                        case 1:
                            $(this).html(regulars[1]);
                            break;
                        case 2:
                            $(this).html(irregulars[1]);
                            break;
                        case 3:
                            $(this).html(lapsers[1]);
                            break;
                    }
                });
            },
            error: function()
            {
                hideCustomLoader();
                bootbox.alert('Some Error Occurred!');
            }
        });

    });

    //Graph Generation
    function getConfig(color,dataSet,title)
    {
        var config = {
            type: 'line',
            data: {
                labels: graph_labels,
                datasets: [
                    {
                        label: title,
                        fill: false,
                        lineTension: 0.1,
                        backgroundColor: color,
                        borderColor: color,
                        borderCapStyle: 'butt',
                        borderDash: [],
                        borderDashOffset: 0.0,
                        borderJoinStyle: 'miter',
                        pointBorderColor: color,
                        pointBackgroundColor: "#fff",
                        pointBorderWidth: 1,
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: color,
                        pointHoverBorderWidth: 2,
                        pointRadius: 1,
                        pointHitRadius: 10,
                        data: dataSet
                    }
                ]
            },
            options: {
                responsive: true,
                hover: {
                    mode: 'label'
                }
            }
        };
        return config;
    }

    function getConfigFeed(color,dataSet,title)
    {
        var config1 = {
            type: 'line',
            data: {
                labels: feed_labels,
                datasets: [
                    {
                        label: title,
                        fill: false,
                        lineTension: 0.1,
                        backgroundColor: color,
                        borderColor: color,
                        borderCapStyle: 'butt',
                        borderDash: [],
                        borderDashOffset: 0.0,
                        borderJoinStyle: 'miter',
                        pointBorderColor: color,
                        pointBackgroundColor: "#fff",
                        pointBorderWidth: 1,
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: color,
                        pointHoverBorderWidth: 2,
                        pointRadius: 1,
                        pointHitRadius: 10,
                        data: dataSet
                    }
                ]
            },
            options: {
                responsive: true,
                hover: {
                    mode: 'label'
                }
            }
        };
        return config1;
    }


    function drawGraphs()
    {
        var selectedLoc = Number($('#location').val());
        var avgCanvas = document.getElementById("avgChecks-canvas").getContext("2d");
        window.avgLine = new Chart(avgCanvas, getConfig('#ACEC00',graph_avg[selectedLoc],'Avg Check-Ins'));

        var regularCanvas = document.getElementById("regulars-canvas").getContext("2d");
        window.regLine = new Chart(regularCanvas, getConfig('#00BBD6',graph_regulars[selectedLoc],'Regulars'));

        var irregularCanvas = document.getElementById("irregulars-canvas").getContext("2d");
        window.irregLine = new Chart(irregularCanvas, getConfig('#BA65C9',graph_irregulars[selectedLoc],'Irregulars'));

        var lapsersCanvas = document.getElementById("lapsers-canvas").getContext("2d");
        window.lapLine = new Chart(lapsersCanvas, getConfig('#EF3C79',graph_lapsers[selectedLoc],'Lapsers'));
    }
    function drawFeedGraph()
    {
        var selectedLoc = Number($('#location-feed').val());
        var feedWeekCanvas = document.getElementById("feedWeekly-canvas").getContext("2d");
        window.feedLine = new Chart(feedWeekCanvas, getConfigFeed('#EF3C79',feed_locs[selectedLoc],'Weekly Feedback'));
    }
    function refreshGraphs()
    {
        var selectedLoc = Number($('#location').val());
        window.avgLine.config.data.datasets[0].data = graph_avg[selectedLoc];
        window.avgLine.update();

        window.regLine.config.data.datasets[0].data = graph_regulars[selectedLoc];
        window.regLine.update();

        window.irregLine.config.data.datasets[0].data = graph_irregulars[selectedLoc];
        window.irregLine.update();

        window.lapLine.config.data.datasets[0].data = graph_lapsers[selectedLoc];
        window.lapLine.update();
    }
    function refreshFeeds()
    {
        var selectedLoc = Number($('#location-feed').val());
        window.feedLine.config.data.datasets[0].data = feed_locs[selectedLoc];
        window.feedLine.update();
    }

    $(document).on('change','input[name="dashboardStats"]', function(){
        toggleGraphs($(this));
    });
    function toggleGraphs(ele)
    {
        $('.mygraphs').hide();
        if($(ele).val() == 1)
        {
            $('#avgChecks-canvas').show("slow");
        }
        else if($(ele).val() == 2)
        {
            $('#regulars-canvas').show("slow");
        }
        else if($(ele).val() == 3)
        {
            $('#irregulars-canvas').show("slow");
        }
        else
        {
            $('#lapsers-canvas').show("slow");
        }
    }
    toggleGraphs('input[name="dashboardStats"]');
</script>

<!-- Instamojo scripts -->
<script>
    var dialog = document.querySelector('dialog');
    if (! dialog.showModal) {
        dialogPolyfill.registerDialog(dialog);
    }
    $(document).on('click','.confirm-btn', function(){
        dialog.showModal();
    });
    dialog.querySelector('.close').addEventListener('click', function() {
        dialog.close();
    });

    function changeCurrent(ele)
    {
        $('#selectedMug').val($(ele).attr('data-id'));
        $('#mugPaymentId').val($(ele).attr('data-paymentId'));
        $('#mugEmail').val($(ele).attr('data-email'));
        $('#mugNum').val($(ele).attr('data-mugId'));
    }

    $(document).on('click','.agree_btn',function () {
        var selectedCard = $('#selectedMug').val();
        var paymentId = $('#mugPaymentId').val();
        var mugEmail = $('#mugEmail').val();
        var mugNum = $('#mugNum').val();

        var postData = {
            "mugId": mugNum,
            "invoiceNo": paymentId,
            "mugEmail":mugEmail
        };

        $.ajax({
            type:"POST",
            dataType:"json",
            url:"<?php echo base_url();?>mugclub/mugRenew/json",
            data:postData,
            success: function(data)
            {
                if(data.status === true)
                {
                    $.ajax({
                        type:"POST",
                        dataType: "json",
                        url:"<?php echo base_url();?>dashboard/instadone/json/"+selectedCard,
                        success: function(data) {
                            if(data.status === true)
                            {

                            }
                            else
                            {
                                bootbox.alert('Try again later!');
                            }
                        },
                        error: function(){
                            bootbox.alert('Some Error Occurred!');
                        }
                    });
                    $('.my-instaCard').each(function(i,val){
                        if($(val).attr('data-id') == selectedCard)
                        {
                            dialog.close();
                            $(this).fadeOut("fast");
                            return false;
                        }
                    });
                }
                else
                {
                    bootbox.alert('Try again later!');
                }
            },
            error: function()
            {
                bootbox.alert('Some Error Occurred!');
            }
        });

    });


</script>

<!-- Feedback javascript-->
<script>
    var lastFormNumber = 0;
    var feedbacks = {};
    $(document).on('submit','#feedback-form', function(e){
        e.preventDefault();
        showCustomLoader();
        $.ajax({
            type:'POST',
            dataType:'json',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(data)
            {
                hideCustomLoader();
                if(data.status == true)
                {
                    bootbox.alert('Feedback Saved', function(){
                        window.location.reload();
                    });
                }
                else
                {
                    window.location.href=data.pageUrl;
                }
            },
            error: function(){
                hideCustomLoader();
                bootbox.alert('Some Error Occurred!');
            }
        });
    });
    $(document).ready(function(){
        $('#genBtn').attr('disabled', true);
    });

    $(document).on('keyup','#feedbackNum', function(){
        if($(this).val() != '' && $(this).val() != 0 && $(this).val() > 0 && $(this).val() < 51)
        {
            $('#genBtn').removeAttr('disabled');
        }
        else
        {
            $('#genBtn').attr('disabled', true);
        }
    });

    $(document).on('click','#genBtn',function(){
        genFeedForm($('#feedbackNum').val());
        $('#feedbackNum').val('');
        $(this).html('Add More');
    });
    function genFeedForm(formLength)
    {
        for(var i = 0; i<formLength;i++)
        {
            var formHtml = '<div class="mdl-grid myFormWrapper">';
            //formHtml += '<ul class="list-inline">';
            formHtml += '<div class="mdl-cell mdl-cell--6-col"><div class="btn-group btn-group-sm">';
            for(var j=1;j<=10;j++)
            {
                if(j==10)
                {
                    formHtml += '<label class="btn btn-default mdl-radio mdl-js-radio mdl-js-ripple-effect">'+
                        '<input type="radio" class="mdl-radio__button" name="overallRating['+lastFormNumber+']" value="'+j+'" checked/>'+
                        '<span class="mdl-radio__label">'+j+'</span>'+
                        '</label>';
                }
                else
                {
                    formHtml += '<label class="btn btn-default mdl-radio mdl-js-radio mdl-js-ripple-effect">'+
                        '<input type="radio" class="mdl-radio__button" name="overallRating['+lastFormNumber+']" value="'+j+'"/>'+
                        '<span class="mdl-radio__label">'+j+'</span>'+
                        '</label>';
                }

            }
            formHtml += '</div></div>';
            formHtml += '<div class="mdl-cell mdl-cell--3-col">';
            formHtml += '<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect">'+
                            '<input type="radio" class="mdl-radio__button" name="userGender['+lastFormNumber+']" value="M" checked/>'+
                            '<span class="mdl-radio__label">Male</span>'+
                        '</label>';
            formHtml += '<label class=" mdl-radio mdl-js-radio mdl-js-ripple-effect">'+
                            '<input type="radio" class="mdl-radio__button" name="userGender['+lastFormNumber+']" value="F"/>'+
                            '<span class="mdl-radio__label">Female</span>'+
                        '</label></div>';
            formHtml += '<div class="mdl-cell mdl-cell--3-col"><div class="mdl-textfield mdl-js-textfield">'+
                        '<input class="mdl-textfield__input" name="userAge['+lastFormNumber+']" type="number" min="21" id="age">'+
                        '<label class="mdl-textfield__label" for="age">Age</label>'+
                        '</div></div>';
            formHtml += '<input type="hidden" name="feedbackLoc['+lastFormNumber+']" value="'+$('#feedbackLoc').val().trim()+'"/>';
            formHtml += '<button type="button" onclick="removeThis(this)" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect">Remove</button></div>';

            $('#feedback-form .form-super-container').append(formHtml);
            lastFormNumber++;
        }
        if($('#feedback-form button[type="submit"]').hasClass('hide'))
        {
            $('#feedback-form button[type="submit"]').removeClass('hide');
        }
    }

    function removeThis(ele)
    {
        $(ele).parent().animate({
            opacity:0
        },300, function(){
            $(ele).parent().remove();
        });
    }

</script>

<script>
    CKEDITOR.replace( 'itemDesc' );
    function toggleHalf(ele)
    {
        if($(ele).is(':checked'))
        {
            $('.priceHalfCls').removeClass('hide');
        }
        else
        {
            $('.priceHalfCls').addClass('hide');
        }
    }
    var upPanel = 1;
    function addUploadPanel()
    {
        /*'<br><br><label>Attachment Type :</label>'+
        '<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="attFood'+upPanel+'">'+
        '<input type="radio" id="attFood'+upPanel+'" class="mdl-radio__button" name="attType['+upPanel+']" value="1" checked>'+
        '<span class="mdl-radio__label">Food</span>'+
        '</label>'+
        '<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="attBeer'+upPanel+'">'+
        '<input type="radio" id="attBeer'+upPanel+'" class="mdl-radio__button" name="attType['+upPanel+']" value="2">'+
        '<span class="mdl-radio__label">Beer Digital</span>'+
        '</label>'+
        '<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="attBeerW'+upPanel+'">'+
        '<input type="radio" id="attBeerW'+upPanel+'" class="mdl-radio__button" name="attType['+upPanel+']" value="3">'+
        '<span class="mdl-radio__label">Beer Woodcut</span>'+
        '</label>'+*/
        var html = '';
        html += '<br><br><input type="file" multiple class="form-control" onchange="uploadChange(this)" /><br>'+
                '<button onclick="addUploadPanel()" type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Another?</button>';
        upPanel++;
        $('.myUploadPanel').append(html);
    }
    var filesArr = [];
    function uploadChange(ele)
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
            xhr[i].open('post', '<?php echo base_url();?>dashboard/uploadFiles', true);

            var data = new FormData;
            data.append('attachment', ele.files[i]);
            data.append('itemType',$('input[name="itemType"]:checked').val());
            xhr[i].send(data);
            xhr[i].onreadystatechange = function(e) {
                if (e.srcElement.readyState == 4 && e.srcElement.status == 200) {
                    if(e.srcElement.responseText == 'Some Error Occurred!')
                    {
                        bootbox.alert('File size Limit 30MB');
                        return false;
                    }
                    filesArr.push(e.srcElement.responseText);
                }
            }
        }
    }
    function fillImgs()
    {
        $('input[name="attachment"]').val(filesArr.join());
    }
    $(document).on('click', '.beer-tags', function(){
        $('#beerLoc-modal .modal-body .tagged-locations').empty();
        $('#beerLoc-modal .beer-loc-select ul li').each(function(i,val){
            if($(val).hasClass('hide'))
            {
                $(val).removeClass('hide');
            }
        });
        beerLocs = [];
        var fnbId = $(this).attr('data-fnbId');
        $('#beerLoc-modal #fnbId').val(fnbId);
        showCustomLoader();
        $.ajax({
            type:'GET',
            dataType:"json",
            url:base_url+'/dashboard/beerLocation/'+fnbId,
            success: function(data){
                hideCustomLoader();
                if(data.status === true)
                {
                    var newHtml = '<ul class="list-inline">';
                    for(var i=0;i<data.locData.length;i++)
                    {
                        beerLocs.push(data.locData[i].id);
                        newHtml += '<li class="loc-info" data-value="'+data.locData[i].id+'"><span>'+data.locData[i].locName+'</span>'+
                                '<i class="fa fa-times"></i></li>';
                        $('#beerLoc-modal .beer-loc-select ul li').each(function(h,val){
                            if($(val).attr('data-value') == data.locData[i].id)
                            {
                                $(val).addClass('hide');
                            }

                        });
                    }
                    newHtml += '</ul>';
                    $('#beerLoc-modal .modal-body .tagged-locations').html(newHtml);
                }
                $('#beerLoc-modal').modal('show');
            },
            error: function(){
                hideCustomLoader();
                bootbox.alert('Some Error Occurred!');
            }
        });
    });

    var beerLocs = [];
    $(document).on('click','#beerLoc-modal .beer-loc-select ul li', function(){
        var locVal = $(this).attr('data-value');
        beerLocs.push(locVal);
        $(this).addClass('hide');
        var tagLocHtml = '';
        if($('#beerLoc-modal .modal-body .tagged-locations ul').length == 0)
        {
            tagLocHtml += '<ul class="list-inline"><li class="loc-info" data-value="'+locVal+'"><span>'+$(this).html()+'&nbsp;</span>'+
                    '<i class="fa fa-times"></i></li></ul>';
            $('#beerLoc-modal .modal-body .tagged-locations').html(tagLocHtml);
        }
        else
        {
            tagLocHtml += '<li class="loc-info" data-value="'+locVal+'"><span>'+$(this).html()+'</span>'+
                '<i class="fa fa-times"></i></li>';
            $('#beerLoc-modal .modal-body .tagged-locations ul').append(tagLocHtml);
        }
    });
    $(document).on('click','#beerLoc-modal .loc-info i', function(){
        var locVal = $(this).parent().attr('data-value');
        beerLocs.splice( $.inArray(locVal,beerLocs) ,1 );
        $(this).parent().addClass('hide');

        $('#beerLoc-modal .beer-loc-select ul li').each(function(i,val){
            console.log(locVal);
            if($(val).attr('data-value') == locVal)
            {
                $(val).removeClass('hide');
            }
        });
    });
    $(document).on('click',".save-fnb-tags", function () {
        if(typeof beerLocs[0] != 'undefined')
        {
            showCustomLoader();
            var postData = {'taggedLoc':beerLocs.join(',')};

            $.ajax({
                type:'POST',
                dataType:'json',
                url:base_url+'dashboard/fnbTagSet/'+$('#beerLoc-modal #fnbId').val(),
                data:postData,
                success: function(data){
                    hideCustomLoader();
                    if(data.status === true)
                    {
                        $('#beerLoc-modal').modal('hide');
                    }
                    else
                    {
                        bootbox.alert('Some Error Occurred!');
                    }

                },
                error: function(){
                    hideCustomLoader();
                    bootbox.alert('Some Error Occurred!');
                }
            });
        }
        else
        {
            $('#beerLoc-modal').modal('hide');
        }
    });
</script>

<script>
    //CKEDITOR.replace('eventDescription');
    var date = new Date();
    $('#eventDate').datetimepicker({
        format: 'YYYY-MM-DD',
        minDate: date
    });
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
        if($(this).val() == "2")
        {
            $('.event-price').removeClass('hide');
            $('.special-offer').removeClass('hide');
        }
        else
        {
            $('.event-price').addClass('hide');
            $('.special-offer').addClass('hide');
        }
    });
    
    var filesEventsArr = [];
    function eventUploadChange(ele)
    {

        $('#eventpanel button[type="submit"]').attr('disabled','true');
        $('#eventpanel .progress').removeClass('hide');
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
                $('#eventpanel button[type="submit"]').removeAttr('disabled');
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

    function fillEventImgs()
    {
        $('#eventpanel input[name="attachment"]').val(filesEventsArr.join());
    }
    $('#main-event-table, #main-fnb-table').DataTable({
        "ordering": false
    });
    $('[data-toggle="tooltip"]').tooltip();
    $(document).on('click','.view-photos', function(){
        var pics = $(this).attr('data-imgs').split(',');
        if(typeof pics != 'undefined')
        {
            var newPics = [];
            for(var i=0;i<pics.length;i++)
            {
                var temp = {href:pics[i],title:''};
                newPics[i] = temp;
            }
            $.swipebox( newPics );
        }
    });
    $(document).on('click','.eventDelete-icon',function(){
        var mugId = $(this).attr('data-eventId');
        bootbox.confirm("Are you sure you want to delete event #"+mugId+" ?", function(result) {
            if(result === true)
            {
                window.location.href='<?php echo base_url();?>dashboard/deleteEvent/'+mugId;
            }
        });
    });
    $(document).on('click','.eventCompletedDelete-icon',function(){
        var mugId = $(this).attr('data-eventId');
        bootbox.confirm("Are you sure you want to delete event #"+mugId+" ?", function(result) {
            if(result === true)
            {
                window.location.href='<?php echo base_url();?>dashboard/deleteCompEvent/'+mugId;
            }
        });
    });
    $(document).on('click','.fnbDelete-icon',function(){
        var mugId = $(this).attr('data-fnbId');
        bootbox.confirm("Are you sure you want to delete Item #"+mugId+" ?", function(result) {
            if(result === true)
            {
                window.location.href='<?php echo base_url();?>dashboard/deleteFnb/'+mugId;
            }
        });
    });
</script>
</html>