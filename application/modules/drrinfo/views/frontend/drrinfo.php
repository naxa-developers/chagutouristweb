<!-- herobanner start -->
   <!--  <section class="details-breadcrumb inner-banner bg-image" data-background="<?php echo base_url('assets/frontend/images/details-breadcrumb.jpg') ?>">
        <div class="overlay"></div>
        <div class="breadcrumb-content">
            <h1><?php echo $drrdata[0]['name'] ?></h1>
            <p><?php echo $drrdata[0]['description'] ?></p>
        </div>
    </section> -->
     <section class="hero-banner breadcrumb-banner">
        <div class="hero-slider owl-carousel breadcrumb-slider">
        <?php if($imagesslider){
         foreach ($imagesslider as $key => $value) {  ?>
            <div class="hero-item bg-image" data-background="<?php  echo $value['gly_path'] ?>" >
                <div class="overlay"></div>
                <div class="breadcrumb-caption">
                    <h1><?php  echo $value['title'] ?> </h1>
                    <p><?php  echo $value['short_summary'] ?></p>
                </div>
            </div>
        <?php } 
        }else{ ?>
            <div class="hero-item bg-image" data-background="<?php echo base_url('assets/frontend/images/details-breadcrumb.jpg') ?>" >
                <div class="overlay"></div>
                <div class="breadcrumb-caption">
                    <h1>पहिरो </h1>
                    <p>पहिरो, नेपालको पहाडी भूभागमा सबैभन्दा दोहोरिने प्राकृतिक प्रकोप हो . पहिरो प्राकृतिक र मानव क्रियाकलाप दुवैले गर्दा जान्छन </p>
                </div>
            </div>
            <div class="hero-item bg-image" data-background="<?php echo base_url('assets/frontend/images/details-breadcrumb.jpg') ?>" >
                <div class="overlay"></div>
                <div class="breadcrumb-caption">
                    <h1><?php echo $drrdata[0]['name'] ?></h1>
                    <p><?php echo $drrdata[0]['description'] ?></p>
                </div>
            </div> 
        <?php } ?>
        </div>
    </section>
     <div class="shortcut">
        <div class="shortcut-list">
        <?php if($catdata): 
            foreach ($catdata as $key => $kdk) {  ?>
            <a href="<?php echo base_url('drrinfo/drrdetails/') ?>?id=<?php echo base64_encode($kdk['id']) ?>" >
            <?php if($kdk['slug'] == "earthquake"){ ?>
            <img src="<?php echo base_url('assets/frontend/images/icon/earthquacke.svg') ?>">
            <?php } ?>
            <?php if($kdk['slug'] == "flood"){ ?>
            <img src="<?php echo base_url('assets/frontend/images/icon/flood.svg') ?>">
            <?php } ?>
            <?php if($kdk['slug'] == "fire"){ ?>
            <img src="<?php echo base_url('assets/frontend/images/icon/fire.svg') ?>">
            <?php } ?>
            <?php if($kdk['slug'] == "drought"){ ?>
            <img src="<?php echo base_url('assets/frontend/images/icon/draought.svg') ?>">
            <?php } ?>
            <?php if($kdk['slug'] == "landslide"){ ?>
            <img src="<?php echo base_url('assets/frontend/images/icon/landslide.svg') ?>">
            <?php } ?>
             <?php if($kdk['slug'] == "शीतलहर"){ ?>
            <img src="<?php echo base_url('assets/frontend/images/icon/earthquacke.svg') ?>">
            <?php } ?>
             <?php if($kdk['slug'] == "road-accident"){ ?>
            <img src="<?php echo base_url('assets/frontend/images/icon/earthquacke.svg') ?>">
            <?php } ?>
            <?php if($kdk['slug'] == "लु-"){ ?>
            <img src="<?php echo base_url('assets/frontend/images/icon/wave.svg') ?>">
            <?php } ?>
            <?php if($kdk['slug'] == "thunder"){ ?>
            <img src="<?php echo base_url('assets/frontend/images/icon/thunder.svg') ?>">
            <?php } ?>
            <span><?php echo $kdk['name'] ?></span> </a>
        <?php } endif; ?>
           
        </div>
    </div>
    <div class="legend">
        <div class="legend-list">
            <?php if($drrsubcat):
                foreach ($drrsubcat as $key => $dsbub): ?>
                    <a href="#before-section<?php echo $dsbub['slug']; ?>" class="iset-btn"><?php echo  ucfirst($dsbub['name']); ?> <i class="la la-long-arrow-right"></i></a>
            <?php endforeach;
             endif; ?>
        </div>
    </div>
    <div class="bg-wrap">
     <?php
        if($drrsubcat): 
            $lang=$this->session->get_userdata('Language');
            if($lang['Language']=='en') {
              $language='en';
            }else{
              $language='nep'; 
            }
            foreach ($drrsubcat as $ken => $d):
            $drrsubcateg = $this->general->get_tbl_data_result('*','drrinformation',array('subcat_id'=>$d['id'],'language'=>$language,'category_id'=>$drrdata[0]['id']));
        if($drrsubcateg){
        foreach ($drrsubcateg as $key => $finaldetails) {  ?>
            <section class="before-section<?php echo $d['slug']; ?> bef-aft" id="before-section<?php echo $d['slug']; ?>" data-aos="fade-up" data-aos-easing="ease-out-cubic" data-aos-duration="2000" data-aos-offset="0">
                <div class="container">
                    <div class="section-title mrb-50">
                       <!--  <h3><?php //echo $d['name']; ?></h3> -->
                        <span><?php echo $finaldetails['short_desc']; ?></span>
                    </div>
                    <div class="before-list bef-aft-list">
                         <?php echo $finaldetails['description']; ?>
                    </div>
                </div>
            </section>
        <?php  } }
            endforeach;
            endif; ?>
     </div>