
<style >
.calendar .calendar-body .card .timeline:after {
    left: 2rem;
}
@media screen and (max-width: 767px){
  .left-sidebar ul{
        display:flex;
        -webkit-flex:flexbox;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
    }  
}
    
</style>
<section class="resource-breadcrumb inner-banner bg-image" data-background="<?php echo base_url('assets/frontend/images/details-breadcrumb.jpg') ?>">
    <div class="overlay"></div>
    <div class="breadcrumb-content">
        <h1> मौसमी तयारी पात्रो</h1>
        <p>हाम्रो मौसमी तयारी गाइडबुकको अध्ययनबाट मौसमी विपदबाट सुरक्षित हुनुहोस्</p>
    </div>
</section>

<section class="calendar pdtb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4">
                <aside class="left-sidebar sticky-top">
                    <div class="card">
                        <div class="card-body">
                            <ul><?php if($baisak):  ?>
                                <li><a href="#baishakh">बैसाख</a></li>
                            <?php endif;
                            if($jestha): ?>
                                <li><a href="#jesth">जेष्ठ</a></li>
                                <?php endif;
                            if($asad): ?>
                                <li><a href="#ashad">असार</a></li>
                                <?php endif;
                            if($sawn): ?>
                                <li><a href="#shrawan">श्रावण</a></li>
                                <?php endif;
                            if($bhadra): ?>
                                <li><a href="#bhadra">भाद्र</a></li>
                                <?php endif;
                            if($ashoj): ?>
                                <li><a href="#ashwin">असोज</a></li>
                                <?php endif;
                            if($kartik): ?>
                                <li><a href="#kartik">कार्तिक</a></li>
                                <?php endif;
                            if($mangsir): ?>
                                <li><a href="#mangsir">मङसिर</a></li>
                                <?php endif;
                            if($poush): ?>
                                <li><a href="#paush">पौष</a></li>
                                <?php endif;
                            if($magh): ?>
                                <li><a href="#magh">माघ</a></li>
                                <?php endif;
                            if($falgun): ?>
                                <li><a href="#falgun">फाल्गुन</a></li>
                                <?php endif; 
                                if($falgun): ?>
                                <li><a href="#chaitra">चैत्र</a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </aside>
            </div>
            <div class="col-lg-9 col-md-8">
                <div class="calendar-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="timeline">
                                <?php if($baisak): ?>
                                <div class="timeline-list" id="baishakh">
                                        <time>बैसाख</time>
                                    <ul>
                                    <?php if($baisak): 
                                    foreach ($baisak as $key => $b) {  ?>
                                        <li>
                                            <div class="event-list green">
                                                <h5><?php echo $b['name'] ?></h5>
                                                <a href="<?php echo base_url('drrinfo/drrdetails/'.$b['type'])  ?>"><?php echo $b['description']?></a>
                                            </div>
                                        </li>

                                    <?php } endif; ?>
                                    </ul>
                                </div>
                                <?php endif; if($jestha):   ?>
                                <div class="timeline-list" id="jesth">
                                        <time>जेष्ठ </time>
                                    <ul>
                                       <?php if($jestha): 
                                    foreach ($jestha as $key => $b) {  ?>
                                        <li>
                                            <div class="event-list green">
                                                <h5><?php echo $b['name'] ?></h5>
                                                <a href="<?php echo base_url('drrinfo/drrdetails/'.$b['type'])  ?>"><?php echo $b['description']?></a>
                                            </div>
                                        </li>

                                    <?php } endif; ?>
                                    </ul>
                                </div>
                                <?php endif; if($asad):   ?>
                                <div class="timeline-list" id="ashad">
                                    <time>असार </time>
                                    <ul>
                                        <?php if($asad): 
                                    foreach ($asad as $key => $b) {  ?>
                                        <li>
                                            <div class="event-list green">
                                                <h5><?php echo $b['name'] ?></h5>
                                                <a href="<?php echo base_url('drrinfo/drrdetails/'.$b['type'])  ?>"><?php echo $b['description']?></a>
                                            </div>
                                        </li>

                                    <?php } endif; ?>
                                    </ul>
                                </div>
                                 <?php endif; if($sawn):   ?>
                                <div class="timeline-list" id="shrawan">
                                    <time>श्रावण </time>
                                    <ul>
                                        <?php if($sawn): 
                                    foreach ($sawn as $key => $b) {  ?>
                                        <li>
                                            <div class="event-list green">
                                                <h5><?php echo $b['name'] ?></h5>
                                                <a href="<?php echo base_url('drrinfo/drrdetails/'.$b['type'])  ?>"><?php echo $b['description']?></a>
                                            </div>
                                        </li>

                                    <?php } endif; ?>
                                    </ul>
                                </div>
                                <?php endif; if($bhadra):   ?>
                                <div class="timeline-list" id="bhadra">
                                    <time>भाद्र </time>
                                    <ul>
                                        <?php if($bhadra): 
                                    foreach ($bhadra as $key => $b) {  ?>
                                        <li>
                                            <div class="event-list green">
                                                <h5><?php echo $b['name'] ?></h5>
                                                <a href="<?php echo base_url('drrinfo/drrdetails/'.$b['type'])  ?>"><?php echo $b['description']?></a>
                                            </div>
                                        </li>

                                    <?php } endif; ?>
                                    </ul>
                                </div>
                                <?php endif; if($ashoj):   ?>
                                <div class="timeline-list" id="ashwin">
                                    <time>असोज </time>
                                    <ul>
                                        <?php if($ashoj): 
                                    foreach ($ashoj as $key => $b) {  ?>
                                        <li>
                                            <div class="event-list green">
                                                <h5><?php echo $b['name'] ?></h5>
                                                <a href="<?php echo base_url('drrinfo/drrdetails/'.$b['type'])  ?>"><?php echo $b['description']?></a>
                                            </div>
                                        </li>

                                    <?php } endif; ?>
                                    </ul>
                                </div>
                                <?php endif;if($kartik):   ?>
                                <div class="timeline-list" id="kartik">
                                    <time>कार्तिक </time>
                                    <ul>
                                        <?php if($kartik): 
                                    foreach ($kartik as $key => $b) {  ?>
                                        <li>
                                            <div class="event-list green">
                                                <h5><?php echo $b['name'] ?></h5>
                                                <a href="<?php echo base_url('drrinfo/drrdetails/'.$b['type'])  ?>"><?php echo $b['description']?></a>
                                            </div>
                                        </li>

                                    <?php } endif; ?>
                                    </ul>
                                </div>
                                <?php endif; if($mangsir):   ?>
                                <div class="timeline-list" id="mangsir">
                                    <time>मङसिर </time>
                                    <ul>
                                        <?php if($mangsir): 
                                    foreach ($mangsir as $key => $b) {  ?>
                                        <li>
                                            <div class="event-list green">
                                                <h5><?php echo $b['name'] ?></h5>
                                                <a href="<?php echo base_url('drrinfo/drrdetails/'.$b['type'])  ?>"><?php echo $b['description']?></a>
                                            </div>
                                        </li>

                                    <?php } endif; ?>
                                    </ul>
                                </div>
                                <?php endif; if($poush):   ?>
                                <div class="timeline-list" id="paush">
                                    <time>पौष </time>
                                    <ul>
                                        <?php if($poush): 
                                    foreach ($poush as $key => $b) {  ?>
                                        <li>
                                            <div class="event-list green">
                                                <h5><?php echo $b['name'] ?></h5>
                                                <a href="<?php echo base_url('drrinfo/drrdetails/'.$b['type'])  ?>"><?php echo $b['description']?></a>
                                            </div>
                                        </li>

                                    <?php } endif; ?>
                                    </ul>
                                </div>
                                <?php endif; if($magh):   ?>
                                <div class="timeline-list" id="magh">
                                    <time>माघ </time>
                                    <ul>
                                        <?php if($magh): 
                                    foreach ($magh as $key => $b) {  ?>
                                        <li>
                                            <div class="event-list green">
                                                <h5><?php echo $b['name'] ?></h5>
                                                <a href="<?php echo base_url('drrinfo/drrdetails/'.$b['type'])  ?>"><?php echo $b['description']?></a>
                                            </div>
                                        </li>

                                    <?php } endif; ?>
                                    </ul>
                                </div>
                                <?php endif; if($falgun):   ?>
                                <div class="timeline-list" id="falgun">
                                    <time>फाल्गुन </time>
                                    <ul>
                                        <?php if($falgun): 
                                    foreach ($falgun as $key => $b) {  ?>
                                        <li>
                                            <div class="event-list green">
                                                <h5><?php echo $b['name'] ?></h5>
                                                <a href="<?php echo base_url('drrinfo/drrdetails/'.$b['type'])  ?>"><?php echo $b['description']?></a>
                                            </div>
                                        </li>

                                    <?php } endif; ?>
                                    </ul>
                                </div>
                                <?php endif; if($chtira):   ?>
                                <div class="timeline-list" id="chaitra">
                                    <time>चैत्र </time>
                                    <ul>
                                        <?php if($chtira): 
                                    foreach ($chtira as $key => $b) {  ?>
                                        <li>
                                            <div class="event-list green">
                                                <h5><?php echo $b['name'] ?></h5>
                                                <a href="<?php echo base_url('drrinfo/drrdetails/'.$b['type'])  ?>"><?php echo $b['description']?></a>
                                            </div>
                                        </li>

                                    <?php } endif; ?>
                                    </ul>
                                </div>
                                <?php endif;  ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

