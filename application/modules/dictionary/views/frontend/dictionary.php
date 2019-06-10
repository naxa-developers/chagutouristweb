<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<section class="resource-breadcrumb inner-banner bg-image" data-background="<?php echo base_url('assets/frontend/images/details-breadcrumb.jpg') ?>" style="background-image: url(&quot;images/details-breadcrumb.jpg&quot;);">
<div class="overlay"></div>
<div class="breadcrumb-content">
    <h1>विपदका शब्दावली</h1>
    <p>के तपाईलाई विपद भनेको के हो थाहा छ? विपदका शब्दावलीहरुको बारेमा थाहा छ? विपदको शब्दहरुको बारे जानकारीकोलागी यो शब्दावली प्रयोग गर्नुस</p>
</div>
</section>
<section class="knowledge pdtb-50">
    <div class="container">
         <div class="row">
                <div class="col-lg-3">
                    <aside class="left-sidebar dictionary-sidebar sticky-top">
                        <div class="card">
                            <div class="card-header main-card-header">
                                <h5>शब्द</h5>
                            </div>
                            <div class="card-body">
                                <ul class="nav nav-tabs flex-column border-tabs" id="myTab" role="tablist">
                                <?php if($dictionary){
                                    foreach ($dictionary as $key => $d) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link" id="dict_1_tab<?php echo $key+1; ?>" data-toggle="tab" href="#dict_1<?php echo $key+1; ?>" role="tab" aria-controls="dict_1<?php echo $key+1; ?>" aria-selected="<?php if($key+1 == '1') { echo "true"; }else{ echo "false"; } ?>"><?php echo $d['word']; ?></a>
                                    </li>

                                <?php } } ?>
                                </ul>
                            </div>
                        </div>
                    </aside>
                </div>
                <div class="col-lg-9">
                    <div class="dictionary-body">
                        <div class="tab-content" id="myTabContent">
                            <?php if($dictionary){
                                    foreach ($dictionary as $kdk => $ds) { ?>
                            <div class="tab-pane fade <?php if($kdk+1 == '1') { echo "show active"; } ?> " id="dict_1<?php echo $kdk+1; ?>" role="tabpanel" aria-labelledby="dict_1_tab<?php echo $kdk+1; ?>">
                                <div class="card">
                                    <div class="card-header">
                                        <h5><?php echo $ds['word']; ?> को अर्थ</h5>
                                    </div>
                                    <div class="card-body">
                                        <p><?php echo $ds['meaning'] ?></p>
                                        <figure>
                                            <img src="<?php echo $ds['image'] ?>" alt="<?php echo $ds['word']?>" />
                                        </figure>
                                        <div class="comment">
                                                <h5>Comment</h5>
                                                <p><?php  echo $ds['comment']; ?></p>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <?php } }   ?>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</section>
<script>
    $(document).ready(function(){
        $('[data-toggle="popover"]').popover();   
    });
    $(document).off('click','.findClickedItemData');
    $(document).on('click','.findClickedItemData',function(){
        var q=$(this).data('id');
        var url='<?php echo base_url()?>dictionary?query='+q;
        window.location=url;
        // var url='<?php echo base_url()?>dictionary';
        // window.location=url;
        // var action="<?php echo base_url() ?>dictionary/index";
        // $.ajax({
        // type: "POST",
        // url: action,
        // dataType: 'html',
        //     data: {q:q},
        //     success: function()
        //     {   window.location=url;
        //         // data = jQuery.parseJSON(jsons);
        //         // if(data.status=='success'){
        //         //     window.location.href = url;
        //         // }
        //     }
        // });
    });
</script>
