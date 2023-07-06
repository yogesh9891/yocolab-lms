<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>White Board</title>
    <script type="text/javascript" src="{{ asset('front_assets/js/jquery-3.3.1.js') }}"></script>

</head>
<body>
    <div style="width: 1600px; height: 780px;" id="wt-container"></div>

    <script src="https://www.whiteboard.team/dist/api.js"></script>
    <script type="text/javascript">
        var wt = new api.WhiteboardTeam('#wt-container', {
            clientId: '5066d6d6499e7638977815313f8e6ed0',
            boardCode: '{{time().rand(10000,99999999)}}'
        });

        wt.onReady(() => {
             console.log('ready')
        });
        
        
        // document.getElementById("whiteboard_team").src="{{secure_asset('front_assets/images/yo.png')}}";
        // document.getElementById("whiteboard_team").width="70";
    </script>
</body>
</html>