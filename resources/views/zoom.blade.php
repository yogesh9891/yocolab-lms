<!DOCTYPE html>

<head>
    <title>Yocolab - {{$data->title}}</title>
    <meta charset="utf-8" />
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.9.0/css/bootstrap.css" />
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.9.0/css/react-select.css" />
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="origin-trial" content="">
    <style type="text/css">
       
    </style>
</head>
{{-- <nav id="nav-tool" class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
           <img src="{{asset('front_assets/images/yocolab-logo.png')}}" class="App-logo" alt="logo" />
        </div>
        <div class="navbar-form navbar-right">
           
            <h5>Live Class Title :{{$data->title}}</h5>
        </div>
    </div>
    
</nav> --}}
<body>
    <script src="https://source.zoom.us/1.9.0/lib/vendor/react.min.js"></script>
    <script src="https://source.zoom.us/1.9.0/lib/vendor/react-dom.min.js"></script>
    <script src="https://source.zoom.us/1.9.0/lib/vendor/redux.min.js"></script>
    <script src="https://source.zoom.us/1.9.0/lib/vendor/redux-thunk.min.js"></script>
    <script src="https://source.zoom.us/1.9.0/lib/vendor/lodash.min.js"></script>
    <script src="https://source.zoom.us/zoom-meeting-1.9.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>

   <script type="text/javascript">

let API_KEY = "{{$data->APP_ID}}";
let API_SECRET = "{{$data->APP_SECRET}}";
let API_URL = "{{env('APP_URL')}}";
let role = "{{$data->role}}";




          ZoomMtg.preLoadWasm();
         ZoomMtg.prepareJssdk();

         var meetingConfig = {

            apiKey:API_KEY,
            apiSecret:API_SECRET,
            meetingNumber:'{{$data->mn}}',
            userName:'{{$data->name}}',
            passWord:'{{$data->password}}',
            leaveUrl:'{{$data->url}}' ,
            duration:40,
            role:{{$data->role}}
         };

          var signature = ZoomMtg.generateSignature({
      meetingNumber: meetingConfig.meetingNumber,
      apiKey: API_KEY,
      apiSecret: API_SECRET,
      role: meetingConfig.role,
      success: function (res) {

        
      }
    });

          ZoomMtg.init({
                leaveUrl: meetingConfig.leaveUrl,
                isSupportAV: true,
                isShowJoiningErrorDialog: false,
                disableInvite:true,
                success: function() {

                    ZoomMtg.join({
                        signature: signature,
                        apiKey: meetingConfig.apiKey,
                        meetingNumber: meetingConfig.meetingNumber,
                        userName: meetingConfig.userName,
                        // password optional; set by Host
                        passWord: meetingConfig.passWord ,
                        error(res) { 
                            console.log(res) 
                        swal({
                        title: "Alert",
                        text:'Kindly wait for the instructor to start the class',
                        icon: "warning",
                       
                        button: "Ok!",
                      }).then((willDelete) => {
                        window.history.back();
                      });
                        }

                      ,
                      success(res){
                        console.log($('.leave-meeting-options__btn'))
                       if($('.meeting-info-container')){ $('.meeting-info-container').hide()}
                      }
                    }) 

                    }
                    }) 

            ZoomMtg.inMeetingServiceListener('onMeetingStatus', function (data) {
    console.log('inMeetingServiceListener onMeetingStatus', data);
  })


      function myTimer() {

 
setInterval(function(){  }, 1000);
       
 
}


   </script>

</html>