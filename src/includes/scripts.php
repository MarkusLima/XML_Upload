<script>

    ConsoleLogHTML.connect(document.getElementById("myULContainer")); // Redirect log messages

    function alertCustomizer(text, color) {
        $.toast({
            text: text,
            showHideTransition: 'slide', // It can be plain, fade or slide
            bgColor: color, // Background color for toast
            textColor: '#eee', // text color
            allowToastClose: true, // Show the close button or not
            hideAfter: 2500, // `false` to make it sticky or time in miliseconds to hide after
            stack: 5, // `fakse` to show one stack at a time count showing the number of toasts that can be shown at once
            textAlign: 'left', // Alignment of text i.e. left, right, center
            position: 'botton-left' // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values to position the toast on page
        })
    }

    function validationFile() {
        var arquivo = document.getElementById('file').value;
        var extensao = arquivo.split(".").pop();

        if (extensao != "xml") {
            $("#btn_submit").prop("disabled", false);
            showImgXml(0);
        } else {
            $("#btn_submit").prop("disabled", false);
            showImgXml(1);
        }
    }

    function showImgXml(show) {
        if (show == 1) {
            $("#img_xml").removeClass("d-none");
        } else {
            $("#img_xml").addClass("d-none");
        }
    };

    var $formulario = document.getElementById('form_envio');
    var $btn_submit = document.getElementById('btn_submit');

    $btn_submit.addEventListener('click', function(event) {

        var xhr = new XMLHttpRequest();
        xhr.open("POST", $formulario.getAttribute('action'));
        var data = new FormData($formulario);

        xhr.send(data);
        
        xhr.onreadystatechange=function()
        {
            if (xhr.readyState==4 && xhr.status==200) {
    
                var json = JSON.parse(xhr.responseText);

                if (json.status === 'File successfully uploaded') {
                    alertCustomizer(json.status, "blue");

                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);

                } else {
                    alertCustomizer(json.status, "#c86864");
                }

            }
        }

    }, false);

    function getFiles(){
        let xhr = new XMLHttpRequest();
        xhr.open('GET', './src/function/get_xml.php');
        xhr.send();

        xhr.onload = function() {
            if (xhr.status == 200) { // analyze HTTP status of the response
                var serverResponse = JSON.parse(xhr.responseText);

                if (serverResponse.body) {

                    var body = '';

                    serverResponse.body.forEach(element => {
                        body += '<div class="col-md-3">'+
                                    '<div class="card">'+
                                        '<div class="card-header d-flex justify-content-around">'+
                                            '<button onclick="detailsXml('+element.id+')" type="button" class="border border-0" data-bs-toggle="modal" data-bs-target="#modalDetails">'+
                                                '<i class="bi bi-eye-fill"></i>'+
                                            '</button>'+
                                            '<button onclick="deleteXml('+element.id+')" type="button" class="border border-0">'+
                                                '<i class="bi bi-trash"></i>'+
                                            '</button>'+
                                        '</div>'+
                                        '<div class="card-body">'+
                                            '<span>'+
                                                '<small>Number: </small>'+
                                                '<strong>'+element.number_nf+'</strong>'+
                                            '</span>'+
                                            '<br>'+
                                            '<span>'+
                                                '<small>Date emiter: </small>'+
                                                '<strong>'+element.date_emiter+'</strong>'+
                                            '</span>'+
                                            '<br>'+
                                            '<span>'+
                                                '<small>Date created: </small>'+
                                                '<strong>'+element.created_at+'</strong>'+
                                            '</span>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>';
                    });

                    $('#render_xml').append(body);
                }
            }
        };

        xhr.onerror = function() {
            alert("Request failed");
        };

    }
    function detailsXml(xml_id)
    {

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "./src/function/details_xml.php");
        var data = new FormData();
        data.append('id', xml_id);

        xhr.send(data);
        
        xhr.onreadystatechange=function()
        {
            if (xhr.readyState==4 && xhr.status==200) {
    
                console.log(xhr.responseText);

            }
        }
    }

    function deleteXml(xml_id)
    {

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "./src/function/delete_xml.php");
        var data = new FormData();
        data.append('id', xml_id);

        xhr.send(data);
        
        xhr.onreadystatechange=function()
        {
            if (xhr.readyState==4 && xhr.status==200) {
    
                var json = JSON.parse(xhr.responseText);

                if (json.status === 'Delete file success') {
                    alertCustomizer(json.status, "blue");
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                } 

            }
        }


    }

    getFiles()
</script>