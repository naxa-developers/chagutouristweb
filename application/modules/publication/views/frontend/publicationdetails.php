<section class="resource-section resource-details pdtb-50">
        <div class="container">
            <div class="row">
            <?php if($publicationdata): 
            foreach($publicationdata as $d ) { ?>
                <div class="col-xl-8 col-sm-12">
                    <div class="resource-group">
                        <div class="resource-list">
                            <figure>
                                <?php if($d['type'] == "images"){ ?>
                                  <div class="docImg">
                                      <img src="<?php echo $d['photo'] ?>" alt="<?php echo $d['title']?>">
                                  </div>
                                <?php } if($d['type'] == "files"): ?>
                                  <a href="<?php echo $d['file'] ?>">
                                    <i class="fa-files-o"></i> <?php echo $d['title'] ?>
                                    <!--   <img src="<?php echo base_url()?>/assets/frontend/img/doc.png" alt="<?php echo $d['title']?>"> -->
                                  </a>
                                <?php  endif; ?>
                                <?php if($d['type'] === 'audio'){ ?>
                                    <audio id="audio" preload="auto" tabindex="0" controls="">
                                        <source src="<?php echo $d['audio'] ?>">
                                        <?php echo $d['title'] ?>
                                    </audio>
                                <?php } ?>

                            </figure>
                            <?php if($d['type'] != "audio"){ ?>
                            <div class="resource-content">
                                <div class="resource-top">
                                    <h3>
                                       <?php echo ucwords($publicationdata[0]['title']) ?>
                                    </h3>
                                    <p> <?php echo $d['summary'] ?></p>
                                </div>
                                <div class="resource-bottom">
                                    <div class="btm-left">
                                        <span class="file-size">
                                            <?php
                                            if($d['type'] == "files") {
                                               $path=str_replace('http://kmc.naxa.com.np/','', $d['file']);
                                              if(file_exists($path)){
                                                $size=filesize($path);
                                                $size_kb=$size/1024;
                                               echo round($size_kb).' kB';
                                               $link= base_url().'/publication/download?file='.$d['file'].'&& title='.$d['title'];

                                             }else{
                                               echo '0 KB';
                                               $link='#';
                                             } 
                                           }else{
                                            if($d['type'] == "images") {
                                               $path=str_replace('http://kmc.naxa.com.np/','', $d['photo']);
                                              if(file_exists($path)){
                                                $size=filesize($path);
                                                $size_kb=$size/1024;
                                               echo round($size_kb).' kB';
                                               $link= base_url().'/publication/downloadimage?file='.$d['photo'].'&& title='.$d['title'];

                                             }else{
                                               echo '0 KB';
                                               $link='#';
                                             } 
                                           }
                                         }
                                             ?>
                                         </span>
                                        <a href="<?php  echo base_url().'/publication/downloadimage?file='.$d['photo'].'&& title='.$d['title'] ?>" class="iset-btn small-btn">Download <i class="la la-download"></i></a>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php } endif; ?>
                <div class="col-xl-4 col-sm-12">
                    <aside class="sidebar">
                        <h4>Related article</h4>
                         <?php if($pubd): 
                              foreach($pubd as $pub ) { ?>
                            <div class="resource-list" data-aos="fade-up" data-aos-easing="ease-out-cubic" data-aos-duration="2000" data-aos-offset="0">
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
                                  <?php if($pub['photo']){ ?>
                                      <img src="<?php echo $pub['photo'] ?>" alt="video">
                                      <?php }else{ ?>
                                      <img src="<?php echo base_url('assets/frontend/images/resource-1.jpg') ?>" alt="pdf Files">
                                      <?php } ?>
                                  </figure>
                              <?php endif; ?>
                              <?php if($pub['type'] == 'files'): ?>
                                  <figure>
                                      <img src="<?php echo base_url('assets/frontend/images/resource-1.jpg') ?>" alt="pdf Files">
                                  </figure>
                              <?php endif; ?>
                              <div class="resource-content">
                                <div class="resource-top">
                                    <h3>
                                        <a href="<?php echo base_url()?>/publication/details/?id=<?php echo base64_encode($pub['id']);?>"><?php echo $pub['title'] ?></a>
                                    </h3>
                                    <div class="post-meta">
                                        <time><i class="la la-calendar"></i>12 dec 2019,</time><span>Ram Sharma</span>
                                    </div>
                                    <p><?php echo $this->general->string_limit($pub['summary'],100); ?></p>
                                </div>
                                <div class="resource-bottom">
                                    <div class="btm-left">
                                    <span class="file-size">
                                    <?php $path=str_replace('http://kmc.naxa.com.np/','', $pub['file']);
                                            if(file_exists($path)){
                                              $size=filesize($path);
                                              $size_kb=$size/1024;
                                             echo round($size_kb).' kB';
                                             $link= base_url().'/publication/download?file='.$pub['file'].'&& title='.$pub['title'];
                                           }else{
                                             echo '0 KB';
                                             $link='#';
                                           } ?>
                                        </span>
                                        <a href="<?php  echo $link ?>">Download <i class="la la-download"></i></a>
                                    </div>
                                    <div class="btm-right">
                                        <a class="read-more" href="<?php echo base_url()?>/publication/details/?id=<?php echo base64_encode($pub['id']);?>">Read more <i class="la la-long-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                          </div>
                       <?php } endif; ?>
                    </aside>
                </div>
            </div>
        </div>
    </section>