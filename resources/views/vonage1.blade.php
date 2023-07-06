<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>OT Accelerator Core</title>

    <link rel="stylesheet" href="{{asset('video/css/style.css')}}">
    <link rel="stylesheet" href="https://assets.tokbox.com/solutions/css/style.css">
    <script src="https://static.opentok.com/v2/js/opentok.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/livestamp/1.1.2/livestamp.min.js"></script>
    <script src="{{asset('video/js/components/opentok-solutions-logging.js')}}"></script>
    <script src="{{asset('video/js/components/opentok-text-chat.js')}}"></script>
    <script src="{{asset('video/js/components/opentok-screen-sharing.js')}}"></script>
    <script src="{{asset('video/js/components/opentok-annotation.js')}}"></script>
    <script src="{{asset('video/js/components/opentok-archiving.js')}}"></script>
    <script src="{{asset('video/js/components/opentok-acc-core.js')}}"></script>
    <script type="text/javascript">
        /* global AccCore */

let otCore;
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
    startURL: 'https://example.com/startArchive',
    stopURL: 'https://example.com/stopArchive',
  },
};

/** Application Logic */
const app = function() {
  const state = {
    connected: false,
    active: false,
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
      default:
        console.log('nothing to do, nowhere to go');
    }
  };

  /**
   * Update the state and UI
   */
  const updateState = function(updates) {
    Object.assign(state, updates);
    Object.keys(updates).forEach(update => updateUI(update));
  };

  /**
   * Start publishing video/audio and subscribe to streams
   */
  const startCall = function() {
    otCore.startCall()
      .then(function({ publishers, subscribers, meta }) {
        updateState({ publishers, subscribers, meta, active: true });
        
      }).catch(function(error) { 

       console.log(error);
       if(error.code==1500){

        alert('Meeting is not strated');
       }

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
      'startScreenShare',
      'endScreenShare',
    ];
    events.forEach(event => otCore.on(event, ({ publishers, subscribers, meta }) => {
      updateState({ publishers, subscribers, meta });
    }));

    document.getElementById('start').addEventListener('click', startCall);
    document.getElementById('toggleLocalAudio').addEventListener('click', toggleLocalAudio);
    document.getElementById('toggleLocalVideo').addEventListener('click', toggleLocalVideo);
  };

  /**
   * Initialize otCore, connect to the session, and listen to events
   */
  const init = function() {
    otCore = new AccCore(options);
    otCore.connect().then(function() { updateState({ connected: true }); });
    createEventListeners();
  };

  init();
};

document.addEventListener('DOMContentLoaded', app);

function endCall(){


   if (!confirm("Are you sure end this meeting ")) {
            e.preventDefault();
        } else {
 otCore.endCall()

        }

    // .then(function({ publishers, subscribers, meta }) {
    //  console(meta)
        
    //   }).catch(function(error) { 

    //    console.log(error);
       

    //     });
}

// setTimeout(() => { 
//   if (otCore) {
//   }
//   alert('Your call has ended after the 1 hour limit') 
// }, 10000)

    </script>
   
</head>

<body>
    <div class="App">
        <div class="App-header">
            <img src="{{asset('front_assets/images/yocolab-logo.png')}}" class="App-logo" alt="logo" />
            <h1>{{$course->title}}</h1>
        </div>
        <div class="App-main">
                <div class=" calEnded" id="" style=" background-image:url('https://image.flaticon.com/icons/png/128/523/523086.png');background-size: cover; " onclick="endCall()"></div>
            <div id="controls" class='App-control-container hidden'>
                <div class="ots-video-control circle audio" id="toggleLocalAudio"></div>
                <div class="ots-video-control circle video" id="toggleLocalVideo"></div>
              
            </div>
            <div class="App-video-container" id="appVideoContainer">
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
            <div id="chat" class="App-chat-container"></div>
        </div>
    </div>

</body>

</html>