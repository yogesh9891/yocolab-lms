<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{$course->title}}</title>
    <meta name="csrf-token" content="{{csrf_token()}}">

    {{-- <link rel="stylesheet" href="{{asset('video/css/style.css')}}"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" >

    <style type="text/css">
      html,
body {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: sans-serif;
}

.clickable {
  cursor: pointer;
}

*,
*:before,
*:after {
    box-sizing: inherit;
}

.App-header {
    background-color: #222;
    height: 40px;
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 20px;
}

.App-header h1 {
    font-size: 16px;
    font-weight: 200;
}

.App-logo {
    height: 60%;
    width: auto;
}

.App-main {
    position: relative;
    width: 100vw;
    height: calc(100vh - 40px);
    margin: auto;
    display: flex;
    flex-direction: row;
    flex-wrap: nowrap;
    overflow: hidden;
}

.App-control-container {
    position: absolute;
    height: 60px;
    width: 100%;
    left: 0;
    bottom: 24px;
    padding: 0 35px;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    z-index: 100!important;
    /* Permalink - use to edit and share this gradient: https://colorzilla.com/gradient-editor/#45484d+0,000000+100;Black+3D+%231 */
    background: #45484d; /* Old browsers */
    background: -moz-linear-gradient(top,  #45484d 0%, #000000 100%); /* FF3.6-15 */
    background: -webkit-linear-gradient(top,  #45484d 0%,#000000 100%); /* Chrome10-25,Safari5.1-6 */
    background: linear-gradient(to bottom,  #45484d 0%,#000000 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#45484d', endColorstr='#000000',GradientType=0 ); /* IE6-9 */
}

.audio-vedio-wrapper{display: flex;flex-direction: row;align-items: center;justify-content: space-between;gap: 7px;}
.end-wrapper{display: flex;flex-direction: row;align-items: center;justify-content: space-between;gap: 7px;}

.App-control-container.hidden {
    display: none;
}

.App-control-container .ots-video-control {
    width: 50px;
    height: 50px;
    margin: 20px 0 !important;
    border: 2px solid white;
    border-radius: 50%;
    background-position: center;
    background-color: #ff5501;
    background-repeat: no-repeat;
    cursor: pointer;
}
.ots-video-control.text-chat.disabled, .ots-video-control.text-chat:hover {
    background-color: #ff5501!important;
}

.App-control-container .ots-video-control.audio {
    background-image: url(https://assets.tokbox.com/solutions/images/icon-mic.png);
}

.App-control-container .ots-video-control.audio:hover, .App-control-container .ots-video-control.audio.muted {
    background-image: url(https://assets.tokbox.com/solutions/images/icon-muted-mic.png);
}

.App-control-container .ots-video-control.video {
    background-image: url(https://assets.tokbox.com/solutions/images/icon-video.png);
}

.App-control-container .ots-video-control.video.muted {
    background-image: url(https://assets.tokbox.com/solutions/images/icon-no-video.png);
}
.App-control-container .ots-video-control.endCall {
    background-image: url(../../front_assets/images/turn-off.png);
    background-size: 26px;
    background-position: center 9px;
}

.App-control-container .ots-video-control.endMeeting {
    background-image: url(../../front_assets/images/end.png);
    background-size: 50px;
    background-position: center;
}

#sidebarCollapse{position: absolute;left: calc(50% - -30px);background-image: url(https://development.yocolab.com/front_assets/images/group.png);background-size: 35px;background-position: center;}
#enableTextChat{position: absolute;left: calc(50% - 25px);}
#startScreenSharing{position: absolute;left: calc(50% - -85px);}
#enableArchiving{position: absolute;left: calc(50% - 80px);}

.App-video-container {
    position: relative;
    width: 100vw;
    height: calc(100vh - 40px);
    display: flex;
    justify-content: center;
    align-items: center;
}

.App-mask {
    width: 100%;
    height: 100%;
    position: relative;
    color: white;
    background: #d86a26d4;
    display: flex;
    justify-content: center;
    align-items: center;
}

.App-mask.hidden {
    display: none;
}

.App-mask .react-spinner {
    position: absolute;
}

.App-mask .message {
    font-weight: 200;
}

.App-mask .message.with-spinner {
    position: absolute;
    top: 57.5%;
}

.App-mask .message.button {
    border: 1px solid white;
    padding: 20px 40px;
    border-radius: 6px;
}

.App-video-container .video-container {
    width: 100%;
    height: 100%;
    display: flex;
}

.App-video-container .video-container.small {
    position: absolute;
    top: 20px;
    right: 20px;
    width: 160px;
    height: 96px;
    border: 1px solid #fcba00;
    z-index: 2;
}

.App-video-container .video-container.small.left {
    left: 20px;
    border: 1px solid #00fcc2;
}

.App-video-container .video-container.hidden {
    display: none;
}

#sidebar{padding-bottom: 30px;}
#sidebar .sidebar-header{}
#sidebar .sidebar-header h4{margin: auto;text-transform: uppercase;padding: 15px;background: #ff5501;color: #fff;font-size: 19px;font-weight: bold;}
#sidebar .sidebar-header1{}
#sidebar ul.list-unstyled{}
#sidebar ul.list-unstyled li{border-bottom: 1px solid #cacaca;padding: 10px 20px 10px 22px;white-space: nowrap;min-width: 265px;}
#sidebar ul.list-unstyled li img{width: 16px;position: relative;left: -10px;filter: opacity(0.5);}


.App-video-container .video-container.active-2 .OT_subscriber {height: 50%;}
.App-video-container .video-container.active-3 .OT_subscriber {width: calc(100%/2) !important;height: calc(100%/0) !important;}
.App-video-container .video-container.active-4 {flex-wrap: wrap;justify-content: center;}
.App-video-container .video-container.active-4 .OT_subscriber {width: calc(100%/2) !important;height: calc(100%/2) !important;}
.App-video-container .video-container.active-5 {flex-wrap: wrap;justify-content: center;}
.App-video-container .video-container.active-5 .OT_subscriber {width: calc(100%/3) !important;height: calc(100%/2) !important;}
.App-video-container .video-container.active-6 {flex-wrap: wrap;justify-content: center;}
.App-video-container .video-container.active-6 .OT_subscriber {width: calc(100%/3) !important;height: calc(100%/2) !important;}
.App-video-container .video-container.active-7 {flex-wrap: wrap;justify-content: center;}
.App-video-container .video-container.active-7 .OT_subscriber {width: calc(100%/4) !important;height: calc(100%/2) !important;}
.App-video-container .video-container.active-8 {flex-wrap: wrap;justify-content: center;}
.App-video-container .video-container.active-8 .OT_subscriber {width: calc(100%/4) !important;height: calc(100%/2) !important;}
.App-video-container .video-container.active-9 {flex-wrap: wrap;justify-content: center;}
.App-video-container .video-container.active-9 .OT_subscriber {width: calc(100%/4) !important;height: calc(100%/3) !important;}
.App-video-container .video-container.active-10 {flex-wrap: wrap;justify-content: center;}
.App-video-container .video-container.active-10 .OT_subscriber {width: calc(100%/4) !important;height: calc(100%/3) !important;}
.App-video-container .video-container.active-11 {flex-wrap: wrap;justify-content: center;}
.App-video-container .video-container.active-11 .OT_subscriber {width: calc(100%/4) !important;height: calc(100%/3) !important;}
.App-video-container .video-container.active-12 {flex-wrap: wrap;justify-content: center;}
.App-video-container .video-container.active-12 .OT_subscriber {width: calc(100%/4) !important;height: calc(100%/3) !important;}
.App-video-container .video-container.active-13 {flex-wrap: wrap;justify-content: center;}
.App-video-container .video-container.active-13 .OT_subscriber {width: calc(100%/5) !important;height: calc(100%/3) !important;}
.App-video-container .video-container.active-14 {flex-wrap: wrap;justify-content: center;}
.App-video-container .video-container.active-14 .OT_subscriber {width: calc(100%/5) !important;height: calc(100%/3) !important;}
.App-video-container .video-container.active-15 {flex-wrap: wrap;justify-content: center;}
.App-video-container .video-container.active-15 .OT_subscriber {width: calc(100%/5) !important;height: calc(100%/3) !important;}
.App-video-container .video-container.active-16 {flex-wrap: wrap;justify-content: center;}
.App-video-container .video-container.active-16 .OT_subscriber {width: calc(100%/4) !important;height: calc(100%/4) !important;}




.App-chat-container{}
.App-chat-container .ots-text-chat-container {
    width: 25vw;
}
.ots-text-chat{
  margin-top: auto!important;
}
.ots-text-chat .ots-messages-holder {
    height: calc(100vh - 112px)!important;
}
.ots-text-chat .ots-send-message-box .ots-character-count{
  top: -18px!important;
  right: 22px!important;
}
progress-spinner {
  display: inline-block;
  width: 1em;
  height: 1em;
  border: 1px solid transparent;
  border-top-color: rgba(0, 0, 0, 0.6);
  border-radius: 50%;
  -webkit-animation: rotate 800ms linear infinite;
          animation: rotate 800ms linear infinite;
}
progress-spinner[dark] {
  border-top-color: rgba(255, 255, 255, 0.6);
}
progress-spinner[dotted] {
  border-width: 0;
  border-style: dotted;
  border-top-width: 2px;
}
@-webkit-keyframes rotate {
  0% {
    -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
  }
}
@keyframes rotate {
  0% {
    -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
  }
}
    </style>
    <link rel="stylesheet" href="https://assets.tokbox.com/solutions/css/style.css">
    <script src="https://static.opentok.com/v2/js/opentok.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/livestamp/1.1.2/livestamp.min.js"></script>
     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" ></script>

    <script src="{{asset('video/js/components/opentok-solutions-logging.js')}}"></script>
    <script src="{{asset('video/js/components/opentok-text-chat.js')}}"></script>
    <script src="{{asset('video/js/components/opentok-screen-sharing.js')}}"></script>
    <script src="{{asset('video/js/components/opentok-annotation.js')}}"></script>
    <script src="{{asset('video/js/components/opentok-archiving.js')}}"></script>
    <script src="{{asset('video/js/components/opentok-acc-core.js')}}"></script>
    <script type="text/javascript">
        /* global AccCore */


function goBack() {
  window.history.back();
}

let otCore,s;
const options = {
  // A container can either be a query selector or an HTMLElement
  // eslint-disable-next-line no-unused-vars
  credentials: {
  apiKey:"{{env('VONAGE_API_KEY')}}",
  sessionId: "{{$sessionId}}",
  token: "{{$token}}",
},


  streamContainers: function streamContainers(pubSub, type, data) {
    return {
      publisher: {
        camera: '#cameraPublisherContainer',
        screen: '#screenPublisherContainer',
      },
      subscriber: {
        camera: '#cameraSubscriberContainer',
        screen: '#screenSubscriberContainer',
      },
    }[pubSub][type];
  },
  controlsContainer: '#controls',
  packages: ['textChat', 'screenSharing', 'annotation', 'archiving'],
  communication: {
    callProperties: null, // Using default
  },
  textChat: {
    name: '{{Auth::user()->name}}', // eslint-disable-line no-bitwise
    waitingMessage: 'Messages will be delivered when other users arrive',
    container: '#chat',
  },
  screenSharing: {
    extensionID: 'plocfffmbcclpdifaikiikgplfnepkpo',
    annotation: true,
    externalWindow: false,
    dev: true,
    screenProperties: null, // Using default
  },
  annotation: {

  },
  archiving: {
    startURL: '{{secure_url('/teacher/startArchive')}}',
    stopURL: '{{secure_url('/teacher/stopArchive')}}',
  },
};

/** Application Logic */
const app = function() {
  const state = {
    connected: false,
    active: false,
    end: false,
    publishers: null,
    subscribers: null,
    meta: null,
    localAudioEnabled: true,
    localVideoEnabled: true,
  };

  /**
   * Update the size and position of video containers based on the number of
   * publishers and subscribers specified in the meta property returned by otCore.
   */
  const updateVideoContainers = () => {
    const { meta } = state;
    const sharingScreen = meta ? !!meta.publisher.screen : false;
    const viewingSharedScreen = meta ? meta.subscriber.screen : false;
    const activeCameraSubscribers = meta ? meta.subscriber.camera : 0;

    const videoContainerClass = `App-video-container ${(sharingScreen || viewingSharedScreen) ? 'center' : ''}`;
    document.getElementById('appVideoContainer').setAttribute('class', videoContainerClass);

    const cameraPublisherClass =
      `video-container ${!!activeCameraSubscribers || sharingScreen ? 'small' : ''} ${!!activeCameraSubscribers || sharingScreen ? 'small' : ''} ${sharingScreen || viewingSharedScreen ? 'left' : ''}`;
    document.getElementById('cameraPublisherContainer').setAttribute('class', cameraPublisherClass);

    const screenPublisherClass = `video-container ${!sharingScreen ? 'hidden' : ''}`;
    document.getElementById('screenPublisherContainer').setAttribute('class', screenPublisherClass);

    const cameraSubscriberClass =
      `video-container ${!activeCameraSubscribers ? 'hidden' : ''} active-${activeCameraSubscribers} ${viewingSharedScreen || sharingScreen ? 'small' : ''}`;
    document.getElementById('cameraSubscriberContainer').setAttribute('class', cameraSubscriberClass);

    const screenSubscriberClass = `video-container ${!viewingSharedScreen ? 'hidden' : ''}`;
    document.getElementById('screenSubscriberContainer').setAttribute('class', screenSubscriberClass);
  };


  /**
   * Update the UI
   * @param {String} update - 'connected', 'active', or 'meta'
   */
  const updateUI = (update) => {
    const { connected, active } = state;

    switch (update) {
      case 'connected':
        if (connected) {
          document.getElementById('connecting-mask').classList.add('hidden');
          document.getElementById('start-mask').classList.remove('hidden');
        }
        break;
      case 'active':
        if (active) {
          document.getElementById('cameraPublisherContainer').classList.remove('hidden');
          document.getElementById('start-mask').classList.add('hidden');
          document.getElementById('controls').classList.remove('hidden');
        }
        break;
      case 'meta':
        updateVideoContainers();
        break;
     case 'end':
        console.log('Meeting is End');
        // updateVideoContainers();
        break;
      default:
        console.log('nothing to do, nowhere to go');
    }
  };



// if(options.token == undefined){
//   $(function(){
//     $('body').css('background-color', 'blue !important');
// });
//       $("#myModal").modal('show');  
// }
  /**
   * Update the state and UI
   */
  const updateState = function(updates) {
    Object.assign(state, updates);
    Object.keys(updates).forEach(update => updateUI(update));
console.log(updates);

    @if(Auth::user()->id != $course->user_id)
       // $('#controls div:last').hide();
       // $('#controls div:nth-last-child(2)').hide();
       $('#startScreenSharing').hide();
       $('#enableArchiving').hide();
    @endif
    //sessionDisconnected();
  };

  /**
   * Start publishing video/audio and subscribe to streams
   */
  const startCall = function() {

    otCore.startCall()
      .then(function({ publishers, subscribers, meta }) {

        updateState({ publishers, subscribers, meta, active: true });
        console.log(meta)
        
      }).catch(function(error) { 

    console.log(error)

        });
  };

  /**
   * Toggle publishing local audio
   */
  const toggleLocalAudio = function() {
    const enabled = state.localAudioEnabled;
    otCore.toggleLocalAudio(!enabled);
    updateState({ localAudioEnabled: !enabled });
    const action = enabled ? 'add' : 'remove';
    document.getElementById('toggleLocalAudio').classList[action]('muted');
  };

  /**
   * Toggle publishing local video
   */
  const toggleLocalVideo = function() {
    const enabled = state.localVideoEnabled;
    otCore.toggleLocalVideo(!enabled);
    updateState({ localVideoEnabled: !enabled });
    const action = enabled ? 'add' : 'remove';
    document.getElementById('toggleLocalVideo').classList[action]('muted');
  };

  /**
   * Subscribe to otCore and UI events
   */
  const createEventListeners = function() {
    const events = [
      'subscribeToCamera',
      'unsubscribeFromCamera',
      'subscribeToScreen',
      'unsubscribeFromScreen',
    
    ];
    events.forEach(event => otCore.on(event, ({ subscribers, meta }) => {
      updateState({ subscribers, meta });
    }));

    document.getElementById('start').addEventListener('click', startCall);
    document.getElementById('toggleLocalAudio').addEventListener('click', toggleLocalAudio);
    document.getElementById('toggleLocalVideo').addEventListener('click', toggleLocalVideo);
  };

    const createEventListenerPublishers = function() {
    const events = [
      'subscribeToCamera',
      'unsubscribeFromCamera',
      'subscribeToScreen',
      'unsubscribeFromScreen',
      'startScreenShare',
      'endScreenShare',
    ];
    events.forEach(event => otCore.on(event, ({ publishers, meta }) => {
      updateState({ publishers, meta });
    }));

    document.getElementById('start').addEventListener('click', startCall);
    document.getElementById('toggleLocalAudio').addEventListener('click', toggleLocalAudio);
    document.getElementById('toggleLocalVideo').addEventListener('click', toggleLocalVideo);
  };

s = function s() {

  // updateState({ connected: false });
  otCore.endcall();
 
    alert("Meeting is ended");
    location.href= "{{$course->url}}";
  console.log(state)
  console.log(otCore.state())

  // if (state.capabilities.subscribe == 1) {
                       
  //          alert("You cannot publish an audio-video stream.");
  //     }

    }

                   
  /**
   * Initialize otCore, connect to the session, and listen to events
   */
  const init = function() {
    
     $("#sidebar").hide();
    let session_token = options.credentials.token;
    if(session_token !=""){

    otCore = new AccCore(options);
    otCore.connect().then(function() { updateState({ connected: true }); });
    createEventListeners();
    createEventListenerPublishers();
    } else {
      alert('session is not started');
       window.history.back();
    }
  };

  init();
};

document.addEventListener('DOMContentLoaded', app);

function endMeeting() {
  console.log(otCore);
       otCore.endCall();
    alert("Meeting is ended");
    location.href= "{{url('/teacher/meeting-end/'.$course->class_id)}}";
   
}

function endCall() {
  let r = confirm('Are you sure to leave Meeting');
  if(r==true){
    
    location.href= "{{$course->url}}";
}

  }


  function toggleUsers() {
     $("#sidebar").toggle();

  }



// setTimeout(() => { 
//   if (otCore) {
//   }
//   alert('Your call has ended after the 1 hour limit') 
// }, 10000)

    </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
      <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
  <script>
 
   var pusher = new Pusher('{{env("MIX_PUSHER_APP_KEY")}}', {
      cluster: '{{env("PUSHER_APP_CLUSTER")}}',
      encrypted: true
    });
 
    var channel = pusher.subscribe('end_meeting');
    channel.bind('App\\Events\\Notify', function(data) {
        

        @if(Auth::user()->id != $course->user_id)
        
      alert(data.message);
       location.href= "{{$course->url}}";

      @endif

    });
  </script>
   
</head>

<body>
  <div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Meeting Notification</h5>
               
            </div>
            <div class="modal-body">
                <p>Meeting is not Started.</p>
                 <a type="button" onclick="goBack()" class="btn btn-primary">OK</a>
            </div>
        </div>
    </div>
</div>
    <div class="App">
        <div class="App-header">
            <img src="{{asset('front_assets/images/yocolab-logo.png')}}" class="App-logo" alt="logo" />
            <h1>{{$course->title}}</h1>
        </div>
      <div class="App-main">
            <div class="App-video-container" id="appVideoContainer">
                
                <div id="controls" class='App-control-container hidden'>
                  <div class="audio-vedio-wrapper">
                    <div class="ots-video-control circle audio" id="toggleLocalAudio"></div>
                    <div class="ots-video-control circle video" id="toggleLocalVideo"></div>
                  </div>
                  
                  <div class="ots-video-control circle " id="sidebarCollapse" onclick="toggleUsers()"></div>

                  <div class="end-wrapper">
                    @if(Auth::user()->id == $course->user_id)
                    <div class="ots-video-control circle endMeeting " onclick="endMeeting()"   title="End Meeting"></div>
                    @endif
                    <div class="ots-video-control circle endCall"  onclick="endCall()" title="Leave Meeting"></div>
                  </div>
                </div>


                <div class="App-mask" id="connecting-mask">
                    <progress-spinner dark style="font-size:50px"></progress-spinner>
                    <div class="message with-spinner">Connecting</div>
                </div>
                <div class="App-mask hidden" id="start-mask">
                    <div class="message button clickable" id="start">Click to Start Call</div>
                </div>
                <div id="cameraPublisherContainer" class="video-container hidden"></div>
                <div id="screenPublisherContainer" class="video-container hidden"></div>
                <div id="cameraSubscriberContainer" class="video-container-hidden"></div>
                <div id="screenSubscriberContainer" class="video-container-hidden"></div>
            </div>
            <nav id="sidebar">
              <div class="sidebar-header">
                <h4>Participants </h4>
              </div>
              <div class="sidebar-header1">
              </div>
              <ul class="list-unstyled components">
                <li><img src="https://development.yocolab.com/front_assets/images/user.svg" alt="">{{$virtualClass->user_name ? $virtualClass->user_name:''}} (Host)</li>
                @php  $students = explode(';',$virtualClass->users) ; @endphp
                @if(count($students) > 0)
                  @foreach($students as $stu)
                  <li><img src="https://development.yocolab.com/front_assets/images/user.svg" alt="">{{$stu}}</li>
                  @endforeach
                @endif
              </ul>
            </nav>
            <div id="chat" class="App-chat-container"></div>
        </div>
    </div>

</body>

</html>