    <section class="hazard-breadcrumb inner-banner bg-image" data-background="<?php echo base_url('assets/frontend/images/hazard-breadcrumb.jpg') ?>">
        <div class="overlay"></div>
        <div class="breadcrumb-content">
           <h3><?php echo !empty(MUNPROFILE)?MUNPROFILE:'' ?></h3>
                <span><?php echo !empty(PROFILEDESC)?PROFILEDESC:'' ?></span>
                <br>
                <br>
        </div>
    </section>
    <section class="page-hazard mrb-50">
        <div class="container">
            <div class="row">
                <?php if($drrdata):
                foreach ($drrdata as $key => $dta) { ?>
                <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-easing="ease-out-cubic" data-aos-duration="2000" data-aos-offset="0">
                    <div class="hazard-list">
                        <div class="overlay"></div>
                        <figure>
                            <img src="<?php echo $dta['image'] ?>" alt="<?php echo $dta['name'] ?>">
                        </figure>
                        <figcaption>
                            <h4><a href="<?php echo base_url('/drrinfo/drrdetails/'.$dta['id']) ?>"><?php echo $dta['name'] ?></a></h4>
                            <p> <?php echo $dta['description'] ?></p>
                          <a href="<?php echo base_url('/drrinfo/')?>drrdetails?id=<?php echo base64_encode($dta['id']);?>"><button type="button" class="iset-btn">थप  जानकारी <i class="la la-long-arrow-right"></i></button></a>
                        </figcaption>
                        <div class="hazard-icon">
                        <?php echo $dta['svgimage'] ?>                    
                        </div>
                    </div>
                </div>
            <?php } endif; ?>
            </div>
        </div>
    </section>

