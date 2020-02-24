<?php
if ($pupils[0]['Pupil_id'] != "") {
    $account_name = $pupils[0]['Account_firstname'] . " " . $pupils[0]['Account_surname'];
    ?>
    <span class='graytitle'><?php echo $account_name ?> account
    <a href='account/view/<?php echo $account_id ?>'>[view]</a>
    </span><br>
    <?php
    foreach($pupils as $pupil) {
        ?>
        <ul class='pageitem'>
        <li class='menu'><a href='pupil/update/<?php echo $pupil['Pupil_id'] ?>/<?php echo $account_id ?>'><span class='name'><?php echo $pupil['Pupil_first_name'] . " " . $pupil['Pupil_surname'] ?></span><span class='arrow'></span></a></li>
        <li class='textbox'>
        <span class='name'>
        <b>Date of birth: </b><?php echo $pupil['dob'] ?><br/>
        <b>Enrolment date: </b><?php echo $pupil['enrolment'] ?>
        </span>
        </li>
        <li class='textbox'>
        <span class='name'>
        <b>Classes:</b><br/><br/>
        <?php
        $query   = $this->db->get_where('view_register', array('pupil_id' => $pupil['Pupil_id']));
        $classes = $query->result_array();
        if (isset($classes)) {
            foreach($classes as $class) {
                ?>
                <a href='pupil/delclass/<?php echo $class['Register_id'] ?>/<?php echo $account_id ?>'><img src='assets/images/delete.gif'></a>
                <?php echo $class['Classes_name'] . ", " . $class['day'] . " " . $class['time'] . " @ " . $class['Venue_name'] ?><br/><br/>
                <?php
            }
        }
        ?>
        </span>
        </li>
        <li class='menu'><a href='pupil/addclass/<?php echo $pupil['Pupil_id'] ?>/<?php echo $account_id ?>'><span class='name'>Add class</span><span class='arrow'></span></a></li>
        </ul>
        <?php
    }
}
?>
<ul class='pageitem'>
<li class='menu'><a href='pupil/add/<?php echo $account_id ?>'><span class='name'>Add pupil to account</span><span class='arrow'></span></a></li>
</ul>