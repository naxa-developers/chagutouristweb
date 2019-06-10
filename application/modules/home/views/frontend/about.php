<section class="resource-breadcrumb inner-banner bg-image" data-background="<?php echo base_url('assets/frontend/images/details-breadcrumb.jpg') ?>">
    <div class="overlay"></div>
    <div class="breadcrumb-content">
        <h1> <?php echo $about[0]['title'] ?></h1>
        <p>हाम्रो मौसमी तयारी गाइडबुकको अध्ययनबाट मौसमी विपदबाट सुरक्षित हुनुहोस्</p>
    </div>
</section>
<section class="about pdtb-50">
    <div class="container">
        <div class="about-list">
            <div class="row">
                <div class="col-xl-6">
                <?php if($about[0]['photo']): ?>
                    <figure>
                        <img src="<?php echo $about[0]['photo'] ?>" alt="about">
                    </figure>
                <?php endif; ?>
                </div>
                <div class="col-xl-6">
                    <div class="about-content">
                        <h4><?php echo $about[0]['title'] ?></h4>
                        <p><?php echo $about[0]['summary'] ?></p>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</section>