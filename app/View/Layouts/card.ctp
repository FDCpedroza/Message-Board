
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4"></div>
                    <div class="col-lg-4">
                        <div class="card mt-3" style='height:90vh; soverflow:auto'>
                            <div class="card-header">Message Board</div>
                            <div class="card-body"  style=' overflow:auto'>
                                <?php echo $this->fetch('content');?>                 
                            </div>
                        </div>
                    </div>
                <div class="col-lg-4"></div>
            </div>
        </div>