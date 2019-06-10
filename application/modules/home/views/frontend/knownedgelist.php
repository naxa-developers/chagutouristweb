<section class="resource-breadcrumb inner-banner bg-image" data-background="<?php echo base_url('assets/frontend/images/details-breadcrumb.jpg') ?>">
        <div class="overlay"></div>
        <div class="breadcrumb-content">
           
            <h1><?php echo !empty(DISASTITLE)?DISASTITLE:'' ?></h1>
            <p><?php echo !empty(DISASDESC)?DISASDESC:'' ?></p>
        </div>
    </section>
    <div class="breadcrumb-form">
        <form action="" method="POST">
            <div class="row">
               <div class="col-xl-3 col-md-4">
                   
                 <!--     <div class="input-group"> -->
                        <input type="hidden" name="keywords" class="form-control" value="<?php echo !empty($this->input->post('keywords'))?$this->input->post('keywords'):''; ?>" aria-label="" placeholder="Search Hazard">
                       <!--  <div class="input-group-append">
                            <span class="input-group-text"><i class="la la-search"></i></span>
                        </div>
                    </div>-->
                </div> 
                <div class="col-xl-7 col-md-4">
                    <div class="form-group">
                    
                        <select class="wide select" name="category">
                            <option selected value="all">-----  प्रकोप छान्नुहोस् ----- </option>
                            <option value="all">सबै</option>
                            <?php if($pub): 
                             foreach ($pub as $key => $p) {  ?>
                                <option value="<?php echo $p['id'] ?>" <?php if($this->input->post('category') === $p['id']) { echo "Selected"; } ?>><?php echo $p['name'] ?></option>
                            <?php } endif; ?>
                        </select>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4">
                    <button type="submit" class="iset-btn">खोजी गर्नुहोस् </button>
                </div>     
            </div>
    </div>
    <section class="knowledge pdtb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <aside class="left-sidebar">
                        <div id="accordion">
                        <?php if($pubcat): 
                        foreach ($pubcat as $key => $pt) { 
                            $npubtype = $this->general->get_tbl_data_result('id,name','publicationfilecat',array('sub_cat_id'=>$pt['id']));
                           // echo "<pre>"; print_r($npubtype);
                         ?>
                            <div class="card">
                                <div class="card-header" id="heading-2<?php echo $key+1?>">
                                    <h5>
                                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-2<?php echo $key+1 ?>" aria-expanded="false"
                                            aria-controls="collapse-2<?php echo $key+1?>">
                                            <?php echo $pt['name']; ?>
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapse-2<?php echo $key+1 ?>" class="collapse <?php if($key+1 == '1'){ echo "show";} ?>" data-parent="#accordion" aria-labelledby="heading-2<?php echo $key+1 ?>">
                                    <div class="card-body">
                                        <ul>
                                        <?php if($npubtype): 
                                        foreach ($npubtype as $key => $b) { ?>
                                            <li>
                                                <div class="form-check">
                                                    <input type="checkbox" name="<?php echo $pt['slug']; ?>[]" class="form-check-input" value="<?php echo $b['id'] ?>" id="exampleCheck1">
                                                    <label class="form-check-label" for="exampleCheck1"><?php echo $b['name'] ?></label>
                                                </div>
                                            </li>
                                        <?php } endif; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php } endif; ?>

                          
                            <div class="col-xl-2 col-md-4 ">
                                <div class="col text-center">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="iset-btn center-block ">बिस्तृतमा  खोजी गर्नुहोस् </button>
                                     <label>&nbsp;</label>
                                     </div>
                            </div>
                        </div>
                    </aside>
                    </form>
                </div>
                <div class="col-lg-9">
                    <div class="knoledge-body">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <?php if($publication): //echo "<pre>";print_r($publication);die;
                                    foreach ($publication as $key => $pub) { ?>
                                        <div class="col-xl-4 col-md-6">
                                            <div class="knoledge-list <?php if($pub['type'] == 'files'){ echo "doclist"; } ?>">
                                            <?php if($pub['type'] == 'video'): ?>
                                                <?php $nurl=$pub['videolink'];
                                                    $nu = substr($nurl, strrpos($nurl, '/' )+1);
                                                   $thimg =str_replace('watch?v=','',$nu, $a); ?>
                                                <figure>
                                                    <img src="https://i.ytimg.com/vi/<?php echo $thimg ?>/mqdefault.jpg" alt="video">
                                                    <figcaption>
                                                        <a href="<?php echo $pub['videolink'] ?>?autoplay=1&rel=0 " class="video-preview"><i class="la la-play-circle"></i></a>
                                                    </figcaption>
                                                </figure>
                                            <?php endif; ?>
                                            <?php if($pub['type'] == 'images'): ?>
                                                <figure>
                                                    <img src="<?php echo $pub['photo'] ?>" alt="video">
                                                </figure>
                                            <?php endif; ?>
                                            <?php if($pub['type'] == 'files'): ?>
                                                <figure>
                                                    <img src="<?php echo base_url('assets/frontend/img/doc.png') ?>" alt="pdf Files">
                                                </figure>
                                            <?php endif; ?>
                                            <?php if($pub['type'] == 'audio'){ ?>
                                                <audio id="audio" preload="auto" tabindex="0" controls="">
                                                    <source src="<?php echo $pub['audio'] ?>">
                                                    <?php echo $pub['title'] ?>
                                                </audio>
                                            <?php } ?>
                                                <div class="knowldege-content">
                                                    <h4>
                                                        <a href="<?php echo base_url()?>/publication/details/?id=<?php echo base64_encode($pub['id']);?>"><?php echo $pub['title'] ?></a>
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }  endif; ?>
                                 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>