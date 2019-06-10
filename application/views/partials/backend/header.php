<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">

    <meta http-equiv=”X-UA-Compatible” content=”IE=EmulateIE9”>
    <meta http-equiv=”X-UA-Compatible” content=”IE=9”>

    <link rel="shortcut icon" href="images/favicon.png">
    <title>Admin</title>
    <!--Core CSS -->
    <link href="<?php echo base_url();?>assets/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/admin/css/bootstrap-reset.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/admin/css/font-awesome.css" rel="stylesheet" />
    <link href="<?php echo base_url();?>assets/admin/css/onoffbtn.css" rel="stylesheet" />

    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/css/DT_bootstrap.css" />

      <!-- //step forms css -->
      <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/css/jquery.steps.css?1">

      <!-- fileupload drop box css -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/css/dropzone.css">
<!-- data css -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">

<!-- end -->
      <!-- fileuplaod css -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/admin/css/bootstrap-fileupload.css" />

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url();?>assets/admin/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/admin/css/style-responsive.css" rel="stylesheet" />

    <link href="<?php echo base_url();?>assets/admin/css/element.css" rel="stylesheet">
    <script src="<?php echo base_url();?>assets/admin/js/jquery-1.9.1.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin/js/jquery-ui-1.9.2.min.js"></script>
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
    <script src="js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <style>
        section#wizard-p-0 {
            overflow-y: scroll;
        }
        .panel-body {

            overflow: auto;
        }

        .form-control {

            color: #110000;
        }
    </style>
    <script>
            var base_url = '<?php echo base_url(); ?>';
            var adminurl = '<?php echo base_url().FOLDER_ADMIN; ?>';
    </script>
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
    <div class="brand">
        <a href="<?php echo base_url(FOLDER_ADMIN)?>/dashboard"  class="logo">
            <img src="<?php echo SITE_SLOGAN_EN ?>" alt="admin" height=60; style="width: auto !important;">
           <!--  <div class="cnm"><?php echo SITE_NAME_EN ?></div> -->
        </a>
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars"></div>
        </div>
    </div>
    <!--logo end-->


    <!--  notification start -->

    <!--  notification end -->

    <div class="top-nav clearfix">
        <!--search & user info start-->
        <ul class="nav pull-right top-menu">
            <li class="nav-item dropdown">
                <?php
                $urll=$this->uri->segment(1);
                if($this->session->userdata('Language')==NULL){
                    $this->session->set_userdata('Language','nep');
                }
                $lang=$this->session->get_userdata('Language');
                $language_data = $this->general->get_tbl_data_result('name,alias','publicationsubcat'); ?>
                <label><?php echo $this->lang->line('switch_language'); ?></label>
                <select class=" ChangeLanguage">
                <?php  foreach ($language_data as $key => $value) { ?>
                    <option class="dropdown-item" value="<?php echo $value['alias'] ?>" data-language="<?php echo $value['alias'] ?>"<?php if($lang['Language'] === $value['alias']) echo "Selected=selectd";?> ><?php echo $value['name'] ?></option>
                <?php } ?>
                </select>
            </li>
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                    <span class="username"><i class="fa fa-user"></i>  <?php echo $this->lang->line('admin'); ?></span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu extended logout">
                    <li><a href="#"><i class=" fa fa-suitcase"></i> <?php echo $this->lang->line('profile'); ?></a></li>
                    <li><a href="#"><i class="fa fa-cog"></i> <?php echo $this->lang->line('settings'); ?></a></li>
                    <li><a href="<?php echo base_url(FOLDER_ADMIN)?>/logout"><i class="fa fa-key"></i> <?php echo $this->lang->line('logout'); ?></a></li>
                </ul>
            </li>
        </ul>
        <!--search & user info end-->
    </div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a href="<?php echo base_url(FOLDER_ADMIN)?>/dashboard" >
                        <i class="fa fa-dashboard"></i>
                        <span><?php echo $this->lang->line('dashboard'); ?></span>

                    </a>
                </li>
                <li class="sub-menu <?php if($this->uri->segment(1) == '') { echo "active open"; } ?>">
                    <a href="javascript:;">
                        <i class="fa fa-laptop"></i>
                        <span><?php echo $this->lang->line('home_page'); ?></span>
                    </a>
                    <ul class="sub"  style="<?php if($this->uri->segment(1) == 'view_proj') { echo "display: block"; } ?>">
                        <li class="<?php if($this->uri->segment(1) == 'view_proj') { echo "active open"; } ?>"><a href="<?php echo base_url()?>view_proj"><?php echo $this->lang->line('project_partners'); ?></a></li>
                        <li><a href="<?php echo base_url();?>feature_nep"><?php echo $this->lang->line('featured_datasets'); ?></a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;" class="<?php if($this->uri->segment(1) == '') { echo "dcjq-parent active"; } ?>">
                        <i class="fa fa-laptop"></i>
                        <span><?php echo $this->lang->line('home_page'); ?></span>
                    </a>
                    <ul class="sub" style="<?php if($this->uri->segment(1) == 'view_proj') { echo "display: block"; } ?>">
                        <li class="<?php if($this->uri->segment(1) == 'view_proj') { echo "active"; } ?>"><a href="<?php echo base_url(FOLDER_ADMIN)?>/project/view_proj"><?php echo $this->lang->line('project_partners'); ?></a></li>
                        <?php

                        if($this->session->userdata('Language')==NULL){
                            $this->session->set_userdata('Language','nep');
                        }
                        $lang=$this->session->get_userdata('Language');
                        if($lang['Language']=='en'){ ?>
                        <li class="<?php if($this->uri->segment(1) == 'feature') { echo "active"; } ?>"><a href="<?php echo base_url(FOLDER_ADMIN);?>/project/feature"><?php echo $this->lang->line('featured_datasets'); ?></a></li>
                      <?php }else{ ?>
                    <li class="<?php if($this->uri->segment(1) == 'feature_nep') { echo "active"; } ?>"><a href="<?php echo base_url(FOLDER_ADMIN);?>/project/feature_nep"><?php echo $this->lang->line('featured_datasets'); ?></a></li>
                          <?php } ?>
                    </ul>
                </li>
                <!-- <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-laptop"></i>
                        <span><?php echo $this->lang->line('categories_management'); ?></span>
                    </a>
                    <ul class="sub">

                        <li><a href="<?php echo base_url(FOLDER_ADMIN);?>/map/categories_tbl"> <?php echo $this->lang->line('categories'); ?></a></li>
                        <li><a href="<?php echo base_url(FOLDER_ADMIN);?>/map/sub_categories"> <?php echo $this->lang->line('sub_categories'); ?></a></li>

                    </ul>
                </li> -->
              <!--   <li class="sub-menu">
                    <a href="<?php echo base_url(FOLDER_ADMIN);?>/calendar">
                        <i class="fa fa-th"></i>
                        <span>मौसमी तयारी पात्रो</span>
                    </a>
                </li> -->
                <!-- <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-th"></i>
                        <span><?php echo $this->lang->line('report_management'); ?></span>
                    </a>
                    <ul class="sub">

                        <li><a href="<?php echo base_url(FOLDER_ADMIN);?>/report/report_manage"><?php echo $this->lang->line('view_reports'); ?></a></li>
                        <li><a href="<?php echo base_url(FOLDER_ADMIN);?>/report/ghatana"><?php echo $this->lang->line('ghatana_bibaran_management'); ?></a></li>
                        <li><a href="<?php echo base_url(FOLDER_ADMIN);?>/report/map_reports_table"><?php echo $this->lang->line('view_ghatana_bibaran_management'); ?></a></li>

                    </ul>
                </li>
 -->


                  <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-th"></i>
                        <span><?php echo $this->lang->line('about_us'); ?></span>
                    </a>
                    <ul class="sub">
                        <li><a href="<?php echo base_url(FOLDER_ADMIN);?>/publication/view_publication"> <?php echo $this->lang->line('about_us_data'); ?></a></li>
                        <li><a href="<?php echo base_url(FOLDER_ADMIN);?>/publication/add_publication_category"><?php echo $this->lang->line('about_us_category'); ?></a></li>
                        <li><a href="<?php echo base_url(FOLDER_ADMIN);?>/publication/add_publication_sub_category"><?php echo $this->lang->line('language_setting'); ?></a></li>

                    </ul>
                </li>
              <!--   <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-th"></i>
                        <span><?php echo $this->lang->line('homepagemanagement'); ?></span>
                    </a>
                    <ul class="sub">
                        <li><a href="<?php echo base_url(FOLDER_ADMIN);?>/site_setting/sliderList"><?php echo $this->lang->line('sliderhome'); ?></a></li>
                        <li><a href="<?php echo base_url(FOLDER_ADMIN);?>/site_setting/homepagesetup"><?php echo $this->lang->line('homepagelabel'); ?></a></li>
                        <li><a href="<?php echo base_url(FOLDER_ADMIN);?>/site_setting/beready">तयारी हुनुहोस्   </a></li>
                    </ul>
                </li> -->
                <!-- <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-th"></i>
                        <span><?php echo $this->lang->line('municipal_map'); ?></span>
                    </a>
                    <ul class="sub">

                         <li><a href="<?php echo base_url();?>map_show"><?php echo $this->lang->line('map_download_management'); ?></a></li>

                    </ul>
                </li> -->
               <!--  <li class="sub-menu">
                    <a href="<?php echo base_url(FOLDER_ADMIN);?>/dictionary">
                        <i class="fa fa-th"></i>
                        <span><?php echo $this->lang->line('dictionary'); ?></span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-th"></i>
                        <span><?php echo $this->lang->line('about_us'); ?></span>
                    </a>
                    <ul class="sub">

                        <li><a href="<?php echo base_url(FOLDER_ADMIN);?>/about/about/edit_about?id=NQ==">परियोजना बारे<?php //echo $this->lang->line('about_management'); ?></a></li>
                        <li><a href="<?php echo base_url(FOLDER_ADMIN);?>/about/view_about">नेपाल  इन्फो </a></li>
                      
                    </ul>
                </li> -->
              <!--   <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-th"></i>
                        <span><?php echo $this->lang->line('about_us'); ?></span>
                    </a>
                    <ul class="sub">
                        <li><a href="<?php echo base_url(FOLDER_ADMIN);?>/drrinfo">प्रकोप सूची </a></li>
                        <li><a href="<?php echo base_url(FOLDER_ADMIN);?>/drrinfo/drrinformation">प्रकोप जानकारी थप्नु </a></li>
                        <li><a href="<?php echo base_url(FOLDER_ADMIN);?>/drrinfo/drrinformationlist">प्रकोप जानकारी सूची</a></li>

                    </ul>
                </li>   
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-th"></i>
                        <span>हाजिरीजवाफ  व्यवस्थापन</span>
                    </a>
                    <ul class="sub">
                        <li><a href="<?php echo base_url(FOLDER_ADMIN);?>/quiz">हाजिरीजवाफ प्रबन्ध गर्नुहोस्</a></li>
                        <li><a href="<?php echo base_url(FOLDER_ADMIN);?>/quiz/quiz_question">हाजिरीजवाफ थप्नु </a></li>

                    </ul>
                </li> -->
                <!-- <li class="sub-menu">
                    <a href="javascript:;">
                        <i class=" fa fa-bar-chart-o"></i>
                        <span>Layers</span>
                    </a>
                    <ul class="sub">
                        <li><a href="<?php echo base_url();?>layers_view">Layers</a></li>
                        <li><a href="chartjs.html">Chartjs</a></li>
                        <li><a href="flot_chart.html">Flot Charts</a></li>
                        <li><a href="c3_chart.html">C3 Chart</a></li>
                    </ul>
                </li> -->
                <?php if($admin==1){?>
                <li class="sub-menu">
                    <a href="<?php echo base_url(FOLDER_ADMIN);?>/site_setting/site_setting">
                        <i class=" fa fa-bar-chart-o"></i>
                        <span><?php echo $this->lang->line('site_setting'); ?></span>
                    </a>
                </li>
          <?php  } ?>

            </ul>
          </div>
        <!-- sidebar menu end-->
    </div>
</aside>
