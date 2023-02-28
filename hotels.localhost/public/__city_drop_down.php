<div id="city-container" class="drop-down-container hidden">
    <div id="city-drop-header" class="drop-header">
        <span class="emptySpan unused"></span>
        <span>City</span>
        <i class="fa-solid fa-chevron-up"></i>
    </div>
    
    <input 
    id="city-input" 
    class="drop-input" 
    type="text"
    placeholder="Select a City"
    value=
    "<?php echo !empty($_REQUEST['city']) ? $_REQUEST['city'] :"";?>"
    readonly
    >

    <ul class="drop-down-inner">
        <?php foreach ($cities as $city) :?>
            <li 
            class="option" 
            data-value="<?php echo $city?>"
            >
            <?php echo $city?>
            </li>
        <?php endforeach ?>
    </ul> 
</div>