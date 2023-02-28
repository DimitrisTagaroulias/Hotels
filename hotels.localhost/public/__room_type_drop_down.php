<div id="room-type-container" class="drop-down-container hidden">
    <div id="room-type-drop-header" class="drop-header">
        <span class="emptySpan unused"></span>
        <span>Room Type</span>
        <i class="fa-solid fa-chevron-up"></i>
    </div>

    <input 
    id="room-type-input" 
    class="drop-input" 
    type="text" 
    name="room-type-title"
    placeholder="Select Room Type"
    value=
    "<?php echo !empty($_REQUEST['room-type-title']) ? $_REQUEST['room-type-title'] :"";?>"
    readonly
    >

    <ul class="drop-down-inner">
        <?php foreach ($allTypes as $roomType) :?>
            <li 
            class="option" 
            data-value="<?php echo $roomType['type_id']?>"
            >
            <?php echo $roomType['title'];?>
            </li>
        <?php endforeach ?>
    </ul> 
</div>