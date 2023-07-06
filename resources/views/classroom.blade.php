<html>
    <head>
        <title> OpenTok Getting Started </title>
        <style>
         body, html {
    background-color: gray;
    height: 100%;
}
#videos {
    position: relative;
    width: 70%;
    height: 100%;
    float: left;
}
#subscriber {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    margin-left: 50px;
    z-index: 10;
}
#publisher {
    position: absolute;
    width: 360px;
    height: 240px;
    bottom: 10px;
    left: 10px;
    z-index: 100;
    border: 3px solid white;
    border-radius: 3px;
}
#textchat {
    position: relative;
    width: 20%;
    float: right;
    right: 0;
    height: 100%;
    background-color: #333;
}
#history {
     width: 100%;
     height: calc(100% - 40px);
     overflow: auto;
}
input#msgTxt {
            height: 40px;
            position: absolute;
            bottom: 0;
            width: 100%;
}
#history .mine {
    color: #00FF00;
    text-align: right;
    margin-right: 10px;
}
#history .theirs {
    color: #00FFFF;
    margin-left: 10px;
}

        </style>

        <script src="https://static.opentok.com/v2/js/opentok.min.js"></script>

    </head>

    <body>
        <div id="videos">
            <div id="subscriber">
                <button type="button" onclick="leaveSession();" id="disconnectBtn">Leave</button>
            </div>
            <div id="publisher">
                <button type="button"  id="stopBtn" style="display: none">Stop</button>
                {{-- <button type="button" onclick="stopCamera();" id="stopCamera" style="float: right;display: none;">Stop Camera</button> --}}
            </div>
        </div>

           <div id="textchat">
         <p id="totalCount" style="background: #fff;color:red"></p>
         <p id="history"></p>
         <form>
              <input type="text" placeholder="Input your text here" id="msgTxt"></input>
         </form>
    </div>  

        <script type="text/javascript">
            var session;
            var connectionCount = 0;
            var apiKey = "{{env('VONAGE_API_KEY')}}";
            var sessionId = "{{$sessionId}}";
            var token = "{{$token}}";
            var publisher;
            var subscriber;
            var streams = [];
            var subscribers = [];
           let stopBtn =  document.getElementById("stopBtn");

            function connect() {

                // Replace apiKey and sessionId with your own values:

                session = OT.initSession(apiKey, sessionId);
                session.on("streamCreated", function (event) {
                      var stream = event.stream;
   // displayStream(stream);
                     subscriber =  session.subscribe(event.stream, 'subscriber', {
                        insertMode: 'append',
                        width: '100%',
                        height: '100%',
                       
                    });
                    console.log("New stream in the session: " + event.stream.streamId);
                   
                });

                session.on({
                    connectionCreated: function (event) {
                        connectionCount++;
                        document.getElementById("totalCount").textContent= 'Total Count'+ connectionCount;
                        console.log(connectionCount + ' connections.');
                    },
                    connectionDestroyed: function (event) {
                        connectionCount--;
                             document.getElementById("totalCount").textContent= 'Total Count'+connectionCount;
                        alert(connectionCount + ' connections.');
                    },
                    sessionDisconnected: function sessionDisconnectHandler(event) {
                        // The event is defined by the SessionDisconnectEvent class
                        alert('Disconnected from the session.');
                        document.getElementById('disconnectBtn').style.display = 'none';
                         // window.history.back();
                        if (event.reason == 'networkDisconnected') {
                            alert('Your network connection terminated.')
                              window.history.back();
                        }
                    }
                });




                var publisher = OT.initPublisher('publisher', {
                    insertMode: 'append',
                    width: '100%',
                    height: '100%',
                  
                });



publisher.on('streamCreated', function (event) {
    console.log('The publisher started streaming.');
});
publisher.on("streamDestroyed", function (event) {
  alert("The publisher stopped streaming. Reason: "
    + event.reason);
});



stopBtn.addEventListener('click', function (event) {
    // session.unpublish(publisher);
 session.disconnect();
     // window.history.back();
 
});
                console.log(publisher);

 

                // Replace token with your own value:
                session.connect(token, function (error) {
                    if (error) {
                        alert('Unable to connect: ', error.message);
                    } else {
                        // document.getElementById('disconnectBtn').style.display = 'block';
                        console.log('Connected to the session.');
                        connectionCount = 1;

                        if (session.capabilities.publish == 1) {
                        
                            session.publish(publisher);
                             document.getElementById('stopBtn').style.display = 'block';
                        } else {

                             // document.getElementById('stopCamera').style.display = 'block';
                            alert("You cannot publish an audio-video stream.");
                        }
                    }
                });

                                 // Receive a message and append it to the history
                  var msgHistory = document.querySelector('#history');
                  session.on('signal:msg', function signalCallback(event) {
                    var msg = document.createElement('p');
                    msg.textContent = event.data;
                    msg.className = event.from.connectionId === session.connection.connectionId ? 'mine' : 'theirs';
                    msgHistory.appendChild(msg);
                    msg.scrollIntoView();
                  });
            }







            connect();

            function displayStream(stream) {
    var div = document.createElement('div');
    div.setAttribute('id', 'stream' + stream.streamId);

    var subscriber = session.subscribe(stream, div);
    subscribers.push(subscriber);

    var aLink = document.createElement('a');
    aLink.setAttribute('href', 'javascript: unsubscribe("' + subscriber.id + '")');
    aLink.innerHTML = "Unsubscribe";

    var streamsContainer = document.getElementById('subscriber');
    streamsContainer.appendChild(div);
    streamsContainer.appendChild(aLink);

    streams = event.streams;
    
}


function stopSession() {
        if (session.capabilities.publish == 1) {
             session.unpublish(publisher);
         } else{
            alert('you cannot stop the sessioon')
         }
      
    }
    function leaveSession() {
        session.disconnect();
    }
     
            // Text chat
var form = document.querySelector('form');
var msgTxt = document.querySelector('#msgTxt');

// Send a signal once the user enters data in the form
form.addEventListener('submit', function submit(event) {
  event.preventDefault();

  session.signal({
    type: 'msg',
    data: msgTxt.value
  }, function signalCallback(error) {
    if (error) {
      console.error('Error sending signal:', error.name, error.message);
    } else {
      msgTxt.value = '';
    }
  });
});

        </script>
    </body>
</html>