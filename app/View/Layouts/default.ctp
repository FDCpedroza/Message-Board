<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1><?php echo $this->Html->link($cakeDescription, 'https://cakephp.org'); ?></h1>
		</div>
		<div id="content">
			<?php
				if (AuthComponent::user()){
					// user is logged in, show logout..user menu etc
					echo $this->Html->link('Logout', 
						array('controller' => 'users', 'action' => 'logout'),
						array('style' => 'float:right; ')
					); 
					echo $this->Html->link('Message List', 
						array('controller' => 'messages', 'action' => 'list'),
						array('style' => 'float:right; margin-right:30px;')
					); 
					
					$avatar = 'https://ui-avatars.com/api/?name='.AuthComponent::user()['name'];
                    if(!AuthComponent::user()['image']){
                        $avatar = AuthComponent::user()['image'];
                    }
                    echo $this->Html->image($avatar , 
                                        array(
                                            'alt' => 'CakePHP',
                                            'style' => 'width:50px; 
														height:50px;
														float:left;'
                                            )
                                        );
					echo $this->html->tag('span', AuthComponent::user()['name'], ['style' => 'float:left; padding-top:1%;']);
					
				
				 }
			?>
	<br><br>
	<br><hr><br><br>
			<?php echo $this->Flash->render(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'https://cakephp.org/',
					array('target' => '_blank', 'escape' => false, 'id' => 'cake-powered')
				);
			?>
			<p>
				<?php echo $cakeVersion; ?>
			</p>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
