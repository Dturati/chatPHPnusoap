/**
 * Created by david on 30/09/16.
 */

var websocket = function (){
    var conn = new WebSocket('ws://192.168.1.62:8080');

    conn.onopen = function (e)
    {
        conn.send(1);
    };

    conn.onmessage = function (e) {
        console.log(e.data);
        //resposta.innerHTML +=  e.data + "\n";
        $.ajax({
             url: 'http://192.168.1.62/resposta.php',
             method :'GET',
             dataType : 'html', //dados vindos do servidor

            success:function(html){
                 $("#respostaAjax").html(html);
             },

        });
    }

}

$.ajax({
    url: 'http://192.168.1.62/resposta.php',
    method :'GET',
    dataType : 'html', //dados vindos do servidor

    success:function(html){
        $("#respostaAjax").html(html);
    },

});
websocket();
