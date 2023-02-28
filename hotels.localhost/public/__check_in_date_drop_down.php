<div id="check-in-date-container" class="drop-down-container hidden">
    <div id="check-in-date-drop-header" class="drop-header">
        <span class="emptySpan unused"></span>
        <span >Check in date</span>
        <i class="fa-solid fa-chevron-up"></i>
    </div>

    <input id="check-in-date-input" data-value="<?php echo $dates ? $_REQUEST['check-in-date']: "";?>" name="check-in-date" class="drop-input date-input" type="text" placeholder="Check in date..." >
    
    <div class="date-error " >
        <p class="error-date-type hidden">Date must be "dd-mm-yyyy"</p>
        <p class="error-same-date <?php echo empty($_REQUEST['dates_error'])? "hidden" : "" ?>">Check in date must be earlier than check out date!
        </p>
    </div>
    
    <div id="check-in-date-picker" class="datepicker"></div>
</div>
