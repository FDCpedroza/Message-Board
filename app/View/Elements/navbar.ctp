<div class='nav-bottom text-center'>
<ul class="nav nav-tabs justify-content-center">
    <li class="nav-item">
        <a class="nav-link <?php echo(isset($composeActive)?  $composeActive: '') ?>" href="/cake-msg/messages/compose">Compose</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo(isset($messageListActive)?  $messageListActive: '') ?>" href="/cake-msg/messages/list">Messages List</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo(isset($profileActive)?  $profileActive: '') ?>" href="/cake-msg/users/profile">Profile</a>
    </li>
</ul>
</div>  