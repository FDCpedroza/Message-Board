<?php 
    $this->extend('/Layouts/card');
    echo $this->element('navbar');
    echo $this->html->css('navbar');
    
    $datetime1 = new DateTime($person['birthdate']);
    $now = new DateTime();
    $interval = $now->diff($datetime1);
    $age = $interval->y;
    
?>
<div class='text-center'>

<?php
        $avatar = 'https://ui-avatars.com/api/?name='.$person['name'];
        if($person['image']){
            $avatar = $person['image'];
        }
        echo $this->Html->image($avatar , 
            array(
                'id' => 'user-avatar',
                'class' => 'rounded-circle',
                'alt' => 'CakePHP',
                'style' => 'width:100px; 
                height:100px;'
                )
        );
?> 
<br>
<br>
<h4><?php if($age) { echo $person['name'].", ".$age;} else { echo $person['name'];}?></h4>
</div>
<hr>
<br>
<br>

<div> 
    <div class="row">
        <div class="col-3">Name:</div>
        <div class="col-9">
            <?php echo $person['name'];?>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-3">Gender:</div>
        <div class="col-9"><?php echo ($person['gender']? ($person['gender'] == 1? 'Male': 'Female') : 'User not Updated') ?></div>
    </div>
    <br>
    <div class="row">
        <div class="col-3">Joined:</div>
        <div class="col-9"><?php echo date('F j, Y ga',strtotime($person['created'])); ?></div>
    </div>
    <br>
    <div class="row">
        <div class="col-3">Last Login:</div>
        <div class="col-9"><?php echo ($person['last_login_time']? date('F j, Y ga',strtotime($person['last_login_time'])): 'Registered but not yet logged in'); ?></div>
    </div>
    <br>
    <div class="row">
        <div class="col-3">Hubby:</div>
        <div class="col-9"><?php echo ($person['hubby']? $person['hubby']: 'User not Updated') ?></div>
    </div>
</div>