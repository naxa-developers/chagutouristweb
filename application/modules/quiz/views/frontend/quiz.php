<style type="text/css">
    body{
        margin-top:40px;
    }

    .stepwizard-step p {
        margin-top: 10px;
    }

    .stepwizard-row {
        display: table-row;
    }

    .stepwizard {
        display: table;
        width: 100%;
        position: relative;
    }

    .stepwizard-step button[disabled] {
        opacity: 1 !important;
        filter: alpha(opacity=100) !important;
    }

    .stepwizard-row:before {
        top: 14px;
        bottom: 0;
        position: absolute;
        content: " ";
        width: 100%;
        height: 1px;
        background-color: #ccc;
        z-order: 0;

    }

    .stepwizard-step {
        display: table-cell;
        text-align: center;
        position: relative;
    }

    .quiz-container ul{
        margin-bottom:1rem;
        padding-bottom:0.6rem;
        border-bottom:1px solid #efefef;
    }
    .quiz-container .btn{
        margin-top:1rem;
    }
    .quiz-container ul li.nav-item{
        margin:0;
    }
    .quiz-container ul li a.nav-link{
        border-radius:0;
            padding: .2rem 1rem;

    }
    .quiz-container ul li a.nav-link.active, .quiz-container ul li a.nav-link:hover{
        border: none;
        border-radius: 4px;
        background-color:#366CAD;
        color:#fff;
    }
</style>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <section class="details-breadcrumb inner-banner bg-image" data-background="<?php echo base_url('assets/frontend/images/details-breadcrumb.jpg') ?>">
        <div class="overlay"></div>
        <div class="breadcrumb-content">
            <h1>हाजिरीजवाफ खेल्नुहोस् </h1>
            <p>विभिन्न विपदको जानकारी सम्बन्धि हाजिरीजवाफ खेल खेल्नुहोस् र वास्तविक जानकारी लिनुहोस्</p>
        </div>
    </section>
    <section class="quiz-section pdtb-30 aos-init aos-animate" data-aos="fade-up" data-aos-easing="ease-out-cubic" data-aos-duration="2000" data-aos-offset="0">
        <div class="quiz-container">
        <h3><?php echo $cat[0]['name']; ?></h3>
            <div class="container">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                <?php if($category):
                 foreach ($category as $key => $catvalue) { ?>
                    <li class="nav-item">
                      <a class="nav-link btn-circle <?php if($key+1 == "1") { echo "active";} ?>" id="home-tab<?php echo $key+1 ?>" data-toggle="tab" href="#home<?php echo $key+1 ?>" role="tab" aria-controls="home" aria-selected="<?php if($key+1 == "1") { echo "true";}else{echo "false"; } ?>"><?php echo $key+1 ?></a>
                    </li>
                <?php } endif; ?>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <?php if($category):
                         foreach ($category as $kp => $catevalue) {
                            $newoptions = $this->general->get_tbl_data_result('*','quiz_options',array('category_id'=>$catevalue['id'])); ?>
                        <div class="tab-pane fade show <?php if($kp+1 == "1") { echo "active";} ?>" id="home<?php echo $kp+1 ?>" role="tabpanel" aria-labelledby="home-tab<?php echo $kp+1 ?>">
                        <?php if($newoptions): ?>
                            <div class="quiz-content">
                                <div class="quiz-qs">
                                    <span><?php echo $kp+1 ?></span>
                                    <h4><?php echo $catevalue['question'] ?></h4>
                                </div>
                                <ul>
                                 <?php foreach ($newoptions as $key => $opvalue) { ?>
                                    <li>
                                        <div class="custom-control custom-radio">
                                            <input type="radio"  id="<?php echo $opvalue['id'] ?>" class="abc btn btn-secondary custom-control-input" name="kp" data-id="<?php echo $opvalue['id'] ?>" data-qnid ="<?php echo $catevalue['id'] ?>" data-catid="<?php echo $catevalue['cat_id'] ?>">
                                            <label class="custom-control-label" for="<?php echo $opvalue['id'] ?>"><?php echo strip_tags($opvalue['name']); ?></label>
                                        </div>
                                    </li>
                                    <?php } ?>
                                    <div id="FinalAnswerShow<?php echo $catevalue['id'] ?>"></div>
                                </ul>
                            </div>
                        <?php endif; ?>
                        </div>
                    <?php } endif; ?>
                </div>
                <button class="prevtab btn btn-primary">अघिल्लो</button>
                <button class="nexttab btn btn-success">अर्को</button>
            </div> 
        </div> 
    </section>
<script type="text/javascript">
    $(document).off('click','.abc');
    $(document).on('click','.abc', function(){
        jQuery.noConflict();
        var base_url='<?php echo base_url(); ?>';
        var urlpost = base_url+'/quiz/check_status';
        var optionid = $(this).data('id');
        var catid = $(this).data('catid');
        var nqnid = $(this).data('qnid');
        $.ajax({
           type:'POST',
           url:urlpost,
           dataType: 'html',
           data:{"optionid":optionid,"nqnid":nqnid,'catid':catid},
            beforeSend: function(){

            },
            success:function(jsons){
               // console.log(jsons);
                data = jQuery.parseJSON(jsons);
                //console.log(data.result);
                if(data.status=='success')
                {
                    $('#FinalAnswerShow'+nqnid).html(data.result);
                    setTimeout(function(){
                        $('#FinalAnswerShow'+nqnid).html("");
                      }, 13000);
                }
            }
        });
    });
</script>
<script type="text/javascript">
     function bootstrapTabControl(){
        var i, items = $('.nav-link'), pane = $('.tab-pane');
        // next
        $('.nexttab').on('click', function(){
            for(i = 0; i < items.length; i++){
                if($(items[i]).hasClass('active') == true){
                    break;
                }
            }
            if(i < items.length - 1){
                // for tab
                $(items[i]).removeClass('active');
                $(items[i+1]).addClass('active');
                // for pane
                $(pane[i]).removeClass('show active');
                $(pane[i+1]).addClass('show active');
            }

        });
        // Prev
        $('.prevtab').on('click', function(){
            for(i = 0; i < items.length; i++){
                if($(items[i]).hasClass('active') == true){
                    break;
                }
            }
            if(i != 0){
                // for tab
                $(items[i]).removeClass('active');
                $(items[i-1]).addClass('active');
                // for pane
                $(pane[i]).removeClass('show active');
                $(pane[i-1]).addClass('show active');
            }
        });
    }
    bootstrapTabControl();
</script>