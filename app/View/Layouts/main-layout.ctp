<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo 'title';?></title>
    <?php 
        
        echo $this->Html->css('bootstrap.min');
        echo $this->Html->script('https://code.jquery.com/jquery-1.10.2.js');
        echo $this->Html->script('bootstrap.min');
        // echo $this->Html->css('my-style');    
        echo $this->fetch('css');
        echo $this->fetch('script');
        echo $this->Html->css('general');
        echo $this->Html->script([
            'https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js',
            'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js',
            'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js',
        ]);
        
    ?>
</head>
<body>
    <?php echo $this->Flash->render(); ?>
    <?php echo $this->fetch('content');?>  
    <?php echo $this->Html->script('general-validation.js'); ?>
</body>
</html>