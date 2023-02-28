<div id="guests-container" class="drop-down-container hidden">
    <div id="guests-drop-header" class="drop-header">
        <span class="emptySpan unused"></span>
        <span>Count of Guests</span>
        <i class="fa-solid fa-chevron-up"></i>
    </div>

    <input 
    id="guests-input" 
    class="drop-input" 
    type="text" 
    name="count-of-guests"
    placeholder="Select Count of Guests"
    readonly
    >

    <ul class="drop-down-inner">
        <?php foreach ($countOfGuests as $countOfGuest) :?>
            <li 
            class="option" 
            data-value="<?php echo $countOfGuest?>"
            >
            <?php echo $countOfGuest;?>
            </li>
        <?php endforeach ?>
    </ul> 
</div>