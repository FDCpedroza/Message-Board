
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4"></div>
                    <div class="col-lg-4">
                        <div class="card mt-3" style='height:90vh; soverflow:auto'>
                            <div class="card-header">
                                <div class='row align-items-center ml-1'>
                                <?php if(AuthComponent::user()): ?>
                                    <?php
                                        $avatar = 'https://ui-avatars.com/api/?name='.AuthComponent::user()['name'];
                                        if(AuthComponent::user()['image']){
                                            $avatar = AuthComponent::user()['image'];
                                        }
                                    ?> 
                                    
                                    <?php echo $this->Html->image(
                                                $avatar , 
                                                array(
                                                    'alt' => 'CakePHP',
                                                    'class' => 'rounded-circle',
                                                    'style' => 
                                                        'width:10%; 
                                                        float:left;'
                                                    )
                                                );
                                    ?>
                                
                                                
                                    <?php 
                                        echo $this->html->tag(
                                            'span', 
                                            AuthComponent::user()['name'], 
                                            array(
                                                'style' => 'float:left;',
                                                'class'=>"ml-1")); 
                                    ?> 
                                        <div class='col-lg-3 ml-auto'>
                                        <?php
                                            echo $this->Html->link('Logout', 
                                                array('controller' => 'loginlogout', 'action' => 'logout'),
                                                array('style' => 'float:right;', 'class' => 'text-right ')
                                            );
                                        ?>
                                        </div>

                                    
                                <?php else: ?>
                                    Message Board
                                <?php endif; ?>
                                </div>
                            </div>
                            <div class="card-body"  style=' overflow:auto;'>
                                <?php echo $this->fetch('content');?>                 
                            </div>
                        </div>
                    </div>
                <div class="col-lg-4"></div>
            </div>
        </div>