
        $("#uploader").plupload({
            // General settings
            runtimes : 'html5',
            url : '/image/upload',
            max_file_size : '5mb',
            chunk_size : '1mb',

            init : {
                /*FileUploaded:function(up,file,res){
                    data = $.parseJSON(res.response);
                    if(data.result=="done" ){
                        newimage = '<li data-id="id-1" class="portfolio-item" data-type="util">';
                        newimage += '<div class="image-wrapper">';
                        newimage += '    <img src="/images/400x400/'+data.name+'">';
                        newimage += '    <a href="#"><span>Agrandir</span></a><br>';
                        newimage += '    <a href="#"><span>Dexindexer</span></a><br>';
                        newimage += '    <a href="#"><span>Selectionner</span></a>';
                        newimage += '</div>';
                        newimage += '<div class="bottom-block">';
                        newimage += '    <p>'+data.name+'</p>';
                        newimage += '</div>';
                        newimage += '</li>';
                        //newimage += '<div class="span3"><div class="thumbnail"><img src="/file/'+data.name+'">';
                        $('#portfolio-start').after(newimage);
                    }
                }*/
            }
        });

        // Client side form validation
        $('form').submit(function(e) {
            var uploader = $('#uploader').plupload('getUploader');
            // Files in queue upload them first
            if (uploader.files.length > 0) {
                // When all files are uploaded submit form
                uploader.bind('StateChanged', function() {
                    if (uploader.files.length === (uploader.total.uploaded + uploader.total.failed)) {
                        $('form')[0].submit();
                    }
                });
                uploader.start();
            } else
                alert('You must at least upload one file.');
            return false;
        });