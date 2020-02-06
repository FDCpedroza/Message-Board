<h2>Write a Message</h2>
<?php

echo $this->form->create('Message');
echo $this->form->input('Recepient', ['options' => $users]);
echo $this->form->textarea('Message', ['rows' => '10']);
echo $this->form->end('Send');

echo $this->html->css('https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css');
echo $this->html->css('compose-select');
echo $this->html->script(['https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js',
                        'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js',
                        'select.js']);