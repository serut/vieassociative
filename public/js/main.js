

/*Gallery PLUGIN STARTS
 * Create a responsive gallery which load from data pictures using masonry
 */
function loadGallery(el,data,picturePattern) {
    picturePattern.tmpl(data).appendTo('#'+el.attr('id'));
    var imgLoad = imagesLoaded('#'+el.attr('id')+' img');
    
    var conf = {
        itemSelector : '.element',
        layoutMode: 'masonry',
        columnWidth : 210,
    };
    imgLoad.on( 'done', function( instance ) {
        el.masonry(conf);
    });
    $(".fancybox").fancybox({
        'transitionIn' : 'elastic',
        'transitionOut' : 'elastic',
        'speedIn' : 600,
        'speedOut' : 200,
        'overlayShow' : false 
    });
    var li = el.find("li");
    var filters = el.parent().find(".filterable a");
    filters.first().addClass('active');
    $(li, filters).each(function(i) {
        $(this).addClass($(this).attr('data-categories') );
    });
    filters.click(function(e) {
        currentOption = $(this).attr('data-categories');
        filters.removeClass('active');
        $(this).addClass('active');
        el.find('.element').each(function(){
            (!$(this).hasClass(currentOption) && currentOption!='*') ? $(this).hide() : $(this).show();
            $(this).css('position', 'absolute'); // correct masonry bug
        });
        el.masonry(); // re-sort goods
        e.preventDefault();
    });
    filters.first().addClass('active');
    /*JQUERY HOVER OPACITY EFFECT STARTS*/
    el.find(".item-hover").hover(
        function(){
            $(this).find(".portfolio-thumbnail").stop(true, true).animate({ opacity: 'show' }, 100);
        },function() {
            $(this).find(".portfolio-thumbnail").stop(true, true).animate({ opacity: 'hide' }, 500);
        }
    );
    /*JQUERY HOVER OPACITY EFFECT ENDS*/
};
 /*Gallery PLUGIN ENDS*/

/*toggle on form PLUGIN STARTS
 * Allows form to toggle elements depending on values of specific checkbox and radio
 */

function toggle_content(toggleEl,val){
    if(val == "true"){
        $('#'+toggleEl).show();
    }else{
        $('#'+toggleEl).hide();
    }
};
$('div.controls[data-toggle]').each(function(){
    var checkboxes = $(this).find('input[type=checkbox]');
    var radios = $(this).find('input[type=radio]');
    var dataToggle = $(this).attr('data-toggle');
    if(radios.length != 0){
        radios.each(function(){
            $(this).change(function(){
                toggle_content(dataToggle,$(this).val());
            });
            if($(this).is(':checked')){
                toggle_content(dataToggle,$(this).val());
            }

        })
    }
    if(checkboxes.length != 0){
        checkboxes.each(function(){
            $(this).change(function(){
                if($(this).is(':checked')){
                    toggle_content(dataToggle,"true");
                }else{
                    toggle_content(dataToggle,"false");
                }
            });
            if($(this).is(':checked')){
                toggle_content(dataToggle,"true");
            }

        })
    }
});
 /*toggle on form PLUGIN ENDS*/



/*Textarea editor PLUGIN STARTS
 * Bind the load of the wysiwyg editor for a textarea
 */
var editorAdded = false;
function launchEditor(el){
    var idEditor = el.attr('id');
    if(! editorAdded){
        var script = document.createElement("script")
        script.type = "text/javascript";
        if (script.readyState){  //IE
            script.onreadystatechange = function(){
                if (script.readyState == "loaded" || script.readyState == "complete"){
                    script.onreadystatechange = null;
                    launchEditorReady(idEditor);
                }
            };
        } else {  //Others
            script.onload = function(){
                launchEditorReady(idEditor);
            };
        }
        script.src = '/pluggin/nicEdit/nicEdit.js';
        document.getElementsByTagName("head")[0].appendChild(script);
        editorAdded = true;
    }else{
        launchEditorReady(idEditor);
    }
}
function launchEditorReady(idEditor){
    var editor = new nicEditor({
        fullPanel : true,
        iconsPath : '/pluggin/nicEdit/nicEditorIcons.gif',
        bgcolor : '#fff'
    }).panelInstance(idEditor);
    $('#'+idEditor).parent().find('.nicEdit-main').focus();
}
 /*Modal form PLUGIN ENDS*/






/*Modal form PLUGIN STARTS*/
function modalForFormModification(data){
    var html = '<section id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
        html+= '<div class="modal-header">';
        html+= '<button type="button" class="close close-modal" data-dismiss="modal" aria-hidden="true">×</button>';
        html+= '<h3>'+data['head']+'</h3>';
        html+= '</div>';
        html+= '<div class="modal-body">';
        html+= data['content'];
        html+= '</div>';
        html+= '<div class="modal-footer">';
        html+= '<button class="button button-orange" data-dismiss="modal" aria-hidden="true">Annuler</button> ';
        html+= '<button class="button button-blue" onclick="$(this).parent().parent().find(\'form\').submit();">Envoyer</button>';
        html+= '</div>';
        html+= '</section>';
    $('#push').before(html);
    $('#myModal').on('hidden', function () {
      $(this).remove();
    })
    $('#myModal').modal('show')
}
 /*Modal form PLUGIN ENDS*/


/*Bootstrap bind PLUGIN STARTS
 * Bind specific forms for validate using Parsley
 */
$(function(){
    $("[data-rel=tooltip]").tooltip();
})
 /*Bootstrap bind PLUGIN ENDS*/




/*Bad Browser PLUGIN STARTS
 * Reject old browser
 * browser-update.org notification script, <browser-update.org>
 * Copyright (c) 2007-2009, MIT Style License <browser-update.org/LICENSE.txt>
 */
$(function(){
    var $buo = function(op,test) {
        var jsv=5;
        var n = window.navigator,b;
        this.op=op||{};
        //options
        this.op.l = op.l||n["language"]||n["userLanguage"]||document.documentElement.getAttribute("lang")||"en";
        this.op.vsakt = {i:10,f:22,o:12,s:6,n:20};
        this.op.vsdefault = {i:7,f:4,o:11,s:4,n:10};
        this.op.vs =op.vs||this.op.vsdefault;
        for (b in this.op.vsakt)
            if (this.op.vs[b]>=this.op.vsakt[b])
                this.op.vs[b]=this.op.vsakt[b]-0.05;


        this.op.onshow = op.onshow||function(o){};

        this.op.test=test||op.test||false;
        if (window.location.hash=="#test-bu")
            this.op.test=true;

        function getBrowser() {
            var n,v,t,ua = navigator.userAgent;
            var names={i:'Internet Explorer',f:'Firefox',o:'Opera',s:'Apple Safari',n:'Netscape Navigator', c:"Chrome", x:"Other"};
            if (/bot|googlebot|slurp|mediapartners|adsbot|silk|android|phone|bingbot|google web preview|like firefox|chromeframe|seamonkey|opera mini|min|meego|netfront|moblin|maemo|arora|camino|flot|k-meleon|fennec|kazehakase|galeon|android|mobile|iphone|ipod|ipad|epiphany|rekonq|symbian|webos/i.test(ua)) n="x";
            else if (/Trident.(\d+\.\d+)/i.test(ua)) n="io";
            else if (/MSIE.(\d+\.\d+)/i.test(ua)) n="i";
            else if (/Chrome.(\d+\.\d+)/i.test(ua)) n="c";
            else if (/Firefox.(\d+\.\d+)/i.test(ua)) n="f";
            else if (/Version.(\d+.\d+).{0,10}Safari/i.test(ua))    n="s";
            else if (/Safari.(\d+)/i.test(ua)) n="so";
            else if (/Opera.*Version.(\d+\.?\d+)/i.test(ua)) n="o";
            else if (/Opera.(\d+\.?\d+)/i.test(ua)) n="o";
            else if (/Netscape.(\d+)/i.test(ua)) n="n";
            else return {n:"x",v:0,t:names[n]};
            if (n=="x") return {n:"x",v:0,t:names[n]};
            
            v=new Number(RegExp.$1);
            if (n=="so") {
                v=((v<100) && 1.0) || ((v<130) && 1.2) || ((v<320) && 1.3) || ((v<520) && 2.0) || ((v<524) && 3.0) || ((v<526) && 3.2) ||4.0;
                n="s";
            }
            if (n=="i" && v==7 && window.XDomainRequest) {
                v=8;
            }
            if (n=="io") {
                n="i";
                if (v>5) v=10;
                else if (v>4) v=9;
                else if (v>3.1) v=8;
                else if (v>3) v=7;
                else v=9;
            }   
            return {n:n,v:v,t:names[n]+" "+v}
        }

        this.op.browser=getBrowser();
        if (!this.op.test && (!this.op.browser || !this.op.browser.n || this.op.browser.n=="x" || this.op.browser.n=="c" || document.cookie.indexOf("browserupdateorg=pause")>-1 || this.op.browser.v>this.op.vs[this.op.browser.n])){
            return;
        }

        var ll=this.op.l.substr(0,2);
        var languages = "de,en";

        function busprintf() {
            var args=arguments;
            var data = args[ 0 ];
            for( var k=1; k<args.length; ++k ) {
                data = data.replace( /%s/, args[ k ] );
            }
            return data;
        }

        var t = 'Your browser (%s) is <b>out of date</b>. It has known <b>security flaws</b> and may <b>not display all features</b> of this and other websites. \
                 <a href="http://browsehappy.com/">Learn how to update your browser</a>';
        if (ll=="de")
            t = 'Sie verwenden einen <b>veralteten Browser</b> (%s) mit <b>Sicherheitsschwachstellen</b> und <b>k&ouml;nnen nicht alle Funktionen dieser Webseite nutzen</b>. \
                <a href="http://browsehappy.com/">Hier erfahren Sie, wie einfach Sie Ihren Browser aktualisieren k&ouml;nnen</a>.';
        else if (ll=="it")
            t = 'Il tuo browser (%s) <b>non è aggiornato</b>. Ha delle <b>falle di sicurezza</b> e potrebbe <b>non visualizzare correttamente</b> le \
                pagine di questo e altri siti. \
                <a href="http://browsehappy.com/">Aggiorna il tuo browser</a>!';
        else if (ll=="pl")
            t = 'Przeglądarka (%s), której używasz, jest przestarzała. Posiada ona udokumentowane <b>luki bezpieczeństwa, inne wady</b> oraz <b>ograniczoną funkcjonalność</b>. Tracisz możliwość skorzystania z pełni możliwości oferowanych przez niektóre strony internetowe. <a href="http://browsehappy.com/">Dowiedz się jak zaktualizować swoją przeglądarkę</a>.';
        else if (ll=="es")
            t = 'Tu navegador (%s) está <b>desactualizado</b>. Tiene conocidas <b>fallas de seguridad</b> y podría <b>no mostrar todas las características</b> de este y otros sitios web. <a href="http://browsehappy.com/">Aprénde cómo puedes actualizar tu navegador</a>';
        else if (ll=="nl")
            t = 'Uw browser (%s) is <b>oud</b>. Het heeft bekende <b>veiligheidsissues</b> en kan <b>niet alle mogelijkheden</b> weergeven van deze of andere websites. <a href="http://browsehappy.com/">Lees meer over hoe uw browser te upgraden</a>';
        else if (ll=="pt")
            t = 'Seu navegador (%s) está <b>desatualizado</b>. Ele possui <b>falhas de segurança</b> e pode <b>apresentar problemas</b> para exibir este e outros websites. <a href="http://browsehappy.com/">Veja como atualizar o seu navegador</a>';
        else if (ll=="sl")
            t = 'Vaš brskalnik (%s) je <b>zastarel</b>. Ima več <b>varnostnih pomankljivosti</b> in morda <b>ne bo pravilno prikazal</b> te ali drugih strani. \
                <a href="http://browsehappy.com/">Poglejte kako lahko posodobite svoj brskalnik</a>';
        else if (ll=="ru")
            t = 'Ваш браузер (%s) <b>устарел</b>. Он имеет <b>уязвимости в безопасности</b> и может <b>не показывать все возможности</b> на этом и других сайтах. <a href="http://browsehappy.com/">Узнайте, как обновить Ваш браузер</a>';
        else if (ll=="id")
            t = 'Browser Anda (% s) sudah <b>kedaluarsa</b>. Browser yang Anda pakai memiliki <b>kelemahan keamanan</b> dan mungkin <b>tidak dapat menampilkan semua fitur</b> dari situs Web ini dan lainnya. <a href="http://browsehappy.com/"> Pelajari cara memperbarui browser Anda</a>';
        else if (ll=="uk")
            t = 'Ваш браузер (%s) <b>застарів</b>. Він <b>уразливий</b> й може <b>не відображати всі можливості</b> на цьому й інших сайтах. <a href="http://browsehappy.com/">Дізнайтесь, як оновити Ваш браузер</a>';
        else if (ll=="ko")
            t = '지금 사용하고 계신 브라우저(%s)는 <b>오래되었습니다.</b> 알려진 <b>보안 취약점</b>이 존재하며, 새로운 웹 사이트가 <b>깨져 보일 수도</b> 있습니다. <a href="http://browsehappy.com/">브라우저를 어떻게 업데이트하나요?</a>';
        else if (ll=="rm")
            t = 'Tes navigatur (%s) è <b>antiquà</b>. El cuntegna <b>problems da segirezza</b> enconuschents e mussa eventualmain <b>betg tut las funcziuns</b> da questa ed autras websites. <a href="http://browsehappy.com/">Emprenda sco actualisar tes navigatur</a>.';
        else if (ll=="ja")  
            t = 'お使いのブラウザ「%s」は、<b>時代遅れ</b>のバージョンです。既知の<b>脆弱性</b>が存在するばかりか、<b>機能不足</b>によって、サイトが正常に表示できない可能性があります。 \
                 <a href="http://browsehappy.com/">ブラウザを更新する方法を確認する</a>';
        else if (ll=="fr")
            t = 'Certaines choses vieillisse bien et prennent de la valeur avec le temps.  Ce n\'est assurément pas le cas de %s.<br> <a href="http://browsehappy.com/">Mettez le à jour</a> tout de suite tant qu\'il en est encore temps !';
        else if (ll=="da")
                t = 'Din browser (%s) er <b>forældet</b>. Den har kendte <b>sikkerhedshuller</b> og kan måske <b>ikke vise alle funktioner</b> på dette og andre websteder. <a href="http://browsehappy.com/">Se hvordan du opdaterer din browser</a>';
        else if (ll=="al")
                t = 'Shfletuesi juaj (%s) është <b>ca i vjetër</b>. Ai ka <b>të meta sigurie</b> të njohura dhe mundet të <b>mos i shfaqë të gjitha karakteristikat</b> e kësaj dhe shumë faqeve web të tjera. <a href="http://browsehappy.com/">Mësoni se si të përditësoni shfletuesin tuaj</a>';
        else if (ll=="ca")
                t = 'El teu navegador (%s) està <b>desactualitzat</b>. Té <b>vulnerabilitats</b> conegudes i pot <b>no mostrar totes les característiques</b> d\'aquest i altres llocs web. <a href="http://browsehappy.com/">Aprèn a actualitzar el navegador</a>';
        else if (ll=="tr")
            t = 'Tarayıcınız (%s) <b>güncel değildir.</b>. Eski versiyon olduğu için <b>güvenlik açıkları</b> vardır ve görmek istediğiniz bu web sitesinin ve diğer web sitelerinin <b>tüm özelliklerini hatasız bir şekilde</b> gösteremeyecektir. \
                 <a href="http://browsehappy.com/">Tarayıcınızı nasıl güncelleyeceğinizi öğrenin!</a>';
        else if (ll=="fa")
            t = 'مرورگر شما (%s) <b>از رده خارج شده</b> می باشد. این مرورگر دارای <b>مشکلات امنیتی شناخته شده</b> می باشد و <b>نمی تواند تمامی ویژگی های این</b> وب سایت و دیگر وب سایت ها را به خوبی نمایش دهد. \
                 <a href="http://browsehappy.com/">در خصوص گرفتن راهنمایی درخصوص نحوه ی به روز رسانی مرورگر خود اینجا کلیک کنید.</a>';
        else if (ll=="sv")
            t = 'Din webbläsare (%s) är <b>föråldrad</b>. Den har kända <b>säkerhetshål</b> och <b>kan inte visa alla funktioner korrekt</b> på denna och på andra webbsidor. <a href="http://browsehappy.com/">Uppdatera din webbläsare idag</a>';
        else if (ll=="sv")
            t = 'Az Ön böngészője (%s) <b>elavult</b>. Ismert <b>biztonsági hiányosságai</b> vannakés esetlegesen <b>nem tud minden funkciót megjeleníteni</b> ezen vagy más weboldalakon. <a href="http://browsehappy.com/">Itt talál bővebb információt a böngészőjének frissítésével kapcsolatban</a>      ';
        if (op.text)
            t = op.text;

        this.op.text=busprintf(t,this.op.browser.t,' href="<a href="http://browsehappy.com/">"');
        var txt = '<div class="container">';
            txt +='  <section class="span24">';
            txt +='    <p>';
            txt +=this.op.text;
            txt +='    </p>';
            txt +='  </section>';
            txt += '</div>';
        $(txt).insertAfter("header");
    }
    var $buoop = {vs:{i:9,f:15,o:10.6,s:4,n:9}} 
    $bu=$buo($buoop);

});
 /*Bad Browser PLUGIN ENDS*/

/*
Not used : 
    $("[data-toggle=dropdown]").dropdown();
    $('#dropdown-association').click(function(event){
        $('#dropdown-association-toggle').toggle();
        $('#dropdown-user-toggle').hide();
        $('#dropdown-association').addClass('current');
        $('#dropdown-user').removeClass('current');
        event.stopPropagation();
    })
    $('#dropdown-user').click(function(event){
      $('#dropdown-user-toggle').toggle();
      $('#dropdown-association-toggle').hide();

      $('#dropdown-association').removeClass('current');
      $('#dropdown-user').addClass('current');
      event.stopPropagation();
    })
    $('html').click(function(){
      $('#dropdown-association-toggle').hide();
      $('#dropdown-user-toggle').hide();
      $('#dropdown-association').removeClass('current');
      $('#dropdown-user').removeClass('current');
    })
    $('.dropdown-items').click(function(event){
      event.stopPropagation();
    })
*/