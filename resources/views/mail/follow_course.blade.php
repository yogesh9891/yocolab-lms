<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="x-apple-disable-message-reformatting">
    <title></title>
    <style>
        table, td, div, h1, p {font-family: 'Montserrat', sans-serif!important;}
    </style>
</head>
<body style="margin:0;padding:0;">
    <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:url('{{asset('front_assets/images/grad2.jpg')}}'); background-repeat: repeat; background-size: contain;margin-top: 50px;">
        <tr>
            <td align="center" style="padding:0;">
                <table role="presentation" style="width:602px;border-collapse:collapse;border-spacing:0;text-align:left;background:  #ffffff;">
                    <tr>
                        <td style="padding: 15px;width:100%;" align="left" colspan="2">
                            <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0; background: #ffffff;">
                                <tr>
                                    <td style="padding:0;width:100%;">
                                        
                                                                
                                    </td>
                                                            
                                    
                                    </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding:0;background:#18056b;">
                            <img src="{{asset('front_assets/images/yo.png')}}" alt="" width="70" style="height:auto;display:block; position: relative;margin-top: -18px;margin-bottom: -20px;" />
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:36px 30px 42px 30px;">
                            <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                <tr>
                                    <td style="padding:0 0 20px 0;color:#000000; text-align: center;">
                                        <h1 style="font-size:24px;margin: 0;line-height: 1;font-family: 'Montserrat', sans-serif!important;font-weight: 500;">{{$details['heading']}}</h1>
                                        <h2 style="font-size:18px;margin:20px 0 20px 0;font-family: 'Montserrat', sans-serif!important;font-weight: 500;">{{$details['description']}}</h2>                                        
                                    </td>
                                </tr>
                                <tr>
                                    
                                    <td style="padding:0;">
                                        <table role="presentation" style="width: 56%;margin: auto;border-collapse:collapse;border:0;border-spacing:0;border: 2px solid #eeeeee;">
                                            <tr>
                                                <td style="width:260px;padding:0;vertical-align:top;color:#153643; text-align: center margin: auto;" colspan="2">
                                                    <p style="margin:0 auto 0;font-size:16px;line-height:24px;font-family: 'Montserrat', sans-serif!important;"><img src="{{asset('storage/course/'.$details['image'])}}" alt="" width="300" style="height:auto;display:block;margin: auto;" /></p>
                                                    <p style="color: #7e7e7e;font-size: 15px;margin-bottom: 0;font-family: 'Montserrat', sans-serif!important; font-weight: 400; padding: 20px 20px 0 20px;">{{$details['instructor']}}</p>
                                                    @if($details['rating'] > 0)
                                                    <ul style="margin-bottom: 0;list-style: none;padding-left: 20px;margin-top: 0;">
                                                        @for($i=1;$i<=$details['rating'];$i++)
                                                        <li style="margin-right: 4px;font-size: 23px;display: inline-block;color: #ffb100;">
                                                            ☆
                                                        </li>
                                                        @endfor
                                                    
                                                        <li style="margin-right: 4px; color: #555555;font-weight: 400;font-size: 14px;display: inline-block;font-family: 'Montserrat', sans-serif!important;">({{$details['rating']}})</li>
                                                    </ul>
                                                    @endif
                                                    <h4 style="max-height: 50px;font-size: 18px;font-weight: 600;min-height: 50px;font-family: 'Montserrat', sans-serif!important;line-height: 1.42857;color: #0a0a0a;margin-top: 5px;padding-left: 20px; margin-bottom: 0;">{{$details['title']}}</h4>
                                                    {{-- <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family: 'Montserrat', sans-serif;padding: 20px 20px 0 20px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In tempus adipiscing felis, sit amet blandit ipsum volutpat sed. Morbi porttitor, eget accumsan dictum, est nisi libero ultricies ipsum, in posuere mauris neque at erat.</p>
                                                    <p style="margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;padding: 0 20px 20px;"><a href="http://www.example.com" style="color:#ee4c50;text-decoration:underline;">Blandit ipsum volutpat sed</a></p> --}}
                                                </td>

                                               
                                            </tr>

                                            <tr>
                                                <td align="left" style="font-family:'montserrat' , sans-serif!important;padding:0;width:50%;padding-left: 20px; padding-bottom: 20px;">
                                                    <p style="color: #7e7e7e;font-size: 15px;margin-bottom: 5px;font-family:'montserrat' , sans-serif!important;line-height:16px;font-weight: 400;">
                                                      {{$details['date']}} <br>
                                                    </p>
                                                </td>

                                                <td align="right" style="font-family:'montserrat' , sans-serif!important;padding:0;width:50%;padding-right: 20px;padding-bottom: 20px;">
                                                    <p style="color: #7e7e7e;font-size: 15px;margin-bottom: 5px;font-family:'montserrat' , sans-serif!important;line-height:16px;font-weight: 400;">
                                                        {{$details['time']}}<br>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border-top: 1px solid #eeeeee; padding: 20px 20px;" colspan="2">
                                                    <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                                        <tr>
                                                            <td style="padding:0;width:50%;" align="center">
                                                                <a href="{{$details['url']}}" style="color:#ffffff; background:#18056b; padding: 9px 15px; text-align: center; font-size: 14px; text-decoration: none; font-weight: 500;font-family:'montserrat' , sans-serif!important;">Enroll Now</a>
                                                                
                                                            </td>
                                                            
                                                          
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:20px 0 20px 0;color:#000000; text-align: center;">
                                      <small>  Click <a href="{{url('/courses')}}" > here</a> for similar classes   </small>                                   
                                    </td>
                                </tr>

                                <tr>
                                    <td style=" padding: 0;" colspan="2">
                                        <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                            <tr>
                                                
                                                            
                                                <td style="padding:0;width:50%; text-align: center;" >
                                                    <p style="font-size: 14px; color: #000000;     font-family:'montserrat' , sans-serif!important;font-weight: 500;margin-bottom: 0;margin-top: 0;">The Yocolab Team</p>
                                                    <a href="#" style="font-size: 12px; color: #fd6100;     font-family:'montserrat' , sans-serif!important;font-weight: 400;margin-bottom: 0;margin-top: 0; text-decoration: none;">www.yocolab.com</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                            </tr>
                            </table>
                        </td>
                    </tr>
                   
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

    