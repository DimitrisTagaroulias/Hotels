<div id="check-out-date-container" class="drop-down-container hidden">
    <div id="check-out-date-drop-header" class="drop-header">
        <span class="emptySpan unused"></span>
        <span>Check out date</span>
        <i class="fa-solid fa-chevron-up"></i>
    </div>

    <input id="check-out-date-input" data-value="<?php echo $dates ? $_REQUEST['check-out-date'] : "";?>" name="check-out-date" class="drop-input date-input" type="text" placeholder="Check in date..." >

    <div class="date-error" >
        <p class="error-date-type hidden">Date must be "dd-mm-yyyy"</p>
        <p class="error-same-date <?php echo empty($_REQUEST['dates_error'])? "hidden" : "" ?>">Check out date must be later than check in date!
        </p>
    </div>
    <div id="check-out-date-picker" class="datepicker"></div>
</div>
