
<!-- herobanner start -->
    <section class="resource-breadcrumb inner-banner bg-image" data-background="<?php echo base_url('assets/frontend/images/details-breadcrumb.jpg') ?>">
        <div class="overlay"></div>
        <div class="breadcrumb-content">
             <h1><?php echo !empty(TERMINOLOGY)?TERMINOLOGY:'' ?></h1>
            <p><?php echo !empty(TERMINOLOGYDESC)?TERMINOLOGYDESC:'' ?></p>
        </div>
    </section>
    <div class="breadcrumb-form">
        <form method="POST" action>
            <div class="row">
                <div class="col-xl-5 col-md-4">
                     <div class="form-group">
                        <select class="wide select" name="category">
                        <option selected value="all">----- प्रकोप छान्नुहोस् -----</option>
                        <?php if($pub):
                         foreach ($pub as $key => $pt) { ?>
                            <option value="<?php echo $pt['id'] ?>" <?php if($this->input->post('category')){ echo "selected";} ?>><?php echo $pt['name'] ?></option>
                          <?php } endif; ?>
                        </select>
                    </div>
                </div>
                <div class="col-xl-5 col-md-4">
                    <div class="form-group">
                        <select class="wide select" name="subcat">
                        <option selected value="all">----- फाईल को प्रकार  छान्नुहोस् -----</option>
                        <?php if($pubcat):
                         foreach ($pubcat as $key => $pcat) { ?>
                            <option value="<?php echo $pcat['id'] ?>" <?php if($this->input->post('subcat')){ echo "selected";} ?>><?php echo $pcat['name'] ?></option>
                          <?php } endif; ?>
                        </select>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4">
                    <button type="submit" class="iset-btn"><?php echo !empty(SEARCH)?SEARCH:'' ?></button>
                </div>     
            </div>
        </form>
    </div>
    <section class="resource-section pdtb-50">
        <div class="container">
            <div class="row">
            <?php if($publicationdata): //echo "<pre>";print_r($publicationdata);die;
                foreach($publicationdata as $d ){ ?>
                <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-easing="ease-out-cubic" data-aos-duration="2000" data-aos-offset="0">
                    <div class="resource-list">
                        <figure>
                            <img src="<?php echo base_url()?>assets/frontend/images/resource-1.jpg" alt="<?php echo $d['title']?>">
                        </figure>
                        <div class="resource-content">
                            <div class="resource-top">
                                <h3>
                                    <a href="<?php echo base_url()?>/publication/details/?id=<?php echo base64_encode($d['id']);?>"> <?php echo $d['title']?>
                                    </a>
                                </h3>
                                <div class="post-meta">
                                    <time><i class="la la-calendar"></i>12 dec 2019,</time><span>Ram Sharma</span>
                                </div>
                                <p><?php echo $this->general->string_limit($d['summary'],100); ?></p>
                            </div>
                            <div class="resource-bottom">
                                <div class="btm-left">
                                  <?php
                                  $path=str_replace('http://kmc.naxa.com.np/','', $d['file']);
                                  if(file_exists($path)){
                                    $size=filesize($path);
                                    $size_kb=$size/1024;
                                   echo round($size_kb).' kB';
                                   $link= base_url().'/publication/download?file='.$d['file'].'&& title='.$d['title'];
                                 }else{
                                   echo '0 KB';
                                   $link='#';
                                 } ?>
                                  <a href="<?php  echo $link ?>"><?php echo !empty(DOWNLOAD)?DOWNLOAD:'' ?> <i class="la la-download"></i></a>
                                </div>
                                <div class="btm-right">
                                    <a class="read-more" href="<?php echo base_url()?>/publication/details/?id=<?php echo base64_encode($d['id']);?>">Read more <i class="la la-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } endif; ?>
               
            </div>
        </div>
    </section>