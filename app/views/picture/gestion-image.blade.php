@extends('template.theme')


@set_true $large_centred 
@section('large-content')
    <section>
        <div>
            <ul class="breadcrumb">
                <li><a href="#">Association</a> <span class="divider">/</span></li>
                <li><a href="/1-qsdf">Faites de la musique</a> <span class="divider">/</span></li>
                <li><a href="/1/edit">Edition</a> <span class="divider">/</span></li>
                <li class="active">Images</li>
            </ul>
            <h3 class="head">{{Lang::get('association/edit/picture.edit_gallery')}}</h3>
            <form>
                <div id="uploader">
                    <p>Si ce message ne change disparait pas sous peu, c'est que votre navigateur est trop ancien pour pouvoir charger notre module d'envoie d'image</p>
                </div>
            </form>
          <div id="busy3" class="square">
          </div>
      </div>
      <div>
        <div class="filter-portfolio">
            <ul class="filterable">
                <li><a class="option-set" data-categories="*">All</a></li>
                <li><a class="option-set" data-categories="design">Design</a></li>
                <li><a class="option-set" data-categories="illustration">Illustration</a></li>
            </ul> 
        </div>
        <div id="gallery" class="portfolio-items isotope span23">
          <!-- Pictures will go here ... -->
        </div>
      </div>
      <a href="#">Top</a>
    </section>
@stop
@section('footer-js')

    <link href="/pluggin/prettyPhoto/prettyPhoto.css" rel="stylesheet">

    <link href="/pluggin/plupload/jquery-ui.css" rel="stylesheet">
    <link href="/pluggin/plupload/jquery.ui.plupload.css" rel="stylesheet">
    <script src="/pluggin/plupload/jquery-ui.js"></script>
    <script src="/pluggin/plupload/plupload.full.js"></script>
    <script src="/pluggin/plupload/jquery.ui.plupload/jquery.ui.plupload.js"></script>
    <script src="/pluggin/plupload/i18n/fr.js"></script>
    <script src="/pluggin/plupload/custom.js"></script>
    <script src="/pluggin/neteye/jquery.activity-indicator-1.0.0.min.js"></script>

    <script id="photo-pattern" type="text/x-jquery-tmpl">
        <div class="element ${categories} span-size${size}" >
            <a class="fancybox" href="${url_img}" rel="gallery1" title="A title">
                <img src="${url_img}" class="size${size}"alt=" " />
            </a>
        </div>
        {{--<div class="thumb-text">
            <b>${head}</b><br>
            <div class="divider"></div>
            <a href="#" title="Image Dummy Title" >${link}</a>
        </div>--}}
    </script>
    <script type="text/javascript">
      function desactiverImage(idImage){
          var informations = $("li[data-id^='id-"+idImage+"']");
          ajax(idImage,"/image/desactiver-image",informations,"desactiverImage");
      }
      function desactiverImageApresAjax(info){
          info.hide();
      }
      
      function selectionnerImage(idImage){
          var informations = $("li[data-id^='id-"+idImage+"']").find('.last span');
          ajax(idImage,"<?php switch($type){case "logo":echo"/association/changer-logo";break;case "affiche":echo"/evenement/changer-affiche";break;}?>",informations,"selectionnerImage");
      }
      function selectionnerImageApresAjax(info,url){
          info.find('.second span').html('<div class="loadings"></div> Redirection ...');
          document.location.href=url;
      }
      function ajax(idImage, url, info,type){
          var infoLibelle = info.find('.second span');
          infoLibelle.html('<img src="http://wbpreview.com/previews/WB0375140/img/loading-black.gif" class="loader"> Chargement ...');
          $('.loadings').each(function(){ 
              $(this).activity({segments: 8, width:2, space: 0, length: 3, align: 'left',color: '#000', speed: 1.5});
          });
          $.ajax({
              url: url,
              dataType: 'json',
              cache:"false",
              data: {id: idImage}
            }).done(function(j) {
                console.log(j);
                console.log(info);
                if(j['etat'] == "succes"){
                    infoLibelle.find('.second span').html('<i class="icon-ok"></i> Ok');
                    switch(type){
                        case "desactiverImage" :
                            desactiverImageApresAjax(info);
                        break;
                        case "selectionnerImage" :
                            selectionnerImageApresAjax(info,j['url']);
                    }
                }else{
                    infoLibelle.find('.second span').html('<i class="icon-remove"></i> <b>Echec</b>');
                }
            },info,type,infoLibelle).error(function(info) {
                  infoLibelle.find('.second span').html('<i class="icon-remove"></i> <b>Echec</b>');
            },infoLibelle);
      }
    /*Gallery PART START*/
    var data = [
        {
            'url_img':'http://lorempixel.com/800/600/sports/',
            'head':'WordPress Custom Theme',
            'link':'Read More',
            'categories':'illustration',
            'size' : '2',
        },
        {
            'url_img':'http://lorempixel.com/800/600/animals/',
            'head':'WordPress Custom Theme',
            'link':'Read More',
            'categories':'illustration design',
            'size' : '1',
        },
        {
            'url_img':'http://lorempixel.com/1000/600/animals/',
            'head':'WordPress Custom Theme',
            'link':'Read More',
            'categories':'illustration',
            'size' : '2',
        },
        {
            'url_img':'http://dummyimage.com/800x1600/4d494d/686a82.gif&text=placeholder+image',
            'head':'WordPress Custom Theme',
            'link':'Read More',
            'categories':'illustration design',
            'size' : '1',
        },
        {
            'url_img':'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-prn1/c26.26.328.328/s160x160/378926_10150600500671124_496920089_n.jpg',
            'head':'WordPress Custom Theme',
            'link':'Read More',
            'categories':'design',
            'size' : '1',
        },{
            'url_img':'http://lorempixel.com/600/1300/animals/',
            'head':'WordPress Custom Theme',
            'link':'Read More',
            'categories':'illustration',
            'size' : '2',
        },
        {
            'url_img':'http://dummyimage.com/800x600/4d494d/686a82.gif&text=placeholder+image',
            'head':'WordPress Custom Theme',
            'link':'Read More',
            'categories':'illustration design',
            'size' : '1',
        },
        {
            'url_img':'http://dummyimage.com/1000x768/4d494d/686a82.gif&text=placeholder+image',
            'head':'WordPress Custom Theme',
            'link':'Read More',
            'categories':'illustration',
            'size' : '2',
        },
        {
            'url_img':'http://dummyimage.com/800x1600/4d494d/686a82.gif&text=placeholder+image',
            'head':'WordPress Custom Theme',
            'link':'Read More',
            'categories':'illustration design',
            'size' : '1',
        },
        {
            'url_img':'http://dummyimage.com/800x600/4d494d/686a82.gif&text=placeholder+image',
            'head':'WordPress Custom Theme',
            'link':'Read More',
            'categories':'design',
            'size' : '1',
        },{
            'url_img':'http://dummyimage.com/800x600/4d494d/686a82.gif&text=placeholder+image',
            'head':'WordPress Custom Theme',
            'link':'Read More',
            'categories':'illustration',
            'size' : '2',
        },
        {
            'url_img':'http://dummyimage.com/800x600/4d494d/686a82.gif&text=placeholder+image',
            'head':'WordPress Custom Theme',
            'link':'Read More',
            'categories':'illustration design',
            'size' : '1',
        },
        {
            'url_img':'http://dummyimage.com/1000x768/4d494d/686a82.gif&text=placeholder+image',
            'head':'WordPress Custom Theme',
            'link':'Read More',
            'categories':'illustration',
            'size' : '2',
        },
        {
            'url_img':'http://dummyimage.com/800x1600/4d494d/686a82.gif&text=placeholder+image',
            'head':'WordPress Custom Theme',
            'link':'Read More',
            'categories':'illustration design',
            'size' : '1',
        },
        {
            'url_img':'http://dummyimage.com/800x600/4d494d/686a82.gif&text=placeholder+image',
            'head':'WordPress Custom Theme',
            'link':'Read More',
            'categories':'design',
            'size' : '1',
        },
    ]
    loadGallery($('#gallery'),data,$('#photo-pattern'));
    /*Gallery PART END*/
    </script>
@stop

