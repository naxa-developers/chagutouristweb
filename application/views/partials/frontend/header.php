<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- SOCIAL MEDIA META -->
    <meta property="og:description" content="ISET | Information about disaster">
    <meta property="og:image" content="preview.html">
    <meta property="og:site_name" content="ISET">
    <meta property="og:title" content="ISET">
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://naxa.com.np">

    <!-- TWITTER META -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@ISET">
    <meta name="twitter:creator" content="@ISET">
    <meta name="twitter:title" content="ISET">
    <meta name="twitter:description" content="ISET | Information about disaster">
    <meta name="twitter:image" content="preview.html">
    
    <!--title-->
    <title><?php echo SITE_NAME_EN ?></title>
    
    <!-- faveicon start   -->
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/frontend/images/ng.png">
    <!-- <link rel="icon" type="image/png" href="images/favicon/favicon-32x32.png" sizes="32x32"> -->
    
    <!-- stylesheet start -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/frontend/newdims/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/frontend/newdims/line-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/frontend/newdims/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/frontend/newdims/magnific-popup.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/frontend/newdims/nice-select.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/frontend/newdims/aos.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/frontend/newdims/style.css">
</head>
<body>
    <body class="">
        <header id="masthead" class="site-header">
            <div class="container">
                <div class="headerWrap">
                    <div class="headLeft">
                        <div class="logo">
                            <a href="<?php echo base_url() ?>"><img src="<?php  echo SITE_SLOGAN_EN; ?>" alt="logo"></a>
                        </div>
                    </div>
                    <div class="headRight">
                        <nav id="site-navigation" class="main-navigation" role="navigation">
                            <div class="toggle-button">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <div class="menu-primary-container">
                                <ul id="primary-menu" class="menu nav-menu">
                                    <li class="<?php if($this->uri->segment(1)){ echo "menu-item"; }else{ echo "menu-item-has-current"; } ?>">
                                        <a href="<?php echo base_url() ?>">गृह पृष्ठ</a>
                                    </li>
                                    <li class="<?php if($this->uri->segment(1)==="knowledge-portal"){ echo "menu-item-has-current"; }else{ echo "menu-item"; } ?>">
                                        <a href="<?php echo base_url('knowledge-portal') ?>">जानकारी पोर्टल</a>
                                    </li>
                                    <li class="<?php if($this->uri->segment(1)==="publication"){ echo "menu-item-has-current"; }else{ echo "menu-item"; } ?>">
                                        <a href="<?php echo base_url('publication') ?>">प्रकाशन </a>
                                    </li>
                                    <li class="<?php if($this->uri->segment(1)==="aboutus"){ echo "menu-item-has-current"; }else{ echo "menu-item"; } ?>">
                                        <a href="<?php echo base_url('aboutus') ?>">परियोजना बारे</a>
                                    </li>
                                    <li class="<?php if($this->uri->segment(1)==="nepal_info"){ echo "menu-item-has-current"; }else{ echo "menu-item"; } ?>">
                                        <a href="<?php echo base_url('nepal_info') ?>">नेपाल  इन्फो </a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
       <main> 
