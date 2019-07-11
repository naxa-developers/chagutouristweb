<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
 <link data-require="leaflet@0.7.3" data-semver="0.7.3" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.css" />
<section id="main-content" class="">
    <style>
        .error {
            color: red;
        }
    </style>
   <style>
html, body, #container, #map {
padding: 0;
margin: 0;
}
html, body, #map, #container {
height: 460px;
}
</style>
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading"> Basic Forms </header>
                    <?php $error=$this->session->flashdata('msg'); if($error){ ?>
                    <div class="alert alert-success alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong>Message</strong>
                        <?php echo $error ; ?>
                    </div>
                    <?php } ?>
                    <form role="form" method="POST" action="" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="exampleInputEmail1">सिर्षक </label>
                                <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="Enter Title">
                                <?php echo form_error('title'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="exampleInputEmail1">Sort Order </label>
                                <input type="text" name="sort_order" class="form-control" id="exampleInputEmail1" placeholder="Enter Title">
                                <?php echo form_error('sort_order'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="exampleInputEmail1">longitude </label>
                                <input type="text" id="longitude" name="longitude" class="form-control" id="exampleInputEmail1" placeholder="Enter Title">
                                <?php echo form_error('longitude'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="exampleInputEmail1">Latitude </label>
                                <input type="text" id="latitude" name="latitude" class="form-control" id="exampleInputEmail1" placeholder="Enter Latitude">
                                <?php echo form_error('latitude'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                           <div class="col-md-3" id="AudioUrl" >
                                <label for="exampleInputFile">Location Audio</label>
                                <input type="file" name="audio" id="exampleInputFile"> 
                            </div>
                        </div>
                        
                        <div class="form-group">
                           <div class="col-md-3" id="videoUrl" >
                                <label for="exampleInputFile">Location Video</label>
                                <input type="file" name="video" id="exampleInputFile"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                            <label for="exampleInputFile">Drag Marker To Get Location</label>
                                <div id="map"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label class="control-label">Summary</label>
                                <textarea class="form-control ckeditor" name="summary" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4" id="ImageDiveSelector" >
                                <label class="control-label">About Photo </label>
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"> <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                    <div> <span class="btn btn-white btn-file"> <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span> <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                        <input type="file" name="proj_pic" class="default" /> </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4">
                                <label class="control-label" for="">&nbsp;&nbsp;&nbsp;</label>
                                <button type="submit" name="submit" class="btn btn-info" style="margin-top: 15px;">Submit</button>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </form>
                </section>
            </div>
        </div>
    </section>
</section>
<style type="text/css">
    html, body, #map {
        margin: 0px;
        width: 100%;
        height: 350px;
        padding: 0px;

    }
</style>
<script data-require="leaflet@0.7.3" data-semver="0.7.3" src="//cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.js"></script>
<script type="text/javascript">
    // var tileLayer = new L.TileLayer('http://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png',{
    //   attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, &copy; <a href="http://cartodb.com/attributions">CartoDB</a>'
    // });
    // var tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    // attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> Contributors'
    // });
    // var Esri_WorldStreetMap = L.tileLayer(
    //         'https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}', {
    //             attribution: 'Tiles &copy; Esri &mdash; Source: Esri, DeLorme, NAVTEQ, USGS, Intermap, iPC, NRCAN, Esri Japan, METI, Esri China (Hong Kong), Esri (Thailand), TomTom, 2012'
    //         });
    // var map = new L.Map('map', {
    //   'center': [27.608421548604188, 85.3887634444982],
    //   'zoom': 12,
    //   'layers': [tileLayer]
    // });
     var map = L.map('map').setView([27.701871, 85.315297], 7);
      L.tileLayer('http://webrd0{s}.is.autonavi.com/appmaptile?lang=zh_cn&size=1&scale=1&style=8&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        minZoom: 5,
        subdomains: ['1', '2', '3', '4']
      }).addTo(map)
      var osm = L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'
    });
    var marker = L.marker([27.608421548604188, 85.3887634444982],{
      draggable: true
    }).addTo(map);

    marker.on('dragend', function (e) {
      document.getElementById('latitude').value = marker.getLatLng().lat;
      document.getElementById('longitude').value = marker.getLatLng().lng;
    });
    googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3']
      });
      googleHybrid = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}',{
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3']
      });
      googleSat = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3']
      });
      // googleTerrain = L.tileLayer('http://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}',{
      //   maxZoom: 20,
      //   subdomains:['mt0','mt1','mt2','mt3']
      // });
      //var none = "";
      var baseLayers = {
        "OpenStreetMap": osm,
        "Google Streets": googleStreets,
        "Google Hybrid": googleHybrid,
        "Google Satellite": googleSat,
        "Google Terrain": googleTerrain//,
        //"None": none
      };
    map.addLayer(googleHybrid);
    layerswitcher = L.control.layers(baseLayers, {}, {collapsed: true}).addTo(map);
    //this isfor measure 
      var plugin = L.control.measure({
        //  control position
        position: 'topleft',
        //  weather to use keyboard control for this plugin
        keyboard: true,
        //  shortcut to activate measure
        activeKeyCode: 'M'.charCodeAt(0),
        //  shortcut to cancel measure, defaults to 'Esc'
        cancelKeyCode: 27,
        //  line color
        lineColor: 'red',
        //  line weight
        lineWeight: 2,
        //  line dash
        lineDashArray: '6, 6',
        //  line opacity
        lineOpacity: 1,
        //  distance formatter
        // formatDistance: function (val) {
        //   return Math.round(1000 * val / 1609.344) / 1000 + 'mile';
        // }
      }).addTo(map)
</script>