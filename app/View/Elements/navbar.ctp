<div class='nav-bottom text-center'>
    <ul class="nav nav-tabs justify-content-center">
        <li class="nav-item">
            <a class="nav-link <?php echo(isset($composeActive)?  $composeActive: '') ?>" 
                href="<?php echo Router::url(['controller' => 'messages', 'action' => 'compose']);?>">
                Compose
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo(isset($messageListActive)?  $messageListActive: '') ?>" 
                href="<?php echo Router::url(['controller' => 'messages', 'action' => 'list']);?>">
                Messages List
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo(isset($profileActive)?  $profileActive: '') ?>" 
                href="<?php echo Router::url(['controller' => 'users', 'action' => 'profile']);?>">
                Profile
            </a>

        </li>
    </ul>
</div>  